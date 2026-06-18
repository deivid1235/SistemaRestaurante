<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('movimientos_stock', function (Blueprint $table) {
            $table->id();
            $table->foreignId('producto_id')->constrained('productos')->onDelete('cascade');
            $table->enum('tipo_operacion', ['entrada', 'salida', 'merma']);
            $table->decimal('cantidad', 12, 4);
            $table->decimal('precio_unitario', 10, 4)->default(0);
            $table->decimal('total', 12, 4)->default(0);
            $table->string('concepto')->nullable();
            $table->string('responsable')->nullable();
            $table->enum('estado', ['pendiente', 'aprobado', 'anulado'])->default('aprobado');
            $table->foreignId('usuario_id')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('movimientos_stock');
    }
};
