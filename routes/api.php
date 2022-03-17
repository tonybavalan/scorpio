<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DriverController;
use App\Http\Controllers\Api\CustomerController;

Route::get('/customer', [CustomerController::class, 'index']);

Route::post('/customer', [CustomerController::class, 'store']);

Route::get('/driver', [DriverController::class, 'index']);

Route::post('/driver', [DriverController::class, 'store']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
