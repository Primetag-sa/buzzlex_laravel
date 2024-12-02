<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * @method static self create(array $data)
 */
class Service extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    /**
    * The attributes that are mass assignable.
    * @var array
    */
    protected $fillable = [
        'name',
    ];

    //########################################### Constants ################################################


    //########################################### Accessors ################################################


    //########################################### Mutators #################################################


    //########################################### Scopes ###################################################


    //########################################### Relations ################################################


}

