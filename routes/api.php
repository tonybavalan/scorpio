<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DriverController;
use App\Http\Controllers\Api\CustomerController;

/*
|--------------------------------------------------------------------------
| Api Routes
|--------------------------------------------------------------------------
*/

// Public Routes
Route::any('customer/login', [CustomerController::class,'login']);

Route::any('driver/login', [DriverController::class,'login']);

Route::apiResource('customer', CustomerController::class);

Route::apiResource('driver', DriverController::class);

// Protected Routes
Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::prefix('customer')->group(function () {
        Route::any('logout', [CustomerController::class, 'logout']);
    });

    Route::prefix('driver')->group(function () {
        Route::any('logout', [DriverController::class, 'logout']);
    });

    Route::apiResource('customer', CustomerController::class)->only(['show', 'destroy']);

    Route::apiResource('driver', DriverController::class)->only(['show', 'destroy']);
});