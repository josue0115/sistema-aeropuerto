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
        $aviones = Avion::with('aerolinea')->where('idAvion', '!=', '')->whereNotNull('IdAvion')->get(); // traemos info de la aerolinea, filtrando aviones con IdAvion no vacío y no nulo
        return view('Avion.Listar', compact('aviones'));
    }

    // Mostrar formulario para crear avión
    public function create()
    {
        $placaPreview = $this->generatePlaca();
        $aerolineas = Aerolinea::all(); // para el combo box
        return view('Avion.Create', compact('aerolineas','placaPreview'));
    }

    // Mostrar detalles de un avión
    public function show(Avion $avion)
    {
        $avion->load('aerolinea');
        return view('Avion.Show', compact('avion'));
    }

    // Mostrar formulario para editar avión
    public function edit(Avion $avion)
    {
        // Si ya tiene placa, mostrar la existente; si no, generar preview
        if (empty($avion->Placa)) {
            $placaPreview = $this->generatePlaca();
        } else {
            $placaPreview = $avion->Placa;
        }
        $aerolineas = Aerolinea::all(); // para el combo box
        return view('Avion.Edit', compact('avion', 'aerolineas', 'placaPreview'));
    }

    // Mostrar confirmación para eliminar avión
    public function delete(Avion $avion)
    {
        $avion->load('aerolinea');
        return view('Avion.Delete', compact('avion'));
    }

    // Guardar avión
    public function store(Request $request)
    {
        $request->validate([
            'idAerolinea' => 'required|max:20',
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
            'idAerolinea' => 'required|max:20',
            'Tipo' => 'required|max:50',
            'Modelo' => 'required|max:50',
            'Capacidad' => 'required|integer',
            'Estado' => 'nullable|max:50',
        ]);

        // Generar placa si no tiene, de lo contrario mantener la existente
        if (empty($avion->Placa)) {
            $placa = $this->generatePlaca();
        } else {
            $placa = $avion->Placa;
        }
        $request->merge(['Placa' => $placa]);

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
