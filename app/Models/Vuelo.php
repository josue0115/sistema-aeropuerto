<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Aeropuerto;
use App\Models\Avion;

class Vuelo extends Model
{
    protected $table = 'vuelo';
<<<<<<< HEAD
    protected $primaryKey = 'IdVuelo';
=======
    protected $primaryKey = 'idVuelo';
>>>>>>> a60e3a7bc7051f4003c150120a92d83368ed27e8
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
<<<<<<< HEAD
        'IdAvion',
        'AeropuertoOrigen',
        'AeropuertoDestino',
=======
        'idVuelo',
        'idAvion',
        'idAeropuertoOrigen',
        'idAeropuertoDestino',
>>>>>>> a60e3a7bc7051f4003c150120a92d83368ed27e8
        'FechaSalida',
        'FechaLlegada',
        'Precio',
        'Estado'
    ];

    // Relación con Avion
    public function avion()
    {
        return $this->belongsTo(Avion::class, 'idAvion', 'idAvion');
    }

    // Relación con Aeropuerto Origen
    public function aeropuertoOrigen()
    {
<<<<<<< HEAD
        return $this->belongsTo(Aeropuerto::class, 'AeropuertoOrigen', 'IdAeropuerto');
=======
        return $this->belongsTo(Aeropuerto::class, 'idAeropuertoOrigen', 'idAeropuerto');
>>>>>>> a60e3a7bc7051f4003c150120a92d83368ed27e8
    }

    // Relación con Aeropuerto Destino
    public function aeropuertoDestino()
    {
<<<<<<< HEAD
        return $this->belongsTo(Aeropuerto::class, 'AeropuertoDestino', 'IdAeropuerto');
=======
        return $this->belongsTo(Aeropuerto::class, 'idAeropuertoDestino', 'idAeropuerto');
>>>>>>> a60e3a7bc7051f4003c150120a92d83368ed27e8
    }

    public static function listar()
    {
        return self::with('aeropuertoOrigen', 'aeropuertoDestino', 'avion')
            ->select('vuelo.*')
            ->selectRaw('aeropuerto_origen.Nombre as aeropuerto_origen_nombre')
            ->selectRaw('aeropuerto_destino.Nombre as aeropuerto_destino_nombre')
            ->leftJoin('aeropuerto as aeropuerto_origen', 'vuelo.idAeropuertoOrigen', '=', 'aeropuerto_origen.idAeropuerto')
            ->leftJoin('aeropuerto as aeropuerto_destino', 'vuelo.idAeropuertoDestino', '=', 'aeropuerto_destino.idAeropuerto')
            ->get()
            ->map(function ($vuelo) {
                $vuelo->aeropuerto_origen_nombre = $vuelo->aeropuerto_origen_nombre ?? $vuelo->aeropuertoOrigen->Nombre ?? 'N/A';
                $vuelo->aeropuerto_destino_nombre = $vuelo->aeropuerto_destino_nombre ?? $vuelo->aeropuertoDestino->Nombre ?? 'N/A';
                return $vuelo;
            });
    }

    public static function obtenerPorId($id)
    {
        return self::with('aeropuertoOrigen', 'aeropuertoDestino', 'avion')->find($id);
    }
}
