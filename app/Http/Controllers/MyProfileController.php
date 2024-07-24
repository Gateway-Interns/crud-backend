<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class MyProfileController extends Controller
{
    public function getUserInfo(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
        ]);

        $user = User::where('full_name', $request->full_name)->first();

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        return response()->json([
            'full_name' => $user->full_name,
            'email' => $user->email,
            'address' => $user->address,
            'age' => $user->age,
            'gender' => $user->gender,
        ]);
    }
}
