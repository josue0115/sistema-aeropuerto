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
        Schema::create('boletos', function (Blueprint $table) {
            $table->unsignedInteger('idBoleto')->primary();
            $table->unsignedInteger('idVuelo')->nullable();
            $table->unsignedInteger('idPasajero')->nullable();
            $table->dateTime('FechaCompra')->nullable();
            $table->decimal('Precio', 10, 2)->nullable();
            $table->decimal('Cantidad', 10, 2)->nullable();
            $table->decimal('Descuento', 10, 2)->nullable();
            $table->decimal('Impuesto', 10, 2)->nullable();
            $table->decimal('Total', 10, 2)->nullable();
            $table->timestamps();

            $table->index(['idVuelo'], 'idVuelo_boleto_idx');
            $table->index(['idPasajero'], 'idPasajero_boleto_idx');
            // Note: Foreign key constraints to Vuelo and Pasajero tables would be added if those tables exist
            // $table->foreign('idVuelo')->references('idVuelo')->on('vuelos')->onDelete('cascade');
            // $table->foreign('idPasajero')->references('idPasajero')->on('pasajeros')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('boletos');
    }
};
