<?php 

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Resources\UpdatePasswordResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;


class PasswordUpdateController extends Controller
{
    public function updatePassword(UpdatePasswordRequest $request)
    {
        
        $user = Auth::user();
       
     

        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json(['message' => 'Current password is incorrect']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();


        return new UpdatePasswordResource($user);
       
    }
}
