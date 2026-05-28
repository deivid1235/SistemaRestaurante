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
        Schema::create('insumos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('insumo_catg_id')->constrained('insumo_catg')->onDelete('cascade');
            $table->foreignId('tipomedida_id')->constrained('tipomedida')->onDelete('cascade');
            $table->string('codigo', 50)->nullable();
            $table->string('nombre', 100);
            $table->string('stock', 50)->nullable();
            $table->decimal('costo', 10, 2)->default(0);
            $table->char('estado', 1)->default('a');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('insumos');
    }
};
