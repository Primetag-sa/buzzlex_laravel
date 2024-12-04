<?php

namespace App\Models;

use Filter\Traits\HasFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * @method static self create(array $data)
 */
class Review extends Model
{
    use HasFactory, HasFilter;

    /**
    * The attributes that are mass assignable.
    * @var array
    */
    protected $fillable = [
        'user_id',
        'photographer_id',
        'review',
        'rate'
    ];

    //########################################### Constants ################################################


    //########################################### Accessors ################################################


    //########################################### Mutators #################################################


    //########################################### Scopes ###################################################


    //########################################### Relations ################################################

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function photographer()
    {
        return $this->belongsTo(Photographer::class);
    }

}

