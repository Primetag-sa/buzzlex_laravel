<?php

namespace App\Http\Controllers\Api\Photographer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Photographer\MessageRequest;
use App\Http\Resources\Photographer\ConversationResource;
use App\Http\Resources\Photographer\MessageResource;
use App\Http\Resources\SuccessResource;
use App\Models\Conversation;
use App\Notifications\MessageNotification;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function store(MessageRequest $request)
    {
        $data = $request->validated();
        $user = auth()->user();
        $conversation = Conversation::firstOrCreate([
            'photographer_id' => $user->id,
            'user_id' => $request->user_id
        ]);

        $message = $user->messages()->create([
            'message' => $data['message'] ?? null,
            'conversation_id' => $conversation->id
        ]);

        if(key_exists('media', $data) && is_array($data['media'])){
            foreach ($data['media'] as $media) {
                $message->addMedia($media)->toMediaCollection('images');
            }
        }
        if(key_exists('record', $data) && !is_null($data['record'])){
            $message->addMedia($media)->toMediaCollection('record');
        }
        $resource = new MessageResource($message);

        $conversation->user->notify(new MessageNotification($resource));
        return new SuccessResource([],"Message sent successfully");
    }

    public function messages(Conversation $conversation)
    {
        $conversation->messages()->whereNull('read_at')->update(['read_at' => now()]);
        $messages = $conversation->messages()->paginate();
        return MessageResource::collection($messages);
    }

    public function index()
    {
        $user = auth()->user();
        $conversations = $user->conversations;
        return ConversationResource::collection($conversations);
    }
}
