<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class VerificationController extends Controller
{
    public function verify(Request $request, $userId)
    {

        if (!$request->hasValidSignature()) {
            return response()->json(['message' => 'Invalid or expired URL.'], 400);
        }


        $user = User::findOrFail($userId);
        $user->markEmailAsVerified();

        return response()->json(['message' => 'Account verified successfully.']);
    }
}