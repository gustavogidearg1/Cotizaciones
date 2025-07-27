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
Schema::create('productos', function (Blueprint $table) {
    $table->id();
    $table->integer('codigo')->unique();
    $table->string('nombre')->unique();
    $table->unsignedBigInteger('um_id');
    $table->text('detalle')->nullable();
    $table->string('img')->nullable();
    $table->string('img_1')->nullable();
    $table->string('img_2')->nullable();
    $table->string('img_3')->nullable();
    $table->string('links')->nullable();
    $table->decimal('volumen_carga_m3', 8, 2)->nullable();
    $table->string('potencia_requerida_hp', 50)->nullable();
    $table->string('toma_potencia_tom', 50)->nullable();
    $table->string('tiempo_descarga_aprx_min', 50)->nullable();
    $table->string('balanza', 50)->nullable();
    $table->string('camaras', 50)->nullable();
    $table->decimal('altura_maxima_mm', 8, 2)->nullable();
    $table->decimal('altura_carga_mm', 8, 2)->nullable();
    $table->decimal('longitud_total_mm', 8, 2)->nullable();
    $table->decimal('peso_vacio_kg', 8, 2)->nullable();
    $table->string('de_serie')->nullable();
    $table->string('opcional')->nullable();
    $table->string('colores')->nullable();
    $table->unsignedBigInteger('familia_id');
    $table->boolean('activo')->default(1);
    $table->unsignedBigInteger('tipo_id');
    $table->unsignedBigInteger('user_id');
    $table->timestamps();

    // Relaciones
    $table->foreign('um_id')->references('id')->on('unidades');
    $table->foreign('familia_id')->references('id')->on('familias');
    $table->foreign('tipo_id')->references('id')->on('tipos');
    $table->foreign('user_id')->references('id')->on('users');
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
