<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TipoServicio extends Model
{
    protected $table = 'tipo_servicio';
    protected $primaryKey = 'idTipoServicio';
    public $timestamps = true;

    protected $fillable = [
        'Nombre',
        'Costo',
        'Descripcion'
    ];

    protected $casts = [
        'Costo' => 'decimal:2'
    ];

    public function servicios()
    {
        return $this->hasMany(Servicio::class, 'idTipoServicio', 'idTipoServicio');
    }

    // Listar tipos de servicio
    public static function listar()
    {
        return DB::select('CALL Sp_Consulta_TipoServicio(NULL)');
    }

    // Obtener tipo de servicio por ID
    public static function obtenerPorId($id)
    {
        return DB::select('CALL Sp_Consulta_TipoServicio(?)', [$id]);
    }

    // Crear nuevo tipo de servicio
    public static function insertar($data)
    {
        return DB::select('CALL Sp_Insertar_TipoServicio(?, ?, ?)', [
            $data['Nombre'],
            $data['Costo'],
            $data['Descripcion']
        ]);
    }

    // Actualizar tipo de servicio
    public static function actualizar($id, $data)
    {
        return DB::select('CALL Sp_Actualizar_TipoServicio(?, ?, ?, ?)', [
            $id,
            $data['Nombre'],
            $data['Costo'],
            $data['Descripcion']
        ]);
    }

    // Eliminar tipo de servicio
    public static function eliminar($id)
    {
        return DB::select('CALL Sp_Eliminar_TipoServicio(?)', [$id]);
    }
}
