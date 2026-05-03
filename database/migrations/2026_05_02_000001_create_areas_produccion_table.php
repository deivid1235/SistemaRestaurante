<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('areas_produccion', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->unsignedBigInteger('inpresora_id')->nullable();
            $table->enum('estado', ['activo', 'inactivo'])->default('activo');
            $table->timestamps();

            $table->foreign('inpresora_id')
                  ->references('id')
                  ->on('inpresoras')
                  ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('areas_produccion');
    }
};
