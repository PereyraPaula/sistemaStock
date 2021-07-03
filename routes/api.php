<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LastMovementController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('categories','App\Http\Controllers\CategoryController');
Route::apiResource('articles','App\Http\Controllers\ArticleController');
Route::apiResource('headproofs','App\Http\Controllers\HeadproofController');
Route::apiResource('lineproofs','App\Http\Controllers\LineproofController');

Route::get('lastmovements', [LastMovementController::class, 'index']);

