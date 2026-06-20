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
        Schema::create('ingresos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_usu')->constrained('usuarios');
            $table->foreignId('id_apc')->constrained('aperturas_caja');

            $table->decimal('importe', 10, 2)->default(0);
            $table->string('responsable', 100);
            $table->string('motivo', 255);
            $table->dateTime('fecha_reg')->useCurrent();
            $table->char('estado', 1)->default('A');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ingresos');
    }
};
