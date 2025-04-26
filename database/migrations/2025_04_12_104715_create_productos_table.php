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
            $table->string('nombre', 255)->unique();
            $table->foreignId('um_id')->constrained('unidades');
            $table->text('detalle')->nullable();
            $table->string('img')->nullable();
            $table->string('img_1')->nullable();
            $table->string('img_2')->nullable();
            $table->string('img_3')->nullable();
            $table->foreignId('familia_id')->constrained('familias');
            $table->boolean('activo')->default(true);
            $table->foreignId('tipo_id')->constrained('tipos');
            $table->foreignId('user_id')->constrained('users');
            $table->timestamps();
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
