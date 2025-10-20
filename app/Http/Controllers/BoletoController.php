<?php

namespace App\Http\Controllers;

use App\Models\Boleto;
use App\Models\Pasajero;
use App\Models\Vuelo;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class BoletoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $boletos = Boleto::listar();
        return view('boletos.index', compact('boletos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pasajeros = Pasajero::listar();
        //$vuelos = Vuelo::listar();
        $vuelos = Vuelo::with(['aeropuertoOrigen', 'aeropuertoDestino'])->get();

        return view('boletos.create', compact('pasajeros', 'vuelos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'idBoleto' => 'nullable|integer|unique:boletos,idBoleto',
            'idVuelo' => 'required|integer',
            'idPasajero' => 'required|integer',
            'FechaCompra' => 'required|date',
            'Precio' => 'required|numeric',
            'Cantidad' => 'required|numeric',
            'Descuento' => 'nullable|numeric',
            'Impuesto' => 'nullable|numeric',
            'Total' => 'required|numeric',
        ]);

        $data = $request->all();

        // Generar ID único si no se proporciona
        if (empty($data['idBoleto'])) {
            $data['idBoleto'] = rand(100000, 999999);
        }

        Boleto::insertar($data);

        // Redirigir a la lista con mensaje de éxito
        return redirect()->route('boletos.index')->with('success', 'Boleto creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show($boleto)
    {
        $id = is_object($boleto) ? $boleto->idBoleto : $boleto;
        $boletoData = Boleto::obtenerPorId($id);
        if (empty($boletoData)) {
            abort(404);
        }
        return view('boletos.show', compact('boletoData'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(string $id)
    // {
    //     $boleto = Boleto::obtenerPorId($id);
    //     if (empty($boleto)) {
    //         abort(404);
    //     }
    //     return view('boletos.edit', compact('boleto'));
    // }
    public function edit($boleto)
    {
        return view('boletos.edit', compact('boleto'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $boleto)
    {
        $id = is_object($boleto) ? $boleto->idBoleto : $boleto;
       $validatedData = $request->validate([
            'idVuelo' => 'nullable|integer',
            'idPasajero' => 'nullable|integer',
            'FechaCompra' => 'nullable|date',
            'Precio' => 'nullable|numeric',
            'Cantidad' => 'nullable|numeric',
            'Descuento' => 'nullable|numeric',
            'Impuesto' => 'nullable|numeric',
            'Total' => 'required|numeric',
        ]);

        // $data = $request->all();
        // $data['Total'] = ($data['Precio'] * $data['Cantidad']) - $data['Descuento'] + $data['Impuesto'];

        Boleto::actualizar($id, $validatedData);

        return redirect()->route('boletos.index')->with('success', 'Boleto actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Boleto::eliminar($id);
        return redirect()->route('boletos.index')->with('success', 'Boleto eliminado exitosamente.');
    }

    /**
     * Generate PDF for the specified boleto.
     */
    public function generatePdf($boleto)
    {
        $id = is_object($boleto) ? $boleto->idBoleto : $boleto;
        $boletoData = Boleto::obtenerPorId($id);
        if (empty($boletoData)) {
            abort(404);
        }

        // Obtener datos adicionales si es necesario (pasajero, vuelo, etc.)
        $pasajero = Pasajero::obtenerPorId($boletoData[0]->idPasajero);
        $vuelo = Vuelo::obtenerPorId($boletoData[0]->idVuelo);

        $data = [
            'boleto' => $boletoData[0],
            'pasajero' => $pasajero[0] ?? null,
            'vuelo' => $vuelo[0] ?? null,
        ];

        $pdf = Pdf::loadView('boletos.pdf', $data);

        return $pdf->download('boleto_' . $id . '.pdf');
    }
}
