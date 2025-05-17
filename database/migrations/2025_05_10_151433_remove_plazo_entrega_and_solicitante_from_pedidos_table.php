<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::table('pedidos', function (Blueprint $table) {
        $table->dropColumn(['plazo_entrega', 'solicitante']);
    });
}

public function down()
{
    Schema::table('pedidos', function (Blueprint $table) {
        $table->string('plazo_entrega', 100)->nullable()->after('forma_entrega');
        $table->string('solicitante', 100)->after('plazo_entrega');
    });
}
};
