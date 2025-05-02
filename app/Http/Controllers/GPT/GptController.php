<?php

namespace App\Http\Controllers\GPT;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use League\CommonMark\CommonMarkConverter;

class GptController extends Controller
{
    public function ask(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:png',
            'prompt' => 'required|string',
        ]);

        // dd($request->all());

        $file = $request->file('image');
        $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads'), $fileName);
        $imagePath = public_path("uploads/{$fileName}");

        $response = Http::withToken(config('services.openai.api_key'))
            ->asMultipart()
            ->attach('image', file_get_contents($imagePath), 'input.png')
            ->post('https://api.openai.com/v1/images/edits', [
                ['name' => 'prompt', 'contents' => $request->prompt],
                ['name' => 'n', 'contents' => 1],
                ['name' => 'size', 'contents' => '1024x1024'],
                ['name' => 'model', 'contents' => 'dall-e-2'],
            ]);

        $responseJson = $response->json();
        $imageUrl = $responseJson['data'][0]['url'] ?? null;

        if ($imageUrl) {
            return redirect()->back()->with('image_url', $imageUrl);
        } else {
            $errorMsg = $responseJson['error']['message'] ?? 'Image editing failed. Please try again.';
            return redirect()->back()->with('error', $errorMsg);
        }
    }

    public function Index()
    {
        return view('dashboard.askgpt');
    }

    public function PropDetails()
    {
        return view('dashboard.propertydetails');
    }



    public function PropertyDetailsResponse(Request $request)
{

    // Validate the input
    $validated = $request->validate([
        'propert_type' => 'required|string|max:255',    // Validate property type
        'location' => 'required|string|max:255',        // Validate location
        'plot_size' => 'required|numeric|min:1',        // Validate plot size in m²
        'living_area' => 'required|numeric|min:1',      // Validate living area in m²
        'details' => 'required|string|max:1000',        // Validate other details (amenities, construction year, etc.)
        'text_tone' => 'required|in:classic,sales-oriented,exclusive', // Validate tone of text
        'image' => 'nullable|mimes:jpeg,png|max:10240', // Validate image (optional)
        'shorten_text' => 'nullable|boolean',           // Validate shorten_text checkbox (optional)
    ]);

    $shorten_text = $request->input('shorten_text', false);

    // Check if there is an image and handle it
    if ($request->hasFile('image')) {
        $file = $request->file('image');
        $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads'), $fileName);
        $imagePath = public_path("uploads/{$fileName}");

        // Encode image to base64
        $imageData = base64_encode(file_get_contents($imagePath));
        $imageMime = mime_content_type($imagePath);
    } else {
        // If no image uploaded, set the data to null
        $imageData = null;
        $imageMime = null;
    }

    // Prepare the content for GPT-4 prompt
    $textContent = "
        Create an appealing real estate description based on the following information: $request->propert_type, $request->location, $request->plot_size, $request->living_area, $request->details. if shorten text (true) $shorten_text The text should be between 1100 and 1400 characters in total else if false its upto you, well-structured, the tone should be $request->text_tone. Use clear language, short paragraphs, and avoid bullet points. Address the reader directly and highlight the key features of the property and if the image is uploaded than give the text according to the image too.
    ";

    // Make a POST request to GPT-4 API
    $response = Http::withToken(config('services.openai.api_key'))
        ->post('https://api.openai.com/v1/chat/completions', [
            'model' => 'gpt-4-turbo',
            'messages' => [
                [
                    'role' => 'user',
                    'content' => $textContent,
                ],
            ],
            'max_tokens' => 1000,
        ]);

        return $response->json();
    // Get the response content from GPT-4
    $reply = $response->json('choices.0.message.content') ?? 'No prompt generated.';

    // Convert the response content to Markdown format if needed
    $converter = new CommonMarkConverter();
    $formattedReply = $converter->convert($reply)->getContent();

    // Return the response with the formatted reply
    return view('dashboard.property-desc-gen-results', compact('formattedReply'));
}

}
