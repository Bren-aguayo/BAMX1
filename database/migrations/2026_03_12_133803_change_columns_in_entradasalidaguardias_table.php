<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement('ALTER TABLE entradasalidaguardias MODIFY hora_entrada TIME NULL');
        DB::statement('ALTER TABLE entradasalidaguardias MODIFY hora_salida TIME NULL');
        DB::statement('ALTER TABLE entradasalidaguardias MODIFY fecha DATE NOT NULL');
    }

    public function down(): void
    {
        DB::statement('ALTER TABLE entradasalidaguardias MODIFY hora_entrada VARCHAR(255) NULL');
        DB::statement('ALTER TABLE entradasalidaguardias MODIFY hora_salida VARCHAR(255) NULL');
        DB::statement('ALTER TABLE entradasalidaguardias MODIFY fecha VARCHAR(255) NOT NULL');
    }
};

