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
        Schema::create('detalle_solicitudes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('solicitud_id')->constrained('solicitudes')->onDelete('cascade');
            $table->string('cod_herramienta');
            $table->foreign('cod_herramienta')->references('cod_herramienta')->on('herramientas')->onDelete('cascade');
            $table->integer('cantidad');
            $table->string('estado');
            $table->enum('proceso', ['pendiente', 'aceptada', 'entregada', 'recibida'])->default('pendiente');
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
        Schema::dropIfExists('detalle_solicitudes');
    }
};
