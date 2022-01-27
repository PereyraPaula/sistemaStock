<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LastMovementController;
use App\Http\Controllers\LineproofController;
use App\Http\Controllers\CategoryController;

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
Route::get('categoriesAll',[CategoryController::class, 'allNameCategories']);
Route::get('categoriaIdByName/{name}', [CategoryController::class, 'searchByNameCategory']);

Route::apiResource('articles','App\Http\Controllers\ArticleController');
Route::apiResource('headproofs','App\Http\Controllers\HeadproofController');
Route::apiResource('lineproofs','App\Http\Controllers\LineproofController');

Route::get('lastmovements', [LastMovementController::class, 'index']);
Route::get('inventory', [LineproofController::class, 'inventory']);

Route::get('betweenDates/{startDate}/{endDate}', [function ($startDate,$endDate) {
    $betweenDates = DB::table('headproofs')
       ->join('lineproofs','lineproofs.headproof_id','=','headproofs.id')
       ->select('headproofs.id','headproofs.type_movement','headproofs.date_movement','lineproofs.quantity_movement')->orderBy('date_movement','desc')
       ->whereBetween('headproofs.date_movement', [$startDate, $endDate])
       ->get();

    return $betweenDates->toJson(JSON_PRETTY_PRINT);
}]);
