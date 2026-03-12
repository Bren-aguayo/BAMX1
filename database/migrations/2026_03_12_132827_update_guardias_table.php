<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('guardias', function (Blueprint $table) {

            // agregar nueva columna
            $table->unsignedBigInteger('area_id')->nullable()->after('apellido');

            // relación con tabla areas
            $table->foreign('area_id')->references('id')->on('areas')->onDelete('cascade');

        });
    }

    public function down(): void
    {
        Schema::table('guardias', function (Blueprint $table) {

            $table->dropForeign(['area_id']);
            $table->dropColumn('area_id');

        });
    }
};