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
        Schema::create('carrito_tools', function (Blueprint $table) {
            $table->id();
            
            // Agregar el campo 'cod_herramienta' como una columna string para coincidir con herramientas
            $table->string('cod_herramienta');
            $table->foreign('cod_herramienta')->references('cod_herramienta')->on('herramientas')->onDelete('cascade');
            
            $table->integer('user_identity');
            $table->foreign('user_identity')->references('user_identity')->on('users')->onDelete('cascade');
            
            $table->integer('cantidad')->default(1);
            $table->timestamps();
        });
    }
   
    public function down()
    {
        Schema::dropIfExists('carritoTools');
    }
};
