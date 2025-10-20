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
            DROP PROCEDURE IF EXISTS Sp_Consulta_Boleto;
            CREATE PROCEDURE Sp_Consulta_Boleto(IN p_idBoleto INT)
            BEGIN
                IF p_idBoleto IS NULL THEN
                    SELECT * FROM boletos;
                ELSE
                    SELECT * FROM boletos WHERE idBoleto = p_idBoleto;
                END IF;
            END;

            DROP PROCEDURE IF EXISTS Sp_Insertar_Boleto;
            CREATE PROCEDURE Sp_Insertar_Boleto(
                IN p_idBoleto INT,
                IN p_idVuelo INT,
                IN p_idPasajero INT,
                IN p_FechaCompra DATETIME,
                IN p_Precio DECIMAL(10,2),
                IN p_Cantidad DECIMAL(10,2),
                IN p_Descuento DECIMAL(10,2),
                IN p_Impuesto DECIMAL(10,2),
                IN p_Total DECIMAL(10,2)
            )
            BEGIN
                INSERT INTO boletos (idBoleto, idVuelo, idPasajero, FechaCompra, Precio, Cantidad, Descuento, Impuesto, Total)
                VALUES (p_idBoleto, p_idVuelo, p_idPasajero, p_FechaCompra, p_Precio, p_Cantidad, p_Descuento, p_Impuesto, p_Total);
                SELECT ROW_COUNT() as affected_rows;
            END;

            DROP PROCEDURE IF EXISTS Sp_Actualizar_Boleto;
            CREATE PROCEDURE Sp_Actualizar_Boleto(
                IN p_idBoleto INT,
                IN p_idVuelo INT,
                IN p_idPasajero INT,
                IN p_FechaCompra DATETIME,
                IN p_Precio DECIMAL(10,2),
                IN p_Cantidad DECIMAL(10,2),
                IN p_Descuento DECIMAL(10,2),
                IN p_Impuesto DECIMAL(10,2),
                IN p_Total DECIMAL(10,2)
            )
            BEGIN
                UPDATE boletos
                SET idVuelo = p_idVuelo,
                    idPasajero = p_idPasajero,
                    FechaCompra = p_FechaCompra,
                    Precio = p_Precio,
                    Cantidad = p_Cantidad,
                    Descuento = p_Descuento,
                    Impuesto = p_Impuesto,
                    Total = p_Total
                WHERE idBoleto = p_idBoleto;
                SELECT ROW_COUNT() as affected_rows;
            END;

            DROP PROCEDURE IF EXISTS Sp_Eliminar_Boleto;
            CREATE PROCEDURE Sp_Eliminar_Boleto(IN p_idBoleto INT)
            BEGIN
                DELETE FROM boletos WHERE idBoleto = p_idBoleto;
                SELECT ROW_COUNT() as affected_rows;
            END;
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('boletos_stored_procedures');
    }
};
