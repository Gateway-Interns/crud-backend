<?php

use App\Http\Auth\Controllers\DeleteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::delete('/user/{user}', [DeleteController::class, 'deletebyid']);




