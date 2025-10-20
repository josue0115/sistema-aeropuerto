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
        Schema::create('pasajeros', function (Blueprint $table) {
            $table->id('idPasajero');
            $table->string('Nombre', 45)->nullable();
            $table->string('Apellido', 45)->nullable();
            $table->string('Pais', 45)->nullable();
            $table->string('TipoPasajero', 45)->nullable();
            $table->string('Estado', 45)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pasajeros');
    }
};
