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
    public function create()
    {
        // Recibir datos de búsqueda desde sessionStorage o parámetros GET
        $busquedaData = session('busquedaVuelos', []);
        if (empty($busquedaData) && request()->has('cantidadPersonas')) {
            $busquedaData = [
                'pasajeros' => request()->get('cantidadPersonas')
            ];
        }

        return view('pasajeros.create', compact('busquedaData'));
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

        foreach ($request->pasajeros as $pasajeroData) {
            // Remove idPasajero if present, let DB auto-increment
            unset($pasajeroData['idPasajero']);
            Pasajero::insertar($pasajeroData);
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
