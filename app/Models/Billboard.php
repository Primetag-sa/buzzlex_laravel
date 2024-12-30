<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * @method static self create(array $data)
 */
class Billboard extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    /**
    * The attributes that are mass assignable.
    * @var array
    */
    protected $fillable = [
        'name',
        'screen',
        'filters',
        'type'
    ];

    protected $casts = [
        'filters' => 'array'
    ];

    //########################################### Constants ################################################

    const APP_TYPE = "app";
    const USER_TYPE = "user";
    const BILLBOARD_TYPE = [
        self::APP_TYPE,
        self::USER_TYPE
    ];


    //########################################### Accessors ################################################


    //########################################### Mutators #################################################

    //########################################### Scopes ###################################################


    //########################################### Relations ################################################


}

