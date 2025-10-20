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
        // Procedimiento para consultar historial de vuelos
        DB::unprepared('DROP PROCEDURE IF EXISTS Sp_Consulta_HistorialVuelo');
        DB::unprepared('
            CREATE PROCEDURE Sp_Consulta_HistorialVuelo(IN p_id_historial_vuelo INT)
            BEGIN
                IF p_id_historial_vuelo IS NULL THEN
                    SELECT * FROM historial_vuelos ORDER BY Fecha DESC;
                ELSE
                    SELECT * FROM historial_vuelos WHERE id_historial_vuelo = p_id_historial_vuelo;
                END IF;
            END
        ');

        // Procedimiento para insertar historial de vuelo
        DB::unprepared('DROP PROCEDURE IF EXISTS Sp_Insertar_HistorialVuelo');
        DB::unprepared('
            CREATE PROCEDURE Sp_Insertar_HistorialVuelo(
                IN p_idhistorial INT,
                IN p_idvuelo INT,
                IN p_idPasajero INT,
                IN p_Fecha DATE,
                IN p_Detalle TEXT
            )
            BEGIN
                INSERT INTO historial_vuelos (idhistorial, idvuelo, idPasajero, Fecha, Detalle)
                VALUES (p_idhistorial, p_idvuelo, p_idPasajero, p_Fecha, p_Detalle);
                SELECT LAST_INSERT_ID() as id_historial_vuelo;
            END
        ');

        // Procedimiento para actualizar historial de vuelo
        DB::unprepared('DROP PROCEDURE IF EXISTS Sp_Actualizar_HistorialVuelo');
        DB::unprepared('
            CREATE PROCEDURE Sp_Actualizar_HistorialVuelo(
                IN p_id_historial_vuelo INT,
                IN p_idhistorial INT,
                IN p_idvuelo INT,
                IN p_idPasajero INT,
                IN p_Fecha DATE,
                IN p_Detalle TEXT
            )
            BEGIN
                UPDATE historial_vuelos
                SET idhistorial = p_idhistorial,
                    idvuelo = p_idvuelo,
                    idPasajero = p_idPasajero,
                    Fecha = p_Fecha,
                    Detalle = p_Detalle
                WHERE id_historial_vuelo = p_id_historial_vuelo;
                SELECT ROW_COUNT() as affected_rows;
            END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS Sp_Consulta_HistorialVuelo');
        DB::unprepared('DROP PROCEDURE IF EXISTS Sp_Insertar_HistorialVuelo');
        DB::unprepared('DROP PROCEDURE IF EXISTS Sp_Actualizar_HistorialVuelo');
    }
};
