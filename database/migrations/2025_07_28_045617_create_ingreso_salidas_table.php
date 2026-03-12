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
        Schema::create('ingreso_salidas', function (Blueprint $table) {
            $table->id();

            // Relación con registros (empleados)
            $table->unsignedBigInteger('id_registro');

            $table->foreign('id_registro')
                ->references('id')
                ->on('registros')
                ->onDelete('restrict');

            // Fecha y horas
            $table->date('fecha');
            $table->time('hora_entrada')->nullable();
            $table->time('hora_salida')->nullable();

            // Un solo registro por empleado por día
            $table->unique(['id_registro', 'fecha']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ingreso_salidas');
    }
};
