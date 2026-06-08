<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AuthorController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/hhh', function () {
    return view('home');
});


Route::resource('books', BookController::class);
Route::resource('categories', CategoryController::class);
Route::resource('authors', AuthorController::class);
