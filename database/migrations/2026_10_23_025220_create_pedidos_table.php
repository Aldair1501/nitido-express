<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->string('numero_pedido', 30)->unique();
            $table->foreignId('user_id')->constrained('users')->restrictOnDelete();
            $table->json('direccion_entrega'); // Copia histórica: datos de entrega Guatemala
            $table->decimal('subtotal', 10, 2);
            $table->decimal('costo_envio', 10, 2)->default(0);
            $table->decimal('total', 10, 2);
            $table->string('estado', 30)->default('pendiente');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};
