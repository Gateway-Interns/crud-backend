<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthCheckController extends Controller
{
    public function checkAuth(Request $request)
    {
        try {
            $user = $request->user();

            if ($user) {
                return response()->json([
                    'status' => true,
                    'message' => 'User is authenticated.',
                    'user' => $user,
                ], 200);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'User is not authenticated.',
                ], 401);
            }

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }
}