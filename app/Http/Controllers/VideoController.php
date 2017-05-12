<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
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
                'video'               => 'required|mimes:mp4,3gpp,mov,avi|max:500000',
                'title'          => 'required',
                'description'    => 'required',

            ],
            [
                'video.mimes'     => 'Les extensions d\'images acceptées sont mp4',
                'video.max'       => 'La taille de la vidéo ne doit pas excéder 500 Mo',
                'video.required'  => 'Veuillez choisir une vidéo',
                'title.required'  => 'Le champ "titre" est obligatoire',
                'description.required'     => 'Le champ "description" est obligatoire',
            ]
        );

        return $validator;
    }

    public function uploadVideo(Request $request)
    {
        $this->execute('http://assovogt.org/tester', function(Google_Client $client, Google_Service_YouTube $youtube) use($request){

            $validator = VideoController::videoValidator($request->all());

            if (! $validator->passes()) {
                $error = "";
                foreach ($validator->errors()->all() as $err){
                    $error .= $err;
                    $error .= '<br>';
                }

                return Redirect::back()->with(['message' => ['type' => 'error', 'message' => $error]]);
            }

            try{

                $snippet = new Google_Service_YouTube_VideoSnippet();
                $snippet->setTitle($request->get('title'));
                $snippet->setDescription($request->get('description'));

                $snippet->setCategoryId("22");

                // Set the video's status to "public". Valid statuses are "public",
                // "private" and "unlisted".
                $status = new Google_Service_YouTube_VideoStatus();
                $status->privacyStatus = "unlisted";

                // Associate the snippet and status objects with a new video resource.
                $video = new Google_Service_YouTube_Video();
                $video->setSnippet($snippet);
                $video->setStatus($status);


                $chunkSizeBytes =  1024 * 1024;

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

                $resourceId = new \Google_Service_YouTube_ResourceId();
                $resourceId->setVideoId($status['id']);
                $resourceId->setKind('youtube#video');

                $playlistItemSnippet = new Google_Service_YouTube_PlaylistItemSnippet();
                $accessibility = $request->get('accessibility');

                if ($accessibility == 'private') {

                    $playlistItemSnippet->setPlaylistId(env('PRIVATE_PLAYLIST_VIDEO'));

                } elseif ($accessibility == 'public') {

                    $playlistItemSnippet->setPlaylistId(env('PUBLIC_PLAYLIST_VIDEO'));
                }

                $playlistItemSnippet->setResourceId($resourceId);

                $playlistItem = new Google_Service_YouTube_PlaylistItem();
                $playlistItem->setSnippet($playlistItemSnippet);

                $playlistItemResponse = $youtube->playlistItems->insert('snippet,contentDetails', $playlistItem, array());


                return Redirect::back()->with(['message' => ['type' => 'success', 'message' => 'Vidéo Ajoutée avec succès']]);

            } catch (Google_Service_Exception $e) {
                $htmlBody = sprintf('<p>A service error occurred: <code>%s</code></p>',
                    htmlspecialchars($e->getMessage()));
            } catch (Google_Exception $e) {
                $htmlBody = sprintf('<p>An client error occurred: <code>%s</code></p>',
                    htmlspecialchars($e->getMessage()));
            }

            return Redirect::back()->with(['message' => ['type' => 'error', 'message' => $htmlBody]]);

        });

        $message = Session::get('message');
        Session::set('message', null);

        return response()->json($message);
    }


    public function listVideo(Request $request){

        $id = 1;
        $groupControl = new groupController();
        $groupControl->load_group();
        $groupControl->verification_param($id);
        $user = Auth::user();
        $notifications = $user->unreadnotifications()->count();

        $this->execute('http://assovogt.org/video/list', function(Google_Client $client, Google_Service_YouTube $youtube) use($request){

            try {

                $nextPageToken = '';

                $result = array();
                $i = 0;

                do {
                    $playlistItemsResponse = $youtube->playlistItems->listPlaylistItems('snippet', array(
                        'playlistId' => env('PRIVATE_PLAYLIST_VIDEO'),
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

    public function addBroadcast(Request $request)
    {

        $this->execute('http://assovogt.org/annuaire', function(Google_Client $client, Google_Service_YouTube $youtube) use($request){

            try {
                // Create an object for the liveBroadcast resource's snippet. Specify values
                // for the snippet's title, scheduled start time, and scheduled end time.
                $broadcastSnippet = new \Google_Service_YouTube_LiveBroadcastSnippet();
                $broadcastSnippet->setTitle('On va voir');
                $broadcastSnippet->setScheduledStartTime('2017-05-12T14:00:00.000Z');
                $broadcastSnippet->setScheduledEndTime('2017-05-12T15:30:00.000Z');


                // Create an object for the liveBroadcast resource's status, and set the
                // broadcast's status to "private".
                $status = new \Google_Service_YouTube_LiveBroadcastStatus();
                $status->setPrivacyStatus('public');


                // Create the API request that inserts the liveBroadcast resource.
                $broadcastInsert = new \Google_Service_YouTube_LiveBroadcast();
                $broadcastInsert->setSnippet($broadcastSnippet);
                $broadcastInsert->setStatus($status);
                $broadcastInsert->setKind('youtube#liveBroadcast');


                // Execute the request and return an object that contains information
                // about the new broadcast.
                $broadcastsResponse = $youtube->liveBroadcasts->insert('snippet,status',
                    $broadcastInsert, array());

                // Create an object for the liveStream resource's snippet. Specify a value
                // for the snippet's title.
                $streamSnippet = new \Google_Service_YouTube_LiveStreamSnippet();
                $streamSnippet->setTitle('Premier test');

                // Create an object for content distribution network details for the live
                // stream and specify the stream's format and ingestion type.
                $cdn = new \Google_Service_YouTube_CdnSettings();
                $cdn->setFormat("480p");
                //$cdn->setIngestionType('rtmp://a.rtmp.youtube.com/live2');


                // Create the API request that inserts the liveStream resource.
                $streamInsert = new \Google_Service_YouTube_LiveStream();
                $streamInsert->setSnippet($streamSnippet);
                $streamInsert->setCdn($cdn);
                $streamInsert->setKind('youtube#liveStream');


                // Execute the request and return an object that contains information
                // about the new stream.
                $streamsResponse = $youtube->liveStreams->insert('snippet,cdn',
                    $streamInsert, array());

                // Bind the broadcast to the live stream.
                $bindBroadcastResponse = $youtube->liveBroadcasts->bind(
                    $broadcastsResponse['id'],'id,contentDetails',
                    array(
                        'streamId' => $streamsResponse['id'],
                    ));

                /*$htmlBody .= "<h3>Added Broadcast</h3><ul>";
                $htmlBody .= sprintf('<li>%s published at %s (%s)</li>',
                    $broadcastsResponse['snippet']['title'],
                    $broadcastsResponse['snippet']['publishedAt'],
                    $broadcastsResponse['id']);
                $htmlBody .= '</ul>';

                $htmlBody .= "<h3>Added Stream</h3><ul>";
                $htmlBody .= sprintf('<li>%s (%s)</li>',
                    $streamsResponse['snippet']['title'],
                    $streamsResponse['id']);
                $htmlBody .= '</ul>';

                $htmlBody .= "<h3>Bound Broadcast</h3><ul>";
                $htmlBody .= sprintf('<li>Broadcast (%s) was bound to stream (%s).</li>',
                    $bindBroadcastResponse['id'],
                    $bindBroadcastResponse['contentDetails']['boundStreamId']);
                $htmlBody .= '</ul>';*/

                return Redirect::back()->with(['result' => array_merge($broadcastsResponse, $streamsResponse)]);

            } catch (Google_Service_Exception $e) {
                $htmlBody = sprintf('<p>A service error occurred: <code>%s</code></p>',
                    htmlspecialchars($e->getMessage()));
                Redirect::back()->with(['result' => $htmlBody]);
            } catch (Google_Exception $e) {
                $htmlBody = sprintf('<p>An client error occurred: <code>%s</code></p>',
                    htmlspecialchars($e->getMessage()));
                Redirect::back()->with(['result' => $htmlBody]);
            } catch (\Exception $e) {

                $htmlBody = sprintf('<p>: <code>%s</code></p>', htmlspecialchars($e->getMessage()));
                Redirect::back()->with(['result' => $htmlBody]);
            }


        });

        return Redirect::back();

    }


}
