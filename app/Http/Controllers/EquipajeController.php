<?php

namespace App\Http\Controllers;

use App\Models\Equipaje;
use App\Models\Boleto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EquipajeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $equipajes = Equipaje::listar();
        return view('equipajes.index', compact('equipajes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Obtener boleto creado en el paso anterior
        $boletoCreado = null;
        if (session()->has('boleto_creado')) {
            $boletoCreado = Boleto::obtenerPorId(session('boleto_creado'));
            if (!empty($boletoCreado)) {
                $boletoCreado = $boletoCreado[0];
            }
        }

        $boletos = Boleto::listar();
        return view('equipajes.create', compact('boletos', 'boletoCreado'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'idBoleto' => 'required|integer|exists:boletos,idBoleto',
            'Costo' => 'required|numeric|min:0',
            'Dimensiones' => 'required|string|max:45|regex:/^[0-9x\s]+$/',
            'Peso' => 'required|numeric|min:0',
            'Estado' => 'required|string|max:10',
        ]);

        $data = $request->all();

        // Calcular CostoExtra basado en peso: 23kg = $30
        $peso = $data['Peso'];
        $data['CostoExtra'] = ($peso / 23) * 30;

        // Calcular Monto total: Costo + CostoExtra
        $data['Monto'] = $data['Costo'] + $data['CostoExtra'];

        // Generar ID automático para equipaje
        $data['idEquipaje'] = DB::select('SELECT COALESCE(MAX(idEquipaje), 0) + 1 as next_id FROM equipajes')[0]->next_id;

        Equipaje::insertar($data);

        // Agregar el monto del equipaje al total acumulado de la reserva
        $totalAcumulado = session('total_acumulado', 0);
        $totalAcumulado += $data['Monto'];
        session(['total_acumulado' => $totalAcumulado]);

        // Verificar si se presionó el botón "Siguiente: Servicios"
        if ($request->input('action') === 'next') {
            // Redirigir a servicios
            return redirect()->route('servicios.create')->with('success', 'Equipaje registrado exitosamente. Ahora selecciona los servicios adicionales.');
        }

        return redirect()->route('equipajes.index')->with('success', 'Equipaje creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $equipaje = Equipaje::obtenerPorId($id);
        if (empty($equipaje)) {
            abort(404);
        }
        $equipaje = $equipaje[0];
        return view('equipajes.show', compact('equipaje'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $equipaje = Equipaje::obtenerPorId($id);
        if (empty($equipaje)) {
            abort(404);
        }
        $equipaje = $equipaje[0];
        $boletos = Boleto::listar();
        return view('equipajes.edit', compact('equipaje', 'boletos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'idBoleto' => 'required|integer|exists:boletos,idBoleto',
            'Costo' => 'required|numeric|min:0',
            'Dimensiones' => 'required|string|max:45|regex:/^[0-9x\s]+$/',
            'Peso' => 'required|numeric|min:0',
            'Estado' => 'required|string|max:10',
        ]);

        $data = $request->all();

        // Calcular CostoExtra basado en peso: 23kg = $30
        $peso = $data['Peso'];
        $data['CostoExtra'] = ($peso / 23) * 30;

        // Calcular Monto total: Costo + CostoExtra
        $data['Monto'] = $data['Costo'] + $data['CostoExtra'];

        Equipaje::actualizar($id, $data);

        return redirect()->route('equipajes.index')->with('success', 'Equipaje actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Equipaje::eliminar($id);

        return redirect()->route('equipajes.index')->with('success', 'Equipaje eliminado exitosamente.');
    }
}
