<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\StudioApiController;

Route::get('/studios', [StudioApiController::class, 'index']);
Route::get('/studios/{id}', [StudioApiController::class, 'show']);
Route::post('/studios', [StudioApiController::class, 'store']);
Route::put('/studios/{id}', [StudioApiController::class, 'update']);
Route::delete('/studios/{id}', [StudioApiController::class, 'destroy']);