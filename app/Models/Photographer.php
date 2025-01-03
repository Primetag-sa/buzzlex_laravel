<?php

namespace App\Models;

use Filter\Traits\HasFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * @method static self create(array $data)
 */
class Photographer extends Authenticatable implements HasMedia
{
    use HasApiTokens, HasFactory, Notifiable, HasFilter, InteractsWithMedia;

    /**
    * The attributes that are mass assignable.
    * @var array
    */
    protected $fillable = [
        'name',
        'bio',
        'phone',
        'email',
        'password',
        'otp',
        'fcm_token',
        'dob',
        'age',
        'gender',
        'latitude',
        'longitude',
        'country',
        'city',
        'rate',
        'phone_verified_at'
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'otp'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'phone_verified_at' => 'datetime',
        'dob'               => 'date',
    ];

    //########################################### Constants ################################################

    const GENDER = [
        'male',
        'female',
    ];

    //########################################### Accessors ################################################


    //########################################### Mutators #################################################


    //########################################### Scopes ###################################################


    //########################################### Relations ################################################

    public function services()
    {
        return $this->hasMany(PhotographerService::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function availability()
    {
        return $this->hasMany(PhotographerAvailability::class)->where('date_from', '>=', today());
    }

    public function galleries()
    {
        return $this->hasMany(Gallery::class);
    }

    public function plans()
    {
        return $this->hasMany(Plan::class);
    }

    public function messages()
    {
        return $this->morphMany(Message::class, 'sender');
    }

    public function conversations()
    {
        return $this->hasMany(Conversation::class);
    }
}

