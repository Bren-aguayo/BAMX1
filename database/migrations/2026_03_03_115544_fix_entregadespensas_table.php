<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // 1️⃣ Renombrar tabla si estaba mal escrita
        if (Schema::hasTable('entrgadespensas')) {
            Schema::rename('entrgadespensas', 'entregadespensas');
        }

        // 2️⃣ Eliminar foreign key vieja directamente con SQL (si existe)
        try {
            DB::statement("
                ALTER TABLE entregadespensas 
                DROP FOREIGN KEY entregadespensas_id_registro_foreign
            ");
        } catch (\Exception $e) {
            // Si no existe, no hacer nada
        }

        Schema::table('entregadespensas', function (Blueprint $table) {

            // 🔴 Renombrar columna si aún existe
            if (Schema::hasColumn('entregadespensas', 'id_registro')) {
                $table->renameColumn('id_registro', 'volunteer_id');
            }

            // 🔴 Cambiar tipos
            $table->date('fecha')->change();
            $table->integer('cantidad')->change();

            // 🔴 Agregar hora si no existe
            if (!Schema::hasColumn('entregadespensas', 'hora')) {
                $table->time('hora')->nullable();
            }
        });

        // 3️⃣ Crear nueva foreign key correcta (si no existe)
        try {
            DB::statement("
                ALTER TABLE entregadespensas
                ADD CONSTRAINT entregadespensas_volunteer_id_foreign
                FOREIGN KEY (volunteer_id)
                REFERENCES volunteers(id)
                ON DELETE CASCADE
            ");
        } catch (\Exception $e) {
            // Si ya existe, no hacer nada
        }
    }

    public function down(): void
    {
        // No revertimos para evitar conflictos estructurales
    }
};