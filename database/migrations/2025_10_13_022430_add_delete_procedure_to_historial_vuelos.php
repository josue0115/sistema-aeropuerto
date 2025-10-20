<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Procedimiento para eliminar historial de vuelo
        DB::unprepared('DROP PROCEDURE IF EXISTS Sp_Eliminar_HistorialVuelo');
        DB::unprepared('
            CREATE PROCEDURE Sp_Eliminar_HistorialVuelo(IN p_id_historial_vuelo INT)
            BEGIN
                DELETE FROM historial_vuelos WHERE id_historial_vuelo = p_id_historial_vuelo;
                SELECT ROW_COUNT() as affected_rows;
            END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS Sp_Eliminar_HistorialVuelo');
    }
};
