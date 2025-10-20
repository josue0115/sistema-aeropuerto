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
        Schema::create('asientos', function (Blueprint $table) {
            $table->increments('idAsiento');
            $table->integer('idVuelo')->nullable();
            $table->string('NumeroAsiento', 10);
            $table->string('Clase', 45)->nullable();
            $table->string('Estado', 45)->nullable();
            $table->timestamps();

            $table->index(['idVuelo'], 'idVuelo_idx');
            $table->foreign('idVuelo')->references('idVuelo')->on('vuelos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asientos');
    }
};
