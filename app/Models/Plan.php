<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * @method static self create(array $data)
 */
class Plan extends Model
{
    use HasFactory;

    /**
    * The attributes that are mass assignable.
    * @var array
    */
    protected $fillable = [
        'photographer_id',
        'name',
        'description',
        'price',
        'discount_percentage',
        'is_recommended',
        'type'
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

    public function features()
    {
        return $this->hasMany(PlanFeature::class);
    }

    public function addons()
    {
        return $this->hasMany(PlanAddon::class);
    }

    public function conditions()
    {
        return $this->hasMany(PlanCondition::class);
    }

    public function outputs()
    {
        return $this->hasMany(PlanOutput::class);
    }
}

