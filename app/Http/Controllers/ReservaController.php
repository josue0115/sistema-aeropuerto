<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use App\Models\Pasajero;
use App\Models\Vuelo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReservaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reservas = Reserva::listar();
        return view('reservas.index', compact('reservas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pasajeros = Pasajero::listar();
        $vuelos = Vuelo::listar();

        // Obtener reservas existentes para sugerir vuelos basados en pasajeros
        $reservasExistentes = DB::select('
            SELECT r.idPasajero, r.idVuelo, p.Nombre, p.Apellido, v.idVuelo as vuelo_id, v.Precio, v.FechaSalida,
                   a_origen.Nombre as origen, a_destino.Nombre as destino
            FROM reservas r
            JOIN pasajeros p ON r.idPasajero = p.idPasajero
            JOIN vuelos v ON r.idVuelo = v.idVuelo
            LEFT JOIN aeropuertos a_origen ON v.idAeropuertoOrigen = a_origen.idAeropuerto
            LEFT JOIN aeropuertos a_destino ON v.idAeropuertoDestino = a_destino.idAeropuerto
            ORDER BY r.FechaReserva DESC
        ');

        return view('reservas.create', compact('pasajeros', 'vuelos', 'reservasExistentes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'idPasajero' => 'required|integer|exists:pasajeros,idPasajero',
            'idVuelo' => 'required|integer|exists:vuelos,idVuelo',
            'FechaReserva' => 'required|date|after_or_equal:today',
            'FechaVuelo' => 'required|date|after_or_equal:today',
            'Estado' => 'required|string|max:10',
        ]);

        $data = $request->all();

        // Calcular monto anticipado (10% del precio del vuelo)
        $vuelo = Vuelo::obtenerPorId($data['idVuelo']);
        if ($vuelo) {
            $data['MontoAnticipado'] = $vuelo->Precio * 0.10;
        }

        // Generar ID automático para la reserva
        $data['idReserva'] = DB::select('SELECT COALESCE(MAX(idReserva), 0) + 1 as next_id FROM reservas')[0]->next_id;

        Reserva::insertar($data);

        return redirect()->route('reservas.index')->with('success', 'Reserva creada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $reserva = Reserva::obtenerPorId($id);
        if (empty($reserva)) {
            abort(404);
        }
        $reserva = $reserva[0];
        return view('reservas.show', compact('reserva'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $reserva = Reserva::obtenerPorId($id);
        if (empty($reserva)) {
            abort(404);
        }
        $reserva = $reserva[0];
        $pasajeros = Pasajero::listar();
        $vuelos = Vuelo::listar();

        // Obtener reservas existentes para sugerir vuelos basados en pasajeros
        $reservasExistentes = DB::select('
            SELECT r.idPasajero, r.idVuelo, p.Nombre, p.Apellido, v.idVuelo as vuelo_id, v.Precio, v.FechaSalida,
                   a_origen.Nombre as origen, a_destino.Nombre as destino
            FROM reservas r
            JOIN pasajeros p ON r.idPasajero = p.idPasajero
            JOIN vuelos v ON r.idVuelo = v.idVuelo
            LEFT JOIN aeropuertos a_origen ON v.idAeropuertoOrigen = a_origen.idAeropuerto
            LEFT JOIN aeropuertos a_destino ON v.idAeropuertoDestino = a_destino.idAeropuerto
            ORDER BY r.FechaReserva DESC
        ');

        return view('reservas.edit', compact('reserva', 'pasajeros', 'vuelos', 'reservasExistentes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'idPasajero' => 'required|integer|exists:pasajeros,idPasajero',
            'idVuelo' => 'required|integer|exists:vuelos,idVuelo',
            'FechaReserva' => 'required|date|after_or_equal:today',
            'FechaVuelo' => 'required|date|after_or_equal:today',
            'Estado' => 'required|string|max:10',
        ]);

        $data = $request->all();

        // Calcular monto anticipado (10% del precio del vuelo)
        $vuelo = Vuelo::obtenerPorId($data['idVuelo']);
        if ($vuelo) {
            $data['MontoAnticipado'] = $vuelo->Precio * 0.10;
        }

        Reserva::actualizar($id, $data);

        return redirect()->route('reservas.index')->with('success', 'Reserva actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Reserva::eliminar($id);

        return redirect()->route('reservas.index')->with('success', 'Reserva eliminada exitosamente.');
    }
}
