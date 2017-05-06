<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Google_Client;
use Google_Service_YouTube;
use Google_Service_YouTube_Video;
use Google_Service_YouTube_VideoSnippet;
use Google_Service_Exception;
use Google_Exception;
use Google_Service_YouTube_VideoStatus;
use Google_Http_MediaFileUpload;
use Illuminate\Support\Facades\Session;
use App\Traits\GoogleAuthTrait;


class VideoController extends Controller
{

    use GoogleAuthTrait;

    public function __construct()
    {
        $this->middleware('auth');
    }


    /*public function uploadVideo(Request $request)
    {
        set_time_limit(0);

        $chemin = null;

        $OAUTH2_CLIENT_ID = env('OAUTH2_CLIENT_ID');
        $OAUTH2_CLIENT_SECRET = env('OAUTH2_CLIENT_SECRET');

        $client = new Google_Client();
        $client->setClientId($OAUTH2_CLIENT_ID);
        $client->setClientSecret($OAUTH2_CLIENT_SECRET);
        $client->setAccessType('offline');
        $client->setApprovalPrompt('force');
        $client->setScopes('https://www.googleapis.com/auth/youtube');
        $redirect = filter_var('http://assovogt.org/video/get_token', FILTER_SANITIZE_URL);
        $client->setRedirectUri($redirect);
        Session::set('redirect', 'http://assovogt.org/tester');

        $youtube = new Google_Service_YouTube($client);

        if ($token = json_decode(env('GOOGLE_TOKEN'), true)) {

            $client->setAccessToken($token);
        }

        if ($client->getAccessToken()) {

            if ($request->file('video') == null) {

                return Redirect::back()->with(['message' => 'video is null']);
            }

            $this->videoValidator($request->allFiles())->validate();

            try{

                $snippet = new Google_Service_YouTube_VideoSnippet();
                $snippet->setTitle("seconde video");
                $snippet->setDescription("second test d'upload");
                $snippet->setTags(array("tag1", "tag2"));

                $snippet->setCategoryId("22");

                // Set the video's status to "public". Valid statuses are "public",
                // "private" and "unlisted".
                $status = new Google_Service_YouTube_VideoStatus();
                $status->privacyStatus = "public";

                // Associate the snippet and status objects with a new video resource.
                $video = new Google_Service_YouTube_Video();
                $video->setSnippet($snippet);
                $video->setStatus($status);


                $chunkSizeBytes = 10 * 1024 * 1024;

                // Setting the defer flag to true tells the client to return a request which can be called
                // with ->execute(); instead of making the API call immediately.
                $client->setDefer(true);

                // Create a request for the API's videos.insert method to create and upload the video.
                $insertRequest = $youtube->videos->insert("status,snippet", $video);

                // Create a MediaFileUpload object for resumable uploads.
                $media = new Google_Http_MediaFileUpload(
                    $client,
                    $insertRequest,
                    'video/*',
                    null,
                    true,
                    $chunkSizeBytes
                );
                $media->setFileSize($request->file('video')->getSize());

                // Read the media file and upload it chunk by chunk.
                $status = false;
                $handle = $request->file('video')->openFile('rb');
                while (!$status && !$handle->eof()) {
                    $chunk = $handle->fread($chunkSizeBytes);
                    $status = $media->nextChunk($chunk);
                }

                // If you want to make other calls after the file upload, set setDefer back to false
                $client->setDefer(false);

                $htmlBody = "<h3>Video Uploaded</h3><ul>";
                $htmlBody .= sprintf('<li>%s (%s)</li>', $status['snippet']['title'], $status['id']);

                $htmlBody .= '</ul>';

                return Redirect::back()->with(['message' => $htmlBody]);

            } catch (Google_Service_Exception $e) {
                $htmlBody = sprintf('<p>A service error occurred: <code>%s</code></p>',
                    htmlspecialchars($e->getMessage()));
            } catch (Google_Exception $e) {
                $htmlBody = sprintf('<p>An client error occurred: <code>%s</code></p>',
                    htmlspecialchars($e->getMessage()));
            }

            return Redirect::back()->with(['message' => $htmlBody]);

        }  else {

            $authUrl = $client->createAuthUrl();
            $htmlBody = "<h3>Autorisation requise</h3>
                <p>Vous devez <a href=\"$authUrl\">autoriser l'accès</a> avant de continuer.<p>";

            return Redirect::back()->with(['message' => $htmlBody]);
        }
    }

    /*public function getToken()
    {
        set_time_limit(0);
        $OAUTH2_CLIENT_ID = env('OAUTH2_CLIENT_ID');
        $OAUTH2_CLIENT_SECRET = env('OAUTH2_CLIENT_SECRET');

        $client = new Google_Client();
        $client->setClientId($OAUTH2_CLIENT_ID);
        $client->setClientSecret($OAUTH2_CLIENT_SECRET);
        $client->setAccessType('offline');
        $client->setApprovalPrompt('force');
        $client->setScopes('https://www.googleapis.com/auth/youtube');
        $redirect = filter_var('http://assovogt.org/video/get_token', FILTER_SANITIZE_URL);
        $client->setRedirectUri($redirect);

        if (isset($_GET['code'])) {

            $client->authenticate($_GET['code']);

            $token = $client->getAccessToken();

            $path = base_path('.env');

            $str = str_replace('GOOGLE_TOKEN=' . env('GOOGLE_TOKEN'), 'GOOGLE_TOKEN=' . json_encode($token), file_get_contents($path));

            if (file_exists($path)) {
                file_put_contents($path, $str);
            }

            header('Location: ' . Session::get('redirect'));

            exit;
        }

    }*/


