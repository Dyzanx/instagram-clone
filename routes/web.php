<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// users
Route::get('/user/config', [App\Http\Controllers\UserController::class, 'config'])->name('user.config');
Route::post('/user/update', [App\Http\Controllers\UserController::class, 'update'])->name('user.update');
Route::get('/user/avatar/{filename}', [App\Http\Controllers\UserController::class, 'getImage'])->name('user.avatar');
Route::get('/user/profile/{id}', [App\Http\Controllers\UserController::class, 'profile'])->name('user.profile');
Route::get('/users/{search?}', [App\Http\Controllers\UserController::class, 'users'])->name('user.index');

// posts
Route::get('/post/create', [App\Http\Controllers\PostController::class, 'create'])->name('post.create');
Route::post('/post/save', [App\Http\Controllers\PostController::class, 'save'])->name('post.save');
Route::get('/post/file/{filename}', [App\Http\Controllers\HomeController::class, 'getImage'])->name('post.file');
Route::get('/post/{id}', [App\Http\Controllers\PostController::class, 'detail'])->name('post.detail');
Route::get('/post/delete/{id}', [App\Http\Controllers\PostController::class, 'delete'])->name('post.delete');
Route::get('/post/edit/{id}', [App\Http\Controllers\PostController::class, 'edit'])->name('post.edit');
Route::post('/post/update/', [App\Http\Controllers\PostController::class, 'update'])->name('post.update');

// comments
Route::get('/comment/save', [App\Http\Controllers\CommentsController::class, 'save'])->name('comment.save');
Route::get('/comment/delete/{id}', [App\Http\Controllers\CommentsController::class, 'delete'])->name('comment.delete');

// likes
Route::get('/like/{post_id}', [App\Http\Controllers\LikesController::class, 'like'])->name('like.like');
Route::get('/dislike/{post_id}', [App\Http\Controllers\LikesController::class, 'dislike'])->name('like.dislike');
Route::get('/likes', [App\Http\Controllers\LikesController::class, 'index'])->name('like.index');