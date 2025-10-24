<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pagos', function (Blueprint $table) {
            $table->integer('idPago')->primary()->autoIncrement();
            $table->integer('idReserva');
            $table->decimal('Monto', 10, 2);
            $table->string('MetodoPago', 50);
            $table->dateTime('FechaPago');
            $table->string('Estado', 20);
            $table->string('Referencia', 100)->nullable();
            $table->timestamps();

            $table->foreign('idReserva')->references('idReserva')->on('reservas');
        });

        // Crear stored procedures para pagos
        DB::unprepared('DROP PROCEDURE IF EXISTS sp_listar_pagos');
        DB::unprepared('
            CREATE PROCEDURE sp_listar_pagos()
            BEGIN
                SELECT * FROM pagos ORDER BY FechaPago DESC;
            END
        ');

        DB::unprepared('DROP PROCEDURE IF EXISTS sp_obtener_pago_por_id');
        DB::unprepared('
            CREATE PROCEDURE sp_obtener_pago_por_id(IN p_idPago INT)
            BEGIN
                SELECT * FROM pagos WHERE idPago = p_idPago;
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

        DB::unprepared('DROP PROCEDURE IF EXISTS sp_eliminar_pago');
        DB::unprepared('
            CREATE PROCEDURE sp_eliminar_pago(IN p_idPago INT)
            BEGIN
                DELETE FROM pagos WHERE idPago = p_idPago;
                SELECT ROW_COUNT() as affected_rows;
            END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS sp_listar_pagos');
        DB::unprepared('DROP PROCEDURE IF EXISTS sp_obtener_pago_por_id');
        DB::unprepared('DROP PROCEDURE IF EXISTS sp_insertar_pago');
        DB::unprepared('DROP PROCEDURE IF EXISTS sp_actualizar_pago');
        DB::unprepared('DROP PROCEDURE IF EXISTS sp_eliminar_pago');

        Schema::dropIfExists('pagos');
    }
};
