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
        Schema::create('pedido_deliveries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_cliente')->constrained('clientes');
            $table->foreignId('id_repartidor')->constrained('usuarios');
            $table->foreignId('tipo_pago')->constrained('tipo_pagos');
            $table->enum('entrega', ['domicilio', 'recoger']);
            $table->string('canal', 50);
            $table->boolean('pedido_programado')->default(false);
            $table->time('hora_entrega')->nullable();
            $table->decimal('paga_con', 10, 2)->default(0);
            $table->decimal('comision_delivery', 10, 2)->default(0);
            $table->decimal('amortizacion', 10, 2)->default(0);
            $table->string('nro_pedido', 10);
            $table->string('nombre_cliente', 100);
            $table->string('telefono_cliente', 20);
            $table->string('direccion_cliente', 100);
            $table->string('referencia_cliente', 100)->nullable();
            $table->string('email_cliente', 200)->nullable();
            $table->dateTime('fecha_preparacion')->nullable();
            $table->dateTime('fecha_envio')->nullable();
            $table->dateTime('fecha_entrega')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedido_deliveries');
    }
};
