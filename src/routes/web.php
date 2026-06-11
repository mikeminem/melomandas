<?php

use Illuminate\Support\Facades\Route;

//free access
Route::get('/', function () {
    return view('welcome');
});


//restricted access
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('categories', App\Http\Controllers\CategoryController::class)
    ->except(['create', 'edit']);
