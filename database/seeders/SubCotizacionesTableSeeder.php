<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SubCotizacionesTableSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        DB::table('sub_cotizaciones')->insert([
            [
                'producto_id' => 3,
                'moneda_id' => 1,
                'precio' => 45320.00,
                'precio_bonificado' => 45320.00,
                'descuento' => 0.00,
                'detalle' => '-',
                'cotizacion_id' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'producto_id' => 7,
                'moneda_id' => 1,
                'precio' => 330.00,
                'precio_bonificado' => 330.00,
                'descuento' => 0.00,
                'detalle' => '-',
                'cotizacion_id' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'producto_id' => 8,
                'moneda_id' => 1,
                'precio' => 1523.00,
                'precio_bonificado' => 1523.00,
                'descuento' => 0.00,
                'detalle' => '-',
                'cotizacion_id' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
