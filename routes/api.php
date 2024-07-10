<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\AuthCheckController;

Route::post('login', [LoginController::class, 'login']);
Route::middleware('auth:sanctum')->post('check-auth', [AuthCheckController::class, 'checkAuth']);

/* Route::get('/user', function (Request $request) {
     return $request->user();
 })->middleware('auth:sanctum');*/