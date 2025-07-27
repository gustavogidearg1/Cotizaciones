<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class RolesTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('roles')->insert([
            [
                'id' => 1,
                'name' => 'Administrador',
                'description' => null,
                'created_at' => Carbon::parse('2025-04-26 19:49:19'),
                'updated_at' => null
            ],
            [
                'id' => 2,
                'name' => 'Editor',
                'description' => null,
                'created_at' => Carbon::parse('2025-04-26 19:49:19'),
                'updated_at' => null
            ],
            [
                'id' => 3,
                'name' => 'Invitado',
                'description' => null,
                'created_at' => Carbon::parse('2025-04-26 19:49:48'),
                'updated_at' => null
            ],
        ]);
    }
}
