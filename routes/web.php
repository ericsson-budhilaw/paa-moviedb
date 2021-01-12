<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BaseController;

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

//Route::get('/', function () {
//    $movie  = \App\Models\Movie::all();
//    echo "<img src=" . $movie[2]->poster . "/>";
//});

//Route::get('/', [ BaseController::class, 'index' ]);
Route::get('/{any}', function() {
    return view('layouts.app');
})->where('any', '.*');
