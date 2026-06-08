<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('creditos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('compra_id')->constrained('compras')->onDelete('cascade');
            $table->decimal('monto_total',   10, 2)->default(0);
            $table->decimal('interes',       10, 2)->default(0);
            $table->decimal('amortizado',    10, 2)->default(0);
            $table->decimal('pendiente',     10, 2)->default(0);
            $table->date('fecha_vencimiento');
            $table->enum('estado', ['pendiente', 'pagado', 'vencido'])->default('pendiente');
            $table->foreignId('usuario_id')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
        });

        Schema::create('pagos_credito', function (Blueprint $table) {
            $table->id();
            $table->foreignId('credito_id')->constrained('creditos')->onDelete('cascade');
            $table->decimal('monto',  10, 2);
            $table->decimal('interes', 10, 2)->default(0);
            $table->date('fecha_pago');
            $table->string('observacion')->nullable();
            $table->foreignId('usuario_id')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pagos_credito');
        Schema::dropIfExists('creditos');
    }
};
