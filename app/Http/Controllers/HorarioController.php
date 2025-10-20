<?php

namespace App\Http\Controllers;

use App\Models\Horario;
use App\Models\Vuelo;
use Illuminate\Http\Request;

class HorarioController extends Controller
{
    // Mostrar la lista de horarios
    public function index()
    {
        $horarios = Horario::with('vuelo')->get();
        return view('Horario.Listar', compact('horarios'));
    }

    // Mostrar la lista de horarios (alias para Listar)
    public function Listar()
    {
        return $this->index();
    }

    // Mostrar formulario para crear horario
    public function create()
    {
        $vuelos = Vuelo::all();
        return view('Horario.Create', compact('vuelos'));
    }

    // Mostrar detalles de un horario
    public function show(Horario $horario)
    {
        $horario->load('vuelo');
        return view('Horario.Show', compact('horario'));
    }

    // Mostrar formulario para editar horario
    public function edit(Horario $horario)
    {
        $horario->load('vuelo');
        $vuelos = Vuelo::all();
        return view('Horario.Edit', compact('horario', 'vuelos'));
    }

    // Mostrar formulario para eliminar horario
    public function delete(Horario $horario)
    {
        $horario->load('vuelo');
        return view('Horario.Delete', compact('horario'));
    }

    // Guardar un nuevo horario
    public function store(Request $request)
    {
        $request->validate([
            'IdVuelo' => 'required|exists:vuelo,IdVuelo',
            'HoraSalida' => 'required|date_format:H:i',
            'HoraLlegada' => 'required|date_format:H:i|after:HoraSalida',
            'Estado' => 'required|max:10',
            'TiempoEspera' => 'required|integer|min:0',
        ]);

        Horario::create($request->all());

        return redirect()->route('horario.index')
                         ->with('success', 'Schedule created successfully');
    }

    // Actualizar un horario
    public function update(Request $request, Horario $horario)
    {
        $request->validate([
            'IdVuelo' => 'required|exists:vuelo,IdVuelo',
            'HoraSalida' => 'required|date_format:H:i',
            'HoraLlegada' => 'required|date_format:H:i|after:HoraSalida',
            'Estado' => 'required|max:10',
            'TiempoEspera' => 'required|integer|min:0',
        ]);

        $horario->update($request->all());

        return redirect()->route('horario.index')
                         ->with('success', 'Schedule updated successfully');
    }

    // Eliminar un horario
    public function destroy(Horario $horario)
    {
        $horario->delete();

        return redirect()->route('horario.listar')
                         ->with('success', 'Schedule deleted successfully');
    }
}
