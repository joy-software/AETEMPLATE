<?php

namespace App\Traits;

use Illuminate\Support\Facades\Redirect;
use Google_Client;
use Google_Service_YouTube;
use Illuminate\Support\Facades\Session;


trait GoogleAuthTrait
{

    public function getToken()
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
        $redirect = filter_var('http://assovogt.org/google/get_token', FILTER_SANITIZE_URL);
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

    }

    public function execute($backAfterAuth, \Closure $callback)
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
        $redirect = filter_var('http://assovogt.org/google/get_token', FILTER_SANITIZE_URL);
        $client->setRedirectUri($redirect);
        Session::set('redirect', $backAfterAuth);

        $youtube = new Google_Service_YouTube($client);

        if ($token = json_decode(env('GOOGLE_TOKEN'), true)) {

            $client->setAccessToken($token);
        }

        if ($client->getAccessToken()) {

            $callback($client, $youtube);

        }  else {

            $authUrl = $client->createAuthUrl();
            $htmlBody = "<h3>Autorisation réquise</h3>
                <p>Vous devez <a href=\"$authUrl\">autoriser l'accès</a> avant de continuer.<p>";

            return Redirect::back()->with(['message' => $htmlBody]);
        }
    }

}