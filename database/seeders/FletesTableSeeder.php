<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FletesTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('fletes')->insert([
            [
                'id' => 1,
                'nombre' => 'A cargo del cliente',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'nombre' => 'A cargo de la empresa',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'nombre' => 'Mitad y mitad',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
