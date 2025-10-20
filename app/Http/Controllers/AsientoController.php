<?php

namespace App\Http\Controllers;

use App\Models\Asiento;
use App\Models\Vuelo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        return view('asientos.create', compact('vuelos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'idVuelo' => 'required|integer|exists:vuelos,idVuelo',
            'NumeroAsiento' => 'required|string|max:10|unique:asientos,NumeroAsiento,NULL,idAsiento,idVuelo,' . $request->idVuelo,
            'Clase' => 'nullable|string|max:45',
            'Estado' => 'nullable|string|max:45',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->only(['idVuelo', 'NumeroAsiento', 'Clase', 'Estado']);
        Asiento::insertar($data);

        return redirect()->route('asientos.index')->with('success', 'Asiento creado exitosamente.');
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
            'idVuelo' => 'required|integer|exists:vuelos,idVuelo',
            'NumeroAsiento' => 'required|string|max:10|unique:asientos,NumeroAsiento,' . $id . ',idAsiento,idVuelo,' . $request->idVuelo,
            'Clase' => 'nullable|string|max:45',
            'Estado' => 'nullable|string|max:45',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->only(['idVuelo', 'NumeroAsiento', 'Clase', 'Estado']);
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
        $idVuelo = $request->query('idVuelo');

        if (!$idVuelo) {
            return response()->json(['error' => 'ID de vuelo requerido'], 400);
        }

        // Get all seats for the flight
        $allSeats = Asiento::where('idVuelo', $idVuelo)->get();

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
        $existingSeats = $allSeats->pluck('NumeroAsiento')->toArray();

        // Available seats are those not in the database
        $available = array_diff($allPossibleSeats, $existingSeats);

        // Occupied seats are those that exist in the database
        $occupied = array_intersect($allPossibleSeats, $existingSeats);

        return response()->json([
            'available' => array_values($available),
            'occupied' => array_values($occupied)
        ]);
    }
}
