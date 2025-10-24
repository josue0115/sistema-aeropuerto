<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Pasajero extends Model
{
    protected $table = 'pasajeros';
    protected $primaryKey = 'idPasajero';
    public $timestamps = false;

    protected $fillable = [
        'idPasajero',
        'Nombre',
        'Apellido',
        'Pais',
        'TipoPasajero',
        'Estado'
    ];

    public static function listar()
    {
        return DB::select('CALL Sp_Consulta_Pasajero(NULL)');
    }

    public static function obtenerPorId($id)
    {
        return DB::select('CALL Sp_Consulta_Pasajero(?)', [$id]);
    }

    public static function insertar($data)
    {
        // Usar INSERT directo en lugar del stored procedure para obtener el ID correcto
        $id = DB::table('pasajeros')->insertGetId([
            'Nombre' => $data['Nombre'],
            'Apellido' => $data['Apellido'],
            'Pais' => $data['Pais'],
            'TipoPasajero' => $data['TipoPasajero'],
            'Estado' => $data['Estado']
        ]);

        \Log::info('ID del pasajero insertado:', ['id' => $id]);
        return $id;
    }

    public static function actualizar($id, $data)
    {
        return DB::select('CALL Sp_Actualizar_Pasajero(?, ?, ?, ?, ?, ?)', [
            $id,
            $data['Nombre'],
            $data['Apellido'],
            $data['Pais'],
            $data['TipoPasajero'],
            $data['Estado']
        ]);
    }

    public static function eliminar($id)
    {
        return DB::select('CALL Sp_Eliminar_Pasajero(?)', [$id]);
    }
}
