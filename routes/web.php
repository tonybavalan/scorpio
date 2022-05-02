<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\UserController;

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
})
->name('login');

Route::post('login', [UserController::class, 'login']);

Route::get('register', function () {
    return view('users.register');
})
->name('register');

Route::post('register', [UserController::class, 'store']);

Route::post('logout', [UserController::class, 'logout'])->name('logout');

Route::get('dashboard', function () {
    return view('dashboard');
})
->name('dashboard')
->middleware('auth');

Route::get('maps', function () {
    return view('maps.trips_map');
});