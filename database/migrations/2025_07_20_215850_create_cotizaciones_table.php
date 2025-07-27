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
    Schema::create('cotizaciones', function (Blueprint $table) {
        $table->id();
        $table->string('cotizacion', 100)->unique()->comment('Nombre o código de cotización');
        $table->string('descripcion', 100)->comment('Descripción de la cotización');
        $table->date('vencimiento')->comment('Fecha de vencimiento');
        $table->string('observacion', 255)->nullable()->comment('Observaciones adicionales');
        $table->unsignedBigInteger('user_id')->comment('Usuario que crea la cotización');
        $table->timestamps();

        // Foreign Key a users
        $table->foreign('user_id')
            ->references('id')
            ->on('users')
            ->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cotizaciones');
    }
};
