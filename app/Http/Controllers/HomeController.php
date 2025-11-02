<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aeropuerto;
use App\Models\Vuelo;
use App\Models\Pasajero;
use App\Models\Reserva;
use App\Models\Factura;

class HomeController extends Controller
{
    public function index()
    {
        $aeropuertos = Aeropuerto::listar();

        // Estadísticas para el dashboard
        $stats = [
            'vuelos' => Vuelo::count(),
            'pasajeros' => Pasajero::count(),
            'reservas' => Reserva::count(),
            'ingresos' => Factura::sum('MontoTotal') ?? 0,
        ];

        return view('home', compact('aeropuertos', 'stats'));
    }
}
