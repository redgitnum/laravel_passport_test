<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if(!Auth::attempt($request->only('email', 'password'))){
            return response(['message' => 'wrong credentials']);
        }

        $accessToken = Auth::user()->createToken('token')->accessToken;
        return response(['user' => Auth::user(), 'token' => $accessToken]);
    }

}
