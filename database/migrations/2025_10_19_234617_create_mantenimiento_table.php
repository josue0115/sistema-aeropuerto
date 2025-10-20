<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::create('mantenimiento', function (Blueprint $table) {
        $table->integer('Id_mantenimiento', true);
        $table->string('IdAvion', 20);
        $table->integer('IdPersonal');
        $table->date('FechaIngreso');
        $table->date('FechaSalida');
        $table->string('Tipo', 20);
        $table->string('Estado', 10);
        $table->string('Descripcion', 45);
        $table->decimal('Costo', 10, 2);
        $table->decimal('CostoExtra', 10, 2)->default(0.00);
        $table->timestamps();

        // Llaves foráneas
        $table->foreign('IdAvion')->references('IdAvion')->on('avion')->onDelete('cascade');
        $table->foreign('IdPersonal')->references('IdPersonal')->on('personal')->onDelete('cascade');
    });
}

    public function down(): void
    {
        Schema::dropIfExists('mantenimiento');
    }
};
