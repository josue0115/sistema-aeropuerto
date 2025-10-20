<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class HistorialVuelo extends Model
{
    //

    protected $table = 'historial_vuelos';
    protected $primaryKey = 'id_historial_vuelo';
    public $timestamps = false;

    protected $fillable = [
        'idhistorial',
        'idvuelo',
        'idPasajero',
        'Fecha',
        'Detalle'
    ];

    protected $hidden = [
        // Add any attributes you want to hide from array or JSON representations
        'password_hash', 
    ];  

    public function getAuthPassword()
    {
        return $this->password_hash;
    }

    // Listar historial de vuelos
    public static function listar()
    {
        return DB::select('CALL Sp_Consulta_HistorialVuelo(NULL)');
    }

    // Obtener historial de vuelo por ID
    public static function obtenerPorId($id)
    {
        return DB::select('CALL Sp_Consulta_HistorialVuelo(?)', [$id]);
    }

    // Crear nuevo historial de vuelo
    public static function insertar($data)
    {
        return DB::select('CALL Sp_Insertar_HistorialVuelo(?, ?, ?, ?, ?)', [
            $data['idhistorial'],
            $data['idvuelo'],           
            $data['idPasajero'],
            $data['Fecha'],
            $data['Detalle']
        ]);

    }

    // Actualizar historial de vuelo
    public static function actualizar($id, $data)
    {
        return DB::select('CALL Sp_Actualizar_HistorialVuelo(?, ?, ?, ?, ?, ?)', [
                $id,
                $data['idhistorial'],
                $data['idvuelo'],
                $data['idPasajero'],
                $data['Fecha'],
                $data['Detalle']
            ]);

    }

    // Eliminar historial de vuelo
    public static function eliminar($id)
    {
        return DB::select('CALL Sp_Eliminar_HistorialVuelo(?)', [$id]);
    }

}
