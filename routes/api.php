<?php

//use App\Http\Controllers\LogoutController;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\AuthCheckController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\DeleteController;
use App\Http\Controllers\Auth\RegisterController;

use App\Http\Controllers\NotificationController;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Notifications\NewReleaseNotification;
use App\Http\Controllers\PostController;


Route::post('/register', [RegisterController::class, 'register']);
Route::post('login', [LoginController::class, 'login']);






Route::middleware('auth:sanctum')->group(function () {
    Route::get('/check-auth', [AuthCheckController::class, 'checkAuth']);
    Route::get('/posts/{post}', [PostController::class, 'show']);
    Route::post('/store', [PostController::class, 'store']);
    Route::patch('/update/{id}', [PostController::class, 'update']);

    Route::post('/forget',[ResetPasswordController::class,'forget']);
    Route::post('/reset',[ResetPasswordController::class,'reset'])->name('password.reset');


    Route::get('users/{user}/posts', [PostController::class, 'postsByUser']);
    Route::delete('/user/{user}',[DeleteController::class, 'deletebyid']);
  //  Route::post('/logout', [LogoutController::class, 'logout']);
});

