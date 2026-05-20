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
        Schema::create('aperturas__caja', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('usuario_id');
            $table->unsignedBigInteger('caja_id');
            $table->unsignedBigInteger('turno_id');
            $table->dateTime('fecha_apertura');
            $table->decimal('monto_apertura', 10, 2);
            $table->dateTime('fecha_cierre')->nullable();
            $table->decimal('monto_cierre', 10, 2)->nullable();
            $table->decimal('monto_sistema', 10, 2)->nullable();
            $table->decimal('diferencia', 10, 2)->nullable();
            $table->char('estado', 1)->default('a');
            $table->string('observacion')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aperturas__caja');
    }
};
