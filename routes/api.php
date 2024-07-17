<?php

use App\Http\Controllers\Auth\AuthCheckController;

use App\Http\Controllers\Auth\PostController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [RegisterController::class, 'register']);



Route::middleware('auth:sanctum')->group(function () {
    Route::post('login', [LoginController::class, 'login']);
    Route::get('/check-auth', [AuthCheckController::class, 'checkAuth']);
    Route::get('/posts/{post}', [PostController::class, 'show']);
    Route::post('/store', [PostController::class, 'store']);
    Route::patch('/update/{id}', [PostController::class, 'update']);
});
