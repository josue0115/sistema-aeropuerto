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
        DB::unprepared('
            DROP PROCEDURE IF EXISTS Sp_Consulta_Pasajero;
            CREATE PROCEDURE Sp_Consulta_Pasajero(IN p_idPasajero INT)
            BEGIN
                IF p_idPasajero IS NULL THEN
                    SELECT * FROM pasajeros;
                ELSE
                    SELECT * FROM pasajeros WHERE idPasajero = p_idPasajero;
                END IF;
            END;

            DROP PROCEDURE IF EXISTS Sp_Insertar_Pasajero;
            CREATE PROCEDURE Sp_Insertar_Pasajero(
                IN p_idPasajero INT,
                IN p_Nombre VARCHAR(45),
                IN p_Apellido VARCHAR(45),
                IN p_Pais VARCHAR(45),
                IN p_TipoPasajero VARCHAR(45),
                IN p_Estado VARCHAR(45)
            )
            BEGIN
                IF p_idPasajero IS NULL THEN
                    INSERT INTO pasajeros (Nombre, Apellido, Pais, TipoPasajero, Estado)
                    VALUES (p_Nombre, p_Apellido, p_Pais, p_TipoPasajero, p_Estado);
                ELSE
                    INSERT INTO pasajeros (idPasajero, Nombre, Apellido, Pais, TipoPasajero, Estado)
                    VALUES (p_idPasajero, p_Nombre, p_Apellido, p_Pais, p_TipoPasajero, p_Estado);
                END IF;
                SELECT ROW_COUNT() as affected_rows;
            END;

            DROP PROCEDURE IF EXISTS Sp_Actualizar_Pasajero;
            CREATE PROCEDURE Sp_Actualizar_Pasajero(
                IN p_idPasajero INT,
                IN p_Nombre VARCHAR(45),
                IN p_Apellido VARCHAR(45),
                IN p_Pais VARCHAR(45),
                IN p_TipoPasajero VARCHAR(45),
                IN p_Estado VARCHAR(45)
            )
            BEGIN
                UPDATE pasajeros
                SET Nombre = p_Nombre,
                    Apellido = p_Apellido,
                    Pais = p_Pais,
                    TipoPasajero = p_TipoPasajero,
                    Estado = p_Estado
                WHERE idPasajero = p_idPasajero;
                SELECT ROW_COUNT() as affected_rows;
            END;

            DROP PROCEDURE IF EXISTS Sp_Eliminar_Pasajero;
            CREATE PROCEDURE Sp_Eliminar_Pasajero(IN p_idPasajero INT)
            BEGIN
                DELETE FROM pasajeros WHERE idPasajero = p_idPasajero;
                SELECT ROW_COUNT() as affected_rows;
            END;
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pasajeros_stored_procedures');
    }
};
