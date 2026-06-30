<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\QueueController;

// Removed middleware('auth:sanctum') so your mobile/desktop views can connect
Route::get('/queue', [QueueController::class, 'index']);
Route::post('/queue', [QueueController::class, 'store']);
Route::patch('/queue/{id}', [QueueController::class, 'update']);
Route::delete('/queue/{id}', [QueueController::class, 'destroy']);