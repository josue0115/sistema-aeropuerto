<?php

namespace App\Http\Controllers;

use App\Models\Mantenimiento;
use App\Models\Avion;
use App\Models\Personal;
use Illuminate\Http\Request;

class MantenimientoController extends Controller
{
    // Mostrar la lista de mantenimientos
    public function Listar()
    {
        $mantenimientos = Mantenimiento::with('avion', 'personal')->get();
        return view('Mantenimiento.Listar', compact('mantenimientos'));
    }

    // Mostrar formulario para crear mantenimiento
    public function create()
    {
        $aviones = Avion::all();
        $personales = Personal::all();
        return view('Mantenimiento.Crear', compact('aviones', 'personales'));
    }

    // Mostrar detalles de un mantenimiento
    public function show(Mantenimiento $mantenimiento)
    {
        $mantenimiento->load('avion', 'personal');
        return view('Mantenimiento.Ver', compact('mantenimiento'));
    }

    // Mostrar formulario para editar mantenimiento
    public function edit(Mantenimiento $mantenimiento)
    {
        $mantenimiento->load('avion', 'personal');
        $aviones = Avion::all();
        $personales = Personal::all();
        return view('Mantenimiento.Editar', compact('mantenimiento', 'aviones', 'personales'));
    }

    // Mostrar formulario para eliminar mantenimiento
    public function delete(Mantenimiento $mantenimiento)
    {
        $mantenimiento->load('avion', 'personal');
        return view('Mantenimiento.Eliminar', compact('mantenimiento'));
    }

    // Guardar un nuevo mantenimiento
    public function store(Request $request)
    {
        $request->validate([
            'IdAvion' => 'required|exists:avion,IdAvion',
            'IdPersonal' => 'required|exists:personal,IdPersonal',
            'FechaIngreso' => 'required|date|after_or_equal:today',
            'FechaSalida' => 'required|date|after:FechaIngreso',
            'Tipo' => 'required|max:20',
            'Estado' => 'required|max:10',
            'Descripcion' => 'required|max:45',
            'CostoExtra' => 'nullable|numeric|min:0',
        ]);

        $costo = $this->getCostoByTipo($request->Tipo);
        $request->merge(['Costo' => $costo]);

        Mantenimiento::create($request->all());

        return redirect()->route('mantenimiento.listar')
                         ->with('success', 'Mantenimiento creado correctamente');
    }

    // Actualizar un mantenimiento
    public function update(Request $request, Mantenimiento $mantenimiento)
    {
        $request->validate([
            'IdAvion' => 'required|exists:avion,IdAvion',
            'IdPersonal' => 'required|exists:personal,IdPersonal',
            'FechaIngreso' => 'required|date|after_or_equal:today',
            'FechaSalida' => 'required|date|after:FechaIngreso',
            'Tipo' => 'required|max:20',
            'Estado' => 'required|max:10',
            'Descripcion' => 'required|max:45',
            'CostoExtra' => 'nullable|numeric|min:0',
        ]);

        $costo = $this->getCostoByTipo($request->Tipo);
        $request->merge(['Costo' => $costo]);

        $mantenimiento->update($request->all());

        return redirect()->route('mantenimiento.listar')
                         ->with('success', 'Mantenimiento actualizado correctamente');
    }

    // Eliminar un mantenimiento
    public function destroy(Mantenimiento $mantenimiento)
    {
        $mantenimiento->delete();

        return redirect()->route('mantenimiento.listar')
                         ->with('success', 'Mantenimiento eliminado correctamente');
    }

    // Método para obtener costo basado en tipo
    private function getCostoByTipo($tipo)
    {
        $costos = [
            'Preventivo' => 500.00,
            'Correctivo' => 800.00,
            'Emergencia' => 1200.00,
            'Inspección' => 300.00,
        ];
        return $costos[$tipo] ?? 0.00;
    }
}
