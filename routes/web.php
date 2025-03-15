<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name("home");


Route::get('/contact' , function () {
    return "Contact use page";
}) ->name('contact');

Route::get('/tos', function () {

    return "Terms of Services";
}) ->name('tos');


Route::get("/blogs" , function(){
    return "Blgos Pages";
})->name('blogs');



Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/register', function () {
    return view('register');
})->name('register');