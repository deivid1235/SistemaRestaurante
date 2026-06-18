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
        Schema::create('ventas', function (Blueprint $table) {
            $table->id();
            // RELACIONES
            $table->foreignId('id_cliente')->nullable()->constrained('clientes')->nullOnDelete();
            $table->foreignId('id_tipo_doc')->constrained('tipo_documentos');
            $table->foreignId('id_usu')->constrained('usuarios');
            $table->foreignId('id_apc')->nullable()->constrained('aperturas_caja')->nullOnDelete();
            $table->char('serie_doc', 4);
            $table->string('nro_doc', 8);
            $table->string('codigo_operacion', 4) ->nullable();
            $table->decimal('op_gravadas', 10, 2)->default(0);
            $table->decimal('op_exoneradas', 10, 2)->default(0);
            $table->decimal('op_inafectas', 10, 2)->default(0);
            $table->decimal('igv', 10, 2)->default(0);
            $table->decimal('total', 10, 2);
            $table->decimal('descuento', 10, 2)->default(0.00);
            $table->dateTime('fecha_emision')->useCurrent();
            $table->date('fecha_vencimiento')->nullable();
            $table->char('enviado_sunat', 1)->default('0');
            $table->string('estado_sunat', 20)->nullable();
            $table->string('code_respuesta_sunat', 5)->nullable();
            $table->string('descripcion_sunat_cdr', 300)->nullable();
            $table->string('hash_cpe', 200)->nullable();
            $table->string('hash_cdr', 200)->nullable();
            $table->string('name_file_sunat', 100)->nullable();
            $table->string('estado', 15)->default('emitido');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ventas');
    }
};
