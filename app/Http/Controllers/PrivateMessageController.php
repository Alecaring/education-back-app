<?php

namespace App\Http\Controllers;

use App\Models\PrivateMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PrivateMessageController extends Controller
{
    public function index()
    {
        // Get all messages for the authenticated user
        $messages = PrivateMessage::where(function ($query) {
            $query->where('sender_id', Auth::id())
                  ->orWhere('receiver_id', Auth::id());
        })->with('sender', 'receiver')
          ->get();

        $users = \App\Models\User::where('id', '!=', Auth::id())->get(); // Exclude current user

        return view('private_messages.index', compact('messages', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'message' => 'required|string',
        ]);

        PrivateMessage::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $request->receiver_id,
            'message' => $request->message,
        ]);

        return redirect()->route('private_messages.index');
    }
}
