<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;

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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::prefix('v1/')->group(function() {
    Route::get('/movies', [ MovieController::class, 'index' ]);
    Route::get('/movies/sort/year', [ MovieController::class, 'sortByYear' ]);
    Route::get('/movies/search/{keyword}', [ MovieController::class, 'searchKeyword' ]);
    Route::get('/movies/search/year/{year}', [ MovieController::class, 'searchByYear' ]);
});
