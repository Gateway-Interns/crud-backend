<?php
use App\Http\Controllers\Auth\AuthCheckController;
use App\Http\Controllers\PostController;

Route::post('/register', [RegisterController::class, 'register']);
Route::post('login', [LoginController::class, 'login']);
Route::get('/index', [PostController::class, 'index']);





Route::middleware(['auth:sanctum'])->group(function () {

    //Route::post('/post/{id}', [PostController::class, 'show']);// showing by id
    Route::post('/store', [PostController::class, 'store']);
    Route::patch('/update/{id}', [PostController::class, 'update']);
});


Route::middleware('auth:sanctum')->get('check-auth', [AuthCheckController::class, 'checkAuth']);
