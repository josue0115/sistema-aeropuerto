<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aerolinea extends Model
{
    protected $table = 'aerolinea';
    protected $primaryKey = 'idAerolinea';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'Nombre',
        'IATA',
        'Ciudad',
        'Pais',
        'Estado'
    ];
}
