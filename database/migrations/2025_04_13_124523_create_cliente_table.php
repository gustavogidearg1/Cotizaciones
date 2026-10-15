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
        Schema::create('cliente', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 255)->unique();
            $table->string('direccion', 255)->nullable();
            $table->foreignId('localidad_id')->constrained('localidad');
            $table->foreignId('provincia_id')->constrained('provincia');
            $table->string('telefono', 100)->nullable();
            $table->string('email')->nullable();
            $table->string('contacto', 100)->nullable();
            $table->enum('concesionario', ['si', 'no'])->default('no');
            $table->foreignId('categoria_id')->constrained('categoria');
            $table->decimal('descuento', 5, 2)->default(0);
            $table->foreignId('user_id')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cliente');
    }
};
