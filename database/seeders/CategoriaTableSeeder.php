<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriaTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('categoria')->insert([
            [
                'categoria' => 'Categoria 1',
                'descripcion' => '',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'categoria' => 'Categoria 2',
                'descripcion' => '',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
