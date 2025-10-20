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
        Schema::create('horario', function (Blueprint $table) {
            $table->integer('IdHorario', true); // AUTO_INCREMENT PRIMARY KEY
            $table->unsignedBigInteger('IdVuelo'); // Llave foránea hacia Vuelo
            $table->time('HoraSalida');
            $table->time('HoraLlegada');
            $table->string('Estado', 10);
            $table->timestamps();

            // Llaves foráneas
            $table->foreign('IdVuelo')->references('IdVuelo')->on('vuelo')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('horario');
    }
};
