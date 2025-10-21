<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Aeropuerto;
use App\Models\Avion;

class Vuelo extends Model
{
    protected $table = 'vuelo';
    protected $primaryKey = 'IdVuelo';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'IdAvion',
        'AeropuertoOrigen',
        'AeropuertoDestino',
        'FechaSalida',
        'FechaLlegada',
        'Precio',
        'Estado'
    ];

    // Relación con Avion
    public function avion()
    {
        return $this->belongsTo(Avion::class, 'IdAvion', 'IdAvion');
    }

    // Relación con Aeropuerto Origen
    public function aeropuertoOrigen()
    {
        return $this->belongsTo(Aeropuerto::class, 'AeropuertoOrigen', 'IdAeropuerto');
    }

    // Relación con Aeropuerto Destino
    public function aeropuertoDestino()
    {
        return $this->belongsTo(Aeropuerto::class, 'AeropuertoDestino', 'IdAeropuerto');
    }

    public static function listar()
    {
        return self::with('aeropuertoOrigen', 'aeropuertoDestino', 'avion')->get();
    }

    public static function obtenerPorId($id)
    {
        return self::with('aeropuertoOrigen', 'aeropuertoDestino', 'avion')->find($id);
    }
}
