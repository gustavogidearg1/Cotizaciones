<?php

namespace Database\Seeders;

use App\Models\Tipo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TiposTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tipos = [
            ['nombre' => 'Fabricado'],
            ['nombre' => 'Comprado'],
        ];

    foreach ($tipos as $tipo) {
        Tipo::create($tipo);
    }
}
}
