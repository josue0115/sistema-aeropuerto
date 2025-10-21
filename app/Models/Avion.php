<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Avion extends Model
{
    use HasFactory;

    protected $table = 'avion';
    protected $primaryKey = 'IdAvion';
    public $incrementing = false; // porque es VARCHAR
    protected $keyType = 'string';

    protected $fillable = [
        'IdAvion',
        'IdAerolinea',
        'Placa',
        'Tipo',
        'Modelo',
        'Capacidad',
        'Estado'
    ];

    // Relación con Aerolinea
    public function aerolinea()
    {
        return $this->belongsTo(Aerolinea::class, 'IdAerolinea', 'IdAerolinea');
    }

    public static function listar()
    {
        return self::with('aerolinea')->get();
    }
}
