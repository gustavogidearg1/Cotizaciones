<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class MonedasTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('monedas')->insert([
            [
                'id' => 1,
                'moneda' => 'Dolares',
                'desc_ampliada' => 'Dolar Estadounidense, tipo de cambio BNA',
                'tipo_cambio' => 1210.00,
                'created_at' => Carbon::parse('2025-05-11 18:09:31'),
                'updated_at' => Carbon::parse('2025-07-11 18:47:55'),
            ],
            [
                'id' => 2,
                'moneda' => 'Pesos',
                'desc_ampliada' => 'Pesos Argentino',
                'tipo_cambio' => 1.00,
                'created_at' => Carbon::parse('2025-05-11 18:09:31'),
                'updated_at' => Carbon::parse('2025-07-17 12:40:29'),
            ],
        ]);
    }
}
