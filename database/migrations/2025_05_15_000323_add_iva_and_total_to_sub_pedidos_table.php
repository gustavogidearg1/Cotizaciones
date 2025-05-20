<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIvaAndTotalToSubPedidosTable extends Migration
{
    public function up()
    {
        Schema::table('sub_pedidos', function (Blueprint $table) {
            if (!Schema::hasColumn('sub_pedidos', 'iva')) {
                $table->decimal('iva', 5, 2)->default(21)->after('subbonificacion');
            }

            if (!Schema::hasColumn('sub_pedidos', 'total')) {
                $table->decimal('total', 12, 2)->default(0)->after('subtotal');
            }
        });
    }

    public function down()
    {
        Schema::table('sub_pedidos', function (Blueprint $table) {
            if (Schema::hasColumn('sub_pedidos', 'iva')) {
                $table->dropColumn('iva');
            }

            if (Schema::hasColumn('sub_pedidos', 'total')) {
                $table->dropColumn('total');
            }
        });
    }
}


