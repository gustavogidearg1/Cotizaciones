<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // Modificar tabla pedidos
        Schema::table('pedidos', function (Blueprint $table) {
            $table->unsignedBigInteger('tipo_pedido_id')->default(1)->after('id');
            $table->string('plazo_entrega', 100)->nullable()->after('forma_entrega');
            $table->string('imagen', 255)->nullable()->after('observacion');
            $table->string('imagen_2', 255)->nullable()->after('imagen');
            $table->unsignedBigInteger('flete_id')->nullable()->after('imagen_2');

            $table->foreign('tipo_pedido_id')->references('id')->on('tipo_pedidos');
            $table->foreign('flete_id')->references('id')->on('fletes');
        });

        // Modificar tabla sub_pedidos
        Schema::table('sub_pedidos', function (Blueprint $table) {
            $table->decimal('iva', 5, 2)->default(21.00)->after('subbonificacion');
            $table->decimal('total', 12, 2)->after('subtotal');
        });

        // Actualizar los totales existentes
        DB::statement('UPDATE sub_pedidos SET total = subtotal * (1 + (iva / 100))');
    }

    public function down()
    {
        // Revertir cambios en pedidos
        Schema::table('pedidos', function (Blueprint $table) {
            $table->dropForeign(['tipo_pedido_id']);
            $table->dropForeign(['flete_id']);
            $table->dropColumn(['tipo_pedido_id', 'plazo_entrega', 'imagen', 'imagen_2', 'flete_id']);
        });

        // Revertir cambios en sub_pedidos
        Schema::table('sub_pedidos', function (Blueprint $table) {
            $table->dropColumn(['iva', 'total']);
        });
    }
};
