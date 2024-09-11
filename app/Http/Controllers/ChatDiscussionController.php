<?php

namespace App\Http\Controllers;

use App\Models\ChatDiscussion;
use App\Models\ChatMessage;
use Illuminate\Http\Request;

class ChatDiscussionController extends Controller
{
    public function index()
    {
        // Recupera tutti i messaggi di chat
        $chatMessages = ChatMessage::with('user')->get();

        // Passa i messaggi alla view
        return view('chat.index', compact('chatMessages'));
    }

    public function store(Request $request)
    {
        $request->validate(['title' => 'required|string|max:255']);

        ChatDiscussion::create(['title' => $request->title]);

        return redirect()->route('chat.discussions.index');
    }
}
