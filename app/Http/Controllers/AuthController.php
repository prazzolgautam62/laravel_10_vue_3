<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    // for user Login 
    public function login(LoginRequest $request):JsonResponse
    {
        // to get the credentials
        $credentials = $request->all();

        if (!Auth::attempt($credentials)) {
            return response()->json(['message' => "Unauthorized", "status" => false], 401);
        }

        $user = User::where("email", $credentials['email'])->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => "Logged in successFully",
            "status" => true,
            "data" => $user,
            "access_token" => $token,
            "token_type" => 'Bearer',
        ], 200);
    }

    public function register(RegisterRequest $request):JsonResponse
    {
        $validatedData = $request->all();

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }
}
