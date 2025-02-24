<?php

use App\Http\Controllers\CocheController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [CocheController::class, 'index'])->name('index');