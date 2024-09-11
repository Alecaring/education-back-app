<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatDiscussion extends Model
{
    use HasFactory;

    protected $fillable = ['title'];

    public function messages()
    {
        return $this->belongsToMany(ChatMessage::class, 'discussion_messages', 'discussion_id', 'message_id');
    }
}
