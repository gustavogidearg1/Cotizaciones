<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class LocalidadTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('localidad')->insert([
            ['id' => 1, 'nombre' => 'Monte Buey', 'cp' => '2589', 'provincia_id' => 1, 'pais_id' => 1, 'created_at' => Carbon::parse('2025-05-08 19:00:20')],
            ['id' => 2, 'nombre' => 'Irriville', 'cp' => '2587', 'provincia_id' => 1, 'pais_id' => 1, 'created_at' => Carbon::parse('2025-05-08 19:00:20')],
            ['id' => 3, 'nombre' => 'Rio Tercero', 'cp' => '5850', 'provincia_id' => 1, 'pais_id' => 1, 'created_at' => Carbon::parse('2025-05-27 16:17:23')],
            ['id' => 4, 'nombre' => 'Hernando', 'cp' => '5929', 'provincia_id' => 1, 'pais_id' => 1, 'created_at' => Carbon::parse('2025-05-27 16:17:23')],
            ['id' => 5, 'nombre' => 'Monte Maiz', 'cp' => '123123', 'provincia_id' => 1, 'pais_id' => 1, 'created_at' => Carbon::parse('2025-05-27 16:17:23')],
            ['id' => 6, 'nombre' => 'Rufino', 'cp' => '6100', 'provincia_id' => 2, 'pais_id' => 1, 'created_at' => Carbon::parse('2025-05-27 16:17:23')],
            ['id' => 7, 'nombre' => 'La Palestina', 'cp' => '5925', 'provincia_id' => 1, 'pais_id' => 1, 'created_at' => Carbon::parse('2025-05-27 16:17:23')],
            ['id' => 8, 'nombre' => 'Arteaga', 'cp' => '2187', 'provincia_id' => 2, 'pais_id' => 1, 'created_at' => Carbon::parse('2025-05-27 16:17:23')],
            ['id' => 9, 'nombre' => 'Sacanta', 'cp' => '5945', 'provincia_id' => 1, 'pais_id' => 1, 'created_at' => Carbon::parse('2025-05-27 16:17:23')],
            ['id' => 10, 'nombre' => 'La Esquina', 'cp' => '2185', 'provincia_id' => 2, 'pais_id' => 1, 'created_at' => Carbon::parse('2025-05-27 16:17:23')],
            ['id' => 11, 'nombre' => 'Laprida', 'cp' => '7414', 'provincia_id' => 4, 'pais_id' => 1, 'created_at' => Carbon::parse('2025-05-27 16:17:23')],
            ['id' => 12, 'nombre' => 'General Pico', 'cp' => '6360', 'provincia_id' => 6, 'pais_id' => 1, 'created_at' => Carbon::parse('2025-05-27 16:17:23')],
            ['id' => 13, 'nombre' => 'Juan Jose Paso', 'cp' => '6474', 'provincia_id' => 4, 'pais_id' => 1, 'created_at' => Carbon::parse('2025-05-27 16:17:23')],
            ['id' => 14, 'nombre' => 'Chivilcoy', 'cp' => '6620', 'provincia_id' => 4, 'pais_id' => 1, 'created_at' => Carbon::parse('2025-05-27 16:17:23')],
            ['id' => 15, 'nombre' => 'Santo Domingo', 'cp' => '3025', 'provincia_id' => 2, 'pais_id' => 1, 'created_at' => Carbon::parse('2025-05-27 16:17:23')],
            ['id' => 16, 'nombre' => 'Rio Cuarto', 'cp' => '5800', 'provincia_id' => 1, 'pais_id' => 1, 'created_at' => Carbon::parse('2025-05-27 16:17:23')],
            ['id' => 17, 'nombre' => 'Victoria', 'cp' => '3153', 'provincia_id' => 7, 'pais_id' => 1, 'created_at' => Carbon::parse('2025-05-27 16:17:23')],
            ['id' => 18, 'nombre' => 'Canada Seca', 'cp' => '6105', 'provincia_id' => 4, 'pais_id' => 1, 'created_at' => Carbon::parse('2025-05-27 16:17:23')],
            ['id' => 19, 'nombre' => 'Trenque Lauquen', 'cp' => '3100', 'provincia_id' => 4, 'pais_id' => 1, 'created_at' => Carbon::parse('2025-05-27 16:17:23')],
            ['id' => 20, 'nombre' => 'Alejo Ledesma', 'cp' => '111', 'provincia_id' => 1, 'pais_id' => 1, 'created_at' => Carbon::parse('2025-05-27 16:17:23')],
        ]);
    }
}
