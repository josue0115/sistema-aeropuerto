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
        Schema::table('reservas', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable()->after('Estado');
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::table('boletos', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable()->after('Total');
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::table('facturas', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable()->after('Estado');
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::table('pagos', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable()->after('Referencia');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pagos', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });

        Schema::table('facturas', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });

        Schema::table('boletos', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });

        Schema::table('reservas', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
};
