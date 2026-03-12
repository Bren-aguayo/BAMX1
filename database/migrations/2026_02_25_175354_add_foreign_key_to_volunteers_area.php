<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('volunteers', function (Blueprint $table) {

            // 🔴 Intentar eliminar la foreign key si ya existe
            try {
                $table->dropForeign(['area_id']);
            } catch (\Exception $e) {
                // No hacer nada si no existe
            }

            // 🔴 Crear la foreign key correctamente
            $table->foreign('area_id')
                  ->references('id')
                  ->on('areas')
                  ->onDelete('restrict');
        });
    }

    public function down(): void
    {
        Schema::table('volunteers', function (Blueprint $table) {

            try {
                $table->dropForeign(['area_id']);
            } catch (\Exception $e) {
                // No hacer nada si no existe
            }
        });
    }
};