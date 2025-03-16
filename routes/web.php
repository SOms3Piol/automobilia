<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::view('/' , 'welcome')->name("home");

Route::view('/contact' , 'contact') ->name('contact');

Route::view('/tos' , 'tos') ->name('tos');

Route::view('/blogs','blogs')->name('blogs');

Route::view('/login','login')->name('login');

Route::view('/register' , 'register')->name('register');

Route::view('/vehicles' , 'products') ->name('vehicles');






// Api routes
Route::post('/register' , [UserController::class,'register'])->name("user.create");
Route::post("/login", [UserController::class,"login"])->name("user.auth");
Route::post('/logout' , [UserController::class,"logout"])->name('logout');