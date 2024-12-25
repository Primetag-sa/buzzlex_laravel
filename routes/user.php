<?php

use App\Http\Controllers\Api\FCMController;
use App\Http\Controllers\Api\ReviewController;
use App\Http\Controllers\Api\User\AuthController;
use App\Http\Controllers\Api\User\OrderController;
use App\Http\Controllers\Api\User\PasswordController;
use App\Http\Controllers\Api\User\PhotographerController;
use Illuminate\Support\Facades\Route;


Route::post('register', [AuthController::class, 'register'])->name('register');
Route::post('login', [AuthController::class, 'login'])->name('login');

Route::post('forgot-password', [PasswordController::class, 'forgot'])->name('forgot-password');
Route::post('reset-password', [PasswordController::class, 'reset'])->name('reset-password');

Route::post('resend-otp', [AuthController::class, 'resendOtp']);

Route::middleware('auth:users')->group(function () {
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('verify-otp', [AuthController::class, 'verifyOtp'])->name('verifyOtp');
    Route::get('profile', [AuthController::class, 'profile'])->name('profile.show');
    Route::put('profile', [AuthController::class, 'updateProfile'])->name('profile.update');
    Route::put('change-password', [AuthController::class, 'changePassword'])->name('password.change');

    Route::post('update-fcm', [FCMController::class, 'updateFcmToken'])->name('update.fcm.token');

    Route::apiResource('photographers', PhotographerController::class,[
        'only' => ['index', 'show']
    ]);
    Route::prefix('photographers')->controller(PhotographerController::class)->group(function(){
        Route::get('{photographer}/galleries', 'galleries');
        Route::get('{photographer}/plans', 'plans');
    });

    Route::apiResource('reviews', ReviewController::class,[
        'only' => ['store', 'show', 'index']
    ]);

    Route::apiResource('orders', OrderController::class, [
        'only' => ['index', 'show', 'store']
    ]);
});
