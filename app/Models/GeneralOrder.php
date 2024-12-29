<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * @method static self create(array $data)
 */
class GeneralOrder extends Model
{
    use HasFactory;

    /**
    * The attributes that are mass assignable.
    * @var array
    */
    protected $fillable = [
        'user_id',
        'name',
        'type',
        'status',
        'latitude',
        'longitude',
        'address',
        'date',
        'phone',
        'email'
    ];

    protected $casts = [
        'date' => 'date',
    ];

    //########################################### Constants ################################################

    const PENDING = 'pending';
    const APPROVED = 'approved';
    const DECLINED = 'declined';

    const DEFAULT_STATUS = SELF::PENDING;

    const STATUSES = [
        SELF::PENDING,
        SELF::APPROVED,
        SELF::DECLINED
    ];

    //########################################### Accessors ################################################

    public function getDayAttribute()
    {
        if(!$this->date->isPast()){
            $date = Carbon::parse($this->date);
            $day = $date->format('l');
            $days = today()->diffInDays($date);
            return "$day, after $days days/s";
        }
        return null;
    }

    //########################################### Mutators #################################################


    //########################################### Scopes ###################################################


    //########################################### Relations ################################################

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}

