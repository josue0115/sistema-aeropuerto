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
    Schema::create('aeropuerto', function (Blueprint $table) {
        $table->string('IdAeropuerto', 20)->primary(); // Clave primaria
        $table->string('NombreAeropuerto', 50);
        $table->string('Pais', 10)->nullable();
        $table->string('Ciudad', 50)->nullable();
        $table->string('Estado', 10)->nullable();
        $table->timestamps(); // created_at y updated_at
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aeropuerto');
    }
};
