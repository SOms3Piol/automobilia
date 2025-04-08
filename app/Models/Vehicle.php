<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    //
   protected $fillable = [
        'user_id',
        'location',
        'title',
        'price',
        'thumbnail',
        'modal',
        'make',
        'year',
        'mileage',
        'transmission',
        'exterior_color',
        'interior_color',
        'manufacture_country',
        'category',
        'engine_capacity',
        'engine_type',
        'additional_feature',
        'description',
        'phone_number'
   ];
    
    protected function casts(){
        return [
            'additional_feature' => 'json'
        ];
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
