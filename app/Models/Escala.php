<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Escala extends Model
{
    protected $table = 'escala';
    protected $primaryKey = 'IdEscala';
    public $incrementing = true;
    protected $keyType = 'int';

    public function getRouteKeyName()
    {
        return 'IdEscala';
    }

    protected $fillable = [
        'IdEscala',
        'IdVuelo',
        'IdAeropuerto',
        'HoraSalida',
        'HoraLlegada',
        'TiempoEspera',
        'Estado'
    ];

    // Relación con Vuelo
    public function vuelo()
    {
        return $this->belongsTo(Vuelo::class, 'IdVuelo', 'IdVuelo');
    }

    // Relación con Aeropuerto
    public function aeropuerto()
    {
        return $this->belongsTo(Aeropuerto::class, 'IdAeropuerto', 'IdAeropuerto');
    }
}
