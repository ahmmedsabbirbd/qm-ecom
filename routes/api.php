<?php

use App\Http\Controllers\AdvanceWhereClausesController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\QueryBuilderPracticeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('/products', ProductController::class);
Route::controller(ProductController::class)->group(function () {
    Route::get('/products/{id}/details', 'productDetails');
    Route::post('/products/{id}/details', 'productDetailsAdd');
});

Route::apiResource('/querybuilder', QueryBuilderPracticeController::class);
Route::apiResource('/advance-where-clauses', AdvanceWhereClausesController::class);
Route::apiResource('/brands', BrandController::class);