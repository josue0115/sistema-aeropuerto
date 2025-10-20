<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
     public function up(): void
    {
        Schema::create('avion', function (Blueprint $table) {
            $table->string('IdAvion', 20)->primary();
            $table->string('IdAerolinea', 20);
            $table->string('Placa', 15)->unique();
            $table->string('Tipo', 50);
            $table->string('Modelo', 50);
            $table->integer('Capacidad');
            $table->string('Estado', 50)->default('Activo');
            $table->timestamps();

            $table->foreign('IdAerolinea')->references('IdAerolinea')->on('Aerolinea')
                  ->onUpdate('cascade')->onDelete('restrict');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('avion');
    }
};
