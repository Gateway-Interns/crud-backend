<?php namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;

use Exception;

class PasswordUpdateController extends Controller
{
    public function updatePassword(Request $request, $id)
    {
        $validatedData = $request->validate([
            'current_password' => ['required', 'string'],
            'new_password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::findOrFail($id);

        if (Auth::id() !== $user->id && !Auth::user()->is_admin) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        if (!Hash::check($validatedData['current_password'], $user->password)) {
            return response()->json(['message' => 'Current password is incorrect'], 400);
        }

        $user->password = Hash::make($validatedData['new_password']);
        $user->save();

        return response()->json(['message' => 'Password updated successfully']);
    }
}
