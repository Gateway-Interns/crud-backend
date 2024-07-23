<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller; // Ensure this import is correct
use App\Models\User;

class UpdateProfileController extends Controller
{
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $id],
            'address' => ['nullable', 'string', 'max:255'],
            'age' => ['nullable', 'integer', 'min:1'],
            'gender' => ['nullable', 'string', 'in:male,female,other'],
        ]);

        $user = User::findOrFail($id);

        if (Auth::id() !== $user->id && !Auth::user()->is_admin) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $user->full_name = $validatedData['full_name'];
        $user->email = $validatedData['email'];
        $user->address = $validatedData['address'];
        $user->age = $validatedData['age'];
        $user->gender = $validatedData['gender'];

        $user->save();

        return response()->json(['message' => 'User updated successfully', 'user' => $user]);
    }
}
