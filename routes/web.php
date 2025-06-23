<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorController;

Route::get('/', function () {
    return redirect(route('authors.index')); 
});

route::resource('authors', AuthorController::class);
