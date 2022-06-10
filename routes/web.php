<?php

use App\Http\Controllers\MyController;
use Illuminate\Support\Facades\Route;

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
})->name("welcome");

Route::get('/pricing', function () {
    return view('pricing');
})->name('pricing');

Route::get('/convert', function () {
    return view('convert');
})->name('convert');

Route::get('/payment', function () {
    return view('payment');
})->name('payment');

Route::post('/convert', [MyController::class, 'convert'])->name('submitconvert');
