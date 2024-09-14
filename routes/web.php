<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CategoryController;

// Welcome Page Route
Route::get('/', function () {
    return view('welcome');
});

// User Routes
Route::resource('users', UserController::class);

// Post Routes
Route::resource('posts', PostController::class);

// Comment Routes (Nested within posts)
Route::prefix('posts/{post}/comments')->name('comments.')->group(function () {
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/users/{user}', [UserController::class, 'show']);
    Route::get('/users/{user}/posts', [UserController::class, 'posts']);
    Route::post('/users', [UserController::class, 'store']);
    Route::put('/users/{user}', [UserController::class, 'update']); 
    Route::delete('/users/{user}', [UserController::class, 'destroy']);
    Route::get('/posts', [PostController::class, 'index']);
    Route::get('posts/{post}/comments', [CommentController::class, 'index']);
    Route::post('posts/{post}/comments', [CommentController::class, 'store']);
    Route::get('posts/{post}/comments/{comment}', [CommentController::class, 'show']);
    Route::put('posts/{post}/comments/{comment}', [CommentController::class, 'update']);
    Route::delete('posts/{post}/comments/{comment}', [CommentController::class, 'destroy']);
    Route::get('/', [CommentController::class, 'index'])->name('index');
    Route::get('create', [CommentController::class, 'create'])->name('create');
    Route::post('/', [CommentController::class, 'store'])->name('store'); Route::get('{comment}/edit', [CommentController::class, 'edit'])->name('edit');
    Route::put('{comment}', [CommentController::class, 'update'])->name('update');
    Route::delete('{comment}', [CommentController::class, 'destroy'])->name('destroy');
    Route::get('/', [CommentController::class, 'index'])->name('index');
    Route::get('create', [CommentController::class, 'create'])->name('create');
    Route::post('/', [CommentController::class, 'store'])->name('store');
    Route::get('{comment}/edit', [CommentController::class, 'edit'])->name('edit');
    Route::put('{comment}', [CommentController::class, 'update'])->name('update');
    Route::delete('{comment}', [CommentController::class, 'destroy'])->name('destroy');
});

// Category Routes
Route::resource('categories', CategoryController::class);
