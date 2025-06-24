<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\GenreController;

Route::get('/', function () {
    return redirect(route('books.index')); 
});

Route::resource('authors', AuthorController::class);
Route::resource('books', BookController::class);
Route::resource('reviews', ReviewController::class)->only('store', 'destroy');
Route::resource('genres', GenreController::class)->only('store', 'destroy');

Route::get('/books/create/{selectedAuthor}', [BookController::class, 'create'])->name('books.create.with.author');
