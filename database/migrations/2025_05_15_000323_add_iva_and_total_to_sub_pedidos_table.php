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
        $table->decimal('iva', 5, 2)->default(21.00)->after('subbonificacion');
        $table->decimal('total', 12, 2)->after('subtotal');
    });
}

    /**
     * Reverse the migrations.
     */
public function down()
{
    Schema::table('sub_pedidos', function (Blueprint $table) {
        $table->dropColumn(['iva', 'total']);
    });
}
};
