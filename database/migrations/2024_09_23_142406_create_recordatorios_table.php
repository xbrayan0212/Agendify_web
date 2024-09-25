<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecordatoriosTable extends Migration
{
    public function up()
    {
        Schema::create('recordatorios', function (Blueprint $table) {
            $table->id();
            $table->timestamp('fecha_envio');
            $table->string('tipo')->nullable();
            $table->string('estado')->nullable();
            $table->foreignId('id_cita')->constrained('citas')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('recordatorios');
    }
}
