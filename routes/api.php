<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\BlogAPIController;
use App\Http\Controllers\API\UserAPIController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::post('register', [AuthController::class, 'register']);
        Route::post('login', [AuthController::class, 'login']);
    });
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user/{user}', [UserAPIController::class, 'show'])
        ->name('api-user.detail');

    Route::get('/my-profile', [UserAPIController::class, 'showProfile']);
    Route::post('/my-profile/update', [UserAPIController::class, 'updateProfile']);
    Route::post('/update-password', [UserAPIController::class, 'updatePassword']);

    Route::prefix('blog')->group(function() {
        Route::get('list', [BlogAPIController::class , 'index'])
            ->name('api-blog.index');

        Route::post('store', [BlogAPIController::class , 'store'])
            ->name('api-blog.store');

        Route::patch('update/{blog}', [BlogAPIController::class , 'update'])
            ->name('api-blog.update');

        Route::delete('delete/{blog}', [BlogAPIController::class , 'delete'])
            ->name('api-blog.delete');
    });
});
