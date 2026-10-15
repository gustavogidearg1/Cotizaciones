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
    Schema::table('monedas', function (Blueprint $table) {
        $table->string('desc_ampliada', 150)->nullable()->after('moneda');
        $table->decimal('tipo_cambio', 10, 2)->default(0)->after('desc_ampliada');
    });
}

public function down()
{
    Schema::table('monedas', function (Blueprint $table) {
        $table->dropColumn(['desc_ampliada', 'tipo_cambio']);
    });
}
};
