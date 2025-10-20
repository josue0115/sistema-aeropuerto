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
        Schema::create('reservas', function (Blueprint $table) {
            $table->unsignedInteger('idReserva')->primary();
            $table->unsignedInteger('idPasajero')->nullable();
            $table->unsignedInteger('idVuelo')->nullable();
            $table->dateTime('FechaReserva')->nullable();
            $table->dateTime('FechaVuelo')->nullable();
            $table->decimal('MontoAnticipado')->nullable();
            $table->string('Estado', 10)->nullable();
            $table->timestamps();

            $table->index(['idPasajero'], 'idPasajero_idx');
            $table->index(['idVuelo'], 'idVuelo_idx');

            // Foreign keys (assuming pasajero and vuelo tables exist)
            $table->foreign('idPasajero')->references('idPasajero')->on('pasajeros')->onDelete('cascade');
            $table->foreign('idVuelo')->references('idVuelo')->on('vuelos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservas');
    }
};
