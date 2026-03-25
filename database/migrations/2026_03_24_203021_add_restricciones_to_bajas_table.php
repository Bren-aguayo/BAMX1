<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bajas', function (Blueprint $table) {

            $table->string('tipo')
                ->default('definitiva')
                ->after('volunteer_id');

            $table->date('fecha_inicio')
                ->nullable()
                ->after('motivo');

            $table->date('fecha_fin')
                ->nullable()
                ->after('fecha_inicio');
        });
    }

    public function down(): void
    {
        Schema::table('bajas', function (Blueprint $table) {
            $table->dropColumn(['tipo', 'fecha_inicio', 'fecha_fin']);
        });
    }
};

