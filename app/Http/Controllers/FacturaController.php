<?php

namespace App\Http\Controllers;

use App\Models\Factura;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

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

    /**
     * Generate PDF for the specified factura.
     */
    public function generatePdf($factura)
    {
        $id = is_object($factura) ? $factura->idFactura : $factura;


        $facturaData = Factura::obtenerPorId($id);
        if (empty($facturaData)) {
            abort(404);
        }

        $factura = (array) $facturaData[0];

        // Obtener datos adicionales para la factura
        $boleto = null;
        $pasajero = null;
        $vuelo = null;
        $servicios = [];
        $asiento = null;
        $equipajes = [];

        if ($factura['idBoleto']) {
            // Obtener boleto
            $boletoData = DB::select('CALL Sp_Consulta_Boleto(?)', [$factura['idBoleto']]);
            if (!empty($boletoData)) {
                $boleto = $boletoData[0];

                // Obtener pasajero
                $pasajeroData = DB::select('CALL Sp_Consulta_Pasajero(?)', [$boleto->idPasajero]);
                if (!empty($pasajeroData)) {
                    $pasajero = $pasajeroData[0];
                }

                // Obtener vuelo
                $vueloData = DB::select('
                    SELECT v.*, ao.NombreAeropuerto as aeropuerto_origen, ad.NombreAeropuerto as aeropuerto_destino
                    FROM vuelo v
                    LEFT JOIN aeropuerto ao ON v.IdAeropuertoOrigen = ao.IdAeropuerto
                    LEFT JOIN aeropuerto ad ON v.IdAeropuertoDestino = ad.IdAeropuerto
                    WHERE v.IdVuelo = ?
                ', [$boleto->idVuelo]);

                if (!empty($vueloData)) {
                    $vuelo = $vueloData[0];
                }

                // Obtener servicios del boleto
                $servicios = DB::select('
                    SELECT s.*, ts.Nombre as tipo_servicio, ts.Costo as costo_unitario, (ts.Costo * s.Cantidad) as CostoTotal
                    FROM servicios s
                    JOIN tipo_servicio ts ON s.idTipoServicio = ts.idTipoServicio
                    WHERE s.idBoleto = ?
                ', [$boleto->idBoleto]);

                // Obtener asiento (último del vuelo del boleto)
                $asientos = DB::select('
                    SELECT a.*, v.IdVuelo, v.Precio as precio_vuelo,
                           ao.NombreAeropuerto as aeropuerto_origen, ad.NombreAeropuerto as aeropuerto_destino
                    FROM asientos a
                    JOIN vuelo v ON a.idVuelo = v.IdVuelo
                    LEFT JOIN aeropuerto ao ON v.IdAeropuertoOrigen = ao.IdAeropuerto
                    LEFT JOIN aeropuerto ad ON v.IdAeropuertoDestino = ad.IdAeropuerto
                    WHERE a.idVuelo = ?
                    ORDER BY a.idAsiento DESC LIMIT 1
                ', [$boleto->idVuelo]);

                if (!empty($asientos)) {
                    $asiento = $asientos[0];
                }

                // Obtener equipajes del boleto
                $equipajes = DB::select('
                    SELECT e.*, (e.Costo + e.CostoExtra) as Monto
                    FROM equipajes e
                    WHERE e.idBoleto = ?
                ', [$boleto->idBoleto]);
            }
        }

        $data = [
            'factura' => $factura,
            'boleto' => $boleto,
            'pasajero' => $pasajero,
            'vuelo' => $vuelo,
            'servicios' => $servicios,
            'asiento' => $asiento,
            'equipajes' => $equipajes,
        ];

        $pdf = Pdf::loadView('facturas.pdf', $data);

        return $pdf->download('factura_' . $id . '.pdf');
    }
}
