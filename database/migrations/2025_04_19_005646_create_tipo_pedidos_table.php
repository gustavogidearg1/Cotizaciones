<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tipo_pedidos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->timestamps();
        });

        // Insertar datos iniciales
        DB::table('tipo_pedidos')->insert([
            ['nombre' => 'Cotización'],
            ['nombre' => 'Pedido']
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('tipo_pedidos');
    }
};
