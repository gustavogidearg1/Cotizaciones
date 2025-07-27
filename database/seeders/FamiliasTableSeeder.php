<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class FamiliasTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('familias')->insert([
            [
                'id' => 1,
                'nombre' => 'Auto descargable',
                'imagen_principal' => 'images/i0TrXDa0r7nIVK1dvY183C0JKcIkxhYytLhq8sN4.png',
                'imagen_secundaria' => null,
                'created_at' => null,
                'updated_at' => Carbon::parse('2025-05-11 21:18:43'),
            ],
            [
                'id' => 2,
                'nombre' => 'Fertilizante',
                'imagen_principal' => 'images/guTiS0EXo0kHJDWVJbhS83SJ7iKKvZTmlNaR6ykz.png',
                'imagen_secundaria' => null,
                'created_at' => null,
                'updated_at' => Carbon::parse('2025-05-11 21:18:56'),
            ],
            [
                'id' => 3,
                'nombre' => 'Batea Volcadora',
                'imagen_principal' => 'images/9O0jNjJbIch9cHIy4cmf5YKKi1OEGc1G9CEkiaBL.png',
                'imagen_secundaria' => null,
                'created_at' => null,
                'updated_at' => Carbon::parse('2025-05-11 21:19:06'),
            ],
            [
                'id' => 4,
                'nombre' => 'Mixer Hotizontal',
                'imagen_principal' => 'images/LXnhFdfKTNTL2uWtR0FQwsPaRYgexReiN9VkNxTp.png',
                'imagen_secundaria' => null,
                'created_at' => null,
                'updated_at' => Carbon::parse('2025-05-11 21:19:14'),
            ],
            [
                'id' => 5,
                'nombre' => 'Mixer Vertical',
                'imagen_principal' => 'images/seRsZha0aLgTSrPS2jdDmJYd4eVoi3X6ArBgUZon.png',
                'imagen_secundaria' => null,
                'created_at' => null,
                'updated_at' => Carbon::parse('2025-05-11 21:19:23'),
            ],
            [
                'id' => 6,
                'nombre' => 'Acoplado Chicos',
                'imagen_principal' => 'images/F1bRlTPqvxhEk4DZDGYVGTn6tq0Q0m2SKImoOeni.png',
                'imagen_secundaria' => null,
                'created_at' => null,
                'updated_at' => Carbon::parse('2025-05-11 21:19:32'),
            ],
            [
                'id' => 7,
                'nombre' => 'Opcionales',
                'imagen_principal' => 'images/XEHTfjYmTXrHoYafeVtOsAATfrnl3ikjoBh2Y2l9.jpg',
                'imagen_secundaria' => null,
                'created_at' => Carbon::parse('2025-05-17 22:15:15'),
                'updated_at' => Carbon::parse('2025-06-01 23:30:35'),
            ],
            [
                'id' => 8,
                'nombre' => 'Accesorios',
                'imagen_principal' => 'images/zOSQUqjPhPMUvPP730l3kwaw1kNnGId7e6XbL2Xc.png',
                'imagen_secundaria' => 'images/NjchUNhFZSkIy4YUIWKHqeaCcMRjipskR26zDhIx.jpg',
                'created_at' => Carbon::parse('2025-05-17 22:16:36'),
                'updated_at' => Carbon::parse('2025-05-27 15:35:12'),
            ],
        ]);
    }
}
