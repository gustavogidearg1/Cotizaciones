<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFormaPagoAndDescuentosToSubPedidosTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('sub_pedidos', function (Blueprint $table) {
            // Nuevos campos de descuento
            $table->decimal('descuento_2', 5, 2)->default(0)->after('subbonificacion');
            $table->decimal('descuento_3', 5, 2)->default(0)->after('descuento_2');
            $table->decimal('descuento_4', 5, 2)->default(0)->after('descuento_3');

            // Relación a forma_pago
            $table->foreignId('forma_pago_id')->nullable()->after('moneda_id')->constrained('forma_pagos')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('sub_pedidos', function (Blueprint $table) {
            $table->dropForeign(['forma_pago_id']);
            $table->dropColumn(['forma_pago_id', 'descuento_2', 'descuento_3', 'descuento_4']);
        });
    }
}
