<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Aeropuerto;
use App\Models\Avion;

class Vuelo extends Model
{
    protected $table = 'vuelos';
    protected $primaryKey = 'idVuelo';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'IdAvion',
        'idAeropuertoOrigen',
        'idAeropuertoDestino',
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
        return $this->belongsTo(Aeropuerto::class, 'idAeropuertoOrigen', 'IdAeropuerto');
    }

    // Relación con Aeropuerto Destino
    public function aeropuertoDestino()
    {
        return $this->belongsTo(Aeropuerto::class, 'idAeropuertoDestino', 'IdAeropuerto');
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
