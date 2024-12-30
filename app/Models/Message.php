<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * @method static self create(array $data)
 */
class Message extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    /**
    * The attributes that are mass assignable.
    * @var array
    */
    protected $fillable = [
        'sender_type',
        'sender_id',
        'message',
        'read_at',
        'conversation_id',
    ];

    //########################################### Constants ################################################


    //########################################### Accessors ################################################


    //########################################### Mutators #################################################


    //########################################### Scopes ###################################################


    //########################################### Relations ################################################

    public function sender(): MorphTo
    {
        return $this->morphTo();
    }

    public function conversation()
    {
        return $this->belongsTo(Conversation::class);
    }

}

