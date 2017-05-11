<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Google_Client;
use Google_Service_YouTube;
use Google_Service_YouTube_Video;
use Google_Service_YouTube_VideoSnippet;
use Google_Service_YouTube_PlaylistItem;
use Google_Service_YouTube_PlaylistItemSnippet;
use Google_Service_Exception;
use Google_Exception;
use Google_Service_YouTube_VideoStatus;
use Google_Http_MediaFileUpload;
use App\Traits\GoogleAuthTrait;




class VideoController extends Controller
{

    use GoogleAuthTrait;


    public function __construct()
    {
        $this->middleware('auth');
    }

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
                $snippet->setTitle($request->get('title'));
                $snippet->setDescription($request->get('description'));
                $snippet->setTags(array("tag1", "tag2"));

                $snippet->setCategoryId("22");

                // Set the video's status to "public". Valid statuses are "public",
                // "private" and "unlisted".
                $status = new Google_Service_YouTube_VideoStatus();
                $status->privacyStatus = "unlisted";

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

                $resourceId = new \Google_Service_YouTube_ResourceId();
                $resourceId->setVideoId($status['id']);
                $resourceId->setKind('youtube#video');

                $playlistItemSnippet = new Google_Service_YouTube_PlaylistItemSnippet();

                $playlistItemSnippet->setPlaylistId('PLorQTUIjuMRYlJe0lJUgCOwuq7LGIveZk');
                $playlistItemSnippet->setResourceId($resourceId);

                $playlistItem = new Google_Service_YouTube_PlaylistItem();
                $playlistItem->setSnippet($playlistItemSnippet);

                $playlistItemResponse = $youtube->playlistItems->insert('snippet,contentDetails', $playlistItem, array());


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


    public function listVideo(Request $request){

        $id = 8;
        $groupControl = new groupController();
        $groupControl->load_group();
        $groupControl->verification_param($id);
        $user = Auth::user();
        $notifications = $user->unreadnotifications()->count();

        $this->execute('http://assovogt.org/annuaire', function(Google_Client $client, Google_Service_YouTube $youtube) use($request){

            try {

                $nextPageToken = '';

                $result = array();
                $i = 0;

                do {
                    $playlistItemsResponse = $youtube->playlistItems->listPlaylistItems('snippet', array(
                        'playlistId' => 'PLorQTUIjuMRYlJe0lJUgCOwuq7LGIveZk',
                        'maxResults' => 50,
                        'pageToken' => $nextPageToken));

                    foreach ($playlistItemsResponse['items'] as $playlistItem) {
                        $result[$i]['id'] = $playlistItem['snippet']['resourceId']['videoId'];
                        $result[$i]['title'] = $playlistItem['snippet']['title'];
                        $result[$i]['description'] = $playlistItem['snippet']['description'];
                        $result[$i]['date'] = $playlistItem['snippet']['publishedAt'];
                        $result[$i]['thumbnails'] = $playlistItem['snippet']['thumbnails']['default']['url'];
                        $i++;
                    }

                    $nextPageToken = $playlistItemsResponse['nextPageToken'];


                } while ($nextPageToken <> '');

                Redirect::back()->with(['result' => $result]);

            } catch (Google_Service_Exception $e) {

                $htmlBody = sprintf('<p>A service error occurred: <code>%s</code></p>', htmlspecialchars($e->getMessage()));
                Redirect::back()->with(['result' => $htmlBody]);

            } catch (Google_Exception $e) {

                $htmlBody = sprintf('<p>An client error occurred: <code>%s</code></p>', htmlspecialchars($e->getMessage()));
                Redirect::back()->with(['result' => $htmlBody]);

            } catch (\Exception $e) {

                $htmlBody = sprintf('<p>: <code>%s</code></p>', htmlspecialchars($e->getMessage()));
                Redirect::back()->with(['result' => $htmlBody]);
            }

        });

        $videos = Session::get('result');


        if (is_array($videos)) {

             $videos = ['content' => $videos, 'status' => 'success'];

        } elseif (is_string($videos)) {

            $videos =  ['content' => $videos, 'status' => 'error'];

        } else {

            $videos =  ['content' => $videos, 'status' => 'unknown'];
        }

        return view('video.index',
            [
                'list_group'=> $groupControl->_list_group,
                'user'=> $user->unreadnotifications,
                'nbr_notif'=> $notifications,
                'videos' => $videos
            ]);

    }

    public function viewVideo(Request $resquest)
    {

    }

}
