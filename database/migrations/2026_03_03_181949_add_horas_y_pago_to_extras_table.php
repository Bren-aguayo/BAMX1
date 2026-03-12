<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('extras', function (Blueprint $table) {
            $table->integer('horas_extra')->default(0)->after('motivo');
            $table->decimal('pago_extra', 8, 2)->default(0)->after('horas_extra');
        });
    }

    public function down(): void
    {
        Schema::table('extras', function (Blueprint $table) {
            $table->dropColumn(['horas_extra', 'pago_extra']);
        });
    }
};