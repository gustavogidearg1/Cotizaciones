<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class ColoresTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('colores')->insert([
            [
                'id' => 1,
                'nombre' => 'Amarillo Comofra',
                'descripcion' => '#FF9900',
                'created_at' => Carbon::parse('2025-04-27 19:41:01'),
                'updated_at' => null,
            ],
            [
                'id' => 2,
                'nombre' => 'Verde VJD',
                'descripcion' => 'MCF230',
                'created_at' => Carbon::parse('2025-04-27 19:41:01'),
                'updated_at' => null,
            ],
            [
                'id' => 3,
                'nombre' => 'No lleva color',
                'descripcion' => null,
                'created_at' => Carbon::parse('2025-05-14 03:35:05'),
                'updated_at' => null,
            ],
            [
                'id' => 4,
                'nombre' => 'Amarillo New Holland',
                'descripcion' => '#00B0F0',
                'created_at' => Carbon::parse('2025-05-27 12:30:02'),
                'updated_at' => Carbon::parse('2025-06-03 18:40:29'),
            ],
            [
                'id' => 5,
                'nombre' => 'Blanco',
                'descripcion' => '#FFFFFF',
                'created_at' => Carbon::parse('2025-05-27 12:30:57'),
                'updated_at' => Carbon::parse('2025-05-27 12:30:57'),
            ],
            [
                'id' => 6,
                'nombre' => 'Rojo Case',
                'descripcion' => '#C00000',
                'created_at' => Carbon::parse('2025-05-27 12:31:33'),
                'updated_at' => Carbon::parse('2025-05-27 12:31:33'),
            ],
            [
                'id' => 7,
                'nombre' => 'Rojo VASSALLI',
                'descripcion' => '#FF0000',
                'created_at' => Carbon::parse('2025-05-27 12:32:14'),
                'updated_at' => Carbon::parse('2025-05-27 12:32:14'),
            ],
            [
                'id' => 8,
                'nombre' => 'Rojo Comofra',
                'descripcion' => null,
                'created_at' => Carbon::parse('2025-05-27 12:33:17'),
                'updated_at' => Carbon::parse('2025-05-27 12:33:17'),
            ],



        ]);
    }
}
