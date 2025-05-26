<?php

namespace App\Http\Controllers\Social;

use Carbon\Carbon;
use App\Http\Controllers\Controller; // ← This was missing
use Illuminate\Http\Request;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;



class SocialController extends Controller
{
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')
            ->scopes(['email', 'public_profile', 'pages_manage_posts', 'pages_read_engagement'])
            ->redirect();
    }

    public function handleFacebookCallback()
    {
        $fbUser = Socialite::driver('facebook')->user();

        dd($fbUser);
        // Step 1: Get short-lived token
        $shortToken = $fbUser->token;



        // Step 2: Exchange for long-lived token
        $response = Http::get('https://graph.facebook.com/v18.0/oauth/access_token', [
            'grant_type' => 'fb_exchange_token',
            'client_id' => config('services.facebook.client_id'),
            'client_secret' => config('services.facebook.client_secret'),
            'fb_exchange_token' => $shortToken,
        ]);

        //   dd([
        //     'client_id' => config('services.facebook.client_id'),
        //     'client_secret' => config('services.facebook.client_secret'),
        // ]);


        // Step 3: Check response
        if (isset($response['access_token'])) {
            $longLivedToken = $response['access_token'];

            $loggedID = Auth::id();
            $loggedUser = User::find($loggedID);

            if ($loggedUser) {
                // Save the long-lived token
                $loggedUser->access_token = $longLivedToken;
                $loggedUser->save(); // ✅ You don't need update() here
            }


            // return response()->json([
            //     'name' => $fbUser->name,
            //     'email' => $fbUser->email,
            //     'id' => $fbUser->id,
            //     'short_token' => $shortToken,
            //     'long_lived_token' => $longLivedToken,
            //     'avatar' => $fbUser->avatar,
            // ]);

            return redirect()->route('facebook.login.check');
        } else {
            return response()->json([
                'error' => 'Failed to get long-lived token',
                'details' => $response->json(),
            ]);
        }
    }




    public function postToPage(Request $request)
    {
        $user = Auth::user();

        // Get user's Facebook pages
        $pages = Http::get('https://graph.facebook.com/v18.0/me/accounts', [
            'access_token' => $user->access_token,
        ])->json();

        if (empty($pages['data'])) {
            return back()->with('error', 'No Facebook pages found!');
        }

        $pageId = $pages['data'][0]['id'];
        $pageAccessToken = $pages['data'][0]['access_token'];

        // Handle scheduled time (optional)
        $utcTime = null;
        if ($request->filled('scheduled_time')) {
            $localTime = $request->input('scheduled_time');
            $timeZone = $request->input('timezone');
            $utcTime = Carbon::createFromFormat('Y-m-d\TH:i', $localTime, $timeZone)
                ->setTimezone('UTC')
                ->timestamp;
        }

        $postData = [
            'message' => $request->input('message'),
            'access_token' => $pageAccessToken,
        ];

        if ($utcTime) {
            $postData['scheduled_publish_time'] = $utcTime;
            $postData['published'] = false;
        }

        $mediaIds = [];

        // Handle media uploads (image/video)
        if ($request->hasFile('media')) {
            foreach ($request->file('media') as $file) {
                $mime = $file->getMimeType();
                $filePath = $file->getRealPath();
                $fileName = $file->getClientOriginalName();

                if (str_starts_with($mime, 'image')) {
                    // Upload image as unpublished
                    $uploadResponse = Http::attach('source', file_get_contents($filePath), $fileName)
                        ->post("https://graph.facebook.com/{$pageId}/photos", [
                            'published' => false,
                            'access_token' => $pageAccessToken,
                        ])->json();

                    if (isset($uploadResponse['id'])) {
                        $mediaIds[] = ['media_fbid' => $uploadResponse['id']];
                    }
                } elseif (str_starts_with($mime, 'video')) {
                    // Upload video directly (with or without scheduling)
                    $videoData = [
                        'description' => $request->input('message'),
                        'access_token' => $pageAccessToken,
                    ];

                    if ($utcTime) {
                        $videoData['scheduled_publish_time'] = $utcTime;
                        $videoData['published'] = false;
                    }

                    $videoResponse = Http::attach('source', file_get_contents($filePath), $fileName)
                        ->post("https://graph.facebook.com/{$pageId}/videos", $videoData);

                    if (!$videoResponse->successful()) {
                        return back()->with('error', 'Failed to upload video.');
                    }
                }
            }

            // If there are image media IDs, attach them to a post
            if (!empty($mediaIds)) {
                $postData['attached_media'] = $mediaIds;
                $response = Http::post("https://graph.facebook.com/{$pageId}/feed", $postData);
            } else {
                // Only videos posted already above
                $response = ['success' => true];
            }
        } else {
            // No media - just text post
            $response = Http::post("https://graph.facebook.com/{$pageId}/feed", $postData);
        }

        if (isset($response['success']) && $response['success'] === true || (is_object($response) && $response->successful())) {
            return back()->with('success', $utcTime ? 'Post scheduled on Facebook!' : 'Post published on Facebook!');
        }

        return back()->with('error', 'Failed to post on Facebook.');
    }



    public function PrivacyPolicy()
    {
        return view('dashboard.privacy-policy');
    }


    public function FacebookLoginCheck()
    {
        $user = Auth::user();
        // $pages = Http::get("https://graph.facebook.com/v19.0/me/accounts", [
        //     'access_token' => $user->access_token
        // ]);


        // $pageId = $pages['data'][0]['id']; 



        return view('dashboard.facebook-post');
    }

    public function dataDeletion(Request $request)
    {
        $signed_request = $request->input('signed_request');
        $data = parse_signed_request($signed_request);

        // User ID mil jayega
        $user_id = $data['user_id'];

        return view('dashboard.data-deletion', ['user_id' => $user_id]);
    }



    //Instagram Work From here


    public function CreateInstaPost()
    {
        return view('dashboard.insta-post');
    }

    public function postToInstagram(Request $request)
    {
        $user = Auth::user();

        // Get Facebook Access Token from User (used for both Facebook and Instagram)
        $accessToken = $user->access_token;

        // Prepare the post data
        $message = $request->input('message');
        $media = $request->file('media');

        // Upload media to Instagram using the Facebook API
        if ($media) {
            $mediaFile = file_get_contents($media->getRealPath());
            $mediaName = $media->getClientOriginalName();

            // Upload the media file to Instagram
            $uploadResponse = Http::attach('source', $mediaFile, $mediaName)
                ->post("https://graph.facebook.com/v18.0/{$user->instagram_user_id}/media", [
                    'image_url' => $mediaFile, // For image posts
                    'caption' => $message,
                    'access_token' => $accessToken,
                ]);

            return ($uploadResponse);

            if ($uploadResponse->successful()) {
                $mediaId = $uploadResponse['id'];

                // Create a post on Instagram
                $publishResponse = Http::post("https://graph.facebook.com/v18.0/{$user->instagram_user_id}/media_publish", [
                    'creation_id' => $mediaId,
                    'access_token' => $accessToken,
                ]);

                if ($publishResponse->successful()) {
                    return back()->with('success', 'Post uploaded successfully!');
                } else {
                    return back()->with('error', 'Failed to publish the post on Instagram.');
                }
            }

            return back()->with('error', 'Failed to upload media to Instagram.');
        }

        return back()->with('error', 'No media selected for posting.');
    }
}
