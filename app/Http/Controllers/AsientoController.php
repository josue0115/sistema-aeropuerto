<?php

namespace App\Http\Controllers;

use App\Models\Asiento;
use App\Models\Vuelo;
use App\Models\Boleto;
use App\Models\Reserva;
use App\Models\Pasajero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class AsientoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $asientos = Asiento::listar();
        return view('asientos.index', compact('asientos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $vuelos = Vuelo::listar();

        // Obtener el vuelo preseleccionado basado en la sesión
        $vueloSeleccionado = session('vuelo_para_asientos');

        return view('asientos.create', compact('vuelos', 'vueloSeleccionado'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // Validación con los nombres correctos
    $validator = Validator::make($request->all(), [
        'IdVuelo' => 'required|integer|exists:vuelo,IdVuelo', // Mayúscula porque así está en la tabla vuelo
        'NumeroAsiento' => 'required|string|max:10|unique:asientos,NumeroAsiento,NULL,idAsiento,idVuelo,' . $request->IdVuelo,
        'Clase' => 'nullable|string|max:45',
        'Estado' => 'nullable|string|max:45',
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    // Preparar datos con el nombre correcto de columna (minúscula para asientos)
    $data = [
        'idVuelo' => $request->IdVuelo, // Convertir de IdVuelo (form) a idVuelo (tabla asientos)
        'NumeroAsiento' => $request->NumeroAsiento,
        'Clase' => $request->Clase,
        'Estado' => $request->Estado ?? 'Ocupado' // Por defecto Ocupado si no se especifica
    ];

    \Log::info('Creando asiento con datos:', $data);

    // Insertar el asiento
    Asiento::insertar($data);

    // Verificar si se presionó el botón "Finalizar Reserva"
    if ($request->input('action') === 'finalize') {
        \Log::info('Botón Finalizar Reserva presionado');
        
        // Guardar datos en sesión para crear la reserva
        session([
            'vuelo_seleccionado' => $request->IdVuelo,
            'asiento_creado' => $request->NumeroAsiento
        ]);

        \Log::info('Redirigiendo a reservas.create con sesión:', [
            'vuelo' => session('vuelo_seleccionado'),
            'asiento' => session('asiento_creado'),
            'pasajero' => session('pasajero_seleccionado')
        ]);

        return redirect()->route('reservas.create')
                        ->with('success', 'Asiento creado. Completa los datos de la reserva.');
    }

    // Para el botón "Crear Asiento" normal
    return redirect()->route('asientos.index')
                    ->with('success', 'Asiento creado exitosamente.');
}

    /**
     * Crear reserva automáticamente usando datos de la sesión
     */
    private function createReservaFromSession()
    {
        // Obtener datos de la sesión
        $pasajeroSeleccionado = session('pasajero_seleccionado');
        $vueloSeleccionado = session('vuelo_seleccionado');

        // Debug: verificar valores de sesión
        \Log::info('Creando reserva desde sesión', [
            'pasajero_seleccionado' => $pasajeroSeleccionado,
            'vuelo_seleccionado' => $vueloSeleccionado,
            'session_data' => session()->all()
        ]);

        if (!$pasajeroSeleccionado || !$vueloSeleccionado) {
            \Log::warning('Datos insuficientes en sesión para crear reserva', [
                'pasajero_seleccionado' => $pasajeroSeleccionado,
                'vuelo_seleccionado' => $vueloSeleccionado
            ]);
            return redirect()->back()->with('error', 'No hay datos suficientes en la sesión para crear la reserva. Pasajero: ' . ($pasajeroSeleccionado ?? 'null') . ', Vuelo: ' . ($vueloSeleccionado ?? 'null'));
        }

        // Preparar datos para la reserva
        $data = [
            'idPasajero' => $pasajeroSeleccionado,
            'idVuelo' => $vueloSeleccionado,
            'FechaReserva' => now()->format('Y-m-d H:i:s'),
            'FechaVuelo' => now()->format('Y-m-d H:i:s'), // Usar fecha actual, puede ajustarse
            'Estado' => 'Confirmada',
        ];

        // Calcular monto anticipado (10% del precio del vuelo)
        $vuelo = Vuelo::obtenerPorId($data['idVuelo']);
        if ($vuelo) {
            $data['MontoAnticipado'] = $vuelo->Precio * 0.10;
            $data['FechaVuelo'] = $vuelo->FechaSalida; // Usar la fecha de salida del vuelo
        } else {
            $data['MontoAnticipado'] = 0;
        }

        // Generar ID automático para la reserva
        $data['idReserva'] = DB::select('SELECT COALESCE(MAX(idReserva), 0) + 1 as next_id FROM reservas')[0]->next_id;

        \Log::info('Insertando reserva', $data);

        // Insertar la reserva
        Reserva::insertar($data);

        // Limpiar la sesión después de crear la reserva
        session()->forget(['total_acumulado', 'vuelo_seleccionado', 'boleto_creado', 'vuelo_para_asientos', 'pasajeros_creados', 'pasajero_seleccionado']);

        \Log::info('Reserva creada exitosamente, redirigiendo a reservas.index');

        return redirect()->route('reservas.index')->with('success', 'Reserva creada exitosamente desde asientos.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $asiento = Asiento::obtenerPorId($id);
        if (empty($asiento)) {
            return redirect()->route('asientos.index')->with('error', 'Asiento no encontrado.');
        }
        return view('asientos.show', compact('asiento'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $asiento = Asiento::obtenerPorId($id);
        if (empty($asiento)) {
            return redirect()->route('asientos.index')->with('error', 'Asiento no encontrado.');
        }
        $vuelos = Vuelo::listar();
        return view('asientos.edit', compact('asiento', 'vuelos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    $validator = Validator::make($request->all(), [
        'IdVuelo' => 'required|integer|exists:vuelo,IdVuelo',
        'NumeroAsiento' => 'required|string|max:10|unique:asientos,NumeroAsiento,' . $id . ',idAsiento,idVuelo,' . $request->IdVuelo,
        'Clase' => 'nullable|string|max:45',
        'Estado' => 'nullable|string|max:45',
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    $data = [
        'idVuelo' => $request->IdVuelo, // Convertir mayúscula a minúscula
        'NumeroAsiento' => $request->NumeroAsiento,
        'Clase' => $request->Clase,
        'Estado' => $request->Estado
    ];
    
    Asiento::actualizar($id, $data);

    return redirect()->route('asientos.index')->with('success', 'Asiento actualizado exitosamente.');
}
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Asiento::eliminar($id);
        return redirect()->route('asientos.index')->with('success', 'Asiento eliminado exitosamente.');
    }

        /**
         * Get available seats for a specific flight
         */
        public function getAvailableSeats(Request $request)
        {
            try {
                $idVuelo = $request->query('idVuelo');

                if (!$idVuelo) {
                    return response()->json(['error' => 'ID de vuelo requerido'], 400);
                }

                // Obtener todos los asientos del vuelo usando el método del modelo
                // Si tu modelo usa stored procedures, usa esto:
                $allSeats = Asiento::listar(); // Obtener todos los asientos
                
                // Filtrar solo los asientos de este vuelo
                $flightSeats = array_filter($allSeats, function($asiento) use ($idVuelo) {
                    return $asiento->idVuelo == $idVuelo;
                });

                // Define all possible seats in the airplane
                $allPossibleSeats = [
                    '1A', '1B', '1C', '1D', // Primera clase
                    '2A', '2B', '2C', '2D', // Clase ejecutiva
                    '3A', '3B', '3C', '3D', // Clase ejecutiva
                    '4A', '4B', '4C', '4D', '4E', '4F', // Clase económica
                    '5A', '5B', '5C', '5D', '5E', '5F', // Clase económica
                    '6A', '6B', '6C', '6D', '6E', '6F'  // Clase económica
                ];

                // Get existing seat numbers
                $existingSeats = array_map(function($asiento) {
                    return $asiento->NumeroAsiento;
                }, $flightSeats);

                // Available seats are those not in the database
                $available = array_diff($allPossibleSeats, $existingSeats);

                // Occupied seats are those that exist in the database
                $occupied = array_intersect($allPossibleSeats, $existingSeats);

                \Log::info('Asientos disponibles cargados', [
                    'idVuelo' => $idVuelo,
                    'disponibles' => count($available),
                    'ocupados' => count($occupied)
                ]);

                return response()->json([
                    'available' => array_values($available),
                    'occupied' => array_values($occupied)
                ]);

            } catch (\Exception $e) {
                \Log::error('Error en getAvailableSeats: ' . $e->getMessage(), [
                    'trace' => $e->getTraceAsString()
                ]);

                return response()->json([
                    'error' => 'Error al cargar asientos',
                    'message' => $e->getMessage()
                ], 500);
            }
        }

        /**
         * Alias para compatibilidad
         */
        public function availableSeats(Request $request)
        {
            return $this->getAvailableSeats($request);
        }
}
