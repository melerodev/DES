<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\SongController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoriesController;
use Illuminate\Support\Facades\Route;

Route::get('/', [SongController::class, 'main']);
Route::resource('song', SongController::class)->except(['create', 'edit']);

Route::post('login', [UserController::class, 'login'])->name('login');
Route::post('logout', [UserController::class, 'logout'])->name('logout');
Route::post('register', [UserController::class, 'register'])->name('register');
Route::get('/categories', [CategoriesController::class, 'index']);
Route::post('/categories', [CategoriesController::class, 'store']);