<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::table('pedidos', function (Blueprint $table) {
        $table->foreignId('moneda_id')->nullable()->constrained('monedas')->after('diferencia');
    });
}

public function down()
{
    Schema::table('pedidos', function (Blueprint $table) {
        $table->dropForeign(['moneda_id']);
        $table->dropColumn('moneda_id');
    });
}

};
