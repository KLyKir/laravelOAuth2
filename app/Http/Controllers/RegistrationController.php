<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegistrationController extends Controller
{
    public function register(){
        return view('auth.register_form');
    }

    public function store(\Illuminate\Http\Request $request){
        $data = $request->validated();
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
        if($user){
            Auth::guard('web')->login($user);
        }
        return redirect()->route('home');
    }
}
