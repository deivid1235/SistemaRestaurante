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
        Schema::create('ventas', function (Blueprint $table) {
            $table->id();
            // RELACIONES PRINCIPALES
            $table->foreignId('id_pedido_mesa')->constrained('pedido_mesas');
            $table->foreignId('id_tipo_pedido')->constrained('tipo_pedido');
            $table->foreignId('id_cliente')->constrained('clientes');
            $table->foreignId('id_tipo_doc')->constrained('tipo_documentos');
            $table->foreignId('id_tipo_pago')->constrained('tipo_pagos');
            $table->foreignId('id_usu')->constrained('usuarios');
            $table->foreignId('id_apc')->constrained('aperturas__caja');
            // DOCUMENTO
            $table->char('serie_doc', 4);
            $table->string('nro_doc', 8);
            // PAGOS
            $table->decimal('pago_efe', 10, 2)->default(0);
            $table->decimal('pago_efe_none', 10, 2)->default(0);
            $table->decimal('pago_tar', 10, 2)->default(0);
            // DESCUENTOS
            $table->char('descuento_tipo', 1);
            $table->integer('descuento_personal')->nullable();
            $table->decimal('descuento_monto', 10, 2)->default(0);
            $table->string('descuento_motivo', 200)->nullable();
            // COMISIONES
            $table->decimal('comision_tarjeta', 10, 2)->default(0);
            $table->decimal('comision_delivery', 10, 2)->default(0);
            // IMPUESTOS Y TOTAL
            $table->decimal('igv', 10, 2)->default(0);
            $table->decimal('total', 10, 2)->default(0);
            // SUNAT
            $table->string('codigo_operacion', 20)->nullable();
            $table->dateTime('fecha_venta')->nullable();
            $table->string('estado', 15)->default('a');
            $table->char('enviado_sunat', 1)->nullable();
            $table->string('code_respuesta_sunat', 5);
            $table->string('descripcion_sunat_cdr', 300);
            $table->string('name_file_sunat', 80);
            $table->string('hash_cdr', 200);
            $table->string('hash_cpe', 200);
            $table->date('fecha_vencimiento');
            // PAGOS EXTRA
            $table->string('pago_yape', 100);
            $table->string('pago_plin', 100);
            $table->string('pago_transferencia', 100);
            // REFERENCIAS
            $table->integer('id_documento_referencia')->nullable();
            $table->char('motivo_nota_id', 2)->nullable();
            $table->string('motivo_sustento', 500)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ventas');
    }
};
