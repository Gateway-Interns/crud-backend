<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthCheckController extends Controller
{
    public function checkAuth(Request $request)
    {
        return response()->json(['message' => 'User is authenticated.'], 200);
    }
}