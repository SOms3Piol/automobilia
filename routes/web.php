<?php

use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehicleController;

use Illuminate\Support\Facades\Route;

Route::view('/' , 'welcome')->name("home");

Route::view('/login','login')->name('login');

Route::view('/register' , 'register')->name('register');

Route::get('/vehicles', [SearchController::class,'index'])->name('vehicles');





Route::get('/blogs' , function(){
    return "blogs pagee";
})->name('blogs');

Route::get('/tos' , function(){
    return  "tos page";
})->name('tos');

Route::get('/contact' , function(){
    return "contact form page";
})->name('contact');



Route::resource('vehicle', VehicleController::class)
    ->except(['show'])
    ->middleware('auth');

Route::middleware('auth')->group(function(){
    Route::view('/dashboard' , 'dashboard')->name('user.dashboard');
    Route::get('/dashboard/setting' , function(){
        return "User setting pages";
    })->name('user.setting');
});
    

    
Route::get('vehicle/{vehicle}', [VehicleController::class, 'show'])
    ->name('vehicle.show');





// Api routes
Route::post('/register' , [UserController::class,'register'])->name("user.create");
Route::post("/login", [UserController::class,"login"])->name("user.auth");
Route::post('/logout' , [UserController::class,"logout"])->name('user.logout');