<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('provincias', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->unsignedBigInteger('pais_id');
            $table->timestamps();

            $table->foreign('pais_id')->references('id')->on('pais')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('provincias');
    }
};
