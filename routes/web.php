<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('login', function () {
    return view('users.login');
});

Route::post('login', [UserController::class, 'login']);

Route::get('register', function () {
    return view('users.register');
});

Route::post('register', [UserController::class, 'store']);

Route::get('logout', function () {
    return response(404);
});

Route::get('maps', function () {
    return view('maps.trips_map');
});