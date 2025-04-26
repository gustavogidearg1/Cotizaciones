<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cliente_id')->constrained('cliente');
            $table->date('fecha');
            $table->date('fecha_necesidad');
            $table->foreignId('forma_pago_id')->constrained('forma_pagos');
            $table->string('forma_entrega', 255);
            $table->string('solicitante', 100);
            $table->text('observacion')->nullable();
            $table->decimal('bonificacion', 5, 2)->default(0);
            $table->foreignId('user_id')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};
