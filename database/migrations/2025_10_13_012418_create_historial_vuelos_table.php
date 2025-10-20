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
        Schema::create('historial_vuelos', function (Blueprint $table) {
            $table->id('id_historial_vuelo');
            $table->unsignedBigInteger('idhistorial');
            $table->unsignedBigInteger('idvuelo');
            $table->unsignedBigInteger('idPasajero');
            $table->date('Fecha');
            $table->text('Detalle');
            // No timestamps as per model
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historial_vuelos');
    }
};
