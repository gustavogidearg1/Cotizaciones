<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParametersTable extends Migration
{
    public function up()
    {
        Schema::create('parameters', function (Blueprint $table) {
            $table->id();
            $table->string('key')->comment('Clave del parámetro');
            $table->string('value')->nullable()->comment('Valor del parámetro');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('parameters');
    }
}
