<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aeropuerto extends Model
{
    protected $table = 'aeropuerto';
    protected $primaryKey = 'idAeropuerto';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'idAeropuerto',
        'NombreAeropuerto',
        'Pais',
        'Ciudad',
        'Estado'
    ];

    protected $casts = [
        'idAeropuerto' => 'string',
    ];

    public function getRouteKeyName()
    {
        return 'idAeropuerto';
    }

    public static function listar()
    {
        return self::all();
    }
}
