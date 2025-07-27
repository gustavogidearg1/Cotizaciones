<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CotizacionesTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('cotizaciones')->insert([
            'cotizacion' => 'Lista 5-2025',
            'descripcion' => 'descripcion',
            'vencimiento' => '2025-06-30',
            'observacion' => null,
            'user_id' => 5, // Asegurate que exista el usuario con id 8
            'created_at' => Carbon::parse('2025-05-11 21:18:01'),
            'updated_at' => Carbon::parse('2025-05-11 21:18:01'),
        ]);
    }
}
