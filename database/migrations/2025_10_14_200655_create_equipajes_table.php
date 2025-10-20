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
        Schema::create('equipajes', function (Blueprint $table) {
            $table->unsignedInteger('idEquipaje')->primary();
            $table->unsignedInteger('idBoleto')->nullable();
            $table->decimal('Costo', 10, 2)->nullable();
            $table->string('Dimensiones', 45)->nullable();
            $table->decimal('Monto', 10, 2)->nullable();
            $table->decimal('CostoExtra', 10, 2)->nullable();
            $table->string('Estado', 10)->nullable();
            $table->timestamps();

            $table->index('idBoleto');
            $table->foreign('idBoleto')->references('idBoleto')->on('boletos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipajes');
    }
};
