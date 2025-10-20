<?php

namespace App\Http\Controllers;

use App\Models\Avion;
use App\Models\Aerolinea;
use Illuminate\Http\Request;

class AvionController extends Controller
{
    // Listar aviones
    public function Listar()
    {
        $aviones = Avion::with('aerolinea')->get(); // traemos info de la aerolinea
        return view('Avion.Listar', compact('aviones'));
    }

    // Mostrar formulario para crear avión
    public function create()
    {
        $aerolineas = Aerolinea::all(); // para el combo box
        return view('Avion.Create', compact('aerolineas'));
    }

    // Mostrar detalles de un avión
    public function show(Avion $avion)
    {
        return view('Avion.Show', compact('avion'));
    }

    // Mostrar formulario para editar avión
    public function edit(Avion $avion)
    {
        $aerolineas = Aerolinea::all(); // para el combo box
        return view('Avion.Edit', compact('avion', 'aerolineas'));
    }

    // Mostrar confirmación para eliminar avión
    public function delete(Avion $avion)
    {
        return view('Avion.Delete', compact('avion'));
    }

    // Guardar avión
    public function store(Request $request)
    {
        $request->validate([
            'IdAerolinea' => 'required|max:20',
            'Tipo' => 'required|max:50',
            'Modelo' => 'required|max:50',
            'Capacidad' => 'required|integer',
            'Estado' => 'nullable|max:50',
        ]);

        // Generar ID automático: letras y números
        $idAvion = $this->generateIdAvion();
        // Generar placa automática: letras y números
        $placa = $this->generatePlaca();
        $request->merge(['IdAvion' => $idAvion, 'Placa' => $placa]);

        Avion::create($request->all());

        return redirect()->route('avion.listar')->with('success', 'Avión creado correctamente');
    }

    // Método para generar ID automático
    private function generateIdAvion()
    {
        do {
            $letters = strtoupper(substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 3));
            $numbers = str_pad(rand(0, 999), 3, '0', STR_PAD_LEFT);
            $idAvion = $letters . $numbers;
        } while (Avion::where('IdAvion', $idAvion)->exists());

        return $idAvion;
    }

    // Método para generar placa automática
    private function generatePlaca()
    {
        do {
            $letters = strtoupper(substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 3));
            $numbers = str_pad(rand(0, 999), 3, '0', STR_PAD_LEFT);
            $placa = $letters . $numbers;
        } while (Avion::where('Placa', $placa)->exists());

        return $placa;
    }

    // Actualizar avión
    public function update(Request $request, Avion $avion)
    {
        $request->validate([
            'IdAerolinea' => 'required|max:20',
            'Tipo' => 'required|max:50',
            'Modelo' => 'required|max:50',
            'Capacidad' => 'required|integer',
            'Estado' => 'nullable|max:50',
        ]);

        // Mantener la placa existente, no cambiar
        $request->merge(['Placa' => $avion->Placa]);

        $avion->update($request->all());

        return redirect()->route('avion.listar')->with('success', 'Avión actualizado correctamente');
    }

    // Eliminar avión
    public function destroy(Avion $avion)
    {
        $avion->delete();

        return redirect()->route('avion.listar')->with('success', 'Avión eliminado correctamente');
    }
}
