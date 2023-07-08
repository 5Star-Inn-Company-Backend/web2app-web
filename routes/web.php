<?php

use App\Jobs\StartBuildJob;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MyController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\Auth\LoginController;

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


Route::post('/convert', [MyController::class, 'convert'])->name('submitconvert');
//for success page
Route::get('/successpage/{id}', [MyController::class, 'success'])->name('successpage');

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


Route::post('/store', [StoreController::class, 'addstore'])->name('submitstore');
Route::get('/showstore', [StoreController::class, 'showstore'])->name('showstore');
Route::get('/viewstore/{id}', [StoreController::class, 'viewstore'])->name('viewstore');


//for the store

// Route::group(['middleware' => 'auth:sanctum'], function () {

Route::get('/createstore', function () {
    return view('createstore');
})->name('createstore');


Route::post('feedback', [MyController::class, 'feedback'])->name('feedback');
//for payment
Route::post('purchase', [StoreController::class, 'purchase']);

//    Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');


//for change password
Route::post('update', [MyController::class, 'update'])->name('update');
// Route::post('updatepass', [MyController::class, 'updatepass'])->name('updatepass');

Route::get('/feed', function () {
    return view('feedback');
})->name('feed');

Route::get('/changepass', function () {
    return view('changepass');
})->name('changepass');

// });

Route::get('/retry/{ref}', function ($ref) {
    StartBuildJob::dispatch($ref);
    echo "success";
})->name('success');


require __DIR__ . '/storages.php';

