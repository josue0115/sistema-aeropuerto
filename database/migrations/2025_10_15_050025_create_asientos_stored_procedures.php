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
        DB::unprepared('
            DROP PROCEDURE IF EXISTS Sp_Consulta_Asiento;
            CREATE PROCEDURE Sp_Consulta_Asiento(IN p_idAsiento INT)
            BEGIN
                IF p_idAsiento IS NULL THEN
                    SELECT a.*, v.idVuelo as vuelo_id, CONCAT(\'Vuelo \', v.idVuelo, \' - \', ao.Nombre, \' a \', ad.Nombre) as vuelo_info
                    FROM asientos a
                    LEFT JOIN vuelos v ON a.idVuelo = v.idVuelo
                    LEFT JOIN aeropuertos ao ON v.idAeropuertoOrigen = ao.idAeropuerto
                    LEFT JOIN aeropuertos ad ON v.idAeropuertoDestino = ad.idAeropuerto;
                ELSE
                    SELECT a.*, v.idVuelo as vuelo_id, CONCAT(\'Vuelo \', v.idVuelo, \' - \', ao.Nombre, \' a \', ad.Nombre) as vuelo_info
                    FROM asientos a
                    LEFT JOIN vuelos v ON a.idVuelo = v.idVuelo
                    LEFT JOIN aeropuertos ao ON v.idAeropuertoOrigen = ao.idAeropuerto
                    LEFT JOIN aeropuertos ad ON v.idAeropuertoDestino = ad.idAeropuerto
                    WHERE a.idAsiento = p_idAsiento;
                END IF;
            END;

            DROP PROCEDURE IF EXISTS Sp_Insertar_Asiento;
            CREATE PROCEDURE Sp_Insertar_Asiento(
                IN p_idVuelo INT,
                IN p_NumeroAsiento VARCHAR(10),
                IN p_Clase VARCHAR(45),
                IN p_Estado VARCHAR(45)
            )
            BEGIN
                INSERT INTO asientos (idVuelo, NumeroAsiento, Clase, Estado)
                VALUES (p_idVuelo, p_NumeroAsiento, p_Clase, p_Estado);
                SELECT ROW_COUNT() as affected_rows;
            END;

            DROP PROCEDURE IF EXISTS Sp_Actualizar_Asiento;
            CREATE PROCEDURE Sp_Actualizar_Asiento(
                IN p_idAsiento INT,
                IN p_idVuelo INT,
                IN p_NumeroAsiento VARCHAR(10),
                IN p_Clase VARCHAR(45),
                IN p_Estado VARCHAR(45)
            )
            BEGIN
                UPDATE asientos
                SET idVuelo = p_idVuelo,
                    NumeroAsiento = p_NumeroAsiento,
                    Clase = p_Clase,
                    Estado = p_Estado
                WHERE idAsiento = p_idAsiento;
                SELECT ROW_COUNT() as affected_rows;
            END;

            DROP PROCEDURE IF EXISTS Sp_Eliminar_Asiento;
            CREATE PROCEDURE Sp_Eliminar_Asiento(IN p_idAsiento INT)
            BEGIN
                DELETE FROM asientos WHERE idAsiento = p_idAsiento;
                SELECT ROW_COUNT() as affected_rows;
            END;
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No need to drop procedures as they are dropped in up() if they exist
    }
};
