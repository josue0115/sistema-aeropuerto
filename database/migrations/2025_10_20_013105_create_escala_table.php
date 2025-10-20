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
        Schema::create('escala', function (Blueprint $table) {
            $table->integer('IdEscala', true);
            $table->integer('IdVuelo');
            $table->integer('IdAeropuerto');
            $table->time('HoraSalida');
            $table->time('HoraLlegada');
            $table->integer('TiempoEspera')->default(0);
            $table->string('Estado', 50);
            $table->timestamps();

            // Llaves foráneas
            $table->foreign('IdVuelo')->references('IdVuelo')->on('vuelo')->onDelete('cascade');
            $table->foreign('IdAeropuerto')->references('IdAeropuerto')->on('aeropuerto')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('escala');
    }
};
