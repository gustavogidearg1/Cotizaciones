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
        Schema::create('sub_pedidos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('producto_id')->constrained('productos');
            $table->decimal('precio', 12, 2);
            $table->decimal('subbonificacion', 5, 2);
            $table->integer('cantidad');
            $table->foreignId('moneda_id')->constrained('monedas');
            $table->date('sub_fecha_entrega');
            $table->decimal('subtotal', 12, 2);
            $table->text('detalle')->nullable();
            $table->foreignId('pedido_id')->constrained('pedidos')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_pedidos');
    }
};
