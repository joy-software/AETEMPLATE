<?php


    $OAUTH2_CLIENT_ID = env('OAUTH2_CLIENT_ID');
    $OAUTH2_CLIENT_SECRET = env('OAUTH2_CLIENT_SECRET');

    $client = new Google_Client();
    $client->setClientId($OAUTH2_CLIENT_ID);
    $client->setClientSecret($OAUTH2_CLIENT_SECRET);
    $client->setAccessType('offline');
    $client->setScopes('https://www.googleapis.com/auth/youtube');
    $redirect = filter_var('http://assovogt.org/tester', FILTER_SANITIZE_URL);

    $client->setRedirectUri($redirect);

    // Define an object that will be used to make all API requests.
    $youtube = new Google_Service_YouTube($client);

    if (isset($_GET['code'])) {

        $client->authenticate($_GET['code']);

        $key = $client->getAccessToken();

        $path = base_path('.env');

        $str = str_replace('GOOGLE_KEY=' . env('GOOGLE_KEY'), 'GOOGLE_KEY=' . json_encode($key), file_get_contents($path));

        if (file_exists($path)) {
            file_put_contents($path, $str);
        }

        header('Location: ' . $redirect);

        exit;
    }


    if ($token = json_decode(env('GOOGLE_KEY'), true)) {

        $client->setAccessToken($token);
    }

    // Check to ensure that the access token was successfully acquired.
    if ($client->getAccessToken()) {

        try {

            $nextPageToken = '';
            $htmlBody = '<ul>';

            do {
                $playlistItemsResponse = $youtube->playlistItems->listPlaylistItems('snippet', array(
                    'playlistId' => 'PLorQTUIjuMRa7sFEPbfNWxXvZcZ-LaLRO',
                    'maxResults' => 50,
                    'pageToken' => $nextPageToken));

                foreach ($playlistItemsResponse['items'] as $playlistItem) {
                    $htmlBody .= sprintf('<li>%s (%s)</li>', $playlistItem['snippet']['title'], $playlistItem['snippet']['resourceId']['videoId']);
                }

                $nextPageToken = $playlistItemsResponse['nextPageToken'];
            } while ($nextPageToken <> '');

            $htmlBody .= '</ul>';


        } catch (Google_Service_Exception $e) {
                $htmlBody = sprintf('<p>A service error occurred: <code>%s</code></p>',
                htmlspecialchars($e->getMessage()));
        } catch (Google_Exception $e) {
                $htmlBody = sprintf('<p>An client error occurred: <code>%s</code></p>',
                htmlspecialchars($e->getMessage()));
        }

        $key =  $client->getAccessToken();

        $path = base_path('.env');

        if (file_exists($path)) {
            file_put_contents($path, str_replace(
                'GOOGLE_KEY=' . env('GOOGLE_KEY'), 'GOOGLE_KEY=' . json_encode($key), file_get_contents($path)
            ));
        }


    }  else {

        // If the user hasn't authorized the app, initiate the OAuth flow

        $authUrl = $client->createAuthUrl();
        $htmlBody = "<h3>Authorization Required $authUrl</h3>
                    <p>You need to <a href=\"$authUrl\">authorize access</a> before proceeding.<p>";
    }
?>

<!doctype html>

<html>

    <head>
        <title>My Live Streams</title>
    </head>

    <body>
      <?=$htmlBody?>
    </body>
</html>
