<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * @method static self create(array $data)
 */
class Order extends Model
{
    use HasFactory;

    /**
    * The attributes that are mass assignable.
    * @var array
    */
    protected $fillable = [
        'user_id',
        'photographer_id',
        'plan_id',
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

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function addons()
    {
        return $this->hasMany(OrderAddon::class, 'addon_id');
    }
}

