<?php

use App\Http\Controllers\Api\CommonApiController;
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

Route::controller(CommonApiController::class)->prefix('customer-invoice')->middleware('auth:sanctum')->group(function () {
    Route::get('/list', 'getList');
    Route::post('/add-data', 'store');
    Route::get('/find-data/{id}', 'find');
    Route::put('/update-data/{id}', 'update');
});
