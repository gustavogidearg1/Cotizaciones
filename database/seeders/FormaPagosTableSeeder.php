<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class FormaPagosTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('forma_pagos')->insert([
            [
                'id' => 1,
                'nombre' => 'CONTADO (TRANSF/ECHEQ)',
                'descripcion' => 'SOBRE IMPLEMENTO.',
                'diferencia' => -10.00,
                'activo' => 1,
                'created_at' => Carbon::parse('2025-05-08 21:58:21'),
                'updated_at' => Carbon::parse('2025-06-03 15:53:49'),
            ],
            [
                'id' => 2,
                'nombre' => '12 VALORES(00/330 DIAS)',
                'descripcion' => 'SOBRE IMPLEMENTO.',
                'diferencia' => 0.00,
                'activo' => 1,
                'created_at' => Carbon::parse('2025-05-08 21:58:21'),
                'updated_at' => Carbon::parse('2025-06-03 15:54:06'),
            ],
            [
                'id' => 3,
                'nombre' => '3 VALORES (34%-33%-33%)',
                'descripcion' => 'SOBRE IMPLEMENTO',
                'diferencia' => 0.00,
                'activo' => 1,
                'created_at' => Carbon::parse('2025-06-03 15:49:58'),
                'updated_at' => Carbon::parse('2025-06-03 15:49:58'),
            ],
            [
                'id' => 4,
                'nombre' => '8 VALORES(00/210 DIAS)',
                'descripcion' => 'SOBRE IMPLEMENTO',
                'diferencia' => -5.00,
                'activo' => 1,
                'created_at' => Carbon::parse('2025-06-03 15:52:55'),
                'updated_at' => Carbon::parse('2025-06-03 15:54:30'),
            ],
            [
                'id' => 5,
                'nombre' => '4 VALORES (00/90 DIAS)',
                'descripcion' => 'SOBRE IMPLEMENTO',
                'diferencia' => -10.00,
                'activo' => 1,
                'created_at' => Carbon::parse('2025-06-03 15:53:12'),
                'updated_at' => Carbon::parse('2025-06-03 15:54:42'),
            ],
            [
                'id' => 6,
                'nombre' => '6 VALORES(00/150 DIAS)',
                'descripcion' => 'SOBRE IMPLEMENTO',
                'diferencia' => 0.00,
                'activo' => 1,
                'created_at' => Carbon::parse('2025-07-18 23:35:14'),
                'updated_at' => Carbon::parse('2025-07-18 23:36:41'),
            ],
            [
                'id' => 7,
                'nombre' => '10 VALORES(00/270 DIAS)',
                'descripcion' => 'SOBRE IMPLEMENTO',
                'diferencia' => 0.00,
                'activo' => 1,
                'created_at' => Carbon::parse('2025-07-18 23:35:51'),
                'updated_at' => Carbon::parse('2025-07-18 23:37:09'),
            ],
        ]);
    }
}
