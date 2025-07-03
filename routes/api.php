<?php

use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\GenreController;
use App\Http\Controllers\Api\ReviewController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthorController;

Route::post('/register', [UserController::class,'register']);
Route::post('/login', [UserController::class,'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('authors', AuthorController::class);
    Route::apiResource('books', BookController::class);
    Route::apiResource('genres', GenreController::class);
    Route::post('reviews', [ReviewController::class, 'store']);
    Route::put('reviews/{review}', [ReviewController::class, 'update']);
    Route::delete('reviews/{review}', [ReviewController::class,'delete']);
});

