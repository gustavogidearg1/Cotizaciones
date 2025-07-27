<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        // Limpia la tabla (ojo: elimina todos los roles existentes)
        DB::table('roles')->truncate();

        DB::table('roles')->insert([
            ['id' => 1, 'name' => 'Administrador', 'description' => '...', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'name' => 'Editor', 'description' => '...', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'name' => 'Invitado', 'description' => '...', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}

