<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OpenRouterController;

Route::get('/', [App\Http\Controllers\MovieController::class, 'index']);
Route::get('/theloai/{id}', [App\Http\Controllers\MovieController::class, 'showByGenre']);

Route::get('/openrouter', [OpenRouterController::class, 'chat']);

Route::get('/detail/{id}', [App\Http\Controllers\MovieController_VA::class, 'detail']);
Route::get('/danh-sach-phim', [App\Http\Controllers\MovieController::class, 'danhsachphim']);
