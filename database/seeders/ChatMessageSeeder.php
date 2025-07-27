<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ChatMessage;
use App\Models\Chat;

class ChatMessageSeeder extends Seeder
{
    public function run(): void
    {
        //obtener todos los chats creados
        $chats = Chat::all();
    //para cada, generar entre  y  mensajes relacionados
$chats->each(function ($chat) {

            ChatMessage::factory()
                ->count(rand(1, 10)) // Genera entre 1 y 10 mensajes
                ->create([
                    'chat_id' => $chat->id,
                ]);
           });
      }
}
