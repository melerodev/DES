<?php

use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

Route::get('/', [PostController::class, 'index'])->name('post.index');

Route::resource('post', PostController::class);

Route::post('/post/{post}/comment', [PostController::class , 'storeComment'])->name('post.comment');

Route::resource('comment', CommentController::class);