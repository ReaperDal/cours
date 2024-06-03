<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

namespace App\Http\Controllers;

use Google_Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        $client = new Google_Client();
        $client->setClientId(env('GOOGLE_CLIENT_ID'));
        $client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
        $client->setRedirectUri(env('GOOGLE_REDIRECT_URI'));
        $client->addScope('https://www.googleapis.com/auth/classroom.courses.readonly');

        $authUrl = $client->createAuthUrl();
        return redirect()->away($authUrl);
    }

    public function handleGoogleCallback(Request $request)
    {
        $client = new Google_Client();
        $client->setClientId(env('GOOGLE_CLIENT_ID'));
        $client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
        $client->setRedirectUri(env('GOOGLE_REDIRECT_URI'));
        $client->fetchAccessTokenWithAuthCode($request->input('code'));

        $token = $client->getAccessToken();
        // Сохраните токен в сессии или базе данных
        Session::put('google_token', $token);

        return redirect()->route('home')->with('success', 'Google account connected.');
    }
}

