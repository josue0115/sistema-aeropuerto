<?php

namespace App\Http\Controllers;

use App\Models\Aerolinea;
use Illuminate\Http\Request;

class AerolineaController extends Controller
{
    // Mostrar la lista de aerolineas
    public function Listar()
    {
        $aerolineas = Aerolinea::all();
        return view('Aerolinea.Listar', compact('aerolineas'));
    }

    // Mostrar formulario para crear aerolinea
    public function create()
    {
        return view('aerolinea.Create');
    }

    // Mostrar detalles de una aerolinea
    public function show(Aerolinea $aerolinea)
    {
        return view('aerolinea.Show', compact('aerolinea'));
    }

    // Mostrar formulario para editar aerolinea
    public function edit(Aerolinea $aerolinea)
    {
        return view('aerolinea.Edit', compact('aerolinea'));
    }

    // Mostrar confirmación para eliminar aerolinea
    public function delete(Aerolinea $aerolinea)
    {
        return view('aerolinea.Delete', compact('aerolinea'));
    }

    // Crear IATA automático con letras y números
    private function generarIataAerolinea()
    {
        // Generar IATA: 2 letras + 1 número + 1 letra (ej: AB1C)
        $letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $iata = $letters[rand(0, 25)] . $letters[rand(0, 25)] . rand(0, 9) . $letters[rand(0, 25)];

        // Verificar que no exista
        while (Aerolinea::where('IdAerolinea', $iata)->exists()) {
            $iata = $letters[rand(0, 25)] . $letters[rand(0, 25)] . rand(0, 9) . $letters[rand(0, 25)];
        }

        return $iata;
    }

    // Guardar
    public function store(Request $request)
    {
        $request->validate([
            'NombreAerolinea' => 'required|max:50',
            'Pais' => 'nullable|max:10',
            'Ciudad' => 'nullable|max:50',
            'Estado' => 'nullable|max:10',
        ]);

        Aerolinea::create([
            'IdAerolinea' => $this->generarIataAerolinea(),
            'NombreAerolinea' => $request->NombreAerolinea,
            'Pais' => $request->Pais,
            'Ciudad' => $request->Ciudad,
            'Estado' => $request->Estado
        ]);

        return redirect()->route('aerolinea.Listar')->with('success', 'Aerolínea creada correctamente');
    }

    // Actualizar
    public function update(Request $request, Aerolinea $aerolinea)
    {
        $request->validate([
            'NombreAerolinea' => 'required|max:50',
            'Pais' => 'nullable|max:10',
            'Ciudad' => 'nullable|max:50',
            'Estado' => 'nullable|max:10',
        ]);

        $aerolinea->update($request->except('IdAerolinea'));
        return redirect()->route('aerolinea.Listar')->with('success', 'Aerolínea actualizada correctamente');
    }

    // Eliminar
    public function destroy(Aerolinea $aerolinea)
    {
        $aerolinea->delete();
        return redirect()->route('aerolinea.Listar')->with('success', 'Aerolínea eliminada correctamente');
    }
}
