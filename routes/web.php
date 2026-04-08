<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OpenRouterController;

Route::get('/', [App\Http\Controllers\MovieController::class, 'index']);
Route::get('/theloai/{id}', [App\Http\Controllers\MovieController::class, 'showByGenre']);

Route::get('/openrouter', [OpenRouterController::class, 'chat']);

Route::get('/timkiem', [App\Http\Controllers\MovieController::class, 'search']);

Route::get('/detail/{id}', [App\Http\Controllers\MovieController_VA::class, 'detail']);
Route::get('/danh-sach-phim', [App\Http\Controllers\MovieController::class, 'danhsachphim']);
Route::get('/them-phim', [App\Http\Controllers\MovieController::class, 'create']);
Route::post('/them-phim', [App\Http\Controllers\MovieController::class, 'store']);
Route::get('/delete/{id}', [App\Http\Controllers\MovieController::class, 'delete']);
