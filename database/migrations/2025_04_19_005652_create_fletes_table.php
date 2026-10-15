<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        Schema::create('fletes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->timestamps();
        });

        // Insertar datos iniciales
        DB::table('fletes')->insert([
            ['nombre' => 'A cargo del cliente'],
            ['nombre' => 'A cargo de la empresa'],
            ['nombre' => 'Mitad y mitad']
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('fletes');
    }
};
