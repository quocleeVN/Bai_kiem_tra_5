<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OpenRouterController;

Route::get('/', [App\Http\Controllers\MovieController::class, 'index']);
Route::get('/theloai/{id}', [App\Http\Controllers\MovieController::class, 'showByGenre']);

Route::get('/openrouter', [OpenRouterController::class, 'chat']);
use App\Http\Controllers\MovieController_QN;


Route::get('/timkiem', [MovieController_QN::class, 'search']);