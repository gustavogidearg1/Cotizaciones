<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('colores', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 50)->unique(); // Nombre único del color
            $table->string('descripcion', 50)->nullable()->unique(); // Descripción opcional pero única
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('colores');
    }
};
