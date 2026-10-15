<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('localidad', function (Blueprint $table) {
            $table->renameColumn('localidad', 'nombre');
        });
    }

    public function down()
    {
        Schema::table('localidad', function (Blueprint $table) {
            $table->renameColumn('nombre', 'localidad');
        });
    }
};
