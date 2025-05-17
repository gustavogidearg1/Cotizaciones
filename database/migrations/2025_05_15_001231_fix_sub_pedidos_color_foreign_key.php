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
    Schema::table('sub_pedidos', function (Blueprint $table) {
        // Eliminar la restricción existente si existe
        $table->dropForeign(['color_id']);

        // Agregar la nueva restricción correctamente
        $table->foreign('color_id')
              ->references('id')
              ->on('colores')
              ->onDelete('set null');
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
