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
    Schema::table('productos', function (Blueprint $table) {
        $table->string('links', 255)->nullable()->after('img_3');
        $table->decimal('volumen_carga_m3', 8, 2)->nullable()->after('links');
        $table->string('potencia_requerida_hp', 50)->nullable()->after('volumen_carga_m3');
        $table->string('toma_potencia_tom', 50)->nullable()->after('potencia_requerida_hp');
        $table->string('tiempo_descarga_aprx_min', 50)->nullable()->after('toma_potencia_tom');
        $table->string('balanza', 50)->nullable()->after('tiempo_descarga_aprx_min');
        $table->string('camaras', 50)->nullable()->after('balanza');
        $table->decimal('altura_maxima_mm', 8, 2)->nullable()->after('camaras');
        $table->decimal('altura_carga_mm', 8, 2)->nullable()->after('altura_maxima_mm');
        $table->decimal('longitud_total_mm', 8, 2)->nullable()->after('altura_carga_mm');
        $table->decimal('peso_vacio_kg', 8, 2)->nullable()->after('longitud_total_mm');
        $table->string('de_serie', 255)->nullable()->after('peso_vacio_kg');
        $table->string('opcional', 255)->nullable()->after('de_serie');
        $table->string('colores', 255)->nullable()->after('opcional');
    });
}

    /**
     * Reverse the migrations.
     */
   public function down()
{
    Schema::table('productos', function (Blueprint $table) {
        $table->dropColumn([
            'links',
            'volumen_carga_m3',
            'potencia_requerida_hp',
            'toma_potencia_tom',
            'tiempo_descarga_aprx_min',
            'balanza',
            'camaras',
            'altura_maxima_mm',
            'altura_carga_mm',
            'longitud_total_mm',
            'peso_vacio_kg',
            'de_serie',
            'opcional',
            'colores'
        ]);
    });
}


};
