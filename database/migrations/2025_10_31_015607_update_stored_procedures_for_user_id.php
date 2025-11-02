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
        // Actualizar Sp_Insertar_Reserva para incluir user_id
        DB::unprepared('DROP PROCEDURE IF EXISTS Sp_Insertar_Reserva');
        DB::unprepared('
            CREATE PROCEDURE Sp_Insertar_Reserva(
                IN p_idReserva INT,
                IN p_idPasajero INT,
                IN p_idVuelo INT,
                IN p_FechaReserva DATETIME,
                IN p_FechaVuelo DATETIME,
                IN p_MontoAnticipado DECIMAL,
                IN p_Estado VARCHAR(10),
                IN p_user_id BIGINT
            )
            BEGIN
                INSERT INTO reservas (idReserva, idPasajero, idVuelo, FechaReserva, FechaVuelo, MontoAnticipado, Estado, user_id)
                VALUES (p_idReserva, p_idPasajero, p_idVuelo, p_FechaReserva, p_FechaVuelo, p_MontoAnticipado, p_Estado, p_user_id);
                SELECT ROW_COUNT() as affected_rows;
            END
        ');

        // Actualizar Sp_Actualizar_Reserva para incluir user_id
        DB::unprepared('DROP PROCEDURE IF EXISTS Sp_Actualizar_Reserva');
        DB::unprepared('
            CREATE PROCEDURE Sp_Actualizar_Reserva(
                IN p_idReserva INT,
                IN p_idPasajero INT,
                IN p_idVuelo INT,
                IN p_FechaReserva DATETIME,
                IN p_FechaVuelo DATETIME,
                IN p_MontoAnticipado DECIMAL,
                IN p_Estado VARCHAR(10),
                IN p_user_id BIGINT
            )
            BEGIN
                UPDATE reservas
                SET idPasajero = p_idPasajero,
                    idVuelo = p_idVuelo,
                    FechaReserva = p_FechaReserva,
                    FechaVuelo = p_FechaVuelo,
                    MontoAnticipado = p_MontoAnticipado,
                    Estado = p_Estado,
                    user_id = p_user_id
                WHERE idReserva = p_idReserva;
                SELECT ROW_COUNT() as affected_rows;
            END
        ');

        // Actualizar Sp_Insertar_Boleto para incluir user_id
        DB::unprepared('DROP PROCEDURE IF EXISTS Sp_Insertar_Boleto');
        DB::unprepared('
            CREATE PROCEDURE Sp_Insertar_Boleto(
                IN p_idBoleto INT,
                IN p_idVuelo INT,
                IN p_idPasajero INT,
                IN p_FechaCompra DATETIME,
                IN p_Precio DECIMAL(10,2),
                IN p_Cantidad DECIMAL(10,2),
                IN p_Descuento DECIMAL(10,2),
                IN p_Impuesto DECIMAL(10,2),
                IN p_Total DECIMAL(10,2),
                IN p_user_id BIGINT
            )
            BEGIN
                INSERT INTO boletos (idBoleto, idVuelo, idPasajero, FechaCompra, Precio, Cantidad, Descuento, Impuesto, Total, user_id)
                VALUES (p_idBoleto, p_idVuelo, p_idPasajero, p_FechaCompra, p_Precio, p_Cantidad, p_Descuento, p_Impuesto, p_Total, p_user_id);
                SELECT ROW_COUNT() as affected_rows;
            END
        ');

        // Actualizar Sp_Actualizar_Boleto para incluir user_id
        DB::unprepared('DROP PROCEDURE IF EXISTS Sp_Actualizar_Boleto');
        DB::unprepared('
            CREATE PROCEDURE Sp_Actualizar_Boleto(
                IN p_idBoleto INT,
                IN p_idVuelo INT,
                IN p_idPasajero INT,
                IN p_FechaCompra DATETIME,
                IN p_Precio DECIMAL(10,2),
                IN p_Cantidad DECIMAL(10,2),
                IN p_Descuento DECIMAL(10,2),
                IN p_Impuesto DECIMAL(10,2),
                IN p_Total DECIMAL(10,2),
                IN p_user_id BIGINT
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
                    Total = p_Total,
                    user_id = p_user_id
                WHERE idBoleto = p_idBoleto;
                SELECT ROW_COUNT() as affected_rows;
            END
        ');

        // Actualizar Sp_Insertar_Factura para incluir user_id
        DB::unprepared('DROP PROCEDURE IF EXISTS Sp_Insertar_Factura');
        DB::unprepared('
            CREATE PROCEDURE Sp_Insertar_Factura(
                IN p_idFactura INT,
                IN p_idBoleto INT,
                IN p_FechaEmision DATETIME,
                IN p_monto DECIMAL,
                IN p_impuesto DECIMAL,
                IN p_MontoTotal DECIMAL,
                IN p_Estado VARCHAR(10),
                IN p_user_id BIGINT
            )
            BEGIN
                INSERT INTO facturas (idFactura, idBoleto, FechaEmision, monto, impuesto, MontoTotal, Estado, user_id)
                VALUES (p_idFactura, p_idBoleto, p_FechaEmision, p_monto, p_impuesto, p_MontoTotal, p_Estado, p_user_id);
                SELECT ROW_COUNT() as affected_rows;
            END
        ');

        // Actualizar Sp_Actualizar_Factura para incluir user_id
        DB::unprepared('DROP PROCEDURE IF EXISTS Sp_Actualizar_Factura');
        DB::unprepared('
            CREATE PROCEDURE Sp_Actualizar_Factura(
                IN p_idFactura INT,
                IN p_idBoleto INT,
                IN p_FechaEmision DATETIME,
                IN p_monto DECIMAL,
                IN p_impuesto DECIMAL,
                IN p_MontoTotal DECIMAL,
                IN p_Estado VARCHAR(10),
                IN p_user_id BIGINT
            )
            BEGIN
                UPDATE facturas
                SET idBoleto = p_idBoleto,
                    FechaEmision = p_FechaEmision,
                    monto = p_monto,
                    impuesto = p_impuesto,
                    MontoTotal = p_MontoTotal,
                    Estado = p_Estado,
                    user_id = p_user_id
                WHERE idFactura = p_idFactura;
                SELECT ROW_COUNT() as affected_rows;
            END
        ');

        // Actualizar sp_insertar_pago para incluir user_id
        DB::unprepared('DROP PROCEDURE IF EXISTS sp_insertar_pago');
        DB::unprepared('
            CREATE PROCEDURE sp_insertar_pago(
                IN p_idReserva INT,
                IN p_Monto DECIMAL(10,2),
                IN p_MetodoPago VARCHAR(50),
                IN p_FechaPago DATETIME,
                IN p_Estado VARCHAR(20),
                IN p_user_id BIGINT
            )
            BEGIN
                INSERT INTO pagos (idReserva, Monto, MetodoPago, FechaPago, Estado, user_id)
                VALUES (p_idReserva, p_Monto, p_MetodoPago, p_FechaPago, p_Estado, p_user_id);
                SELECT LAST_INSERT_ID() as idPago;
            END
        ');

        // Actualizar sp_actualizar_pago para incluir user_id
        DB::unprepared('DROP PROCEDURE IF EXISTS sp_actualizar_pago');
        DB::unprepared('
            CREATE PROCEDURE sp_actualizar_pago(
                IN p_idPago INT,
                IN p_idReserva INT,
                IN p_Monto DECIMAL(10,2),
                IN p_MetodoPago VARCHAR(50),
                IN p_FechaPago DATETIME,
                IN p_Estado VARCHAR(20),
                IN p_user_id BIGINT
            )
            BEGIN
                UPDATE pagos
                SET idReserva = p_idReserva,
                    Monto = p_Monto,
                    MetodoPago = p_MetodoPago,
                    FechaPago = p_FechaPago,
                    Estado = p_Estado,
                    user_id = p_user_id
                WHERE idPago = p_idPago;
                SELECT ROW_COUNT() as affected_rows;
            END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revertir a versiones anteriores sin user_id
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

        DB::unprepared('DROP PROCEDURE IF EXISTS Sp_Insertar_Boleto');
        DB::unprepared('
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
            END
        ');

        DB::unprepared('DROP PROCEDURE IF EXISTS Sp_Actualizar_Boleto');
        DB::unprepared('
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
            END
        ');

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

        DB::unprepared('DROP PROCEDURE IF EXISTS sp_insertar_pago');
        DB::unprepared('
            CREATE PROCEDURE sp_insertar_pago(
                IN p_idReserva INT,
                IN p_Monto DECIMAL(10,2),
                IN p_MetodoPago VARCHAR(50),
                IN p_FechaPago DATETIME,
                IN p_Estado VARCHAR(20)
            )
            BEGIN
                INSERT INTO pagos (idReserva, Monto, MetodoPago, FechaPago, Estado)
                VALUES (p_idReserva, p_Monto, p_MetodoPago, p_FechaPago, p_Estado);
                SELECT LAST_INSERT_ID() as idPago;
            END
        ');

        DB::unprepared('DROP PROCEDURE IF EXISTS sp_actualizar_pago');
        DB::unprepared('
            CREATE PROCEDURE sp_actualizar_pago(
                IN p_idPago INT,
                IN p_idReserva INT,
                IN p_Monto DECIMAL(10,2),
                IN p_MetodoPago VARCHAR(50),
                IN p_FechaPago DATETIME,
                IN p_Estado VARCHAR(20)
            )
            BEGIN
                UPDATE pagos
                SET idReserva = p_idReserva,
                    Monto = p_Monto,
                    MetodoPago = p_MetodoPago,
                    FechaPago = p_FechaPago,
                    Estado = p_Estado
                WHERE idPago = p_idPago;
                SELECT ROW_COUNT() as affected_rows;
            END
        ');
    }
};
