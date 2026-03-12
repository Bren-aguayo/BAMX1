<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('ingreso_salidas', function (Blueprint $table) {
            // quitar foreign key incorrecta
            $table->dropForeign(['id_registro']);

            // crear foreign key correcta
            $table->foreign('id_registro')
                ->references('id')
                ->on('volunteers')
                ->onDelete('restrict');
        });
    }

    public function down(): void
    {
        Schema::table('ingreso_salidas', function (Blueprint $table) {
            $table->dropForeign(['id_registro']);

            $table->foreign('id_registro')
                ->references('id')
                ->on('registros')
                ->onDelete('restrict');
        });
    }
};

