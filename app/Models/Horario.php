<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    protected $table = 'horario';
    protected $primaryKey = 'IdHorario';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'IdVuelo',
        'HoraSalida',
        'HoraLlegada',
        'Estado',
        'TiempoEspera'
    ];

    // Relación con Vuelo
    public function vuelo()
    {
        return $this->belongsTo(Vuelo::class, 'IdVuelo', 'IdVuelo');
    }
}
