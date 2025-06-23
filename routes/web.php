<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;

Route::get('/', function () {
    return redirect(route('authors.index')); 
});

route::resource('authors', AuthorController::class);
route::resource('books', BookController::class);
