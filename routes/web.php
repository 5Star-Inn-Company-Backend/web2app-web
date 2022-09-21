<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MyController;
use App\Http\Controllers\StoreController;

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

Route::get('/success', function () {
    return view('successpage');
})->name('success');

Route::get('/feed', function () {
    return view('feedback');
})->name('feed');


//for the store

Route::get('/createstore', function () {
    return view('createstore');
})->name('createstore');

Route::post('/convert', [MyController::class, 'convert'])->name('submitconvert');
Route::post('/store', [StoreController::class, 'addstore'])->name('submitstore');
Route::get('/showstore', [StoreController::class, 'showstore'])->name('showstore');
Route::get('/viewstore/{id}', [StoreController::class, 'viewstore'])->name('viewstore');
//for success page
Route::get('/successpage/{id}', [MyController::class, 'success'])->name('successpage');
Route::post('feedback', [MyController::class, 'feedback'])->name('feedback');
//for payment
Route::post('purchase', [StoreController::class, 'purchase']);
