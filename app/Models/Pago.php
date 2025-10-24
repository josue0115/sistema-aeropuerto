<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Pago extends Model
{
    use HasFactory;

    protected $table = 'pagos';
    protected $primaryKey = 'idPago';
    public $timestamps = false;

    protected $fillable = [
        'idReserva',
        'Monto',
        'MetodoPago',
        'FechaPago',
        'Estado',
        'Referencia'
    ];

    /**
     * Listar todos los pagos
     */
    public static function listar()
    {
        return DB::select('CALL sp_listar_pagos()');
    }

    /**
     * Obtener pago por ID
     */
    public static function obtenerPorId($id)
    {
        return DB::select('CALL sp_obtener_pago_por_id(?)', [$id]);
    }

    /**
     * Insertar nuevo pago
     */
    public static function insertar($data)
    {
        return DB::select('CALL sp_insertar_pago(?, ?, ?, ?, ?)', [
            $data['idReserva'],
            $data['Monto'],
            $data['MetodoPago'],
            $data['FechaPago'],
            $data['Estado']
        ]);
    }

    /**
     * Actualizar pago
     */
    public static function actualizar($id, $data)
    {
        return DB::select('CALL sp_actualizar_pago(?, ?, ?, ?, ?, ?)', [
            $id,
            $data['idReserva'] ?? null,
            $data['Monto'] ?? null,
            $data['MetodoPago'] ?? null,
            $data['FechaPago'] ?? null,
            $data['Estado'] ?? null
        ]);
    }

    /**
     * Eliminar pago
     */
    public static function eliminar($id)
    {
        return DB::select('CALL sp_eliminar_pago(?)', [$id]);
    }

    /**
     * Relación con Reserva
     */
    public function reserva()
    {
        return $this->belongsTo(Reserva::class, 'idReserva', 'idReserva');
    }
}
