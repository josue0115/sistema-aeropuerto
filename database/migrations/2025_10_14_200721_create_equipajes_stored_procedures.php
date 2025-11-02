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
        // Procedimiento para consultar equipajes
        DB::unprepared('DROP PROCEDURE IF EXISTS Sp_Consulta_Equipaje');
        DB::unprepared('
            CREATE PROCEDURE Sp_Consulta_Equipaje(IN p_idEquipaje INT)
            BEGIN
                IF p_idEquipaje IS NULL THEN
                    SELECT * FROM equipajes ORDER BY idEquipaje DESC;
                ELSE
                    SELECT * FROM equipajes WHERE idEquipaje = p_idEquipaje;
                END IF;
            END
        ');

        // Procedimiento para insertar equipaje
        DB::unprepared('DROP PROCEDURE IF EXISTS Sp_Insertar_Equipaje');
        DB::unprepared('
            CREATE PROCEDURE Sp_Insertar_Equipaje(
                IN p_idEquipaje INT,
                IN p_idBoleto INT,
                IN p_Costo DECIMAL(10,2),
                IN p_Dimensiones VARCHAR(45),
                IN p_Peso DECIMAL(5,2),
                IN p_Monto DECIMAL(10,2),
                IN p_CostoExtra DECIMAL(10,2),
                IN p_Estado VARCHAR(10)
            )
            BEGIN
                INSERT INTO equipajes (idEquipaje, idBoleto, Costo, Dimensiones, Peso, Monto, CostoExtra, Estado)
                VALUES (p_idEquipaje, p_idBoleto, p_Costo, p_Dimensiones, p_Peso, p_Monto, p_CostoExtra, p_Estado);
                SELECT ROW_COUNT() as affected_rows;
            END
        ');

        // Procedimiento para actualizar equipaje
        DB::unprepared('DROP PROCEDURE IF EXISTS Sp_Actualizar_Equipaje');
        DB::unprepared('
            CREATE PROCEDURE Sp_Actualizar_Equipaje(
                IN p_idEquipaje INT,
                IN p_idBoleto INT,
                IN p_Costo DECIMAL(10,2),
                IN p_Dimensiones VARCHAR(45),
                IN p_Peso DECIMAL(5,2),
                IN p_Monto DECIMAL(10,2),
                IN p_CostoExtra DECIMAL(10,2),
                IN p_Estado VARCHAR(10)
            )
            BEGIN
                UPDATE equipajes
                SET idBoleto = p_idBoleto,
                    Costo = p_Costo,
                    Dimensiones = p_Dimensiones,
                    Peso = p_Peso,
                    Monto = p_Monto,
                    CostoExtra = p_CostoExtra,
                    Estado = p_Estado
                WHERE idEquipaje = p_idEquipaje;
                SELECT ROW_COUNT() as affected_rows;
            END
        ');

        // Procedimiento para eliminar equipaje
        DB::unprepared('DROP PROCEDURE IF EXISTS Sp_Eliminar_Equipaje');
        DB::unprepared('
            CREATE PROCEDURE Sp_Eliminar_Equipaje(IN p_idEquipaje INT)
            BEGIN
                DELETE FROM equipajes WHERE idEquipaje = p_idEquipaje;
                SELECT ROW_COUNT() as affected_rows;
            END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS Sp_Consulta_Equipaje');
        DB::unprepared('DROP PROCEDURE IF EXISTS Sp_Insertar_Equipaje');
        DB::unprepared('DROP PROCEDURE IF EXISTS Sp_Actualizar_Equipaje');
        DB::unprepared('DROP PROCEDURE IF EXISTS Sp_Eliminar_Equipaje');
    }
};
