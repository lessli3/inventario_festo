<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolicitudesTable extends Migration
{
    public function up()
    //Tabla de solicitudes
    {
        Schema::create('solicitudes', function (Blueprint $table) {
            //Campos de la tabla
            $table->id();
            $table->bigInteger('user_identity')->unsigned(); 
            $table->foreign('user_identity')->references('user_identity')->on('users')->onDelete('cascade');
            $table->string('nombre');
            $table->string('telefono');
            $table->string('email');
            $table->date('fecha');
            $table->time('hora');
            $table->datetime('hora_salida')->nullable();
            $table->datetime('hora_entrega')->nullable();            
            $table->enum('estado', ['pendiente', 'aceptada', 'entregada', 'finalizada'])->default('pendiente');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('solicitudes');
    }
}
