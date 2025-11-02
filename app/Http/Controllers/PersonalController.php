<?php

namespace App\Http\Controllers;

use App\Models\Personal;
use Illuminate\Http\Request;

class PersonalController extends Controller
{
    // Mostrar la lista de personal
    public function Listar()
    {
        $personal = Personal::all();
        return view('Personal.Listar', compact('personal'));
    }

    // Mostrar formulario para crear personal
    public function create()
    {
        return view('Personal.Create');
    }

    // Mostrar detalles de un personal
    public function show(Personal $personal)
    {
        return view('Personal.Show', compact('personal'));
    }

    // Mostrar formulario para editar personal
    public function edit(Personal $personal)
    {
        return view('Personal.Edit', compact('personal'));
    }

    // Mostrar confirmación de eliminación
    public function delete(Personal $personal)
    {
        return view('Personal.Delete', compact('personal'));
    }

    // Guardar nuevo personal
    public function store(Request $request)
    {
        $request->validate([
            'Nombre' => 'required|max:45',
            'Apellido' => 'required|max:15',
            'Cargo' => 'required|max:20',
            'FechaIngreso' => 'required|date|after_or_equal:today',
            'Estado' => 'nullable|max:50',
            'Telefono' => 'required|numeric|digits_between:8,15',
            'Correo' => 'required|email|max:45',
            'Direccion' => 'required|max:45',
        ]);

        // Asignar salario automático basado en cargo
        $salario = $this->getSalarioByCargo($request->Cargo);
        $request->merge(['Salario' => $salario]);

        Personal::create($request->all());

        return redirect()->route('personal.listar')
                         ->with('success', 'Personal creado correctamente');
    }

    // Método para obtener salario basado en cargo
    private function getSalarioByCargo($cargo)
    {
        $salarios = [
            'Piloto' => 5000.00,
            'Copiloto' => 4000.00,
            'Azafata' => 2500.00,
            'Mecánico' => 3000.00,
            'Administrador' => 3500.00,
            'Recepcionista' => 2000.00,
            'Seguridad' => 2200.00,
            'Limpieza' => 1800.00,
        ];

        return $salarios[$cargo] ?? 2000.00; // Salario por defecto si no se encuentra
    }

    // Actualizar personal
    public function update(Request $request, Personal $personal)
    {
        $request->validate([
            'Cargo' => 'required|max:20',
            'FechaIngreso' => 'required|date|after_or_equal:today',
            'Estado' => 'nullable|max:50',
            'Telefono' => 'required|numeric|digits_between:8,15',
            'Correo' => 'required|email|max:45',
            'Direccion' => 'required|max:45',
        ]);

        // Asignar salario automático basado en cargo
        $salario = $this->getSalarioByCargo($request->Cargo);
        $request->merge(['Salario' => $salario]);

        $personal->update($request->except(['Nombre', 'Apellido']));

        return redirect()->route('personal.listar')
                         ->with('success', 'Personal actualizado correctamente');
    }

    // Eliminar personal
    public function destroy(Personal $personal)
    {
        $personal->delete();

        return redirect()->route('personal.listar')
                         ->with('success', 'Personal eliminado correctamente');
    }
}
