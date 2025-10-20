<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('personal', function (Blueprint $table) {
            $table->id('IdPersonal');
            $table->string('Nombre', 45);
            $table->string('Apellido', 15);
            $table->string('Cargo', 20);
            $table->date('FechaIngreso');
            $table->decimal('Salario', 10, 2);
            $table->string('Estado', 50);
            $table->integer('Telefono');
            $table->string('Correo', 45);
            $table->string('Direccion', 45);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('personal');
    }
};
