<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'message'];

    // Relazione con l'utente
    public function user()
    {

        return $this->belongsTo(User::class);

    }

    public function discussions()
    {
        return $this->belongsToMany(ChatDiscussion::class, 'discussion_messages', 'message_id', 'discussion_id');
    }
}