    public static function videoValidator(array $data)
    {

        $validator = Validator::make($data,
            [
                'video'               => 'mimes:mp4|max:5000',
            ],
            [
                'video.mimes'     => 'Les extensions d\'images acceptées sont mp4',
                'video.max'       => 'La taille de la vidéo ne doit pas excéder 5 Mo',
            ]
        );

        return $validator;
    }

    public function uploadVideo(Request $request)
    {
        $this->execute('http://assovogt.org/tester', function(Google_Client $client, Google_Service_YouTube $youtube) use($request){

            if ($request->file('video') == null) {

                return Redirect::back()->with(['message' => 'video is null']);
            }

            VideoController::videoValidator($request->allFiles())->validate();

            try{

                $snippet = new Google_Service_YouTube_VideoSnippet();
                $snippet->setTitle("seconde video");
                $snippet->setDescription("second test d'upload");
                $snippet->setTags(array("tag1", "tag2"));

                $snippet->setCategoryId("22");

                // Set the video's status to "public". Valid statuses are "public",
                // "private" and "unlisted".
                $status = new Google_Service_YouTube_VideoStatus();
                $status->privacyStatus = "public";

                // Associate the snippet and status objects with a new video resource.
                $video = new Google_Service_YouTube_Video();
                $video->setSnippet($snippet);
                $video->setStatus($status);


                $chunkSizeBytes = 10 * 1024 * 1024;

                // Setting the defer flag to true tells the client to return a request which can be called
                // with ->execute(); instead of making the API call immediately.
                $client->setDefer(true);

                // Create a request for the API's videos.insert method to create and upload the video.
                $insertRequest = $youtube->videos->insert("status,snippet", $video);

                // Create a MediaFileUpload object for resumable uploads.
                $media = new Google_Http_MediaFileUpload(
                    $client,
                    $insertRequest,
                    'video/*',
                    null,
                    true,
                    $chunkSizeBytes
                );
                $media->setFileSize($request->file('video')->getSize());

                // Read the media file and upload it chunk by chunk.
                $status = false;
                $handle = $request->file('video')->openFile('rb');
                while (!$status && !$handle->eof()) {
                    $chunk = $handle->fread($chunkSizeBytes);
                    $status = $media->nextChunk($chunk);
                }

                // If you want to make other calls after the file upload, set setDefer back to false
                $client->setDefer(false);

                $htmlBody = "<h3>Video Uploaded</h3><ul>";
                $htmlBody .= sprintf('<li>%s (%s)</li>', $status['snippet']['title'], $status['id']);

                $htmlBody .= '</ul>';

                return Redirect::back()->with(['message' => $htmlBody]);

            } catch (Google_Service_Exception $e) {
                $htmlBody = sprintf('<p>A service error occurred: <code>%s</code></p>',
                    htmlspecialchars($e->getMessage()));
            } catch (Google_Exception $e) {
                $htmlBody = sprintf('<p>An client error occurred: <code>%s</code></p>',
                    htmlspecialchars($e->getMessage()));
            }

            return Redirect::back()->with(['message' => $htmlBody]);

        });

        return Redirect::back();
    }
}
