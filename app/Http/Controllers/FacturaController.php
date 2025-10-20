<?php

namespace App\Http\Controllers;

use App\Models\Factura;
use Illuminate\Http\Request;

class FacturaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $facturas = Factura::listar();
        return view('facturas.index', compact('facturas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('facturas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'idFactura' => 'required|integer',
            'idBoleto' => 'nullable|integer',
            'FechaEmision' => 'nullable|date',
            'monto' => 'nullable|numeric',
            'impuesto' => 'nullable|numeric',
            'MontoTotal' => 'nullable|numeric',
            'Estado' => 'nullable|string|max:10',
        ]);

        Factura::insertar($request->all());

        return redirect()->route('facturas.index')->with('success', 'Factura creada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $factura = Factura::obtenerPorId($id);
        if (empty($factura)) {
            abort(404);
        }
        return view('facturas.show', compact('factura'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $factura = Factura::obtenerPorId($id);
        if (empty($factura)) {
            abort(404);
        }
        return view('facturas.edit', compact('factura'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'idBoleto' => 'nullable|integer',
            'FechaEmision' => 'nullable|date',
            'monto' => 'nullable|numeric',
            'impuesto' => 'nullable|numeric',
            'MontoTotal' => 'nullable|numeric',
            'Estado' => 'nullable|string|max:10',
        ]);

        Factura::actualizar($id, $request->all());

        return redirect()->route('facturas.index')->with('success', 'Factura actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Factura::eliminar($id);

        return redirect()->route('facturas.index')->with('success', 'Factura eliminada exitosamente.');
    }
}
