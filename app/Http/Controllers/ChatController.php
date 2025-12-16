<?php

namespace App\Http\Controllers;

use App\Events\NewChatMessage;
use App\Models\ChatMessage;
use App\Models\ChatSession;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return ChatSession::where('user1_id', $request->user()->id)
            ->orWhere('user2_id', $request->user()->id)
            ->with('user1', 'user2', 'messages')
            ->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user2_id' => 'required|exists:users,id',
        ]);

        return ChatSession::create([
            'user1_id' => $request->user()->id,
            'user2_id' => $validated['user2_id'],
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(ChatSession $chatSession)
    {
        return $chatSession->load('user1', 'user2', 'messages');
    }

    /**
     * Store a newly created message in storage.
     */
    public function storeMessage(Request $request, ChatSession $chatSession)
    {
        $validated = $request->validate([
            'message' => 'required|string',
        ]);

        $message = $chatSession->messages()->create([
            'user_id' => $request->user()->id,
            'message' => $validated['message'],
        ]);

        broadcast(new NewChatMessage($message))->toOthers();

        return $message;
    }
}
