<?php

namespace App\Http\Controllers;

use App\Models\Boleto;
use App\Models\Pasajero;
use App\Models\Vuelo;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class BoletoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $boletos = Boleto::listar();
        return view('boletos.index', compact('boletos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Obtener pasajeros creados en el paso anterior
        $pasajerosCreados = session('pasajeros_creados', []);
        \Log::info('Pasajeros creados en sesión:', ['ids' => $pasajerosCreados]);

        if (!empty($pasajerosCreados)) {
            // Usar stored procedure para obtener los pasajeros por IDs
            $pasajeros = [];
            foreach ($pasajerosCreados as $id) {
                $result = Pasajero::obtenerPorId($id);
                if (!empty($result)) {
                    $pasajeros[] = $result[0];
                }
            }
            \Log::info('Pasajeros encontrados:', ['count' => count($pasajeros)]);
        } else {
            // Si no hay pasajeros creados, mostrar todos usando stored procedure
            $pasajeros = Pasajero::listar();
            \Log::info('Mostrando todos los pasajeros:', ['count' => count($pasajeros)]);
        }

        // Obtener vuelo seleccionado
        $vueloSeleccionado = null;
        if (session()->has('vuelo_seleccionado')) {
            $vueloSeleccionado = Vuelo::with(['aeropuertoOrigen', 'aeropuertoDestino'])->find(session('vuelo_seleccionado'));
        }

        $vuelos = Vuelo::with(['aeropuertoOrigen', 'aeropuertoDestino'])->get();

        // Cantidad por defecto basada en el número de pasajeros creados
        $cantidadDefault = count($pasajerosCreados);

        return view('boletos.create', compact('pasajeros', 'vuelos', 'vueloSeleccionado', 'cantidadDefault'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'idBoleto' => 'nullable|integer|unique:boletos,idBoleto',
                'idVuelo' => 'required|integer',
                'idPasajero' => 'required|integer',
                'FechaCompra' => 'required|date',
                'Precio' => 'required|numeric',
                'Cantidad' => 'required|numeric',
                'Descuento' => 'nullable|numeric',
                'Impuesto' => 'nullable|numeric',
                'Total' => 'required|numeric',
            ]);

            $data = $request->all();

            // Generar ID único si no se proporciona
            if (empty($data['idBoleto'])) {
                $data['idBoleto'] = rand(100000, 999999);
            }

            $boletoId = Boleto::insertar($data);

            // Sumar el total del boleto al total acumulado en la sesión
            $totalActual = session('total_acumulado', 0);
            session(['total_acumulado' => $totalActual + $data['Total']]);

            // Verificar si se presionó el botón "Siguiente: Servicios"
            if ($request->input('action') === 'next') {
                // Guardar el ID del boleto creado en la sesión
                session(['boleto_creado' => $boletoId]);

                // Retornar JSON con el ID del boleto para AJAX
                return response()->json(['boleto_id' => $boletoId]);
            }

            // Redirigir a la lista con mensaje de éxito
            return redirect()->route('boletos.index')->with('success', 'Boleto creado exitosamente.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'errors' => $e->errors(),
                    'message' => 'Errores de validación'
                ], 422);
            }
            throw $e;
        } catch (\Exception $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'Error interno del servidor',
                    'error' => $e->getMessage()
                ], 500);
            }
            throw $e;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($boleto)
    {
        $id = is_object($boleto) ? $boleto->idBoleto : $boleto;
        $boletoData = Boleto::obtenerPorId($id);
        if (empty($boletoData)) {
            abort(404);
        }
        return view('boletos.show', compact('boletoData'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(string $id)
    // {
    //     $boleto = Boleto::obtenerPorId($id);
    //     if (empty($boleto)) {
    //         abort(404);
    //     }
    //     return view('boletos.edit', compact('boleto'));
    // }
    public function edit($boleto)
    {
        return view('boletos.edit', compact('boleto'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $boleto)
    {
        $id = is_object($boleto) ? $boleto->idBoleto : $boleto;
       $validatedData = $request->validate([
            'idVuelo' => 'nullable|integer',
            'idPasajero' => 'nullable|integer',
            'FechaCompra' => 'nullable|date',
            'Precio' => 'nullable|numeric',
            'Cantidad' => 'nullable|numeric',
            'Descuento' => 'nullable|numeric',
            'Impuesto' => 'nullable|numeric',
            'Total' => 'required|numeric',
        ]);

        // $data = $request->all();
        // $data['Total'] = ($data['Precio'] * $data['Cantidad']) - $data['Descuento'] + $data['Impuesto'];

        Boleto::actualizar($id, $validatedData);

        return redirect()->route('boletos.index')->with('success', 'Boleto actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Boleto::eliminar($id);
        return redirect()->route('boletos.index')->with('success', 'Boleto eliminado exitosamente.');
    }

    /**
     * Generate PDF for the specified boleto.
     */
    public function generatePdf($boleto)
    {
        $id = is_object($boleto) ? $boleto->idBoleto : $boleto;
        $boletoData = Boleto::obtenerPorId($id);
        if (empty($boletoData)) {
            abort(404);
        }

        // Obtener datos adicionales si es necesario (pasajero, vuelo, etc.)
        $pasajero = Pasajero::obtenerPorId($boletoData[0]->idPasajero);
        $vuelo = Vuelo::with(['aeropuertoOrigen', 'aeropuertoDestino', 'avion'])->find($boletoData[0]->idVuelo);

        $data = [
            'boleto' => $boletoData[0],
            'pasajero' => $pasajero[0] ?? null,
            'vuelo' => $vuelo,
        ];

        $pdf = Pdf::loadView('boletos.pdf', $data);

        return $pdf->download('boleto_' . $id . '.pdf');
    }
}
