<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogsTable extends Migration
{
    public function up()
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            $table->string('info')->nullable()->comment('Información breve o título');
            $table->text('message')->nullable()->comment('Mensaje detallado del evento');
            $table->text('context')->nullable()->comment('Contexto adicional (puede ser JSON)');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('logs');
    }
}
