<?php

use App\Http\Controllers\UserController;
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








// Api routes
Route::post('/register' , [UserController::class,'register'])->name("user.create");
Route::post("/login", [UserController::class,"login"])->name("user.auth");
Route::post('/logout' , [UserController::class,"logout"])->name('logout');