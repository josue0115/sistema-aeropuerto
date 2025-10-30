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
            SELECT r.idPasajero, r.idVuelo, p.Nombre, p.Apellido, v.IdVuelo as vuelo_id, v.Precio, v.FechaSalida,
                   a_origen.NombreAeropuerto as origen, a_destino.NombreAeropuerto as destino
            FROM reservas r
            JOIN pasajeros p ON r.idPasajero = p.idPasajero
            JOIN vuelo v ON r.idVuelo = v.idVuelo
            LEFT JOIN aeropuerto a_origen ON v.IdAeropuertoOrigen = a_origen.IdAeropuerto
            LEFT JOIN aeropuerto a_destino ON v.IdAeropuertoDestino = a_destino.IdAeropuerto
            ORDER BY r.FechaReserva DESC
        ');

        // Calcular total acumulado de la reserva actual (si existe en sesión)
        $totalAcumulado = session('total_acumulado', 0);

        // Sumar el MontoAnticipado al total acumulado para mostrar el total de la reserva
        $totalReserva = $totalAcumulado;

        // Obtener valores de sesión para pre-llenar campos
        $pasajeroSeleccionado = session('pasajero_seleccionado');

        // Si no hay pasajero seleccionado, usar el primer pasajero creado
        if (!$pasajeroSeleccionado) {
            $pasajerosCreados = session('pasajeros_creados', []);
            if (!empty($pasajerosCreados)) {
                $pasajeroSeleccionado = $pasajerosCreados[0];
            }
        }

        $vueloSeleccionado = session('vuelo_seleccionado');

        return view('reservas.create', compact('pasajeros', 'vuelos', 'reservasExistentes', 'totalAcumulado', 'totalReserva', 'pasajeroSeleccionado', 'vueloSeleccionado'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'idPasajero' => 'required|integer|exists:pasajeros,idPasajero',
            'idVuelo' => 'required|integer|exists:vuelo,idVuelo',
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

        // Sumar el MontoAnticipado al total acumulado de la reserva
        $totalAcumulado = session('total_acumulado', 0);
        $totalAcumulado += $data['MontoAnticipado'];
        session(['total_acumulado' => $totalAcumulado]);

        // Generar ID automático para la reserva
        $data['idReserva'] = DB::select('SELECT COALESCE(MAX(idReserva), 0) + 1 as next_id FROM reservas')[0]->next_id;

        Reserva::insertar($data);

        // Verificar si se presionó el botón "Crear y Pagar"
        if ($request->input('action') === 'pay') {
            // Guardar ID de reserva en sesión para el pago
            session(['reserva_creada' => $data['idReserva']]);

            // Redirigir a pago
            return redirect()->route('pagos.create')->with('success', 'Reserva creada exitosamente. Ahora procesa el pago.');
        }

        // Limpiar la sesión después de crear la reserva
        session()->forget(['total_acumulado', 'vuelo_seleccionado', 'boleto_creado', 'vuelo_para_asientos', 'pasajeros_creados']);

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
            JOIN vuelo v ON r.idVuelo = v.idVuelo
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
            'idVuelo' => 'required|integer|exists:vuelo,idVuelo',
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
     * Redirigir a pago después de crear reserva
     */
    public function procesarPago()
    {
        // Verificar que existe una reserva creada
        if (!session()->has('reserva_creada')) {
            return redirect()->route('reservas.create')->with('error', 'No se encontró una reserva para procesar el pago.');
        }

        return redirect()->route('pagos.create');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Reserva::eliminar($id);

        return redirect()->route('reservas.index')->with('success', 'Reserva eliminada exitosamente.');
    }

    /**
     * Store a newly created resource and redirect to payment.
     */
    public function storeAndPay(Request $request)
    {
        $request->validate([
            'idPasajero' => 'required|integer|exists:pasajeros,idPasajero',
            'idVuelo' => 'required|integer|exists:vuelo,idVuelo',
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

        $reservaId = Reserva::insertar($data);

        // Guardar ID de reserva en sesión para el pago
        session(['reserva_creada' => $reservaId]);

        // Redirigir a pago
        return redirect()->route('pagos.create')->with('success', 'Reserva creada exitosamente. Ahora procesa el pago.');
    }
}
