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
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->integer('tipo_cliente');
            $table->string('tipo_documento', 3); // DNI o RUC
            $table->string('numero_documento', 13);
            $table->string('nombres', 100);
            $table->string('razon_social', 100)->nullable();
            $table->string('telefono', 15);
            $table->date('fecha_nac');
            $table->string('correo', 100);
            $table->string('password'); 
            $table->string('direccion', 100);
            $table->string('referencia', 100)->nullable();
            $table->enum('estado', ['a', 'i'])->default('a');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
