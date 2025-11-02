<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use App\Models\Pasajero;
use App\Models\Vuelo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class ReservaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        if ($user->role === 'cliente') {
            // Para clientes, filtrar reservas por user_id
            $reservas = array_filter(Reserva::listar(), function($reserva) use ($user) {
                return $reserva->user_id == $user->id;
            });
        } else {
            // Para operadores y admins, mostrar todas
            $reservas = Reserva::listar();
        }
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

        // Agregar el ID del usuario logueado
        $data['user_id'] = auth()->id();

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

            // Retornar respuesta JSON con el ID de la reserva para manejar en JavaScript
            return response()->json([
                'success' => true,
                'reserva_id' => $data['idReserva'],
                'message' => 'Reserva creada exitosamente.'
            ]);
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
                   a_origen.NombreAeropuerto as origen, a_destino.NombreAeropuerto as destino
            FROM reservas r
            JOIN pasajeros p ON r.idPasajero = p.idPasajero
            JOIN vuelo v ON r.IdVuelo = v.IdVuelo
            LEFT JOIN aeropuerto a_origen ON v.IdAeropuertoOrigen = a_origen.IdAeropuerto
            LEFT JOIN aeropuerto a_destino ON v.IdAeropuertoDestino = a_destino.IdAeropuerto
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

        // Agregar el ID del usuario logueado
        $data['user_id'] = auth()->id();

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
     * Generate PDF for the specified reserva.
     */
    public function generatePdf($id)
    {
        $reservaData = Reserva::obtenerPorId($id);
        if (empty($reservaData)) {
            abort(404);
        }
        $reserva = $reservaData[0];

        // Obtener datos adicionales para la reserva
        $pasajero = null;
        $vuelo = null;

        if ($reserva->idPasajero) {
            $pasajeroData = DB::select('CALL Sp_Consulta_Pasajero(?)', [$reserva->idPasajero]);
            if (!empty($pasajeroData)) {
                $pasajero = $pasajeroData[0];
            }
        }

        if ($reserva->idVuelo) {
            $vueloData = DB::select('
                SELECT v.*, ao.NombreAeropuerto as aeropuerto_origen, ad.NombreAeropuerto as aeropuerto_destino
                FROM vuelo v
                LEFT JOIN aeropuerto ao ON v.IdAeropuertoOrigen = ao.IdAeropuerto
                LEFT JOIN aeropuerto ad ON v.IdAeropuertoDestino = ad.IdAeropuerto
                WHERE v.IdVuelo = ?
            ', [$reserva->idVuelo]);

            if (!empty($vueloData)) {
                $vuelo = $vueloData[0];
            }
        }

        $data = [
            'reserva' => $reserva,
            'pasajero' => $pasajero,
            'vuelo' => $vuelo,
        ];

        $pdf = Pdf::loadView('reservas.pdf', $data);

        return $pdf->download('reserva_' . $id . '.pdf');
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

        // Agregar el ID del usuario logueado
        $data['user_id'] = auth()->id();

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
