<?php

namespace App\Http\Controllers\OAuth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class SocialController extends Controller
{
    public function facebook(Request $request){
        $accessTokenLink = 'https://graph.facebook.com/v18.0/oauth/access_token?';
        $parametrs = [
            'client_id' => env('FACEBOOK_CLIENT_ID'),
            'redirect_uri' => env('FACEBOOK_REDIRECT_URI'),
            'client_secret' => env('FACEBOOK_CLIENT_SECRET'),
            'code' => $request->get('code')
        ];
        $response = Http::post($accessTokenLink, $parametrs);

        $responseData = json_decode($response->body(), true); // Преобразование JSON в массив
        if (isset($responseData['access_token'])) {
            $accessToken = $responseData['access_token'];
            $userInfoLink = 'https://graph.facebook.com/v18.0/me?fields=id,name,email';
            $userInfoResponse = Http::get($userInfoLink, ['access_token' => $accessToken]);

            $userInfoData = json_decode($userInfoResponse->body(), true);
            if(!isset($userInfoData['email'])){
                $email = $userInfoData['id'].'@email';
            }else{
                $email = $userInfoData['email'];
            }
            $user = User::query()->updateOrCreate([
                'email' => $email,
            ], [
                'name' => $userInfoData['name'],
                'password' => Hash::make($userInfoData['id']),
                'role_id' => 1
            ]);
            if(null === $user){
                return redirect()->route('login');
            }
            Auth::guard('web')->login($user);
            return redirect()->route('home');
        } else {
            return redirect()->route('login')->withErrors('common_error', 'Some problems');
        }
    }
}
