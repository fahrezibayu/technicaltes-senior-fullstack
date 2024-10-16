<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MasterController;
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
Route::get('/desa', [MasterController::class, 'index']);
Route::get('/farmer', [MasterController::class, 'farmer']);
Route::get('/facilitator', [MasterController::class, 'facilitator']);
Route::get('/kecamatan', [MasterController::class, 'kecamatan']);
Route::get('/kabupaten', [MasterController::class, 'kabupaten']);
Route::get('/province', [MasterController::class, 'province']);
