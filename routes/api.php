<?php

use App\Http\Controllers\Auth\AuthCheckController;

use App\Http\Controllers\PostController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\NotificationController;

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Notifications\NewReleaseNotification;

Route::post('/register', [RegisterController::class, 'register']);
Route::post('login', [LoginController::class, 'login']);



Route::middleware('auth:sanctum')->group(function () {
    Route::get('/check-auth', [AuthCheckController::class, 'checkAuth']);
    Route::get('/posts/{post}', [PostController::class, 'show']);
    Route::post('/store', [PostController::class, 'store']);
    Route::patch('/update/{id}', [PostController::class, 'update']);


    Route::prefix('notifications')->group(function () {
        Route::post('{notification}/read', [NotificationController::class, 'markAsRead']);
        Route::post('read-all', [NotificationController::class, 'markAllAsRead']);
        Route::post('{notification}/unread', [NotificationController::class, 'markAsUnread']);
        Route::delete('{notification}', [NotificationController::class, 'deleteNotification']);
    });
    // test comment
    Route::get('users/{user}/posts', [PostController::class, 'postsByUser']);
});
