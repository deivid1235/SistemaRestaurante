<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('compras', function (Blueprint $table) {
            $table->id();
            $table->foreignId('proveedor_id')->constrained('proveedor')->onDelete('restrict');
            $table->string('tipo_comprobante', 50);   // Factura, Boleta, Ticket, etc.
            $table->string('serie', 10)->nullable();
            $table->string('numero', 20)->nullable();
            $table->date('fecha_documento');
            $table->time('hora_documento')->nullable();
            $table->string('tipo_pago', 50)->default('Contado'); // Contado, Crédito
            $table->decimal('subtotal', 10, 2)->default(0);
            $table->decimal('descuento', 10, 2)->default(0);
            $table->decimal('total', 10, 2)->default(0);
            $table->enum('estado', ['pendiente', 'aceptado', 'anulado'])->default('aceptado');
            $table->foreignId('usuario_id')->nullable()->constrained('usuarios')->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('compras');
    }
};
