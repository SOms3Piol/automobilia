<?php

use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\DealersController;

use Illuminate\Support\Facades\Route;

// nav-bar routes
Route::view('/' , 'welcome')->name("home");
Route::get('/vehicles', [SearchController::class,'index'])->name('vehicles');
Route::get('/search',[SearchController::class,'search'])->name('search.vehicle');
Route::get('/dealers', [DealersController::class, 'index'])->name('dealer.index');
Route::get('/dealers/{id}', [DealersController::class, 'show'])->name('dealer.show');


// static routes
Route::get('/blogs' , function(){
    return "blogs pagee";
})->name('blogs');

Route::get('/tos' , function(){
    return  "tos page";
})->name('tos');

Route::get('/contact' , function(){
    return "contact form page";
})->name('contact');


// Resources Managing
Route::resource('vehicle', VehicleController::class)
    ->except(['show'])
    ->middleware('auth');
Route::get('vehicle/{vehicle}', [VehicleController::class, 'show'])
    ->name('vehicle.show');

Route::middleware('auth')->group(function(){
    Route::view('/dashboard' , 'dashboard')->name('user.dashboard');
    Route::get('/dashboard/setting' , function(){
        return "User setting pages";
    })->name('user.setting');
});
    







// user Auth routes
Route::view('/login','login')->name('login');

Route::view('/register' , 'register')->name('register');
Route::post('/register' , [UserController::class,'register'])->name("user.create");
Route::post("/login", [UserController::class,"login"])->name("user.auth");
Route::post('/logout' , [UserController::class,"logout"])->name('user.logout');