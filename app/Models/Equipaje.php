<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Equipaje extends Model
{
    protected $table = 'equipajes';
    protected $primaryKey = 'idEquipaje';
    public $timestamps = false;

    protected $fillable = [
        'idEquipaje',
        'idBoleto',
        'Costo',
        'Dimensiones',
        'Monto',
        'CostoExtra',
        'Estado'
    ];

    public static function listar()
    {
        return DB::select('CALL Sp_Consulta_Equipaje(NULL)');
    }

    public static function obtenerPorId($id)
    {
        return DB::select('CALL Sp_Consulta_Equipaje(?)', [$id]);
    }

    public static function insertar($data)
    {
        return DB::select('CALL Sp_Insertar_Equipaje(?, ?, ?, ?, ?, ?, ?)', [
            $data['idEquipaje'],
            $data['idBoleto'],
            $data['Costo'],
            $data['Dimensiones'],
            $data['Monto'],
            $data['CostoExtra'],
            $data['Estado']
        ]);
    }

    public static function actualizar($id, $data)
    {
        return DB::select('CALL Sp_Actualizar_Equipaje(?, ?, ?, ?, ?, ?, ?)', [
            $id,
            $data['idBoleto'],
            $data['Costo'],
            $data['Dimensiones'],
            $data['Monto'],
            $data['CostoExtra'],
            $data['Estado']
        ]);
    }

    public static function eliminar($id)
    {
        return DB::select('CALL Sp_Eliminar_Equipaje(?)', [$id]);
    }
}
