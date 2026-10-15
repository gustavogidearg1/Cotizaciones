<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (Schema::hasTable('localidad') && !Schema::hasColumn('localidad', 'cp')) {
            Schema::table('localidad', function (Blueprint $table) {
                $table->string('cp', 10)->after('nombre');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('localidad', function (Blueprint $table) {
            //
        });
    }
};
