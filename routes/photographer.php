<?php

use App\Http\Controllers\Api\Photographer\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('register', [AuthController::class, 'register'])->name('register');
Route::post('login', [AuthController::class, 'login'])->name('login');

Route::middleware('auth:photographers')->group(function () {
    Route::post('verify-otp', [AuthController::class, 'verifyOtp'])->name('verifyOtp');
});
