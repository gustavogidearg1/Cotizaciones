<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('sub_pedidos', function (Blueprint $table) {
            // Primero eliminar la restricción de clave foránea si existe
            if (Schema::hasColumn('sub_pedidos', 'color_id')) {
                $table->dropForeign(['color_id']);
            }

            // Eliminar la columna si existe
            if (Schema::hasColumn('sub_pedidos', 'color_id')) {
                $table->dropColumn('color_id');
            }

            // Volver a crear la columna correctamente
            $table->foreignId('color_id')
                  ->nullable()
                  ->constrained('colores')
                  ->after('moneda_id')
                  ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('sub_pedidos', function (Blueprint $table) {
            $table->dropForeign(['color_id']);
            $table->dropColumn('color_id');
        });
    }
};
