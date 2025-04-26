<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        Role::create([
            'id' => Role::ADMIN,
            'name' => 'Admin',
            'description' => 'Administrador del sistema'
        ]);

        Role::create([
            'id' => Role::EDITOR,
            'name' => 'Editor',
            'description' => 'Editor de contenido'
        ]);

        Role::create([
            'id' => Role::GUEST,
            'name' => 'Invitado',
            'description' => 'Usuario invitado'
        ]);

        Role::create([
            'id' => Role::GUEST,
            'name' => 'Cliente',
            'description' => 'Usuario Cliente'
        ]);
    }
}
