<?php

namespace Database\Factories;


use Illuminate\Database\Eloquent\Factories\Factory;

class ChatFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'whatsapp_name' => $this->faker->userName,
        ];
    }
}
