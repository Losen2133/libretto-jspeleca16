<?php

namespace App\Http\Controllers\Api;

use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function register(Request $request) {
        $request->validate([
            'email' => 'required|string|email',
            'password'=> 'required|string',
        ]);

        $user = User::create([
            'email'=> $request->email,
            'password'=> bcrypt($request->password),
        ]);
        
        return response()->json([
            'message' => 'User registered successfully!'
        ]);
    }

    public function login(Request $request) {
        $request->validate([
            'email'=> 'required|string|email',
            'password'=> 'required|string'
        ]);
    
        $user = User::where('email', $request->email)->first();
    
        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email'=> ['Provided credentials are incorrect!']
            ]);
        }
    
        $token = $user->createToken('auth_token')->plainTextToken;
    
        return response()->json([
            'message'=> 'User logged in successfully!',
            'access_token'=> $token,
            'token_type' => 'Bearer'
        ]);
    }
    

    public function logout(Request $request) {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message'=> 'User logged out successfully!'
        ]);
    }
}
