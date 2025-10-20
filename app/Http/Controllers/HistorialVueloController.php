<?php

namespace App\Http\Controllers;

use App\Models\HistorialVuelo;
use Illuminate\Http\Request;

class HistorialVueloController extends Controller
{
    // Mostrar lista de historial de vuelos
    public function index()
    {
        $historiales = HistorialVuelo::listar();
        return view('historial_vuelos.index', compact('historiales'));
    }

    // Mostrar formulario para crear nuevo historial
    public function create()
    {
        return view('historial_vuelos.create');
    }

    // Guardar nuevo historial
    public function store(Request $request)
    {
        $request->validate([
            'idhistorial' => 'required|integer',
            'idvuelo' => 'required|integer',
            'idPasajero' => 'required|integer',
            'Fecha' => 'required|date',
            'Detalle' => 'required|string|max:255',
        ]);

        HistorialVuelo::insertar($request->all());

        return redirect()->route('historial_vuelos.index')->with('success', 'Historial de vuelo creado exitosamente.');
    }

    // Mostrar detalles de un historial específico
    public function show($id)
    {
        $historial = HistorialVuelo::obtenerPorId($id);
        return view('historial_vuelos.show', compact('historial'));
    }

    // Mostrar formulario para editar historial
    public function edit($id)
    {
        $historial = HistorialVuelo::obtenerPorId($id);
        return view('historial_vuelos.edit', compact('historial'));
    }

    // Actualizar historial
    public function update(Request $request, $id)
    {
        $request->validate([
            'idhistorial' => 'required|integer',
            'idvuelo' => 'required|integer',
            'idPasajero' => 'required|integer',
            'Fecha' => 'required|date',
            'Detalle' => 'required|string|max:255',
        ]);

        HistorialVuelo::actualizar($id, $request->all());

        return redirect()->route('historial_vuelos.index')->with('success', 'Historial de vuelo actualizado exitosamente.');
    }

    // Eliminar historial
    public function destroy($id)
    {
        HistorialVuelo::eliminar($id);
        return redirect()->route('historial_vuelos.index')->with('success', 'Historial de vuelo eliminado exitosamente.');
    }
}
