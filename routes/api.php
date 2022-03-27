<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\TripController;
use App\Http\Controllers\Api\V1\DriverController;
use App\Http\Controllers\Api\V1\CustomerController;

/*
|--------------------------------------------------------------------------
| Api Routes
|--------------------------------------------------------------------------
*/

// Public Routes
Route::post('customer/login', [CustomerController::class,'login']);

Route::post('driver/login', [DriverController::class,'login']);

Route::apiResource('customer', CustomerController::class)->only(['index', 'store']);

Route::apiResource('driver', DriverController::class)->only(['index', 'store']);

Route::get('/map/{query}', function ($query) {
    // $response = Http::timeout(5)->get('https://api.tomtom.com/search/2/geocode/'.$query.'.json?storeResult=false&typeahead=true&countrySet=IN&view=IN&key=NLv6kmsraNtNKpaoqqBHK6e3GZYFozJz');

    $response = Http::get('https://api.tomtom.com/search/2/geocode/'.$query.'.json?storeResult=false&typeahead=true&countrySet=IN&view=IN&key=NLv6kmsraNtNKpaoqqBHK6e3GZYFozJz');

    return response()->json($response->body());
});

Route::apiResource('trip', TripController::class);

// Protected Routes
Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::prefix('customer')->group(function () {
        Route::get('logout', [CustomerController::class, 'logout']);
    });

    Route::prefix('driver')->group(function () {
        Route::get('logout', [DriverController::class, 'logout']);
    });

    Route::apiResource('customer', CustomerController::class)->only(['show', 'destroy']);

    Route::apiResource('driver', DriverController::class)->only(['show', 'destroy']);
});