<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aeropuerto extends Model
{
    protected $table = 'aeropuerto';
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

    protected $casts = [
        'IdAeropuerto' => 'string',
    ];

    public function getRouteKeyName()
    {
        return 'IdAeropuerto';
    }

    public static function listar()
    {
        return self::all();
    }
}
