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
        Schema::create('venta_detalles', function (Blueprint $table) {
            $table->id();
            // relación con ventas
            $table->foreignId('venta_id')->constrained('ventas')->cascadeOnDelete();
            // producto
            $table->unsignedBigInteger('id_prod');
            $table->integer('cantidad');
            $table->decimal('precio', 10, 2);
            $table->decimal('total', 10, 2);
           
            // FK producto
            $table->foreign('id_prod')->references('id')->on('productos')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('venta_detalles');
    }
};
