<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('extras', function (Blueprint $table) {
            $table->string('estado_entrega')->default('pendiente')->after('pago_extra');
            $table->date('fecha_entrega')->nullable()->after('estado_entrega');
            $table->time('hora_entrega')->nullable()->after('fecha_entrega');
            $table->string('responsable_entrega')->nullable()->after('hora_entrega');
        });
    }

    public function down(): void
    {
        Schema::table('extras', function (Blueprint $table) {
            $table->dropColumn([
                'estado_entrega',
                'fecha_entrega',
                'hora_entrega',
                'responsable_entrega',
            ]);
        });
    }
};