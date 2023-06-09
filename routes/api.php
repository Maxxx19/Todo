<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\SubtaskController;

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

Route::get('/tasks', [TaskController::class, 'index']);
Route::prefix('/task')->group(function(){
    Route::post('/store',[TaskController::class, 'store']);
    Route::put('/{id}' , [TaskController::class, 'update']);
    Route::delete('/{id}', [TaskController::class, 'destroy'] );
});

Route::get('/subtasks/{task_id}', [SubtaskController::class, 'index']);
Route::prefix('/subtask')->group(function(){
    Route::post('/store/{task_id}',[SubtaskController::class, 'store']);
    Route::put('/{id}' , [SubtaskController::class, 'update']);
    Route::delete('/{id}', [SubtaskController::class, 'destroy'] );
});