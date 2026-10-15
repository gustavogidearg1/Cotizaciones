<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Eliminar la columna de pedidos si existe
        Schema::table('pedidos', function (Blueprint $table) {
            if (Schema::hasColumn('pedidos', 'color_id')) {
                $table->dropForeign(['color_id']);
                $table->dropColumn('color_id');
            }
        });

        // Agregar la columna a sub_pedidos
        Schema::table('sub_pedidos', function (Blueprint $table) {
            if (!Schema::hasColumn('sub_pedidos', 'color_id')) {
                $table->unsignedBigInteger('color_id')->nullable()->after('pedido_id');
                $table->foreign('color_id')->references('id')->on('colores')->onDelete('set null');
            }
        });
    }

    public function down()
    {
        // Revertir los cambios
        Schema::table('sub_pedidos', function (Blueprint $table) {
            $table->dropForeign(['color_id']);
            $table->dropColumn('color_id');
        });

        Schema::table('pedidos', function (Blueprint $table) {
            $table->unsignedBigInteger('color_id')->nullable()->after('categoria_id');
            $table->foreign('color_id')->references('id')->on('colores')->onDelete('set null');
        });
    }
};
