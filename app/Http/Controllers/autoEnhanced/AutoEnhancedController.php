<?php

namespace App\Http\Controllers\autoEnhanced;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AutoEnhancedController extends Controller
{

    public function enhanceImage(Request $request)
    {
        // Step 1: Validate request
        $request->validate([
            'image' => 'required|image|mimes:jpeg,jpg,png',
        ]);

        $image = $request->file('image');
        $originalName = time() . '_' . $image->getClientOriginalName();
        $mimeType = $image->getClientMimeType();
        // $orderId = Str::uuid(); // You can store this if needed later

        // Step 2: Register image with Autoenhance
        $registerResponse = Http::withHeaders([
            'x-api-key' => env('AUTOENHANCE_API_KEY'),
            'Content-Type' => 'application/json',
        ])->post('https://api.autoenhance.ai/v3/images/', [
            'image_name' => $originalName,
            'contentType' => $mimeType,

        ]);

        if (!$registerResponse->successful()) {
            return response()->json([
                'message' => 'Failed to register image with Autoenhance.',
                'error' => $registerResponse->json(),
            ], 500);
        }

        $registerData = $registerResponse->json();
        $uploadUrl = $registerData['s3PutObjectUrl'] ?? null;
        $imageId = $registerData['image_id'] ?? null;

        if (!$uploadUrl || !$imageId) {
            return response()->json([
                'message' => 'Missing signed URL or image ID in response',
                'response' => $registerData,
            ], 500);
        }

        // Step 3: Upload RAW image to S3 using PUT
        $uploadResponse = Http::withHeaders([
            'Content-Type' => $mimeType,
        ])->withBody(
            file_get_contents($image->getRealPath()), // RAW binary
            $mimeType
        )->put($uploadUrl);

        if ($uploadResponse->status() !== 200) {
            return response()->json([
                'message' => 'S3 Upload Failed',
                'error' => $uploadResponse->body(),
                'status_code' => $uploadResponse->status()
            ], 500);
        }

        // Step 4: Poll the processing status
        $statusUrl = "https://api.autoenhance.ai/v3/images/{$imageId}";
        $statusResponse = Http::withHeaders([
            'x-api-key' => env('AUTOENHANCE_API_KEY'),
            'Content-Type' => 'application/json',
        ])->get($statusUrl);

        if (!$statusResponse->successful()) {
            return response()->json([
                'message' => 'Failed to check image status',
                'error' => $statusResponse->json(),
            ], 500);
        }

        $statusData = $statusResponse->json();
        // dd($statusData);
        $status = $statusData['status'] ?? 'pending';
        

        if ($status === 'processing') {
            // Step 5: Download the enhanced image
            $enhancedImageUrl = "https://api.autoenhance.ai/v3/images/{$imageId}/enhanced";
            $enhancedImageResponse = Http::withHeaders([
                'x-api-key' => env('AUTOENHANCE_API_KEY'),
                'Content-Type' => 'application/json',
            ])->get($enhancedImageUrl);

            if (!$enhancedImageResponse->successful()) {
                return response()->json([
                    'image_id' => $imageId,
                    'message' => 'Failed to download enhanced image',
                    'error' => $enhancedImageResponse->json(),
                ], 500);
            }

            // Step 6: Return enhanced image data (base64 OR direct download link etc.)
            return response()->json([
                'message' => 'Image enhanced successfully.',
                'image_id' => $imageId,
                'enhanced_image_base64' => base64_encode($enhancedImageResponse->body()),
            ]);
        }

        // If still processing
        return response()->json([
            'image_id' => $imageId,
            'message' => 'Image is still being processed.',
            'status' => $status,
        ]);
    }

    public function previewEnhancedImage($imageId)
    {
        $response = Http::withHeaders([
            'x-api-key' => env('AUTOENHANCE_API_KEY'),
            'Content-Type' => 'application/json',
        ])->get("https://api.autoenhance.ai/v3/images/{$imageId}/preview");


        if ($response->successful()) {
            $imageData = $response->body(); // raw image
            $base64 = base64_encode($imageData);
            $mime = 'image/jpeg'; // default — you can dynamically get it if needed

            return response()->json([
                'preview_url' => "data:{$mime};base64,{$base64}",
            ]);
        } else {
            return response()->json([
                'message' => 'Image not ready yet or failed.',
                'status' => $response->status(),
                'body' => $response->body(),
            ], 500);
        }
    }

    public function AutoEnhanceForm()
    {
        return view('dashboard.autoenhanced');
    }

    public function AutoEnhanceFormJS()
    {
        $apikey = env('AUTOENHANCE_API_KEY');
        return view('dashboard.autoEnhanceApi', compact('apikey'));
    }
}
