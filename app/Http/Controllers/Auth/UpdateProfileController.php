<?php 

namespace App\Http\Controllers\Auth;
use App\Models\User;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Resources\UpdateUserResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
class UpdateProfileController extends Controller
{
public function update(UpdateProfileRequest $request)
{
    $validatedData = $request->validated();
    $user = Auth::user();

    if (!$user) {
        return 'not authenticated';
    }


         User::findOrFail($user->id)->update([
        'full_name' => $validatedData['full_name'],
        'email' => $validatedData['email'],
        'address' => $validatedData['address'],
        'age' => $validatedData['age'],
        'gender' => $validatedData['gender'],
    ]);
        return new UpdateUserResource($user);
    }
}
