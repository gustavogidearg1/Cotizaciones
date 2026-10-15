<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // 1) Agrego la columna como nullable para no romper datos existentes
        Schema::table('cotizaciones', function (Blueprint $table) {
            $table->unsignedBigInteger('moneda_id')->nullable()->after('observacion');
        });

        // 2) Seteo valor por defecto en registros existentes (2 = Pesos, según tu dump)
        DB::table('cotizaciones')->whereNull('moneda_id')->update(['moneda_id' => 2]);

        // 3) Vuelvo NOT NULL y agrego la FK
        Schema::table('cotizaciones', function (Blueprint $table) {
            $table->unsignedBigInteger('moneda_id')->nullable(false)->change();

            // Nombre de la FK: igual al que genera Laravel por convención
            $table->foreign('moneda_id', 'cotizaciones_moneda_id_foreign')
                  ->references('id')->on('monedas')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
        });
    }

    public function down(): void
    {
        Schema::table('cotizaciones', function (Blueprint $table) {
            // Primero elimino la FK, luego la columna
            $table->dropForeign('cotizaciones_moneda_id_foreign');
            $table->dropColumn('moneda_id');
        });
    }
};
