<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * @method static self create(array $data)
 */
class Gallery extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    /**
    * The attributes that are mass assignable.
    * @var array
    */
    protected $fillable = [
        'photographer_id',
        'service_id'
    ];

    //########################################### Constants ################################################


    //########################################### Accessors ################################################


    //########################################### Mutators #################################################


    //########################################### Scopes ###################################################


    //########################################### Relations ################################################

    public function photographer()
    {
        return $this->belongsTo(Photographer::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

}

