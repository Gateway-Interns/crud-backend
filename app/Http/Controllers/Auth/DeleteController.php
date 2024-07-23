<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;              
use Illuminate\Http\Request;

class DeleteController extends Controller
{
    
    public function deletebyid(Request $request, User $user)
    {
  
            $user->delete();
            return response()->json(['message' => 'User deleted successfully.'], 200);

    
    }
}



    


