<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sub_cotizaciones', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('producto_id');
            $table->unsignedBigInteger('moneda_id');
            $table->decimal('precio', 12, 2);
            $table->decimal('precio_bonificado', 12, 2);
            $table->decimal('descuento', 5, 2);
            $table->string('detalle', 100)->nullable();
            $table->unsignedBigInteger('cotizacion_id');

            $table->timestamps();

            // Claves foráneas
            $table->foreign('producto_id')->references('id')->on('productos')->onDelete('cascade');
            $table->foreign('moneda_id')->references('id')->on('monedas')->onDelete('cascade');
            $table->foreign('cotizacion_id')->references('id')->on('cotizaciones')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sub_cotizaciones');
    }
};
