<?php

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

use App\Models\Build;
use Illuminate\Support\Facades\Route;


Route::get('/bucket/{reference}/{type}', function ($reference,$type) {
    $build=Build::where(['reference_code' => $reference])->latest()->first();

    if(!$build){
        abort(403);
    }
    $path = storage_path('app/public/artifacts/' . "$reference.$type");

    if (!File::exists($path)) {
        abort(404);
    }
    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);
    return $response;
})->name('bucket.download');



