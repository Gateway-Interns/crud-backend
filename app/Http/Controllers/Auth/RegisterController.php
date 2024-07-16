<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\auth\registerRequest;
use App\Http\Resources\Auth\registerResource;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function register(RegisterRequest $request)
    {

        $user = User::create([
            'full_name' => $request->full_name,
            'email' => $request->email,
            'address' => $request->address,
            'password' => Hash::make($request->password), // Hash the password

            'age' => $request->age,
            'gender' => $request->gender,
        ]);
        $token = $user->createToken($request->full_name)->plainTextToken;

        
        return (new RegisterResource($user))->additional(['token' => $token]);
     
    }
}
