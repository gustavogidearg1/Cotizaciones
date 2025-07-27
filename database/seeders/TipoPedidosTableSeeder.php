<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoPedidosTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('tipo_pedidos')->insert([
            ['id' => 1, 'nombre' => 'Cotizacion', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'nombre' => 'Pedido',     'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
