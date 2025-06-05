<?php

use App\Http\Controllers\ChatController;
use Illuminate\Support\Facades\Route;

Route::middleware(['web','auth'])->group(function(){
    Route::get('/chat/{id}/messages',[ChatController::class,'chat_messages']);
    Route::post('/chat/{id}/messages', [ChatController::class,'send_message']);
});


?>