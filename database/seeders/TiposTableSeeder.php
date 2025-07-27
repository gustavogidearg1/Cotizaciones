<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TiposTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('tipos')->insert([
            ['id' => 1,  'nombre' => 'Implemento',             'created_at' => '2025-04-26 19:51:32'],
            ['id' => 2,  'nombre' => 'Accesorio',              'created_at' => '2025-04-28 00:56:16'],
            ['id' => 3,  'nombre' => 'Accesorios MV',          'created_at' => '2025-05-28 17:17:46'],
            ['id' => 4,  'nombre' => 'Accesorios MH',          'created_at' => '2025-05-28 17:17:46'],
            ['id' => 5,  'nombre' => 'Accesorios ATF',         'created_at' => '2025-05-28 17:22:51'],
            ['id' => 6,  'nombre' => 'Accesorios TA',          'created_at' => '2025-05-28 17:22:51'],
            ['id' => 7,  'nombre' => 'Accesorios BV',          'created_at' => '2025-05-29 09:13:46'],
            ['id' => 8,  'nombre' => 'Accesorios IC',          'created_at' => null],
            ['id' => 9,  'nombre' => 'Accesorios Balanza',     'created_at' => null],
            ['id' => 10, 'nombre' => 'Balanza MV',             'created_at' => null],
            ['id' => 11, 'nombre' => 'Balanza MH',             'created_at' => null],
            ['id' => 12, 'nombre' => 'Balanza ATF',            'created_at' => null],
            ['id' => 13, 'nombre' => 'Balanza TA',             'created_at' => null],
            ['id' => 14, 'nombre' => 'Neumatico TA',           'created_at' => '2025-05-29 15:24:21'],
            ['id' => 15, 'nombre' => 'Neumatico MH',           'created_at' => '2025-05-29 15:31:24'],
            ['id' => 16, 'nombre' => 'Neumatico MV',           'created_at' => '2025-05-29 15:34:15'],
            ['id' => 17, 'nombre' => 'Neumatico Varios',       'created_at' => '2025-05-29 15:35:57'],
            ['id' => 18, 'nombre' => 'Componentes IC',         'created_at' => '2025-05-30 09:13:30'],
            ['id' => 19, 'nombre' => 'Componentes IC',         'created_at' => '2025-05-30 09:21:33'],
            ['id' => 20, 'nombre' => 'Componentes MV',         'created_at' => '2025-05-30 09:21:33'],
            ['id' => 21, 'nombre' => 'Componentes TA',         'created_at' => '2025-05-30 09:21:58'],
            ['id' => 22, 'nombre' => 'Componentes ATF',        'created_at' => '2025-05-30 09:21:58'],
            ['id' => 23, 'nombre' => 'Componentes',            'created_at' => null],
            ['id' => 24, 'nombre' => 'Componentes BV',         'created_at' => '2025-05-30 09:22:25'],
            ['id' => 25, 'nombre' => 'Ruedas MV',              'created_at' => '2025-05-30 09:22:25'],
            ['id' => 26, 'nombre' => 'Ruedas AC',              'created_at' => '2025-05-30 09:22:47'],
            ['id' => 27, 'nombre' => 'Ruedas',                 'created_at' => '2025-05-30 09:22:47'],
        ]);
    }
}
