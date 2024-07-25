<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\VerificationController;

Route::get('/verify-email/{user}', [VerificationController::class, 'verify'])
    ->name('verification.verify')
    ->middleware('signed');

Route::get('/', function () {
    return view('welcome');
});

#Route::post('/register', [RegisterController::class, 'register'])->name('register');