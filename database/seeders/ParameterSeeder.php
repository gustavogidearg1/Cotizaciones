<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Parameter;

class ParameterSeeder extends Seeder
{
    public function run(): void
    {
        Parameter::factory()->count(5)->create();
    }
}
