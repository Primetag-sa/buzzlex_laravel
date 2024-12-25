<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * @method static self create(array $data)
 */
class Conversation extends Model
{
    use HasFactory;

    /**
    * The attributes that are mass assignable.
    * @var array
    */
    protected $fillable = [
        'user_id',
        'photographer_id',
        'conversation_name',
    ];

    //########################################### Constants ################################################


    //########################################### Accessors ################################################

    public function getLastMessageAttribute()
    {
        return $this->messages()->first()->message ?? null;
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

    public function messages()
    {
        return $this->hasMany(Message::class)->orderBy('id', 'desc');
    }

}

