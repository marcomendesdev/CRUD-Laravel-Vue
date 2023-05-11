<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // public function register
    public function register(Request $request)
    {
        // validate the request
        $validatedData = $request->validate([
            'name' => 'required|max:55',
            'email' => 'email|required|unique:users',
            'password' => 'required'
        ]);

        // create a user
        $validatedData['password'] = bcrypt($request->password);
        $user = User::create($validatedData);

        // create a token
        $token = $user->createToken('authToken')->plainTextToken;

        // return a response
        return response(['user' => $user, 'token' => $token]);
    }

    // public function login
    public function login(Request $request)
    {
        // validate the request
        $validatedData = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        // validate the user
        if (!Auth::attempt($validatedData)) {
            return response(['message' => 'Invalid credentials']);
        }
        /** @var \App\Models\User $user **/
        $user = Auth::user();
        // create a token
        $token = $user->createToken('authToken')->plainTextToken;

        // return a response
        return response(['user' => auth()->user(), 'token' => $token]);
    }

    // public function logout
    public function logout(Request $request)
    {
        // logout the user
        $request->user()->currentAccessToken()->delete();

        // return a response
        return response(['message' => 'Logged out']);
    }
}
