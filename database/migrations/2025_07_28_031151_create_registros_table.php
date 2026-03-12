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
        Schema::create('registros', function (Blueprint $table) {
            $table->id();
        
        $table->string(    'nombre');
        $table->string(    'apellido_p');
        $table->string(    'apellido_m');
        $table->string('genero');
        $table->string('nac');
        $table->string('ine')->nullable();;
        $table->string('domicilio')->nullable();;
        $table->string('calle');
        $table->string('colonia');
        $table->string('municipio');
        $table->string('codigop');
        $table->string('certificadom')->nullable();;
        $table->string('acuerdo')->nullable();;
        $table->string('autorizacion')->nullable();;
        $table->string('reglamento')->nullable();;
        $table->string('contactoemergencia');
        $table->string('telefonoemergencia');
        $table->string('fechaingreso');
        $table->unsignedBigInteger('principal');
        $table->foreign('principal')->references('id')->on('areas');

        $table->unsignedBigInteger('alternativa_uno');
        $table->foreign('alternativa_uno')->references('id')->on('areas');

        $table->unsignedBigInteger('alternativa_dos');
        $table->foreign('alternativa_dos')->references('id')->on('areas');
        $table->string('especiales');
        $table->string('foto')->nullable();;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registros');
    }
};
