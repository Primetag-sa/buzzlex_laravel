<?php

use App\Http\Controllers\Api\FCMController;
use App\Http\Controllers\Api\Photographer\AuthController;
use App\Http\Controllers\Api\Photographer\ChatController;
use App\Http\Controllers\Api\Photographer\GalleryController;
use App\Http\Controllers\Api\Photographer\GeneralOrderController;
use App\Http\Controllers\Api\Photographer\OrderController;
use App\Http\Controllers\Api\Photographer\PasswordController;
use App\Http\Controllers\Api\Photographer\PlanController;
use App\Http\Controllers\Photographer\MediaController;
use App\Models\GeneralOrder;
use Illuminate\Support\Facades\Route;


Route::post('register', [AuthController::class, 'register'])->name('register');
Route::post('login', [AuthController::class, 'login'])->name('login');

Route::post('forgot-password', [PasswordController::class, 'forgot'])->name('forgot-password');
Route::post('reset-password', [PasswordController::class, 'reset'])->name('reset-password');

Route::post('resend-otp', [AuthController::class, 'resendOtp']);
Route::post('verify-otp', [AuthController::class, 'verifyOtp'])->name('verifyOtp');


Route::middleware('auth:photographers')->group(function () {
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('profile', [AuthController::class, 'profile'])->name('profile.show');
    Route::put('profile', [AuthController::class, 'updateProfile'])->name('profile.update');
    Route::put('information', [AuthController::class, 'updateInformation'])->name('information.update');
    Route::put('change-password', [AuthController::class, 'changePassword'])->name('password.change');

    Route::post('update-fcm', [FCMController::class, 'updateFcmToken'])->name('update.fcm.token');

    Route::apiResource('galleries', GalleryController::class, [
        'only' => ['index', 'show', 'store', 'update', 'destroy']
    ]);

    Route::apiResource('media', MediaController::class,[
        'only' => ['destroy']
    ]);

    Route::apiResource('plans', PlanController::class, [
        'only' => ['index', 'show', 'store', 'update', 'destroy']
    ]);

    Route::apiResource('orders', OrderController::class, [
        'only' => ['index', 'show']
    ]);

    Route::prefix('orders')->controller(OrderController::class)->group(function () {
        Route::put('{order}/approve', 'approve');
        Route::put('{order}/decline', 'decline');
    });

    Route::prefix('chat')->controller(ChatController::class)->group(function(){
        Route::post('send-message', 'store');
        Route::get('conversations', 'index');
        Route::get('conversations/{conversation}', 'messages');
    });

    Route::prefix('general-orders')->controller(GeneralOrderController::class)->group(function(){
        Route::get('/', 'index');
        Route::get('{generalOrder}', 'show');
        Route::put('send-proposal', 'sendProposal');
    });
});

