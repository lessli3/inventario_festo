<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolicitudesTable extends Migration
{
    public function up()
    {
        Schema::create('solicitudes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_identity')->unsigned(); // Se debe marcar como unsigned
            $table->foreign('user_identity')->references('user_identity')->on('users')->onDelete('cascade');
            $table->string('nombre');
            $table->string('telefono');
            $table->string('email');
            $table->date('fecha');
            $table->time('hora');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('solicitudes');
    }
}
