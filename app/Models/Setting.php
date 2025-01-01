<?php

namespace App\Models;

use Filter\Traits\HasFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
/**
 * @method static self create(array $data)
 */
class Setting extends Model implements HasMedia
{
    use HasFactory, HasFilter, InteractsWithMedia;

    /**
    * The attributes that are mass assignable.
    * @var array
    */
    protected $fillable = [
        'name',
        'value',
        'type'
    ];

    //########################################### Constants ################################################


    //########################################### Accessors ################################################


    //########################################### Mutators #################################################


    //########################################### Scopes ###################################################


    //########################################### Relations ################################################


}

