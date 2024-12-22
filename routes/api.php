<?php

use App\Http\Controllers\Api\BillboardController;
use App\Http\Controllers\Api\ServiceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::apiResource('services', ServiceController::class,[
    'only' => ['index', 'show']
]);


Route::apiResource('billboards', BillboardController::class,[
    'only' => ['index', 'show']
]);
