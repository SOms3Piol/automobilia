<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name("home");

Route::get('/login', function () {
    return "fRom login";
})->name('login');

Route::get('/register', function () {
    return "fRom register";
})->name('register');