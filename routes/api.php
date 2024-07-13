<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\AuthCheckController;
use App\Http\Controllers\Auth\PostController;

Route::post('/register', [RegisterController::class, 'register']);
Route::post('login', [LoginController::class, 'login']);
Route::middleware('auth:sanctum')->get('check-auth', [AuthCheckController::class, 'checkAuth']);
Route::middleware('auth:sanctum')->get('posts/{post}', [PostController::class, 'show']);