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
        $iataPreview = $this->generarIataAerolinea();
        return view('aerolinea.Create', compact('iataPreview'));
    }

    // Mostrar detalles de una aerolinea
    public function show(Aerolinea $aerolinea)
    {
        return view('aerolinea.Show', compact('aerolinea'));
    }

    // Mostrar formulario para editar aerolinea
    public function edit(Aerolinea $aerolinea)
    {
        return view('Aerolinea.Edit', compact('aerolinea'));
    }

    // Mostrar confirmación para eliminar aerolinea
    public function delete(Aerolinea $aerolinea)
    {
        return view('Aerolinea.Delete', compact('aerolinea'));
    }

    // Crear IATA automático con letras y números
    private function generarIataAerolinea()
    {
        // Generar IATA: 2 letras + 1 número + 1 letra (ej: AB1C)
        $letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $iata = $letters[rand(0, 25)] . $letters[rand(0, 25)] . rand(0, 9) . $letters[rand(0, 25)];

        // Verificar que no exista en el campo IATA
        while (Aerolinea::where('IATA', $iata)->exists()) {
            $iata = $letters[rand(0, 25)] . $letters[rand(0, 25)] . rand(0, 9) . $letters[rand(0, 25)];
        }

        return $iata;
    }

    // Guardar
    public function store(Request $request)
    {
        $request->validate([
            'Nombre' => 'required|max:50',
            'Ciudad' => 'nullable|max:50',
            'Pais' => 'nullable|max:50',
            'Estado' => 'nullable|max:10',
        ]);

        $iata = $this->generarIataAerolinea();

        Aerolinea::create([
            'Nombre' => $request->Nombre,
            'IATA' => $iata,
            'Ciudad' => $request->Ciudad,
            'Pais' => $request->Pais,
            'Estado' => $request->Estado
        ]);

        return redirect()->route('aerolinea.Listar')->with('success', 'Aerolínea creada correctamente');
    }

    // Actualizar
    public function update(Request $request, Aerolinea $aerolinea)
    {
        $request->validate([
            'Nombre' => 'required|max:50',
            //'IATA' => 'required|max:3|unique:aerolinea,IATA,' . $idaerolinea . ',' . $primaryKeyName,
            //'IATA' => 'required|max:3|unique:aerolinea,IATA,' . $aerolinea->IdAerolinea . ',' . $primaryKeyName,
            
            'IATA' => 'required|max:10|:aerolinea,IATA,' . $aerolinea->IdAerolinea . ',IdAerolinea',
            'Ciudad' => 'nullable|max:50',
            'Pais' => 'nullable|max:50',
            'Estado' => 'nullable|max:10',
        ]);

        $aerolinea->update($request->except(['idAerolinea', 'IATA']));
        return redirect()->route('aerolinea.Listar')->with('success', 'Aerolínea actualizada correctamente');
    }

    // Eliminar
    public function destroy(Aerolinea $aerolinea)
    {
        // Crear backup en JSON antes de eliminar
        $backupData = [
            'IdAerolinea' => $aerolinea->IdAerolinea,
            'NombreAerolinea' => $aerolinea->NombreAerolinea,
            'Pais' => $aerolinea->Pais,
            'Ciudad' => $aerolinea->Ciudad,
            'Estado' => $aerolinea->Estado,
            'created_at' => $aerolinea->created_at,
            'updated_at' => $aerolinea->updated_at,
            'deleted_at' => now(),
            'deleted_by' => 'Sistema',
            'action' => 'DELETE'
        ];

        $filename = 'aerolinea_backup_' . $aerolinea->IdAerolinea . '_' . now()->format('Y-m-d_H-i-s') . '.json';
        $path = base_path('backup/' . $filename);

        // Asegurar que el directorio existe
        $directory = dirname($path);
        if (!is_dir($directory)) {
            mkdir($directory, 0755, true);
        }

        file_put_contents($path, json_encode($backupData, JSON_PRETTY_PRINT));

        $aerolinea->delete();
        return redirect()->route('aerolinea.Listar')->with('success', 'Aerolínea eliminada correctamente');
    }
}
