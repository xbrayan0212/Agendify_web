<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistorialTable extends Migration
{
    public function up()
    {
        Schema::create('historial', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_consulta');
            $table->text('observaciones')->nullable();
            $table->foreignId('id_cita')->constrained('citas')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('historial');
    }
}

