<?php

namespace App\Http\Controllers;

use App\Models\Aeropuerto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AeropuertoController extends Controller
{

    public function index()
    {
        $aeropuertos = Aeropuerto::listar();
        return view('aeropuertos.index', compact('aeropuertos'));
    }

    // Mostrar la lista de aeropuertos
    public function Listar()
    {
        $aeropuertos = Aeropuerto::all();
        // La vista está en resources/views/Aeropuerto/Listar.blade.php
        return view('Aeropuerto.Listar', compact('aeropuertos'));
    }

    // Mostrar formulario para crear aeropuerto
    public function create()
    {
        return view('Aeropuerto.Create');
    }

    // Mostrar detalles de un aeropuerto
    public function show(Aeropuerto $aeropuerto)
    {
        return view('Aeropuerto.show', compact('aeropuerto'));
    }

    // Mostrar formulario para editar aeropuerto
    public function edit(Aeropuerto $aeropuerto)
    {
        return view('Aeropuerto.Edit', compact('aeropuerto'));
    }

    // Mostrar confirmación para eliminar aeropuerto
    public function delete(Aeropuerto $aeropuerto)
    {
        return view('Aeropuerto.Delete', compact('aeropuerto'));
    }

    // Guardar un nuevo aeropuerto desde el modal
    public function store(Request $request)
    {
        $request->validate([
            'NombreAeropuerto' => 'required|max:50',
            'Pais' => 'required|max:10',
            'Ciudad' => 'required|max:50',
            'Estado' => 'required|max:10',
        ]);

        // Generar IATA automáticamente: 3 letras + 3 números
        $iata = strtoupper(substr(md5(uniqid()), 0, 3)) . rand(100, 999);

        $data = $request->all();
        $data['IdAeropuerto'] = $iata;

        Aeropuerto::create($data);

        // Redirige a la misma página de Listar usando la ruta con nombre
        return redirect()->route('aeropuertos.listar')
                         ->with('success', 'Aeropuerto creado correctamente');
    }

    // Actualizar un aeropuerto desde el modal
    public function update(Request $request, Aeropuerto $aeropuerto)
    {
        $request->validate([
            'NombreAeropuerto' => 'required|max:50',
            'Pais' => 'nullable|max:10',
            'Ciudad' => 'nullable|max:50',
            'Estado' => 'nullable|max:10',
        ]);

        $aeropuerto->update($request->except('IdAeropuerto'));

        return redirect()->route('aeropuertos.listar')
                         ->with('success', 'Aeropuerto actualizado correctamente');
    }

    // Eliminar un aeropuerto
    public function destroy(Aeropuerto $aeropuerto)
    {
        // Crear backup en JSON antes de eliminar
        $backupData = [
            'IdAeropuerto' => $aeropuerto->IdAeropuerto,
            'NombreAeropuerto' => $aeropuerto->NombreAeropuerto,
            'Pais' => $aeropuerto->Pais,
            'Ciudad' => $aeropuerto->Ciudad,
            'Estado' => $aeropuerto->Estado,
            'created_at' => $aeropuerto->created_at,
            'updated_at' => $aeropuerto->updated_at,
            'deleted_at' => now(),
            'deleted_by' => 'Sistema',
            'action' => 'DELETE'
        ];

        $filename = 'aeropuerto_backup_' . $aeropuerto->IdAeropuerto . '_' . now()->format('Y-m-d_H-i-s') . '.json';
        $path = base_path('backup/' . $filename);

        // Asegurar que el directorio existe
        $directory = dirname($path);
        if (!is_dir($directory)) {
            mkdir($directory, 0755, true);
        }

        file_put_contents($path, json_encode($backupData, JSON_PRETTY_PRINT));

        $aeropuerto->delete();

        return redirect()->route('aeropuerto.listar')
                         ->with('success', 'Aeropuerto eliminado correctamente');
    }


}
