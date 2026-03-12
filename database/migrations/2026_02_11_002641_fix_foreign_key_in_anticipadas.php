<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('anticipadas', function (Blueprint $table) {

            // 🔴 Eliminar foreign key si ya existe
            try {
                $table->dropForeign(['id_registro']);
            } catch (\Exception $e) {
                // No hacer nada si no existe
            }

            // 🔴 Crear la nueva foreign key apuntando a volunteers
            $table->foreign('id_registro')
                  ->references('id')
                  ->on('volunteers')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('anticipadas', function (Blueprint $table) {

            // Eliminar la foreign key actual
            try {
                $table->dropForeign(['id_registro']);
            } catch (\Exception $e) {
                // No hacer nada si no existe
            }

            // Restaurar la relación anterior
            $table->foreign('id_registro')
                  ->references('id')
                  ->on('registros')
                  ->onDelete('cascade');
        });
    }
};