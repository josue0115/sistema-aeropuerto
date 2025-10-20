<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aeropuerto extends Model
{
    protected $table = 'aeropuertos';
    protected $primaryKey = 'IdAeropuerto';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'IdAeropuerto',
        'NombreAeropuerto',
        'Pais',
        'Ciudad',
        'Estado'
    ];

    public static function listar()
    {
        return self::all();
    }
}
