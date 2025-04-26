<?php

namespace Database\Seeders;

use App\Models\Familia;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FamiliasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $familias = [
            ['nombre' => 'Autodescargable'],
            ['nombre' => 'Implemento Chico'],
            ['nombre' => 'Batea'],
            ['nombre' => 'Fertilizante'],
            ['nombre' => 'Mixer Horizontal'],
            ['nombre' => 'Mixer Vertical'],
        ];

    foreach ($familias as $familia) {
        Familia::create($familia);
    }
}
}
