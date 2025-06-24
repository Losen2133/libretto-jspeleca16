<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ReviewController;

Route::get('/', function () {
    return redirect(route('books.index')); 
});

Route::resource('authors', AuthorController::class);
Route::resource('books', BookController::class);
Route::resource('reviews', ReviewController::class);

Route::get('/books/create/{selectedAuthor}', [BookController::class, 'create'])->name('books.create.with.author');
Route::get('reviews/create', [ReviewController::class, 'create'])->name('reviews.create');
