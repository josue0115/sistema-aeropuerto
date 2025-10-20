<?php

namespace App\Http\Controllers;

use App\Models\TipoServicio;
use Illuminate\Http\Request;

class TipoServicioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tipoServicios = TipoServicio::listar();
        return view('tipo_servicios.index', compact('tipoServicios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tipo_servicios.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'Nombre' => 'required|string|max:50|unique:tipo_servicio,Nombre',
            'Costo' => 'required|numeric|min:0',
            'Descripcion' => 'nullable|string',
        ]);

        TipoServicio::insertar($request->all());

        return redirect()->route('tipo_servicios.index')->with('success', 'Tipo de Servicio creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $tipoServicio = TipoServicio::obtenerPorId($id);
        if (empty($tipoServicio)) {
            abort(404);
        }
        return view('tipo_servicios.show', compact('tipoServicio'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $tipoServicio = TipoServicio::obtenerPorId($id);
        if (empty($tipoServicio)) {
            abort(404);
        }
        return view('tipo_servicios.edit', compact('tipoServicio'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'Nombre' => 'required|string|max:50|unique:tipo_servicio,Nombre,' . $id . ',idTipoServicio',
            'Costo' => 'required|numeric|min:0',
            'Descripcion' => 'nullable|string',
        ]);

        TipoServicio::actualizar($id, $request->all());

        return redirect()->route('tipo_servicios.index')->with('success', 'Tipo de Servicio actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        TipoServicio::eliminar($id);

        return redirect()->route('tipo_servicios.index')->with('success', 'Tipo de Servicio eliminado exitosamente.');
    }
}
