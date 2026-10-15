<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('localidades', function (Blueprint $table) {
            $table->id();
            $table->string('localidad')->unique();
            $table->string('cp', 10);
            $table->unsignedBigInteger('provincia_id');
            $table->unsignedBigInteger('pais_id');
            $table->timestamps();

            // Claves foráneas
            $table->foreign('provincia_id')
                  ->references('id')
                  ->on('provincias')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->foreign('pais_id')
                  ->references('id')
                  ->on('pais')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('localidades');
    }
};
