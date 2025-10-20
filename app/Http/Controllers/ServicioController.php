<?php

namespace App\Http\Controllers;

use App\Models\Servicio;
use App\Models\Boleto;
use App\Models\TipoServicio;
use Illuminate\Http\Request;

class ServicioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $servicios = Servicio::listar();
        return view('servicios.index', compact('servicios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $boletos = Boleto::listar();
        $tipoServicios = TipoServicio::all();
        return view('servicios.create', compact('boletos', 'tipoServicios'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'idBoleto' => 'nullable|integer',
            'idTipoServicio' => 'required|integer|exists:tipo_servicio,idTipoServicio',
            'Fecha' => 'nullable|date',
            'Cantidad' => 'required|numeric|min:0.01',
            'Estado' => 'nullable|string|max:20',
        ]);

        $data = $request->all();

        Servicio::insertar($data);

        return redirect()->route('servicios.index')->with('success', 'Servicio creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $servicio = Servicio::obtenerPorId($id);
        if (empty($servicio)) {
            abort(404);
        }
        return view('servicios.show', compact('servicio'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $servicio = Servicio::obtenerPorId($id);
        if (empty($servicio)) {
            abort(404);
        }
        return view('servicios.edit', compact('servicio'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'idBoleto' => 'nullable|integer',
            'idTipoServicio' => 'nullable|integer',
            'Fecha' => 'nullable|date',
            'Cantidad' => 'nullable|numeric',
            'Estado' => 'nullable|string|max:20',
        ]);

        Servicio::actualizar($id, $request->all());

        return redirect()->route('servicios.index')->with('success', 'Servicio actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Servicio::eliminar($id);

        return redirect()->route('servicios.index')->with('success', 'Servicio eliminado exitosamente.');
    }
}
