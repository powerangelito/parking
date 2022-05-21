<?php

use App\Http\Controllers\CarController;
use App\Http\Controllers\CheckInController;
use App\Http\Controllers\CheckOutController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::apiResource('checkIN', CheckInController::class);
Route::apiResource('car', CarController::class);

Route::post('checkIN', [CheckInController::class, 'store']);
Route::post('checkOUT', [CheckOutController::class, 'store']);
