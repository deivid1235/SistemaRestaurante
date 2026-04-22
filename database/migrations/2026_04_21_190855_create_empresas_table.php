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
        Schema::create('empresas', function (Blueprint $table) {
            $table->id();
            $table->char('ruc', 11)->unique();
            $table->string('razon_social');
            $table->string('nombre_comercial')->nullable();
            $table->string('direccion_comercial')->nullable();
            $table->string('direccion_fiscal')->nullable();
            $table->char('ubigeo', 6)->nullable();
            $table->string('departamento')->nullable();
            $table->string('provincia')->nullable();
            $table->string('distrito')->nullable();
            $table->enum('modo', ['produccion', 'beta'])->default('beta');
            $table->string('usuariosol')->nullable();
            $table->text('clave_sol')->nullable(); 
            $table->text('clavecertificado')->nullable(); 
            $table->string('celular', 20)->nullable();
            $table->string('email', 150)->nullable();
            $table->string('logo')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empresas');
    }
};
