<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Reserva extends Model
{
    protected $table = 'reservas';
    protected $primaryKey = 'idReserva';
    public $timestamps = false;

    protected $fillable = [
        'idReserva',
        'idPasajero',
        'idVuelo',
        'FechaReserva',
        'FechaVuelo',
        'MontoAnticipado',
        'Estado',
        'user_id'
    ];

    public static function listar()
    {
        return DB::select('CALL Sp_Consulta_Reserva(NULL)');
    }

    public static function obtenerPorId($id)
    {
        return DB::select('CALL Sp_Consulta_Reserva(?)', [$id]);
    }

    public static function insertar($data)
    {
        return DB::select('CALL Sp_Insertar_Reserva(?, ?, ?, ?, ?, ?, ?, ?)', [
            $data['idReserva'],
            $data['idPasajero'],
            $data['idVuelo'],
            $data['FechaReserva'],
            $data['FechaVuelo'],
            $data['MontoAnticipado'],
            $data['Estado'],
            $data['user_id']
        ]);
    }

    public static function actualizar($id, $data)
    {
        return DB::select('CALL Sp_Actualizar_Reserva(?, ?, ?, ?, ?, ?, ?, ?)', [
            $id,
            $data['idPasajero'],
            $data['idVuelo'],
            $data['FechaReserva'],
            $data['FechaVuelo'],
            $data['MontoAnticipado'],
            $data['Estado'],
            $data['user_id']
        ]);
    }

    public static function eliminar($id)
    {
        return DB::select('CALL Sp_Eliminar_Reserva(?)', [$id]);
    }
}
