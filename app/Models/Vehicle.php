<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    //
    
    protected function casts(){
        return [
            'additional_feature' => 'json'
        ];
    }

    protected function user(){
        return $this->belongsTo(User::class);
    }
}
