<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * @method static self create(array $data)
 */
class PlanFeature extends Model
{
    use HasFactory;

    /**
    * The attributes that are mass assignable.
    * @var array
    */
    protected $fillable = [
        'plan_id',
        'feature',
    ];

    //########################################### Constants ################################################


    //########################################### Accessors ################################################


    //########################################### Mutators #################################################


    //########################################### Scopes ###################################################


    //########################################### Relations ################################################

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

}

