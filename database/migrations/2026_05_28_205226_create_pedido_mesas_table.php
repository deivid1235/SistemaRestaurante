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
        Schema::create('pedido_mesas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_mesa')->constrained('mesas')->cascadeOnDelete();
            $table->foreignId('id_mozo')->constrained('usuarios')->cascadeOnDelete();
            $table->string('nombre_cliente', 150)->nullable();
            $table->integer('nro_personas')->nullable();
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedido_mesas');
    }
};
