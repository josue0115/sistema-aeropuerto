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
        Schema::table('equipajes', function (Blueprint $table) {
            $table->decimal('Peso', 5, 2)->nullable()->after('Dimensiones');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('equipajes', function (Blueprint $table) {
            $table->dropColumn('Peso');
        });
    }
};
