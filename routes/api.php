<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;

// User API routes
Route::apiResource('users', UserController::class);

// Post API routes
Route::apiResource('posts', PostController::class);

// Category API routes
Route::apiResource('categories', CategoryController::class);

// Comments (nested within posts)
Route::prefix('posts/{post}')->group(function () {
    Route::get('comments', [CommentController::class, 'index']);
    Route::post('comments', [CommentController::class, 'store']);
    Route::get('comments/{comment}', [CommentController::class, 'show']);
    Route::put('comments/{comment}', [CommentController::class, 'update']);
    Route::delete('comments/{comment}', [CommentController::class, 'destroy']);
});
