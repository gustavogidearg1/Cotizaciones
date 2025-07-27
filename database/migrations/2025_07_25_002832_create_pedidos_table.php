<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id(); // bigint unsigned, auto_increment, PK

            $table->unsignedBigInteger('tipo_pedido_id')->default(1);
            $table->date('fecha');
            $table->date('fecha_necesidad');
            $table->unsignedBigInteger('forma_pago_id');
            $table->string('forma_entrega', 255);
            $table->text('observacion')->nullable();
            $table->string('imagen', 255)->nullable();
            $table->string('imagen_2', 255)->nullable();
            $table->unsignedBigInteger('flete_id')->nullable();
            $table->decimal('bonificacion', 5, 2)->default(0.00);
            $table->decimal('diferencia', 5, 2)->default(0.00);
            $table->unsignedBigInteger('user_id');
            $table->string('cliente', 255);
            $table->string('cuit', 11);
            $table->string('direccion', 255);
            $table->unsignedBigInteger('localidad_id');
            $table->unsignedBigInteger('provincia_id');
            $table->unsignedBigInteger('pais_id')->default(1);
            $table->string('telefono', 100);
            $table->string('email', 255);
            $table->string('contacto', 100)->nullable();
            $table->unsignedBigInteger('categoria_id')->default(1);
            $table->string('token', 255)->unique()->nullable();
            $table->unsignedBigInteger('moneda_id')->nullable();
            $table->decimal('cotizacion', 10, 2)->nullable();

            $table->timestamps();

            // Foreign Keys
            $table->foreign('tipo_pedido_id')->references('id')->on('tipos')->onDelete('restrict');
            $table->foreign('forma_pago_id')->references('id')->on('forma_pagos')->onDelete('restrict');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict');
            $table->foreign('flete_id')->references('id')->on('fletes')->onDelete('set null');
            $table->foreign('localidad_id')->references('id')->on('localidad')->onDelete('restrict');
            $table->foreign('provincia_id')->references('id')->on('provincia')->onDelete('restrict');
            $table->foreign('pais_id')->references('id')->on('pais')->onDelete('restrict');
            $table->foreign('categoria_id')->references('id')->on('categorias')->onDelete('restrict');
            $table->foreign('moneda_id')->references('id')->on('monedas')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};
