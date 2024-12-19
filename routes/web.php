<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
//    return view('welcome');
//});
Route::resource('posts', PostController::class);
Route::get('/', [PostController::class, 'index']);

Route::post('posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');

Route::put('posts/{post}/publish', [PostController::class, 'publish'])->name('posts.publish');
Route::put('posts/{post}/unpublish', [PostController::class, 'unpublish'])->name('posts.unpublish');