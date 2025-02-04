<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SalesController;

Auth::routes(['verify' => true]);

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');
Route::resource('sales', SalesController::class);
Route::get('/createnewproduct', [App\Http\Controllers\HomeController::class, 'crearProducto'])->name('createnewproduct');
Route::post('/sales/{sale}/buy', [SalesController::class, 'buy'])->name('buy');
Route::get('/editproduct/{id}', action: [App\Http\Controllers\HomeController::class, 'edit'])->name('editproduct');
Route::delete('/deleteproduct/{sale}', [App\Http\Controllers\SalesController::class, 'destroy'])->name('deleteproduct');
