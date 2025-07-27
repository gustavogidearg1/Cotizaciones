<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class ProvinciaTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('provincia')->insert([
            ['id' => 1, 'provincia' => 'Cordoba', 'pais_id' => 1, 'created_at' => Carbon::parse('2025-04-26 19:52:31')],
            ['id' => 2, 'provincia' => 'Santa Fe', 'pais_id' => 1, 'created_at' => Carbon::parse('2025-04-26 19:52:31')],
            ['id' => 4, 'provincia' => 'Buenos Aires', 'pais_id' => 1, 'created_at' => Carbon::parse('2025-05-27 12:28:22')],
            ['id' => 5, 'provincia' => 'Catamarca', 'pais_id' => 1, 'created_at' => Carbon::parse('2025-05-27 18:56:27')],
            ['id' => 6, 'provincia' => 'La Pampa', 'pais_id' => 1, 'created_at' => Carbon::parse('2025-05-27 18:56:40')],
            ['id' => 7, 'provincia' => 'Entre Rios', 'pais_id' => 1, 'created_at' => Carbon::parse('2025-05-27 18:56:48')],
            ['id' => 8, 'provincia' => 'Chubut', 'pais_id' => 1, 'created_at' => Carbon::parse('2025-06-02 15:01:40')],
            ['id' => 9, 'provincia' => 'Chaco', 'pais_id' => 1, 'created_at' => Carbon::parse('2025-06-02 15:02:41')],
            ['id' => 10, 'provincia' => 'Neuquen', 'pais_id' => 1, 'created_at' => Carbon::parse('2025-06-02 15:03:35')],
            ['id' => 11, 'provincia' => 'San juan', 'pais_id' => 1, 'created_at' => Carbon::parse('2025-06-02 15:05:22')],
            ['id' => 12, 'provincia' => 'San luis', 'pais_id' => 1, 'created_at' => Carbon::parse('2025-06-02 15:05:41')],
            ['id' => 15, 'provincia' => 'Corrientes', 'pais_id' => 1, 'created_at' => Carbon::parse('2025-06-02 15:08:21')],
            ['id' => 16, 'provincia' => 'Tucuman', 'pais_id' => 1, 'created_at' => Carbon::parse('2025-06-02 15:08:47')],
            ['id' => 17, 'provincia' => 'Santiago del estero', 'pais_id' => 1, 'created_at' => Carbon::parse('2025-06-02 15:09:31')],
            ['id' => 18, 'provincia' => 'Santa cruz', 'pais_id' => 1, 'created_at' => Carbon::parse('2025-06-02 15:09:54')],
            ['id' => 19, 'provincia' => 'Salta', 'pais_id' => 1, 'created_at' => Carbon::parse('2025-06-02 15:10:26')],
            ['id' => 20, 'provincia' => 'Mendoza', 'pais_id' => 1, 'created_at' => Carbon::parse('2025-06-02 15:11:23')],
            ['id' => 21, 'provincia' => 'La rioja', 'pais_id' => 1, 'created_at' => Carbon::parse('2025-06-02 15:12:31')],
            ['id' => 22, 'provincia' => 'Formosa', 'pais_id' => 1, 'created_at' => Carbon::parse('2025-06-02 15:18:18')],
            ['id' => 23, 'provincia' => 'Jujuy', 'pais_id' => 1, 'created_at' => Carbon::parse('2025-06-02 15:22:04')],
            ['id' => 24, 'provincia' => 'Rio negro', 'pais_id' => 1, 'created_at' => Carbon::parse('2025-06-02 15:23:54')],
            ['id' => 25, 'provincia' => 'Misiones', 'pais_id' => 1, 'created_at' => Carbon::parse('2025-07-20 19:09:49')],
        ]);
    }
}
