<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MapController;
use App\Http\Controllers\Api\V1\TripController;
use App\Http\Controllers\Api\V1\DriverController;
use App\Http\Controllers\Api\V1\CustomerController;
use App\Http\Controllers\Api\V1\UserController;

/*
|--------------------------------------------------------------------------
| Api Routes
|--------------------------------------------------------------------------
*/

// Public Routes
Route::post('customer/login', [CustomerController::class,'login']);

Route::post('driver/login', [DriverController::class,'login']);

Route::post('user/login', [UserController::class, 'login']);

Route::apiResource('customer', CustomerController::class)->only(['index', 'store']);

Route::apiResource('driver', DriverController::class)->only(['index', 'store']);

Route::apiResource('user', UserController::class)->only(['index', 'store']);

Route::get('geocode/{query}', [MapController::class, 'geocoding']);

// Route::get('structgeocode/{query}', [MapController::class, 'structGeocoding']);

// Protected Routes
Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::get('trips', [TripController::class, 'index']);
    Route::post('trip', [TripController::class, 'store']);
    
    Route::prefix('customer')->group(function () {
        Route::get('logout', [CustomerController::class, 'logout']);
    });

    Route::prefix('driver')->group(function () {
        Route::get('logout', [DriverController::class, 'logout']);
    });

    Route::prefix('user')->group(function () {
        Route::get('logout', [UserController::class, 'logout']);
    });

    // Route::apiResource('customer', CustomerController::class)->only(['show', 'destroy']);

    // Route::apiResource('driver', DriverController::class)->only(['show', 'destroy']);
});