<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Factura extends Model
{
    //

    protected $table = 'facturas';
    protected $primaryKey = 'idFactura';
    public $timestamps = false;

    protected $fillable = [
        'idFactura',
        'idBoleto',
        'FechaEmision',
        'monto',
        'impuesto',
        'MontoTotal',
        'Estado',
        'user_id'
    ];

    public static function listar()
    {
        return DB::select('CALL Sp_Consulta_Factura(NULL)');
    }

    public static function obtenerPorId($id)
    {
        return DB::select('CALL Sp_Consulta_Factura(?)', [$id]);
    }

    public static function insertar($data)
    {
        return DB::select('CALL Sp_Insertar_Factura(?, ?, ?, ?, ?, ?, ?, ?)', [
            $data['idFactura'],
            $data['idBoleto'],
            $data['FechaEmision'],
            $data['monto'],
            $data['impuesto'],
            $data['MontoTotal'],
            $data['Estado'],
            $data['user_id']
        ]);
    }

    public static function actualizar($id, $data)
    {
        return DB::select('CALL Sp_Actualizar_Factura(?, ?, ?, ?, ?, ?, ?, ?)', [
            $id,
            $data['idBoleto'],
            $data['FechaEmision'],
            $data['monto'],
            $data['impuesto'],
            $data['MontoTotal'],
            $data['Estado'],
            $data['user_id']
        ]);
    }

    public static function eliminar($id)
    {
        return DB::select('CALL Sp_Eliminar_Factura(?)', [$id]);
    }
}
