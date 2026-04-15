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
        Schema::create('libro_reclamacions', function (Blueprint $table) {
            $table->id();
           
            $table->string('tipo_documento');
            $table->string('numero_documento')->unique();
            $table->string('primer_nombre');
            $table->string('segundo_nombre')->nullable();
            $table->string('primer_apellido');
            $table->string('segundo_apellido');
            $table->string('correo');
            $table->string('telefono');
            $table->string('direccion');
            $table->string('departamento');
            $table->string('provincia');
            $table->string('distrito');

            $table->string('servicio_contratado');
            $table->string('numero_orden')->nullable();
            $table->string('identificacion_servicio')->nullable();
            $table->decimal('monto_reclamado', 12, 2)->nullable();

            $table->string('tipo_reclamo');
            $table->text('motivo');
            $table->text('detalle_solicitud');
            $table->text('pedido_concreto');
            $table->boolean('acepto_politicas')->default(true);
            
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('libro_reclamacions');
    }
};
