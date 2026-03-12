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
        Schema::create('volunteers', function (Blueprint $table) {
            $table->id();

            $table->string('nombre_completo')->nullable();
            $table->string('genero')->nullable();
            $table->string('area')->nullable();
            $table->date('fecha_nacimiento')->nullable();

            $table->string('documento_identidad')->nullable();
            $table->string('comprobante_domicilio')->nullable();

            $table->string('calle')->nullable();
            $table->string('colonia')->nullable();
            $table->string('municipio')->nullable();
            $table->string('cp')->nullable();

            $table->string('certificado_medico')->nullable();
            $table->string('acuerdo')->nullable();
            $table->string('aut_exclusion_responsabilidad')->nullable();
            $table->string('reglamento_voluntarios')->nullable();

            $table->string('nombre_contacto')->nullable();
            $table->string('tel_emergencias')->nullable();
            $table->date('fecha_ingreso')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('volunteers');
    }
};
