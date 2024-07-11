<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request): JsonResponse
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6',
        ]);

        $attributes = $request->only(app(User::class)->getFillable());
        $attributes['password'] = Hash::make($attributes['password']);

        $user = User::create($attributes);

        $token = $user->createToken('authToken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response()->json([
            'success' => true,
            'message' => 'Registration Successful',
            'data' => $response
        ], HttpResponse::HTTP_CREATED);
    }

    public function login(Request $request): JsonResponse
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->get('email'))->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages(
                [
                    'credentials' => 'Incorrect Credentials',
                ]
            );
        }

        $token = $user->createToken('authToken')->plainTextToken;

        $loginResponse = [
            'user' => $user,
            'token' => $token
        ];

        return response()->json([
            'success' => true,
            'message' => 'Login Successful',
            'data' => $loginResponse
        ], HttpResponse::HTTP_OK);
    }
}
