<?php

namespace App\Http\Controllers\media;

use App\Http\Controllers\Controller;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MediaController extends Controller
{
    public function ViewMedia()
    {
        $loggedUser = Auth::user()->id;
        $media = Media::where('uploaded_by', $loggedUser)->get();
        return view('dashboard.view-media', compact('media'));
    }

    public function UploadMedia()
    {
        return view('dashboard.upload-media');
    }

    public function ProcessUploadMedia(Request $request)
    {
        $request->validate([
            'filename' => 'required|array', // Ensure it's an array
            'filename.*' => 'required|file|max:10000|mimes:jpeg,png,jpg,gif,svg,mp4,webm,ogg,mp3,wav,flac,3gp,avi,wmv,mov,flv,ts,mpg,mpeg,webp,pdf,docx,csv,rar,zip',
        ]);

        $uploadedFiles = [];

        foreach ($request->file('filename') as $file) {
            $filename = time() . '_' . $file->getClientOriginalName();
            $mimeType = $file->getMimeType();
            $size = $file->getSize(); // File size in bytes
            $fileType = explode('/', $mimeType)[0]; // 'image', 'video', 'audio', etc.

            // Store file directly in public/dashboard/uploads/
            $destinationPath = public_path('dashboard/uploads');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0775, true);
            }

            $file->move($destinationPath, $filename);

            $media = Media::create([
                'filename' => $filename,
                'file_type' => $fileType,
                'mime_type' => $mimeType,
                'size' => $size,
                'uploaded_by' => Auth::id(),
            ]);

            $uploadedFiles[] = $media;
        }

        return redirect()->back()->with('success', 'Media uploaded successfully');
    }

    public function destroy($id)
    {
        $media = Media::findOrFail($id);

        // Delete file from public folder
        $filePath = public_path('dashboard/uploads/' . $media->filename);
        if (file_exists($filePath)) {
            unlink($filePath);
        }

        // Delete from database
        $media->delete();

        return redirect()->back()->with('success', 'File deleted successfully.');
    }


    public function ProcessUploadTaskMedia(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'filename' => 'required|array',
            'filename.*' => 'required|file|max:10000|mimes:jpeg,png,jpg,gif,svg,mp4,webm,ogg,mp3,wav,flac,3gp,avi,wmv,mov,flv,ts,mpg,mpeg,webp,pdf,docx,csv,rar,zip',
        ]);

        $uploadedFiles = [];

        foreach ($request->file('filename') as $file) {
            $filename = time() . '_' . $file->getClientOriginalName();
            $mimeType = $file->getMimeType();
            $size = $file->getSize(); // File size in bytes
            $fileType = explode('/', $mimeType)[0]; // 'image', 'video', 'audio', etc.

            // Store the file in the public/dashboard/uploads/ directory
            $destinationPath = public_path('dashboard/uploads');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0775, true);
            }

            $file->move($destinationPath, $filename);

            // Create an entry in the database
            $media = Media::create([
                'filename' => $filename,
                'file_type' => $fileType,
                'mime_type' => $mimeType,
                'size' => $size,
                'uploaded_by' => Auth::id(),
            ]);
        }

        // Return success response
        return response()->json(['success' => true]);
    }


    public function ajaxUpload(Request $request)
    {
        $request->validate([
            'filename' => 'required|array',
            'filename.*' => 'required|file|max:10000|mimes:jpeg,png,jpg,gif,svg,mp4,webm,ogg,mp3,wav,flac,3gp,avi,wmv,mov,flv,ts,mpg,mpeg,webp,pdf,docx,csv,rar,zip',
        ]);

        foreach ($request->file('filename') as $file) {
            $filename = time() . '_' . $file->getClientOriginalName();
            $mimeType = $file->getMimeType();
            $size = $file->getSize();
            $fileType = explode('/', $mimeType)[0];

            // Save to public folder
            $file->move(public_path('dashboard/uploads'), $filename);

            Media::create([
                'filename' => $filename,
                'file_type' => $fileType,
                'mime_type' => $mimeType,
                'size' => $size,
                'uploaded_by' => Auth::id(),
            ]);
        }

        return response()->json(['success' => true]);
    }

    public function getMediaGallery()
    {
        $loggedUser = Auth::user()->id;
        $mediaItems = Media::where('uploaded_by', $loggedUser)->get();// or filter as per your requirements

        // Return the media items as JSON
        return response()->json($mediaItems);
    }
    
       public function filterByCategory(Request $request)
    {
        $category = $request->category;

        $media = $category
            ? Media::where('category', $category)->get()
            : Media::all();

        return view('dashboard.media._media_cards', compact('media'))->render();
    }
}
