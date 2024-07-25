<?php



use App\Http\Controllers\LogoutController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthCheckController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\DeleteController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\PostController;





Route::post('/register', [RegisterController::class, 'register']);
Route::post('login', [LoginController::class, 'login']);



Route::middleware('auth:sanctum')->group(function () {
    Route::get('/check-auth', [AuthCheckController::class, 'checkAuth']);
    Route::get('/posts/{post}', [PostController::class, 'show']);
    Route::post('/store', [PostController::class, 'store']);
    Route::patch('/update/{id}', [PostController::class, 'update']);
    Route::get('users/{user}/posts', [PostController::class, 'postsByUser']);
    Route::delete('/user/{user}',[DeleteController::class, 'deletebyid']);
    Route::post('/logout', [LogoutController::class, 'logout']);
    Route::delete('/posts/{post}', [PostController::class, 'destroy']);
    Route::get('/posts', [PostController::class, 'index']);
});