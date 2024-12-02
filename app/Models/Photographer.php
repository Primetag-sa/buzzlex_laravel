<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
/**
 * @method static self create(array $data)
 */
class Photographer extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

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

    public function addons()
    {
        return $this->hasMany(Addon::class);
    }

}

