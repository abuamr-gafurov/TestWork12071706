<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\LoginResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse|\App\Http\Resources\LoginResource
     */
    public function __invoke(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email|min:5|max:255',
            'password' => 'required|min:8|max:50'
        ]);

        if(!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Не верный эл. почта или пароль!',
            ], 401);
        }

        $token = Auth::user()->createToken($request->email)->plainTextToken;

        return new LoginResource(Auth::user(), $token);
    }
}
