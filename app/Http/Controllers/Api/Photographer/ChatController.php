<?php

namespace App\Http\Controllers\Api\Photographer;

use App\Http\Controllers\Controller;
use App\Http\Resources\Photographer\ConversationResource;
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
            'user_id' => 'required|exists:users,id'
        ]);
        $user = auth()->user();
        $conversation = Conversation::firstOrCreate([
            'photographer_id' => $user->id,
            'user_id' => $request->user_id
        ]);

        $user->messages()->create([
            'message' => $request->message,
            'conversation_id' => $conversation->id
        ]);

        $conversation->user->notify(new MessageNotification($request->message));
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
