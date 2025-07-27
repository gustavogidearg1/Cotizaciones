<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ChatMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'chat_id',
        'message',
        'sender',
    ];

    // Relación: Un mensaje pertenece a un chat
    public function chat()
    {
        return $this->belongsTo(Chat::class, 'chat_id');
    }
}
