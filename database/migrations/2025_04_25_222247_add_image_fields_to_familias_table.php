<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('familias', function (Blueprint $table) {
            $table->string('imagen_principal', 255)->nullable()->after('nombre');
            $table->string('imagen_secundaria', 255)->nullable()->after('imagen_principal');
        });
    }

    public function down()
    {
        Schema::table('familias', function (Blueprint $table) {
            $table->dropColumn(['imagen_principal', 'imagen_secundaria']);
        });
    }
};
