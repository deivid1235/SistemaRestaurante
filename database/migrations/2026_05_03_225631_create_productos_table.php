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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_catg')->constrained('producto_categorias') ->cascadeOnDelete();
            $table->foreignId('id_areap')->constrained('areas_produccion') ->cascadeOnDelete();
            $table->string('nombre');
            $table->text('notas')->nullable();
            $table->text('descripcion')->nullable();
            $table->string('imagen')->nullable();
            $table->string('codigo_qr')->nullable();
            $table->string('codigo_barra')->nullable();
            $table->decimal('precio', 10, 2);
            $table->decimal('costo', 10, 2)->nullable();
            $table->integer('stock')->default(0);
            $table->integer('stock_minimo')->default(0);
            $table->enum('preparacion', ['cocina', 'bodega']);
            $table->integer('tiempo_preparacion')->default(0);
            $table->boolean('delivery')->default(true);
            $table->boolean('destacado')->default(false);
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
        Schema::dropIfExists('productos');
    }
};
