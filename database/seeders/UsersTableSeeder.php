<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class UsersTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'id' => 5,
                'name' => 'Gustavo Godoy',
                'nom_corto' => 'GG',
                'email' => 'gustavog@live.com.ar',
                'email_verified_at' => null,
                'password' => '$2y$12$tthHQqMbYABYggngJOkpdeAHzZeNyDwxjE0BivR79BRdazzGkM02K', // ya está encriptada
                'remember_token' => 'aFM1ganX5qU9A1j3NrGRiCo7LX5LVrYYptvcDB1kNX1ZFuTcHWhJgEKNYfEF',
                'created_at' => Carbon::parse('2025-05-24 03:13:02'),
                'updated_at' => Carbon::parse('2025-05-24 03:13:02'),
                'role_id' => 1
            ],
            [
                'id' => 6,
                'name' => 'Ruben Champrone',
                'nom_corto' => 'RC',
                'email' => 'gerenciageneral@comofrasrl.com.ar',
                'email_verified_at' => null,
                'password' => '$2y$12$lqUVShdfmEWoX4wrxVW0OOo5Qr1U5oGJYh8pP9UYpqsz/AyHDKkNu',
                'remember_token' => 'lU1yNEvIIBWyTrYNAvmTT8TkeiEc5fbSxaVD1p5uKJla3SOoqMd8HJxhaQ2O',
                'created_at' => Carbon::parse('2025-05-27 18:28:07'),
                'updated_at' => Carbon::parse('2025-05-27 18:33:33'),
                'role_id' => 1
            ],
        ]);
    }
}
