<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('dni', 20)->nullable();
            $table->string('nombres');
            $table->string('apellido_paterno')->nullable();
            $table->string('apellido_materno')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('cargo_rrhh')->nullable(); // Cargo en la empresa (RRHH)
            $table->string('foto')->nullable();
            $table->string('username')->unique();
            $table->string('password');
            $table->enum('rol', ['ADMINISTRADOR', 'CAJERO', 'PRODUCCION', 'MOZO', 'REPARTIDOR', 'PERSONALIZADO'])->default('MOZO');
            $table->boolean('estado')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
