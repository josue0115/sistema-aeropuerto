<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aerolinea extends Model
{
    protected $table = 'aerolineas';
    protected $primaryKey = 'IdAerolinea';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'IdAerolinea',
        'NombreAerolinea',
        'Pais',
        'Ciudad',
        'Estado'
    ];
}
