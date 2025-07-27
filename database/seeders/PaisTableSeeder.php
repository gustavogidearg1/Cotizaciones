<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class PaisTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('pais')->insert([
            [
                'id' => 1,
                'pais' => 'Argentina',
                'created_at' => Carbon::parse('2025-04-26 19:50:56'),
                'updated_at' => null,
            ],
            [
                'id' => 2,
                'pais' => 'Uruguay',
                'created_at' => Carbon::parse('2025-04-26 19:50:56'),
                'updated_at' => null,
            ],
        ]);
    }
}
