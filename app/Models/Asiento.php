<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Asiento extends Model
{
    protected $table = 'asientos';
    protected $primaryKey = 'idAsiento';
    public $timestamps = true;

    protected $fillable = [
        'idVuelo',
        'NumeroAsiento',
        'Clase',
        'Estado'
    ];

    public function vuelo()
    {
        return $this->belongsTo(Vuelo::class, 'idVuelo', 'idVuelo');
    }

    public static function listar()
    {
        return DB::select('CALL Sp_Consulta_Asiento(NULL)') ?? [];
    }

    public static function obtenerPorId($id)
    {
        $result = DB::select('CALL Sp_Consulta_Asiento(?)', [$id]);
        return $result ? $result : [];
    }

    public static function insertar($data)
    {
        return DB::select('CALL Sp_Insertar_Asiento(?, ?, ?, ?)', [
            $data['idVuelo'],
            $data['NumeroAsiento'],
            $data['Clase'],
            $data['Estado']
        ]);
    }

    public static function actualizar($id, $data)
    {
        return DB::select('CALL Sp_Actualizar_Asiento(?, ?, ?, ?, ?)', [
            $id,
            $data['idVuelo'],
            $data['NumeroAsiento'],
            $data['Clase'],
            $data['Estado']
        ]);
    }

    public static function eliminar($id)
    {
        return DB::select('CALL Sp_Eliminar_Asiento(?)', [$id]);
    }
}
