<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sub_pedidos', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('producto_id');
            $table->decimal('precio', 12, 2);
            $table->decimal('subbonificacion', 5, 2);
            $table->decimal('descuento_2', 5, 2)->default(0.00);
            $table->decimal('descuento_3', 5, 2)->default(0.00);
            $table->decimal('descuento_4', 5, 2)->default(0.00);
            $table->decimal('diferencia', 6, 2)->default(0.00);
            $table->decimal('iva', 5, 2)->default(21.00);
            $table->integer('cantidad');
            $table->unsignedBigInteger('moneda_id');
            $table->unsignedBigInteger('forma_pago_id')->nullable();
            $table->date('sub_fecha_entrega');
            $table->decimal('subtotal', 12, 2);
            $table->decimal('total', 12, 2);
            $table->text('detalle')->nullable();
            $table->unsignedBigInteger('pedido_id');
            $table->unsignedBigInteger('color_id')->nullable();
            $table->timestamps();

            // Foreign Keys
            $table->foreign('producto_id')->references('id')->on('productos')->onDelete('restrict');
            $table->foreign('moneda_id')->references('id')->on('monedas')->onDelete('restrict');
            $table->foreign('pedido_id')->references('id')->on('pedidos')->onDelete('restrict');
            $table->foreign('color_id')->references('id')->on('colores')->onDelete('set null');
            $table->foreign('forma_pago_id')->references('id')->on('forma_pagos')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sub_pedidos');
    }
};
