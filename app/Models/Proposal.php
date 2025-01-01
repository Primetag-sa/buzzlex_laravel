<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * @method static self create(array $data)
 */
class Proposal extends Model
{
    use HasFactory;

    /**
    * The attributes that are mass assignable.
    * @var array
    */
    protected $fillable = [
        'general_order_id',
        'photographer_id',
        'plan_id',
        'price'
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


    //########################################### Mutators #################################################


    //########################################### Scopes ###################################################


    //########################################### Relations ################################################
    public function generalOrder()
    {
        return $this->belongsTo(GeneralOrder::class);
    }

    public function photographer()
    {
        return $this->belongsTo(Photographer::class);
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }
}

