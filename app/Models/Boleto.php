<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Boleto extends Model
{
    protected $table = 'boletos';
    protected $primaryKey = 'idBoleto';
    public $timestamps = false;

    protected $fillable = [
        'idBoleto',
        'IdVuelo',
        'idPasajero',
        'FechaCompra',
        'Precio',
        'Cantidad',
        'Descuento',
        'Impuesto'
    ];

    public static function listar()
    {
        return DB::select('CALL Sp_Consulta_Boleto(NULL)');
    }

    public static function obtenerPorId($id)
    {
        return DB::select('CALL Sp_Consulta_Boleto(?)', [$id]);
    }

    public static function insertar($data)
    {
        $result = DB::select('CALL Sp_Insertar_Boleto(?, ?, ?, ?, ?, ?, ?, ?, ?)', [
            $data['idBoleto'],
            $data['idVuelo'],
            $data['idPasajero'],
            $data['FechaCompra'],
            $data['Precio'],
            $data['Cantidad'],
            $data['Descuento'],
            $data['Impuesto'],
            $data['Total']
        ]);
        return $data['idBoleto']; // Retornar el ID del boleto insertado
    }

     public static function actualizar($id, $data)
     {
         return DB::select('CALL Sp_Actualizar_Boleto(?, ?, ?, ?, ?, ?, ?, ?, ?)', [
             $id,
             $data['idVuelo'],
             $data['idPasajero'],
             $data['FechaCompra'],
             $data['Precio'],
             $data['Cantidad'],
             $data['Descuento'],
             $data['Impuesto'],
             $data['Total']
         ]);
     }
  

    public static function eliminar($id)
    {
        return DB::select('CALL Sp_Eliminar_Boleto(?)', [$id]);
    }
}
