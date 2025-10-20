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
        // Procedimiento para consultar facturas
        DB::unprepared('DROP PROCEDURE IF EXISTS Sp_Consulta_Factura');
        DB::unprepared('
            CREATE PROCEDURE Sp_Consulta_Factura(IN p_idFactura INT)
            BEGIN
                IF p_idFactura IS NULL THEN
                    SELECT * FROM facturas ORDER BY FechaEmision DESC;
                ELSE
                    SELECT * FROM facturas WHERE idFactura = p_idFactura;
                END IF;
            END
        ');

        // Procedimiento para insertar factura
        DB::unprepared('DROP PROCEDURE IF EXISTS Sp_Insertar_Factura');
        DB::unprepared('
            CREATE PROCEDURE Sp_Insertar_Factura(
                IN p_idFactura INT,
                IN p_idBoleto INT,
                IN p_FechaEmision DATETIME,
                IN p_monto DECIMAL,
                IN p_impuesto DECIMAL,
                IN p_MontoTotal DECIMAL,
                IN p_Estado VARCHAR(10)
            )
            BEGIN
                INSERT INTO facturas (idFactura, idBoleto, FechaEmision, monto, impuesto, MontoTotal, Estado)
                VALUES (p_idFactura, p_idBoleto, p_FechaEmision, p_monto, p_impuesto, p_MontoTotal, p_Estado);
                SELECT ROW_COUNT() as affected_rows;
            END
        ');

        // Procedimiento para actualizar factura
        DB::unprepared('DROP PROCEDURE IF EXISTS Sp_Actualizar_Factura');
        DB::unprepared('
            CREATE PROCEDURE Sp_Actualizar_Factura(
                IN p_idFactura INT,
                IN p_idBoleto INT,
                IN p_FechaEmision DATETIME,
                IN p_monto DECIMAL,
                IN p_impuesto DECIMAL,
                IN p_MontoTotal DECIMAL,
                IN p_Estado VARCHAR(10)
            )
            BEGIN
                UPDATE facturas
                SET idBoleto = p_idBoleto,
                    FechaEmision = p_FechaEmision,
                    monto = p_monto,
                    impuesto = p_impuesto,
                    MontoTotal = p_MontoTotal,
                    Estado = p_Estado
                WHERE idFactura = p_idFactura;
                SELECT ROW_COUNT() as affected_rows;
            END
        ');

        // Procedimiento para eliminar factura
        DB::unprepared('DROP PROCEDURE IF EXISTS Sp_Eliminar_Factura');
        DB::unprepared('
            CREATE PROCEDURE Sp_Eliminar_Factura(IN p_idFactura INT)
            BEGIN
                DELETE FROM facturas WHERE idFactura = p_idFactura;
                SELECT ROW_COUNT() as affected_rows;
            END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS Sp_Consulta_Factura');
        DB::unprepared('DROP PROCEDURE IF EXISTS Sp_Insertar_Factura');
        DB::unprepared('DROP PROCEDURE IF EXISTS Sp_Actualizar_Factura');
        DB::unprepared('DROP PROCEDURE IF EXISTS Sp_Eliminar_Factura');
    }
};
