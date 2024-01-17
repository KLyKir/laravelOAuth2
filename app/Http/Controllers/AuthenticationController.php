<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    public function index(){
        $facebookLink = "https://www.facebook.com/v18.0/dialog/oauth?client_id=".env('FACEBOOK_CLIENT_ID').'&redirect_uri='.env('FACEBOOK_REDIRECT_URI');

        return view('auth.auth_form', [
            'facebookAuthLink' => $facebookLink,
            'redirect_uri' => 'http://localhost/oauth/facebook'
        ]);
    }

    public function authenticator(LoginForm $request){
        $data = $request->validated();
        if(Auth::guard('web')->attempt($data)){
            return redirect()->route('home');
        }
        return back()->withErrors(['email' => 'There is no accounts with this email', 'password' => 'Wrong password']);
    }

    public function logout(Request $request){
        Auth::guard('web')->logout();
        $request->session()->regenerate();
        return redirect()->route('home');
    }
}
