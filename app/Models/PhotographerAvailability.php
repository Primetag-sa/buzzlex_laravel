<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * @method static self create(array $data)
 */
class PhotographerAvailability extends Model
{
    use HasFactory;

    /**
    * The attributes that are mass assignable.
    * @var array
    */
    protected $table = 'photographer_availability';
    protected $fillable = [
        'photographer_id',
        'date_from',
        'date_to',
        'status'
    ];

    //########################################### Constants ################################################

    const STATUS_AVAILABLE = 'available';
    const STATUS_UNAVAILABLE = 'unavailable';
    const STATUSES = [
        self::STATUS_AVAILABLE,
        self::STATUS_UNAVAILABLE
    ];

    //########################################### Accessors ################################################


    //########################################### Mutators #################################################


    //########################################### Scopes ###################################################


    //########################################### Relations ################################################

    public function photographer()
    {
        return $this->belongsTo(Photographer::class);
    }

}

