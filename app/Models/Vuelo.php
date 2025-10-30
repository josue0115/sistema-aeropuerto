<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Aeropuerto;
use App\Models\Avion;

class Vuelo extends Model
{
    protected $table = 'vuelo';
    protected $primaryKey = 'IdVuelo';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'IdVuelo',
        'IdAvion',
        'IdAeropuertoOrigen',
        'IdAeropuertoDestino',
        'FechaSalida',
        'FechaLlegada',
        'Precio',
        'Estado'
    ];

    public function getRouteKeyName()
    {
        return 'IdVuelo';
    }

    // Relaciones
    public function avion()
    {
        return $this->belongsTo(Avion::class, 'IdAvion', 'IdAvion');
    }

    public function aeropuertoOrigen()
    {
        return $this->belongsTo(Aeropuerto::class, 'IdAeropuertoOrigen', 'IdAeropuerto');
    }

    public function aeropuertoDestino()
    {
        return $this->belongsTo(Aeropuerto::class, 'IdAeropuertoDestino', 'IdAeropuerto');
    }

    // Método para listar vuelos con joins
    public static function listar()
    {
        return self::with(['avion', 'aeropuertoOrigen', 'aeropuertoDestino'])
            ->select('vuelo.*')
            ->selectRaw('aeropuerto_origen.NombreAeropuerto as aeropuerto_origen_nombre')
            ->selectRaw('aeropuerto_destino.NombreAeropuerto as aeropuerto_destino_nombre')
            ->leftJoin('aeropuerto as aeropuerto_origen', 'vuelo.IdAeropuertoOrigen', '=', 'aeropuerto_origen.IdAeropuerto')
            ->leftJoin('aeropuerto as aeropuerto_destino', 'vuelo.IdAeropuertoDestino', '=', 'aeropuerto_destino.IdAeropuerto')
            ->get()
            ->map(function ($vuelo) {
                $vuelo->aeropuerto_origen_nombre = $vuelo->aeropuerto_origen_nombre ?? $vuelo->aeropuertoOrigen->NombreAeropuerto ?? 'N/A';
                $vuelo->aeropuerto_destino_nombre = $vuelo->aeropuerto_destino_nombre ?? $vuelo->aeropuertoDestino->NombreAeropuerto ?? 'N/A';
                return $vuelo;
            });
    }

    public static function obtenerPorId($id)
    {
        return self::with('avion', 'aeropuertoOrigen', 'aeropuertoDestino')->find($id);
    }
}
