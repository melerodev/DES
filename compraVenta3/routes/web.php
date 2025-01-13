<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SalesController;

// Ensure the SalesController class exists in the specified namespace
// If it does not exist, create it using the following command:
// php artisan make:controller SalesController

Route::get('/', function () {
    return view('welcome');
});

Route::get('/createnewproduct.blade', function () {
    return view('createnewproduct');
});

Route::resource('sales', SalesController::class);
Route::get('/', [SalesController::class, 'index']);