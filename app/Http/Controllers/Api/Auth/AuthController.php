<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $newUserData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|min:8|confirmed'
        ]);

        $user = User::create([
            'name' => $newUserData['name'],
            'email' => $newUserData['email'],
            'password' => bcrypt($newUserData['password'])
        ]);

        $token = $user->createToken('divar-app-token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token,
        ], 201);
    }

    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();

        return response()->json([
            'message' => 'logged out'
        ]);

    }

    public function login(Request $request)
    {
        $userData = $request->validate([
            'email' => 'required',
            'password' => 'required|min:8'
        ]);

        // check user and password
        $user = User::where('email', $userData['email'])->first();

        if (!$user || !Hash::check($userData['password'], $user->password)) {
            return response()->json([
                'message' => 'email or password do not match'
            ], 401);
        }


        $token = $user->createToken('divar-app-token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token,
        ], 201);

    }
}
