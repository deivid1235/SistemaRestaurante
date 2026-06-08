<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('detalle_compras', function (Blueprint $table) {
            $table->id();
            $table->foreignId('compra_id')->constrained('compras')->onDelete('cascade');
            $table->foreignId('producto_id')->nullable()->constrained('productos')->onDelete('set null');
            $table->string('descripcion', 200)->nullable(); // por si el producto fue eliminado
            $table->string('unidad_medida', 30)->default('UND');
            $table->decimal('cantidad', 10, 3)->default(1);
            $table->decimal('precio_unitario', 10, 2)->default(0);
            $table->decimal('importe', 10, 2)->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detalle_compras');
    }
};
