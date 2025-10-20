<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mantenimiento extends Model
{
    protected $table = 'mantenimiento';
    protected $primaryKey = 'Id_mantenimiento';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'IdAvion',
        'IdPersonal',
        'FechaIngreso',
        'FechaSalida',
        'Tipo',
        'Estado',
        'Descripcion',
        'Costo',
        'CostoExtra'
    ];

    public function avion()
    {
        return $this->belongsTo(Avion::class, 'IdAvion', 'IdAvion');
    }

    public function personal()
    {
        return $this->belongsTo(Personal::class, 'IdPersonal', 'IdPersonal');
    }
}
