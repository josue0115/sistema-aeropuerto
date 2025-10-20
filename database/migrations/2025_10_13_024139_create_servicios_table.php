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
        Schema::create('servicios', function (Blueprint $table) {
            $table->unsignedInteger('idServicio')->primary();
            $table->unsignedInteger('idBoleto')->nullable();
            $table->dateTime('Fecha')->nullable();
            $table->string('TipoServicio', 10)->nullable();
            $table->decimal('Costo')->nullable();
            $table->decimal('Cantidad')->nullable();
            $table->decimal('CostoTotal')->nullable();
            $table->string('Estado', 10)->nullable();
            $table->timestamps();

            $table->index(['idBoleto'], 'idBoleto_idx');
            // Note: Foreign key constraint to Boleto table would be added if Boleto table exists
            // $table->foreign('idBoleto')->references('idBoleto')->on('boletos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('servicios');
    }
};
