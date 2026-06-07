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
        Schema::create('producto_pres', function (Blueprint $table) {
            $table->id();
            $table->foreignId('producto_id')->constrained('productos')->cascadeOnDelete();
            $table->string('codigo', 50)->nullable();
            $table->string('codigo_qr')->nullable();
            $table->string('codigo_barra')->nullable();
            $table->string('presentacion', 100);
            $table->string('descripcion', 150)->nullable();
            $table->decimal('precio', 10, 2);
            $table->decimal('precio_delivery', 10, 2)->default(0);
            $table->decimal('costo', 10, 2)->default(0);
            $table->integer('stock')->default(0);
            $table->integer('stock_min')->default(0);
            $table->decimal('igv', 5, 2)->default(18);
            $table->text('receta')->nullable();
            $table->boolean('delivery')->default(true);
            $table->char('estado', 1)->default('a');
            $table->integer('orden')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('producto_pres');
    }
};
