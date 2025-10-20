<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up()
{
    Schema::create('vuelo', function (Blueprint $table) {
        $table->id('IdVuelo'); // AUTO_INCREMENT PRIMARY KEY
        $table->string('IdAvion', 20);  // Llave foránea hacia Avion
        $table->string('AeropuertoOrigen', 45); 
        $table->string('AeropuertoDestino', 45);
        $table->date('FechaSalida');
        $table->date('FechaLlegada');
        $table->decimal('Precio', 10, 2);
        $table->string('Estado', 10);
        $table->timestamps();

        // Llaves foráneas
        $table->foreign('IdAvion')->references('IdAvion')->on('avion')->onDelete('cascade');
        $table->foreign('AeropuertoOrigen')->references('IdAeropuerto')->on('aeropuerto')->onDelete('cascade');
        $table->foreign('AeropuertoDestino')->references('IdAeropuerto')->on('aeropuerto')->onDelete('cascade');
    });
}

    public function down(): void
    {
        Schema::dropIfExists('vuelo');
    }
};
