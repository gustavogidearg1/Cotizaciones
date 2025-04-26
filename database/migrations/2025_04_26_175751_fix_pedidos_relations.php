<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('pedidos', function (Blueprint $table) {
            // Cambiar columnas a nullable temporalmente
            $table->unsignedBigInteger('localidad_id')->nullable()->change();
            $table->unsignedBigInteger('provincia_id')->nullable()->change();
            $table->unsignedBigInteger('pais_id')->nullable()->change();
            $table->unsignedBigInteger('categoria_id')->nullable()->change();
        });

        // Lógica para poblar datos (si es necesario)
        DB::table('pedidos')->update([
            'pais_id' => 1,
            'categoria_id' => 1
        ]);

        Schema::table('pedidos', function (Blueprint $table) {
            // Restablecer restricciones después de actualizar datos
            $table->unsignedBigInteger('localidad_id')->nullable(false)->change();
            $table->unsignedBigInteger('provincia_id')->nullable(false)->change();
            $table->unsignedBigInteger('pais_id')->nullable(false)->default(1)->change();
            $table->unsignedBigInteger('categoria_id')->nullable(false)->default(1)->change();
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
