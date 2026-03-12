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
    Schema::table('bajas', function (Blueprint $table) {
        $table->renameColumn('id_registro', 'volunteer_id');
        $table->renameColumn('concepto', 'motivo');
    });
}

public function down(): void
{
    Schema::table('bajas', function (Blueprint $table) {
        $table->renameColumn('volunteer_id', 'id_registro');
        $table->renameColumn('motivo', 'concepto');
    });
}
};
