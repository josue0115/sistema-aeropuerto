<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personal extends Model
{
    use HasFactory;

    protected $table = 'personal';
    protected $primaryKey = 'IdPersonal';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'Nombre',
        'Apellido',
        'Cargo',
        'FechaIngreso',
        'Salario',
        'Estado',
        'Telefono',
        'Correo',
        'Direccion'
    ];
}
