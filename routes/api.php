<?php

use App\Http\Controllers\CreateAppController;
use App\Http\Controllers\ManageMemberController;
use App\Http\Controllers\MyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('member', ManageMemberController::class)->middleware('auth:sanctum');

Route::post("app/convert/{app}", [MyController::class, "convert"])->middleware('auth:sanctum');

Route::post("app", CreateAppController::class)->middleware('auth:sanctum');

Route::get('/cache-all', function () {
    // Cache configuration files
    Artisan::call('config:cache');

    // Cache routes
    Artisan::call('route:cache');

    // Cache views
    Artisan::call('view:cache');

    return 'All caches have been set.';
});
