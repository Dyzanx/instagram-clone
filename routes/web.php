<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/user/config', [App\Http\Controllers\UserController::class, 'config'])->name('user.config');
Route::post('/user/update', [App\Http\Controllers\UserController::class, 'update'])->name('user.update');
Route::get('/user/avatar/{filename}', [App\Http\Controllers\UserController::class, 'getImage'])->name('user.avatar');

Route::get('/post/create', [App\Http\Controllers\PostController::class, 'create'])->name('post.create');
Route::post('/post/save', [App\Http\Controllers\PostController::class, 'save'])->name('post.save');
Route::get('/post/file/{filename}', [App\Http\Controllers\HomeController::class, 'getImage'])->name('post.file');