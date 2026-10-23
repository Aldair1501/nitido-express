<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('direcciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('destinatario', 150);
            $table->string('telefono', 20);
            $table->string('departamento', 100);
            $table->string('municipio', 100);
            $table->text('direccion');
            $table->text('referencia')->nullable();
            $table->boolean('predeterminada')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('direcciones');
    }
};
