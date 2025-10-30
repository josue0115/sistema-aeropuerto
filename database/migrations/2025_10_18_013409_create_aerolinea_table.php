<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::create('aerolinea', function (Blueprint $table) {
        $table->string('IdAerolinea', 20)->primary();
        $table->string('NombreAerolinea', 50);
        $table->string('Pais', 10)->nullable();
        $table->string('Ciudad', 10)->nullable();
        $table->string('Estado', 10)->nullable();
        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('aerolinea');
}

};
