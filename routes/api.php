<?php
use App\Http\Controllers\DeleteController;   // use to contact between  DeletContruller and api.php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');




// user/{id} is   the URI pattern that the route responds to in postman or any other. 
//deletebyid method in the controller
//DeleteController is the name o controller 

Route::delete('/user/{id}', [App\Http\Controllers\DeleteController::class, 'deletebyid']);   

