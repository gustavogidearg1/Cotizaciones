<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Chat extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'whatsapp_name',
    ];

    // Relación: Un chat tiene muchos mensajes
    public function messages()
    {
        return $this->hasMany(ChatMessage::class, 'chat_id');
    }
}
