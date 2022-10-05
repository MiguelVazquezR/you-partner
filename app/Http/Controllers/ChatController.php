<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Http\Requests\StoreChatRequest;
use App\Http\Requests\UpdateChatRequest;
use App\Http\Resources\ChatResource;
use App\Http\Resources\MessageResource;
use App\Models\Message;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(StoreChatRequest $request)
    {
        dd($request);
    }

    public function show(Chat $chat)
    {
        //
    }

    public function edit(Chat $chat)
    {
        //
    }

    public function update(UpdateChatRequest $request, Chat $chat)
    {
        //
    }

    public function destroy(Chat $chat)
    {
        //
    }

    public function sendMessage(Request $request)
    {
        $message = Message::create($request->all());

        return new MessageResource(Message::with('user')->find($message->id));
    }

    public function readMessage(Request $request)
    {
        $chat = Chat::find($request->chat_id);
        $chat->unreadMessages->each(fn ($message) => $message->update(['read_at' => now()]));

        return new ChatResource(Chat::with('users', 'messages.user')->find($chat->id));
    }
}
