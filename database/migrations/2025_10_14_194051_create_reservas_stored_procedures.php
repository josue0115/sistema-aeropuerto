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
        // Procedimiento para consultar reservas
        DB::unprepared('DROP PROCEDURE IF EXISTS Sp_Consulta_Reserva');
        DB::unprepared('
            CREATE PROCEDURE Sp_Consulta_Reserva(IN p_idReserva INT)
            BEGIN
                IF p_idReserva IS NULL THEN
                    SELECT * FROM reservas ORDER BY FechaReserva DESC;
                ELSE
                    SELECT * FROM reservas WHERE idReserva = p_idReserva;
                END IF;
            END
        ');

        // Procedimiento para insertar reserva
        DB::unprepared('DROP PROCEDURE IF EXISTS Sp_Insertar_Reserva');
        DB::unprepared('
            CREATE PROCEDURE Sp_Insertar_Reserva(
                IN p_idReserva INT,
                IN p_idPasajero INT,
                IN p_idVuelo INT,
                IN p_FechaReserva DATETIME,
                IN p_FechaVuelo DATETIME,
                IN p_MontoAnticipado DECIMAL,
                IN p_Estado VARCHAR(10)
            )
            BEGIN
                INSERT INTO reservas (idReserva, idPasajero, idVuelo, FechaReserva, FechaVuelo, MontoAnticipado, Estado)
                VALUES (p_idReserva, p_idPasajero, p_idVuelo, p_FechaReserva, p_FechaVuelo, p_MontoAnticipado, p_Estado);
                SELECT ROW_COUNT() as affected_rows;
            END
        ');

        // Procedimiento para actualizar reserva
        DB::unprepared('DROP PROCEDURE IF EXISTS Sp_Actualizar_Reserva');
        DB::unprepared('
            CREATE PROCEDURE Sp_Actualizar_Reserva(
                IN p_idReserva INT,
                IN p_idPasajero INT,
                IN p_idVuelo INT,
                IN p_FechaReserva DATETIME,
                IN p_FechaVuelo DATETIME,
                IN p_MontoAnticipado DECIMAL,
                IN p_Estado VARCHAR(10)
            )
            BEGIN
                UPDATE reservas
                SET idPasajero = p_idPasajero,
                    idVuelo = p_idVuelo,
                    FechaReserva = p_FechaReserva,
                    FechaVuelo = p_FechaVuelo,
                    MontoAnticipado = p_MontoAnticipado,
                    Estado = p_Estado
                WHERE idReserva = p_idReserva;
                SELECT ROW_COUNT() as affected_rows;
            END
        ');

        // Procedimiento para eliminar reserva
        DB::unprepared('DROP PROCEDURE IF EXISTS Sp_Eliminar_Reserva');
        DB::unprepared('
            CREATE PROCEDURE Sp_Eliminar_Reserva(IN p_idReserva INT)
            BEGIN
                DELETE FROM reservas WHERE idReserva = p_idReserva;
                SELECT ROW_COUNT() as affected_rows;
            END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS Sp_Consulta_Reserva');
        DB::unprepared('DROP PROCEDURE IF EXISTS Sp_Insertar_Reserva');
        DB::unprepared('DROP PROCEDURE IF EXISTS Sp_Actualizar_Reserva');
        DB::unprepared('DROP PROCEDURE IF EXISTS Sp_Eliminar_Reserva');
    }
};
