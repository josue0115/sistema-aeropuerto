<?php

namespace App\Http\Controllers;

use App\Models\Pasajero;
use Illuminate\Http\Request;

class PasajeroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pasajeros = Pasajero::listar();
        return view('pasajeros.index', compact('pasajeros'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // Recibir datos de búsqueda desde sessionStorage o parámetros GET
        $busquedaData = session('busquedaVuelos', []);
        if (empty($busquedaData) && request()->has('cantidadPersonas')) {
            $busquedaData = [
                'pasajeros' => request()->get('cantidadPersonas')
            ];
        }

        // Guardar el vuelo seleccionado en la sesión si viene por parámetro
        if ($request->has('vuelo_id')) {
            session(['vuelo_seleccionado' => $request->vuelo_id]);
        }

        $vueloSeleccionado = null;
        if (session()->has('vuelo_seleccionado')) {
            $vueloSeleccionado = \App\Models\Vuelo::with(['aeropuertoOrigen', 'aeropuertoDestino'])->find(session('vuelo_seleccionado'));
        }

        return view('pasajeros.create', compact('busquedaData', 'vueloSeleccionado'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'pasajeros' => 'required|array|min:1',
            'pasajeros.*.Nombre' => 'required|string|max:45',
            'pasajeros.*.Apellido' => 'required|string|max:45',
            'pasajeros.*.Pais' => 'required|string|max:45',
            'pasajeros.*.TipoPasajero' => 'required|string|max:45',
            'pasajeros.*.Estado' => 'required|string|max:45',
        ]);

        $pasajerosIds = [];
        foreach ($request->pasajeros as $index => $pasajeroData) {
            // Remove idPasajero if present, let DB auto-increment
            unset($pasajeroData['idPasajero']);
            $pasajeroId = Pasajero::insertar($pasajeroData);
            \Log::info("Pasajero {$index} insertado con ID:", ['id' => $pasajeroId]);
            $pasajerosIds[] = $pasajeroId;
        }

        // Guardar los IDs de pasajeros en la sesión para usarlos en boletos
        session(['pasajeros_creados' => $pasajerosIds]);
        \Log::info('Pasajeros guardados en sesión:', ['ids' => $pasajerosIds]);

        // Verificar si el usuario quiere continuar a boletos o solo guardar
        if ($request->input('action') === 'continue_to_boletos') {
            return redirect()->route('boletos.create')->with('success', 'Pasajeros guardados exitosamente. Ahora puede crear los boletos.');
        }

        return redirect()->route('pasajeros.index')->with('success', 'Pasajeros creados exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pasajero = Pasajero::obtenerPorId($id);
        if (empty($pasajero)) {
            abort(404);
        }
        return view('pasajeros.show', compact('pasajero'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pasajero = Pasajero::obtenerPorId($id);
        if (empty($pasajero)) {
            abort(404);
        }
        return view('pasajeros.edit', compact('pasajero'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'Nombre' => 'nullable|string|max:45',
            'Apellido' => 'nullable|string|max:45',
            'Pais' => 'nullable|string|max:45',
            'TipoPasajero' => 'nullable|string|max:45',
            'Estado' => 'nullable|string|max:45',
        ]);

        Pasajero::actualizar($id, $request->all());

        return redirect()->route('pasajeros.index')->with('success', 'Pasajero actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Pasajero::eliminar($id);
        return redirect()->route('pasajeros.index')->with('success', 'Pasajero eliminado exitosamente.');
    }
}
