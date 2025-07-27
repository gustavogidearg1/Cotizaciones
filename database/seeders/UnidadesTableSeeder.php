<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnidadesTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('unidades')->insert([
            'nombre' => 'Unidad',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
