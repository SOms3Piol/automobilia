<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MessageRead extends Model{

    protected $fillable = [
        'sender_id',
        'message_id',
        'chat_id'
    ];

}


?>