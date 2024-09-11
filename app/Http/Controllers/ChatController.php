<?php

namespace App\Http\Controllers;

use App\Models\ChatMessage;
use App\Models\ChatDiscussion;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index()
    {
        $discussions = ChatDiscussion::with('messages.user')->latest()->get();
        return view('chat.index', compact('discussions'));
    }

    public function storeMessage(Request $request, $discussionId)
    {
        $request->validate(['message' => 'required|string']);

        $discussion = ChatDiscussion::findOrFail($discussionId);

        $message = new ChatMessage();
        $message->user_id = auth()->id();
        $message->message = $request->message;
        $message->save();

        $discussion->messages()->attach($message->id);

        return redirect()->route('chat.index');
    }

    public function storeDiscussion(Request $request)
    {
        $request->validate(['title' => 'required|string']);

        ChatDiscussion::create(['title' => $request->title]);

        return redirect()->route('chat.index');
    }
}
