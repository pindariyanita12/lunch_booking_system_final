<?php

namespace App\Http\Controllers;

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

        // Redirect to AAD signin page
        //return redirect()->away($authUrl);

        return response()->json(["link" => $authUrl]);
    }

    public function signout(Request $request)
    {

        $tokenCache = new TokenCache();
        $tokenCache->clearTokens();
        $isactive = User::where('email', $request->mail)->first();

        $isactive->is_active = 0;

        $isactive->save();

        return response(["message" => "Success"], 200);
    }

    //get user data api
    public function get_data(Request $request)
    {

        $httpClient = new \GuzzleHttp\Client();

        $httpRequest =
        $httpClient
            ->post('https://login.microsoftonline.com/f4814d23-3835-4d87-a7dc-57a19c04684a/oauth2/v2.0/token', [
                'form_params' => [
                    "code" => $request->code,
                    "grant_type" => "authorization_code",
                    "tenant" => $request->tenant,
                    "client_id" => $request->client_id,
                    "client_secret" => $request->client_secret,
                    "redirect_uri" => "http://localhost/lunch_booking_system/index.html",
                ],

            ]);

        $response = json_decode($httpRequest->getBody()->getContents());
        $remember_token = $response->access_token;
        $graph = new Graph();
        $graph->setAccessToken($remember_token);

        $user = $graph->createRequest("GET", "/me")
            ->setReturnType(Model\User::class)
            ->execute();
        $isactive = User::where('email', $user->getmail())->first();
        if (!$isactive) {

            $isactive = User::create([

                'emp_id' => null,
                'name' => $user->getgivenName(),
                'email' => $user->getmail(),
                'department' => null,
                'password' => '23',
                'type' => 1,
                'is_admin' => 0,
                'is_active' => 0,
                'remember_token' => $remember_token,
            ]);
            $isactive->is_active = 1;
            $isactive->remember_token = $remember_token;
            $isactive->save();
        } else {

            $isactive->is_active = 1;
            $isactive->remember_token = $remember_token;
            $isactive->save();
        }
// dd($isactive);
        return response(["user" => $isactive]);

    }

}
