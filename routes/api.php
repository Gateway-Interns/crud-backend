<?php
use App\Http\Controllers\DeleteController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::delete('/user/{id}',[App\Http\Controllers\DeleteController::class,'deletebyid']);


/// hello this is a new chane 

///