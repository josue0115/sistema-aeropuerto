<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Avion extends Model
{
    use HasFactory;

    protected $table = 'avion';
    protected $primaryKey = 'idAvion';
    public $incrementing = true; // porque es INT
    protected $keyType = 'int';

    public function getRouteKeyName()
    {
        return 'idAvion';
    }

    protected $fillable = [
        'idAvion',
        'idAerolinea',
        'Placa',
        'Tipo',
        'Modelo',
        'Capacidad',
        'Estado'
    ];

    // Relación con Aerolinea
    public function aerolinea()
    {
        return $this->belongsTo(Aerolinea::class, 'idAerolinea', 'idAerolinea');
    }

    public static function listar()
    {
        return self::all();
    }
}
