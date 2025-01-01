<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Filter\Traits\HasFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class User extends Authenticatable implements HasMedia
{
    use HasApiTokens, HasFactory, HasFilter, Notifiable, InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'phone',
        'email',
        'password',
        'otp',
        'fcm_token',
        'dob',
        'gender',
        'latitude',
        'longitude',
        'phone_verified_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'otp'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'phone_verified_at' => 'datetime',
        'dob' => 'date',
    ];

    public function getTotalSpentAttribute()
    {
        return $this->orders()->sum('total_price');
    }

    public function routeNotificationForFcm()
    {
        return $this->fcm_token;
    }

    public function favorites()
    {
        return $this->hasMany(UserFavorite::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function messages()
    {
        return $this->morphMany(Message::class, 'sender');
    }

    public function conversations()
    {
        return $this->hasMany(Conversation::class);
    }

    public function generalOrders()
    {
        return $this->hasMany(GeneralOrder::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
