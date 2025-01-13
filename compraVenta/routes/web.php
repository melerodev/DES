<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SalesController;

/* Route::get('/', function () {
    return view('welcome');
});
 */

// 1º
Auth::routes(['verify' => true]);

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');
Route::get('/', [SalesController::class, 'index']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'home'])->name('home');
// Route::get('/verificado', [App\Http\Controllers\HomeController::class, 'verificado'])->name('verificado');
// Route::get('/usermanager', [App\Http\Controllers\HomeController::class, 'usermanager'])->name('usermanager');
Route::resource('sales', SalesController::class);
Route::get('/createnewproduct', [App\Http\Controllers\HomeController::class, 'crearProducto'])->name('createnewproduct');
Route::post('/sales/{sale}/buy', [SalesController::class, 'buy'])->name('sales.buy');
// funcion para getImagePath
Route::get('/getImagePath/{id}', [App\Http\Controllers\SalesController::class, 'getImagePath'])->name('getImagePath');

// // Administrators routes
// Route::get('admin', [App\Http\Controllers\AdministratorsController::class, 'index'])->name('admin.index');
// Route::get('super', [App\Http\Controllers\AdministratorsController::class, 'indexSuper'])->name('super.index');

// // Profile routes
// Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
// Route::get('/profile/password', [ProfileController::class, 'show'])->name('profile.password');
// Route::put('/profile/update', [ProfileController::class, 'updateProfile'])->name('profile.update');
// Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
// Route::get('/profile/{id}/edit', [ProfileController::class, 'edit'])->name('profile.edit');
// Route::delete('/profile/{id}', [ProfileController::class, 'destroy'])->name('profile.destroy');
