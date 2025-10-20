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
        // Procedimiento para consultar tipos de servicio
        DB::unprepared('DROP PROCEDURE IF EXISTS Sp_Consulta_TipoServicio');
        DB::unprepared('
            CREATE PROCEDURE Sp_Consulta_TipoServicio(IN p_idTipoServicio INT)
            BEGIN
                IF p_idTipoServicio IS NULL THEN
                    SELECT * FROM tipo_servicio ORDER BY Nombre ASC;
                ELSE
                    SELECT * FROM tipo_servicio WHERE idTipoServicio = p_idTipoServicio;
                END IF;
            END
        ');

        // Procedimiento para insertar tipo de servicio
        DB::unprepared('DROP PROCEDURE IF EXISTS Sp_Insertar_TipoServicio');
        DB::unprepared('
            CREATE PROCEDURE Sp_Insertar_TipoServicio(
                IN p_Nombre VARCHAR(50),
                IN p_Costo DECIMAL(10,2),
                IN p_Descripcion TEXT
            )
            BEGIN
                INSERT INTO tipo_servicio (Nombre, Costo, Descripcion)
                VALUES (p_Nombre, p_Costo, p_Descripcion);
                SELECT ROW_COUNT() as affected_rows;
            END
        ');

        // Procedimiento para actualizar tipo de servicio
        DB::unprepared('DROP PROCEDURE IF EXISTS Sp_Actualizar_TipoServicio');
        DB::unprepared('
            CREATE PROCEDURE Sp_Actualizar_TipoServicio(
                IN p_idTipoServicio INT,
                IN p_Nombre VARCHAR(50),
                IN p_Costo DECIMAL(10,2),
                IN p_Descripcion TEXT
            )
            BEGIN
                UPDATE tipo_servicio
                SET Nombre = p_Nombre,
                    Costo = p_Costo,
                    Descripcion = p_Descripcion
                WHERE idTipoServicio = p_idTipoServicio;
                SELECT ROW_COUNT() as affected_rows;
            END
        ');

        // Procedimiento para eliminar tipo de servicio
        DB::unprepared('DROP PROCEDURE IF EXISTS Sp_Eliminar_TipoServicio');
        DB::unprepared('
            CREATE PROCEDURE Sp_Eliminar_TipoServicio(IN p_idTipoServicio INT)
            BEGIN
                DELETE FROM tipo_servicio WHERE idTipoServicio = p_idTipoServicio;
                SELECT ROW_COUNT() as affected_rows;
            END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS Sp_Consulta_TipoServicio');
        DB::unprepared('DROP PROCEDURE IF EXISTS Sp_Insertar_TipoServicio');
        DB::unprepared('DROP PROCEDURE IF EXISTS Sp_Actualizar_TipoServicio');
        DB::unprepared('DROP PROCEDURE IF EXISTS Sp_Eliminar_TipoServicio');
    }
};
