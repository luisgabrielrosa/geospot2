<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catastros', function (Blueprint $table) {
            $table->id();
            $table->string('fid', 100)->nullable();
            $table->text('geo_shape')->nullable();
            $table->string('call_numero', 100)->nullable();
            $table->string('codigo_postal', 100)->nullable();
            $table->string('colonia_predio', 100)->nullable();
            $table->string('superficie_terreno', 100)->nullable();
            $table->string('superficie_construccion', 100)->nullable();
            $table->string('uso_construccion', 100)->nullable();
            $table->string('clave_rango_nivel', 100)->nullable();
            $table->string('anio_construccion', 100)->nullable();
            $table->string('instalaciones_especiales', 100)->nullable();
            $table->string('valor_unitario_suelo', 100)->nullable();
            $table->string('valor_suelo', 100)->nullable();
            $table->string('clave_valor_unitario_suelo', 100)->nullable();
            $table->string('colonia_cumpliemiento', 100)->nullable();
            $table->string('alcaldia_cumplimiento', 100)->nullable();
            $table->string('subsidio', 100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('catastros');
    }
};
