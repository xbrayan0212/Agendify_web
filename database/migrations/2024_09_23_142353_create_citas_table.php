<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCitasTable extends Migration
{
    public function up()
    {
        Schema::create('citas', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->time('hora');
            $table->string('motivo');
            $table->string('estado');
            $table->foreignId('id_profesional')->constrained('users')->onDelete('cascade');
            $table->foreignId('id_cliente')->constrained('clientes')->onDelete('cascade');
            $table->foreignId('id_servicio')->constrained('servicios')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('citas');
    }
}
