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
        Schema::table('servicios', function (Blueprint $table) {
            $table->unsignedBigInteger('idTipoServicio')->nullable()->after('idBoleto');
            $table->foreign('idTipoServicio')->references('idTipoServicio')->on('tipo_servicio')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('servicios', function (Blueprint $table) {
            $table->dropForeign(['idTipoServicio']);
            $table->dropColumn('idTipoServicio');
        });
    }
};
