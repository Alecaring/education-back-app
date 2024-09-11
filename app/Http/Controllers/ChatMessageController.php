<?php

namespace App\Http\Controllers;

use App\Models\ChatDiscussion;
use App\Models\ChatMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatMessageController extends Controller
{
    /**
     * Mostra tutti i messaggi.
     */
    public function index()
    {
        $chatMessages = ChatMessage::with('user')->latest()->get();
        return view('chat.index', compact('chatMessages'));
    }

    /**
     * Salva un nuovo messaggio di chat.
     */
    public function store(Request $request, $discussionId)
    {
        $request->validate(['message' => 'required|string']);

        $discussion = ChatDiscussion::findOrFail($discussionId);

        $message = new ChatMessage();
        $message->user_id = auth()->id();
        $message->message = $request->message;
        $message->save();

        $discussion->messages()->attach($message->id);

        return redirect()->route('chat.discussions.index');
    }
}
