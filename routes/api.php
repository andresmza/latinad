<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DisplayController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {

    // Authentication Routes
    Route::post('/login', [AuthController::class, 'login']);

    // Protected Routes
    Route::middleware('auth:api')->group(function () {
        Route::apiResource('displays', DisplayController::class);       
        Route::post('/logout', [AuthController::class, 'logout']);
    });
});
