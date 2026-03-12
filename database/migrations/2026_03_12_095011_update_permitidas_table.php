<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('permitidas', function (Blueprint $table) {
            $table->unsignedBigInteger('volunteer_id')->nullable()->after('id');
        });

        DB::statement('UPDATE permitidas SET volunteer_id = id_registro');

        Schema::table('permitidas', function (Blueprint $table) {
            $table->foreign('volunteer_id')->references('id')->on('volunteers')->onDelete('cascade');

            $table->renameColumn('hora', 'hora_salida');
            $table->renameColumn('encargado', 'encargado_salida');

            $table->string('hora_reingreso')->nullable()->after('motivo');
            $table->string('encargado_reingreso')->nullable()->after('hora_reingreso');
            $table->string('concepto_reingreso')->nullable()->after('encargado_reingreso');
            $table->string('estado')->default('fuera')->after('concepto_reingreso');
        });
    }

    public function down(): void
    {
        Schema::table('permitidas', function (Blueprint $table) {
            $table->renameColumn('hora_salida', 'hora');
            $table->renameColumn('encargado_salida', 'encargado');

            $table->dropForeign(['volunteer_id']);
            $table->dropColumn([
                'hora_reingreso',
                'encargado_reingreso',
                'concepto_reingreso',
                'estado',
                'volunteer_id',
            ]);
        });
    }
};
