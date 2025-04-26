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
        Schema::table('localidad', function (Blueprint $table) {
            // Cambiar el nombre de la columna si es necesario
            $table->renameColumn('localidad', 'nombre');

            // Agregar campos faltantes
            $table->string('cp')->after('nombre');
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
