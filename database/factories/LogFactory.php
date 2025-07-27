<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class LogFactory extends Factory
{
    public function definition(): array
    {
        return [
            'info' => $this->faker->sentence(3),
            'message' => $this->faker->paragraph,
            'context' => [
                'user_id' => $this->faker->randomNumber(),
                'ip' => $this->faker->ipv4,
            ],
        ];
    }
}
