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
        // Procedimiento para consultar servicios
        DB::unprepared('DROP PROCEDURE IF EXISTS Sp_Consulta_Servicio');
        DB::unprepared('
            CREATE PROCEDURE Sp_Consulta_Servicio(IN p_idServicio INT)
            BEGIN
                IF p_idServicio IS NULL THEN
                    SELECT * FROM servicios ORDER BY Fecha DESC;
                ELSE
                    SELECT * FROM servicios WHERE idServicio = p_idServicio;
                END IF;
            END
        ');

        // Procedimiento para insertar servicio
        DB::unprepared('DROP PROCEDURE IF EXISTS Sp_Insertar_Servicio');
        DB::unprepared('
            CREATE PROCEDURE Sp_Insertar_Servicio(
                IN p_idServicio INT,
                IN p_idBoleto INT,
                IN p_Fecha DATETIME,
                IN p_TipoServicio VARCHAR(10),
                IN p_Costo DECIMAL,
                IN p_Cantidad DECIMAL,
                IN p_CostoTotal DECIMAL,
                IN p_Estado VARCHAR(10)
            )
            BEGIN
                INSERT INTO servicios (idServicio, idBoleto, Fecha, TipoServicio, Costo, Cantidad, CostoTotal, Estado)
                VALUES (p_idServicio, p_idBoleto, p_Fecha, p_TipoServicio, p_Costo, p_Cantidad, p_CostoTotal, p_Estado);
                SELECT ROW_COUNT() as affected_rows;
            END
        ');

        // Procedimiento para actualizar servicio
        DB::unprepared('DROP PROCEDURE IF EXISTS Sp_Actualizar_Servicio');
        DB::unprepared('
            CREATE PROCEDURE Sp_Actualizar_Servicio(
                IN p_idServicio INT,
                IN p_idBoleto INT,
                IN p_Fecha DATETIME,
                IN p_TipoServicio VARCHAR(10),
                IN p_Costo DECIMAL,
                IN p_Cantidad DECIMAL,
                IN p_CostoTotal DECIMAL,
                IN p_Estado VARCHAR(10)
            )
            BEGIN
                UPDATE servicios
                SET idBoleto = p_idBoleto,
                    Fecha = p_Fecha,
                    TipoServicio = p_TipoServicio,
                    Costo = p_Costo,
                    Cantidad = p_Cantidad,
                    CostoTotal = p_CostoTotal,
                    Estado = p_Estado
                WHERE idServicio = p_idServicio;
                SELECT ROW_COUNT() as affected_rows;
            END
        ');

        // Procedimiento para eliminar servicio
        DB::unprepared('DROP PROCEDURE IF EXISTS Sp_Eliminar_Servicio');
        DB::unprepared('
            CREATE PROCEDURE Sp_Eliminar_Servicio(IN p_idServicio INT)
            BEGIN
                DELETE FROM servicios WHERE idServicio = p_idServicio;
                SELECT ROW_COUNT() as affected_rows;
            END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS Sp_Consulta_Servicio');
        DB::unprepared('DROP PROCEDURE IF EXISTS Sp_Insertar_Servicio');
        DB::unprepared('DROP PROCEDURE IF EXISTS Sp_Actualizar_Servicio');
        DB::unprepared('DROP PROCEDURE IF EXISTS Sp_Eliminar_Servicio');
    }
};
