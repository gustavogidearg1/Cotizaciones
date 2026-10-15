<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('pedidos', function (Blueprint $table) {
            $table->dropForeign(['cliente_id']);
            $table->dropColumn('cliente_id');

            $table->string('cliente', 255);
            $table->string('direccion', 255);
            $table->unsignedBigInteger('localidad_id')->nullable();
            $table->unsignedBigInteger('provincia_id')->nullable();
            $table->unsignedBigInteger('pais_id')->nullable()->default(1);
            $table->string('telefono', 100);
            $table->string('email', 255);
            $table->string('contacto', 100)->nullable();
            $table->unsignedBigInteger('categoria_id')->nullable()->default(1);


        });

        Schema::table('pedidos', function (Blueprint $table) {
            $table->foreign('localidad_id')->references('id')->on('localidad');
            $table->foreign('provincia_id')->references('id')->on('provincia');
            $table->foreign('pais_id')->references('id')->on('pais');
            $table->foreign('categoria_id')->references('id')->on('categoria');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
