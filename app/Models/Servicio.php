<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Servicio extends Model
{
    protected $table = 'servicios';
    protected $primaryKey = 'idServicio';
    public $timestamps = false;

    protected $fillable = [
        'idBoleto',
        'Fecha',
        'idTipoServicio',
        'Costo',
        'Cantidad',
        'costoTotal',
        'Estado'
    ];

    protected $hidden = [
        // Add any attributes you want to hide from array or JSON representations
    ];

    protected $casts = [
        'Fecha' => 'datetime',
        'Cantidad' => 'decimal:2',
        'Costo' => 'decimal:2',
        'costoTotal' => 'decimal:2'
    ];

    public function boleto()
    {
        return $this->belongsTo(Boleto::class, 'idBoleto', 'idBoleto');
    }

    public function tipoServicio()
    {
        return $this->belongsTo(TipoServicio::class, 'idTipoServicio', 'idTipoServicio');
    }

    // Listar servicios
    public static function listar()
    {
        return DB::select('
            SELECT s.*, ts.Nombre as TipoServicio, ts.Costo as Costo, (ts.Costo * s.Cantidad) as CostoTotal
            FROM servicios s
            LEFT JOIN tipo_servicio ts ON s.idTipoServicio = ts.idTipoServicio
        ');
    }

    // Obtener servicio por ID
    public static function obtenerPorId($id)
    {
        return DB::select('CALL Sp_Consulta_Servicio(?)', [$id]);
    }

    // Crear nuevo servicio
    public static function insertar($data)
    {
        return self::create($data);
    }

    // Actualizar servicio
    public static function actualizar($id, $data)
    {
        $servicio = self::find($id);
        if ($servicio) {
            $servicio->update($data);
            return $servicio;
        }
        return null;
    }

    // Eliminar servicio
    public static function eliminar($id)
    {
        return DB::select('CALL Sp_Eliminar_Servicio(?)', [$id]);
    }
}
