<?php

namespace App\Models;

use Carbon\Carbon;
use Filter\Traits\HasFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * @method static self create(array $data)
 */
class Order extends Model
{
    use HasFactory, HasFilter;

    /**
    * The attributes that are mass assignable.
    * @var array
    */
    protected $fillable = [
        'user_id',
        'photographer_id',
        'plan_id',
        'name',
        'type',
        'date',
        'status',
        'latitude',
        'longitude',
        'address',
        'email',
        'phone',
        'total_price',
        'discount'
    ];

    protected $casts = [
        'date' => 'date',
    ];

    //########################################### Constants ################################################
    const PENDING = 'pending';
    const APPROVED = 'approved';

    const DEFAULT_STATUS = SELF::PENDING;

    const STATUSES = [
        SELF::PENDING,
        SELF::APPROVED
    ];

    //########################################### Accessors ################################################

    public function getDayAtAttribute()
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

    public function photographer()
    {
        return $this->belongsTo(Photographer::class);
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function addons()
    {
        return $this->hasMany(OrderAddon::class, 'addon_id');
    }
}

