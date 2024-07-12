<?php

namespace App\Http\Controllers;
use App\Models\User;              // to conntact and transfer data between model and controller
use Illuminate\Http\Request;

class DeleteController extends Controller
{
    public function deletebyid(Request $request ,$id)  // Request $request represents the HTTP request.and Request is the object ,It provides a way to access and manipulate incoming data
    {
        //first way
       // $user =User::find($id);           // find user by using id , if inside of database we don't have data , it return null
       //$user->delete();                  // delete the user when finded by  find($id)
       // return response()->json($user);   // Return a JSON response with the deleted user data
    


    //secound way with if condition

    $user = User::find($id);   //Find the user by ID   and "User" is our model
    
   
    if ($user) {                //  Check if the user exists
        
        $user->delete();       //Delete the user
        
       
        return response()->json([     // Return a JSON response with the deleted user data
            
            'message' => 'User deleted successfully.',
            'data' => $user
        ]);
    } else {
        
        return response()->json([    // If the user is not found, return an error response
           
            'message' => 'User not found.'
        ], 404);
    }

}
}

