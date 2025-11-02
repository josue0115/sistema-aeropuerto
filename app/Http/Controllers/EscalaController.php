<?php

namespace App\Http\Controllers;

use App\Models\Escala;
use App\Models\Vuelo;
use App\Models\Aeropuerto;
use Illuminate\Http\Request;

class EscalaController extends Controller
{
    // Mostrar la lista de escalas
    public function index()
    {
        $escalas = Escala::with('vuelo', 'aeropuerto')->get();
        return view('Escala.Listar', compact('escalas'));
    }

    // Mostrar formulario para crear escala
    public function create()
    {
        $vuelos = Vuelo::with('aeropuertoOrigen', 'aeropuertoDestino')->get();
        $aeropuertos = Aeropuerto::all();
        return view('Escala.Create', compact('vuelos', 'aeropuertos'));
    }

    // Mostrar detalles de una escala
    public function show(Escala $escala)
    {
        $escala->load('vuelo', 'aeropuerto');
        return view('Escala.Show', compact('escala'));
    }

    // Mostrar formulario para editar escala
    public function edit(Escala $escala)
    {
        $escala->load('vuelo', 'aeropuerto');
        $vuelos = Vuelo::with('aeropuertoOrigen', 'aeropuertoDestino')->get();
        $aeropuertos = Aeropuerto::all();
        return view('Escala.Edit', compact('escala', 'vuelos', 'aeropuertos'));
    }

    // Mostrar formulario para eliminar escala
    public function delete(Escala $escala)
    {
        $escala->load('vuelo', 'aeropuerto');
        return view('Escala.Delete', compact('escala'));
    }

    // Guardar una nueva escala
    public function store(Request $request)
    {
        $request->validate([
            'IdVuelo' => 'required|exists:vuelo,IdVuelo',
            'IdAeropuerto' => 'required|exists:aeropuerto,IdAeropuerto',
            'HoraSalida' => 'required|date_format:H:i',
            'HoraLlegada' => 'required|date_format:H:i|after:HoraSalida',
            'TiempoEspera' => 'required|integer|min:0',
            'Estado' => 'required|string|max:50',
        ], [
            'HoraLlegada.after' => 'La hora de llegada debe ser posterior a la hora de salida.',
        ]);

        Escala::create($request->all());

        return redirect()->route('escala.index')
                         ->with('success', 'Escala created successfully');
    }

    // Actualizar una escala
    public function update(Request $request, Escala $escala)
    {
        $request->validate([
            'IdVuelo' => 'required|exists:vuelo,IdVuelo',
            'IdAeropuerto' => 'required|exists:aeropuerto,IdAeropuerto',
            'HoraSalida' => 'required|date_format:H:i',
            'HoraLlegada' => 'required|date_format:H:i|after:HoraSalida',
            'TiempoEspera' => 'required|integer|min:0',
            'Estado' => 'required|string|max:50',
        ], [
            'HoraLlegada.after' => 'La hora de llegada debe ser posterior a la hora de salida.',
        ]);

        $escala->update($request->all());

        return redirect()->route('escala.index')
                         ->with('success', 'Escala updated successfully');
    }

    // Eliminar una escala
    public function destroy(Escala $escala)
    {
        $escala->delete();

        return redirect()->route('escala.delete')
                         ->with('success', 'Escala deleted successfully');
    }
}
