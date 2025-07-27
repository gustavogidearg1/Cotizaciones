<?php

namespace Database\Factories;

use App\Models\Chat;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\ChatMessage;

class ChatMessageFactory extends Factory
{
    protected $model = ChatMessage::class;

    public function definition(): array
    {
        return [
            //'chat_id' => Chat::factory(),
            'message' => $this->faker->sentence(12),
            'sender' => $this->faker->randomElement(['user', 'bot']),
        ];
    }
}
