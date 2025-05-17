<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pedido;
use App\Models\SubPedido;
use Illuminate\Support\Facades\DB;

class PedidoSeeder extends Seeder
{
    public function run()
    {
        // Verificar si ya existe el pedido con id=1
        if (!Pedido::where('id', 1)->exists()) {
            // Insertar con ID explícito para el primer pedido
            DB::table('pedidos')->insert([
                'id' => 1, // Especificamos el ID manualmente
                'tipo_pedido_id' => 1,
                'fecha' => '2025-04-17',
                'fecha_necesidad' => '2025-05-13',
                'forma_pago_id' => 1,
                'forma_entrega' => 'Ex-works (EXW) - Retiro desde planta',
                'observacion' => 'observacion',
                'imagen' => 'imagen',
                'imagen_2' => 'imagen_2',
                'flete_id' => 2,
                'bonificacion' => 0.00,
                'user_id' => 3,
                'created_at' => '2025-05-13 23:50:07',
                'updated_at' => null,
                'cliente' => 'cliente',
                'direccion' => 'direccion',
                'localidad_id' => 2,
                'provincia_id' => 1,
                'pais_id' => 1,
                'telefono' => 'telefono',
                'email' => 'email',
                'contacto' => 'contacto',
                'categoria_id' => 1
            ]);

            // Ahora insertamos un nuevo pedido con ID autoincremental
            $nuevoPedido = Pedido::create([
                'tipo_pedido_id' => 1,
                'fecha' => now()->format('Y-m-d'),
                'fecha_necesidad' => '2025-05-29',
                'forma_pago_id' => 1,
                'forma_entrega' => 'Ex-works (EXW) - Retiro desde planta',
                'cliente' => 'Gustavo Godoy',
                'direccion' => 'General Paz 745',
                'localidad_id' => 1,
                'provincia_id' => 1,
                'pais_id' => 1,
                'telefono' => '03534191741',
                'email' => 'gustavog@live.com.ar',
                'contacto' => 'Un contacto',
                'bonificacion' => 0.00,
                'flete_id' => 1,
                'observacion' => null,
                'user_id' => 3,
                'categoria_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ]);

            // Crear subpedido para el nuevo pedido
            SubPedido::create([
                'pedido_id' => $nuevoPedido->id,
                'producto_id' => 3,
                'color_id' => 2,
                'moneda_id' => 1,
                'precio' => 100000.00,
                'cantidad' => 1,
                'iva' => 10.50,
                'detalle' => null,
                'subbonificacion' => 0.00,
                'sub_fecha_entrega' => '2025-05-29',
                'subtotal' => 100000.00,
                'total' => 110500.00,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        } else {
            // Si ya existe el pedido 1, solo creamos uno nuevo
            $nuevoPedido = Pedido::create([
                'tipo_pedido_id' => 1,
                'fecha' => now()->format('Y-m-d'),
                'fecha_necesidad' => '2025-05-29',
                // ... (resto de campos como arriba)
            ]);

                        SubPedido::create([
                'pedido_id' => $nuevoPedido->id,
                'producto_id' => 3,
                'color_id' => 2,
                'moneda_id' => 1,
                'precio' => 100000.00,
                'cantidad' => 1,
                'iva' => 10.50,
                'detalle' => null,
                'subbonificacion' => 0.00,
                'sub_fecha_entrega' => '2025-05-29',
                'subtotal' => 100000.00,
                'total' => 110500.00,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
