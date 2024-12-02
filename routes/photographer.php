<?php

use App\Http\Controllers\Api\FCMController;
use App\Http\Controllers\Api\Photographer\AuthController;
use App\Http\Controllers\Api\Photographer\PasswordController;
use Illuminate\Support\Facades\Route;


Route::post('register', [AuthController::class, 'register'])->name('register');
Route::post('login', [AuthController::class, 'login'])->name('login');

Route::post('forgot-password', [PasswordController::class, 'forgot'])->name('forgot-password');
Route::post('reset-password', [PasswordController::class, 'reset'])->name('reset-password');

Route::middleware('auth:photographers')->group(function () {
    Route::post('verify-otp', [AuthController::class, 'verifyOtp'])->name('verifyOtp');
    Route::get('profile', [AuthController::class, 'profile'])->name('profile.show');
    Route::put('profile', [AuthController::class, 'updateProfile'])->name('profile.update');
    Route::put('change-password', [AuthController::class, 'changePassword'])->name('password.change');

    Route::post('update-fcm', [FCMController::class, 'updateFcmToken'])->name('update.fcm.token');
});

