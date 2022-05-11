<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\CustomerController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('customers', [CustomerController::class, 'index'])->middleware(['auth'])->name('customers');

Route::get('drivers', [CustomerController::class, 'index'])->middleware(['auth'])->name('drivers');

Route::get('trips', [CustomerController::class, 'index'])->middleware(['auth'])->name('trips');

require __DIR__.'/auth.php';
