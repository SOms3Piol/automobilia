<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchasedPlan extends Model
{
    //
   protected $fillable = [
        'plan_id',
        'user_id',
        'allowed_ads'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
