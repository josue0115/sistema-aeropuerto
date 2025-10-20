<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
