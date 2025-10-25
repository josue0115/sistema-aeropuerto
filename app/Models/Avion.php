<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Avion extends Model
{
    use HasFactory;

    protected $table = 'aviones';
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
<<<<<<< HEAD
        return self::with('aerolinea')->get();
=======
        return self::all();
>>>>>>> a60e3a7bc7051f4003c150120a92d83368ed27e8
    }
}
