<?php
namespace App\Http\Auth\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;              
use Illuminate\Http\Request;

class DeleteController extends Controller
{
    
    public function deletebyid(Request $request, User $user)
    {
        if ($user) {
            $user->delete();
            return response()->json($user);
        }

       
    }
}



    


