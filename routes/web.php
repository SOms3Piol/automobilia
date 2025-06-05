<?php

use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\DealersController;
use App\Http\Controllers\ChatController;

use Illuminate\Support\Facades\Route;

// nav-bar routes
Route::view('/' , 'welcome')->name("home");
Route::get('/vehicles', [SearchController::class,'index'])->name('vehicles');
Route::get('/search',[SearchController::class,'search'])->name('search.vehicle');


// dealers-route
Route::get('/dealers', [DealersController::class, 'index'])->name('dealer.index');
Route::get('/dealers/{id}', [DealersController::class, 'show'])->name('dealer.show');
Route::get('/ads' , [DealersController::class, 'index_ads'])->name('dealer.ads');
Route::delete('/disable' , [DealersController::class, 'disable_ad'])->name('disable_ad');
Route::post('/active',[DealersController::class,'active_ad'])->name('active.ad');



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
    Route::get('/dashboard' , [DealersController::class, 'dashboard'])->name('user.dashboard');
    Route::get('/dashboard/setting' , function(){
        return "User setting pages";
    })->name('user.setting');


    // checkout routes
    Route::get('/plans' , [CheckoutController::class,'index'])->name('plans.index');
    Route::get('/checkout-session/{id}', [CheckoutController::class ,'checkout_session'])->name('checkout.session');
    Route::get('/checkout-success' , [CheckoutController::class, 'checkout_success'])->name('checkout.success');
    Route::get('/checkout-cancel' , [CheckoutController::class, 'checkout_cancel'])->name('checkout.cancel');
    Route::delete('/cancel-subscription', [CheckoutController::class, 'unsubscribe'])->name('unsubscribe');



    Route::get('/chats',[ChatController::class,'index'])->name('chat.index');

});
    

// user Auth routes
Route::view('/login','login')->name('login');
Route::view('/register' , 'register')->name('register');
Route::post('/register' , [UserController::class,'register'])->name("user.create");
Route::post("/login", [UserController::class,"login"])->name("user.auth");
Route::post('/logout' , [UserController::class,"logout"])->name('user.logout');



