<?php

use App\Http\Controllers\DeskController;
use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
/*
|---------------------------------------------------------
-----------------
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

Route::get('/tasks', [TaskController::class, 'index']);


Route::prefix('/task')->group(function() {
   Route::post('/store', [TaskController::class, 'store']);
   Route::post('/sort', [TaskController::class, 'sort']);
   Route::put('/{id}', [TaskController::class, 'update']);
   Route::delete('/{id}', [TaskController::class, 'destroy']);
});

Route::get('/desks', [DeskController::class, 'index']);
Route::prefix('/desk')->group(function() {
    Route::post('/store', [DeskController::class, 'store']);
    Route::post('/sort', [DeskController::class, 'sort']);
    Route::put('/{id}', [DeskController::class, 'update']);
    Route::delete('/{id}', [DeskController::class, 'destroy']);
});
