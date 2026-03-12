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

        // 🔥 Eliminar foreign key vieja (la que apunta a registros)
        $table->dropForeign('bajas_id_registro_foreign');

        // 🔥 Crear foreign key correcta hacia volunteers
        $table->foreign('volunteer_id')
              ->references('id')
              ->on('volunteers')
              ->onDelete('cascade');
    });
}

public function down(): void
{
    Schema::table('bajas', function (Blueprint $table) {

        $table->dropForeign(['volunteer_id']);

        $table->foreign('volunteer_id')
              ->references('id')
              ->on('registros');
    });
}
};
