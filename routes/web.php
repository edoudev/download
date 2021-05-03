<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return inertia('Home');
})->name('home');

Route::get('/process', fn () => redirect()->route('home'));
Route::post('/process', 'MainController@index')->name('process');
