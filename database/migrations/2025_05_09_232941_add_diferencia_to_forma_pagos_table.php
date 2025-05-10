<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('forma_pagos', function (Blueprint $table) {
            $table->decimal('diferencia', 5, 2)->default(0.00)->after('descripcion');
        });
    }

    public function down()
    {
        Schema::table('forma_pagos', function (Blueprint $table) {
            $table->dropColumn('diferencia');
        });
    }
};
