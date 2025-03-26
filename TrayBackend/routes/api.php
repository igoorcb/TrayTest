<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\GoogleAuthController;
use App\Http\Controllers\UserController;


Route::post('/complete-profile', [UserController::class, 'completeProfile']);
Route::get('/users', [UserController::class, 'index']);

Route::prefix('auth/google')->group(function () {
    Route::get('/redirect', [GoogleAuthController::class, 'redirect']);
    Route::get('/callback', [GoogleAuthController::class, 'callback']);
});
