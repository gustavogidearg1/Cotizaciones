<?php

namespace Database\Seeders;

use App\Models\Unidad;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UnidadesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
{
    $unidades = [
        ['nombre' => 'Unidad'],
        ['nombre' => 'Kilogramo'],
        ['nombre' => 'Litro'],
        ['nombre' => 'Metro'],
        ['nombre' => 'Caja'],
    ];

    foreach ($unidades as $unidad) {
        Unidad::create($unidad);
    }
}
}
