<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\ConversationResource;
use App\Http\Resources\SuccessResource;
use App\Models\Conversation;
use App\Notifications\MessageNotification;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'message' => 'required',
            'photographer_id' => 'required|exists:photographers,id'
        ]);
        $user = auth()->user();
        $conversation = Conversation::firstOrCreate([
            'user_id' => $user->id,
            'photographer_id' => $request->photographer_id
        ]);

        $user->messages()->create([
            'message' => $request->message,
            'conversation_id' => $conversation->id
        ]);

        $conversation->photographer->notify(new MessageNotification($request->message));
        return new SuccessResource([],"Message sent successfully");
    }

    public function show(Conversation $conversations)
    {
        return new ConversationResource($conversations);
    }

    public function index()
    {
        $user = auth()->user();
        $conversations = $user->conversations;
        return ConversationResource::collection($conversations);
    }
}
