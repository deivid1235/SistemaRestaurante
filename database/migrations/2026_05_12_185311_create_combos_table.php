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
        Schema::create('combos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 255);
            $table->foreignId('id_area')->constrained('areas_produccion')->onDelete('cascade');

            $table->text('nota')->nullable();
            $table->text('descripcion')->nullable();
            $table->string('imagen', 255)->nullable();

            $table->enum('estado', ['activo', 'inactivo'])->default('activo');
            $table->boolean('delivery')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('combos');
    }
};
