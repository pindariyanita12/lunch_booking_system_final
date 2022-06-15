<?php

namespace App\Http\Controllers;

use App\Models\Record;
use App\Models\User;
use App\TokenStore\TokenCache;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Microsoft\Graph\Graph;
use Microsoft\Graph\Model;

class AuthController extends Controller
{

    //
    public function signin()
    {

        // Initialize the OAuth client
        $oauthClient = new \League\OAuth2\Client\Provider\GenericProvider([
            'clientId' => config('azure.appId'),
            'clientSecret' => config('azure.appSecret'),
            'redirectUri' => config('azure.redirectUri'),
            'urlAuthorize' => config('azure.authority') . config('azure.authorizeEndpoint'),
            'urlAccessToken' => config('azure.authority') . config('azure.tokenEndpoint'),
            'urlResourceOwnerDetails' => '',
            'scopes' => config('azure.scopes'),
        ]);

        $authUrl = $oauthClient->getAuthorizationUrl();

        // Save client state so we can validate in callback
        session(['oauthState' => $oauthClient->getState()]);
        return response()->json(["link" => $authUrl]);
    }

    public function signout(Request $request)
    {
        auth()->user()->update(['is_active', 0]);
        auth()->logout();
        return redirect('/');

    }

    //get user data api
    public function handler(Request $request)
    {

        $httpClient = new \GuzzleHttp\Client();

        $httpRequest = $httpClient->post(env('OAUTH_AUTHORITY') . env('OAUTH_TOKEN_ENDPOINT'), [
            'form_params' => [
                "code" => $request->code,
                "grant_type" => "authorization_code",
                "tenant" => ENV('OAUTH_TENANT_ID'),
                "client_id" => ENV('OAUTH_APP_ID'),
                "client_secret" => ENV('OAUTH_APP_SECRET'),
                "redirect_uri" => ENV('OAUTH_REDIRECT_URI'),
            ],
        ]);

        $response = json_decode($httpRequest->getBody()->getContents());
        $remember_token = $response->access_token;
        $graph = new Graph();
        $graph->setAccessToken($remember_token);

        $user = $graph->createRequest("GET", "/me")
            ->setReturnType(Model\User::class)
            ->execute();
        $user = User::where('email', $user->getmail())->first();

        if (!$user) {
            $user = User::create([
                'emp_id' => null,
                'name' => $user->getgivenName(),
                'email' => $user->getmail(),
                'department' => null,
                'password' => '23',
                'is_admin' => 0,
                'is_active' => 1,
                'remember_token' => $remember_token,
            ]);
        } else {
            $user->is_active = 1;
            $user->remember_token = $remember_token; //ms access token, we reused column
            $user->save();
        }
        \Auth::login($user); // let's make this user logged in using laravel
        return redirect()->route('user.welcome');
    }
}
