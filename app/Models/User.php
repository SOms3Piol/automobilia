<?php

namespace App\Models;

use App\Models\Chat;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone_number'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function vehicles(){
        return $this->hasMany(Vehicle::class);
    }

    public function purchasedPlan(){
        return $this->hasOne(PurchasedPlan::class);
    }

   public function sentMessages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    public function chatsAsSender()
    {
        return $this->hasMany(Chat::class, 'sender_id');
    }

    public function chatsAsReceiver()
    {
        return $this->hasMany(Chat::class, 'receiver_id');
    }

    public function chats()
    {
        return Chat::where('sender_id', $this->id)
                   ->orWhere('receiver_id', $this->id);
    }
    
}
