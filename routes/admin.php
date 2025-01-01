<?php

use App\Http\Controllers\Api\Admin\AuthController;
use App\Http\Controllers\Api\Admin\UserController;
use Illuminate\Support\Facades\Route;


Route::prefix('auth')->controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('forgot-password', 'forgotPassword');
    Route::post('reset-password', 'resetPassword');
});

Route::prefix('users')->controller(UserController::class)->group(function () {
    Route::get('/', 'index');
    Route::post('/', 'store');
    Route::get('/{user}', 'show');
    Route::put('/{user}', 'update');
    Route::post('/delete', 'delete');
});
