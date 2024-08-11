<?php
namespace App\Http\Controllers\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class LogoutController extends Controller
{


    public function logout(Request $request)
    {

        $user = $request->user();
        $user->tokens()->delete();
        return response()->json(['message' => 'logged out']);



    }


}