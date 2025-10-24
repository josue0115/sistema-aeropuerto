<?php

namespace App\Http\Controllers;

use App\Models\Pago;
use App\Models\Reserva;
use App\Models\Boleto;
use App\Models\Servicio;
use App\Models\Asiento;
use App\Models\Factura;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class PagoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pagos = Pago::listar();
        return view('pagos.index', compact('pagos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Obtener reserva creada en el paso anterior
        $reservaCreada = null;
        if (session()->has('reserva_creada')) {
            $reservaCreada = Reserva::obtenerPorId(session('reserva_creada'));
            if (!empty($reservaCreada)) {
                $reservaCreada = $reservaCreada[0];
            }
        }

        // Obtener detalles de la reserva para mostrar en el resumen
        $detallesPago = $this->obtenerDetallesPago();

        return view('pagos.create', compact('reservaCreada', 'detallesPago'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'numero_tarjeta' => 'required|string|regex:/^\d{16}$/',
            'fecha_expiracion' => 'required|string|regex:/^\d{2}\/\d{2}$/',
            'cvv' => 'required|string|regex:/^\d{3}$/',
            'nombre_titular' => 'required|string|max:100',
        ]);

        // Obtener reserva de la sesión
        $idReserva = session('reserva_creada');
        if (!$idReserva) {
            return redirect()->route('reservas.create')->with('error', 'No se encontró la reserva para procesar el pago.');
        }

        // Obtener total acumulado
        $total = session('total_acumulado', 0);

        // Simular procesamiento de pago
        $referenciaPago = 'PAY_' . time() . '_' . rand(1000, 9999);

        // Crear registro de pago
        $pagoData = [
            'idReserva' => $idReserva,
            'Monto' => $total,
            'MetodoPago' => 'Tarjeta de Crédito',
            'FechaPago' => now()->format('Y-m-d H:i:s'),
            'Estado' => 'Completado',
            'Referencia' => $referenciaPago
        ];

        $pagoId = Pago::insertar($pagoData);

        // Crear factura después del pago exitoso
        $idBoleto = session('boleto_creado');
        $facturaData = null;
        if ($idBoleto) {
            // Calcular impuesto (por ejemplo, 12% IVA)
            $impuesto = $total * 0.12;
            $montoTotal = $total + $impuesto;

            // Generar ID único para la factura
            $idFactura = DB::select('SELECT COALESCE(MAX(idFactura), 0) + 1 as next_id FROM facturas')[0]->next_id;

            $facturaData = [
                'idFactura' => $idFactura,
                'idBoleto' => $idBoleto,
                'FechaEmision' => now()->format('Y-m-d H:i:s'),
                'monto' => $total,
                'impuesto' => $impuesto,
                'MontoTotal' => $montoTotal,
                'Estado' => 'Emitida'
            ];

            Factura::insertar($facturaData);
        }

        // Limpiar sesión después del pago exitoso
        session()->forget([
            'total_acumulado',
            'vuelo_seleccionado',
            'boleto_creado',
            'vuelo_para_asientos',
            'pasajeros_creados',
            'pasajero_seleccionado',
            'reserva_creada'
        ]);

        // Redirigir a la página de éxito que descargará el PDF y luego irá al home
        return redirect()->route('pagos.success', ['idFactura' => $facturaData['idFactura']]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pago = Pago::obtenerPorId($id);
        if (empty($pago)) {
            abort(404);
        }
        return view('pagos.show', compact('pago'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pago = Pago::obtenerPorId($id);
        if (empty($pago)) {
            abort(404);
        }
        return view('pagos.edit', compact('pago'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'idReserva' => 'nullable|integer',
            'Monto' => 'nullable|numeric',
            'MetodoPago' => 'nullable|string|max:50',
            'FechaPago' => 'nullable|date',
            'Estado' => 'nullable|string|max:20',
        ]);

        Pago::actualizar($id, $request->all());

        return redirect()->route('pagos.index')->with('success', 'Pago actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Pago::eliminar($id);

        return redirect()->route('pagos.index')->with('success', 'Pago eliminado exitosamente.');
    }

    /**
     * Mostrar página de éxito del pago
     */
    public function success(Request $request)
    {
        $idFactura = $request->query('idFactura');
        return view('pagos.success', compact('idFactura'));
    }

    /**
     * Obtener detalles completos del pago desde la sesión
     */
    private function obtenerDetallesPago()
    {
        $detalles = [
            'boleto' => null,
            'servicios' => [],
            'asiento' => null,
            'total' => session('total_acumulado', 0)
        ];

        // Obtener boleto
        if (session()->has('boleto_creado')) {
            $boleto = Boleto::obtenerPorId(session('boleto_creado'));
            if (!empty($boleto)) {
                $detalles['boleto'] = $boleto[0];
            }
        }

        // Obtener servicios del boleto
        if ($detalles['boleto']) {
            $servicios = DB::select('
                SELECT s.*, ts.Nombre as tipo_servicio, ts.Costo as costo_unitario, (ts.Costo * s.Cantidad) as CostoTotal
                FROM servicios s
                JOIN tipo_servicio ts ON s.idTipoServicio = ts.idTipoServicio
                WHERE s.idBoleto = ?
            ', [$detalles['boleto']->idBoleto]);

            $detalles['servicios'] = $servicios;
        }

        // Obtener asiento (último creado)
        $asientos = DB::select('
            SELECT a.*, v.idVuelo, v.Precio as precio_vuelo,
                   ao.Nombre as aeropuerto_origen, ad.Nombre as aeropuerto_destino
            FROM asientos a
            JOIN vuelo v ON a.idVuelo = v.idVuelo
            LEFT JOIN aeropuertos ao ON v.idAeropuertoOrigen = ao.idAeropuerto
            LEFT JOIN aeropuertos ad ON v.idAeropuertoDestino = ad.idAeropuerto
            ORDER BY a.idAsiento DESC LIMIT 1
        ');

        if (!empty($asientos)) {
            $detalles['asiento'] = $asientos[0];
        }

        return $detalles;
    }

    /**
     * Generar PDF de la factura
     */
    private function generarFacturaPdf($facturaData, $detallesPago)
    {
        // Obtener datos adicionales para la factura
        $boleto = $detallesPago['boleto'];
        $pasajero = null;
        $vuelo = null;

        if ($boleto) {
            $pasajero = Boleto::obtenerPorId($boleto->idBoleto);
            if (!empty($pasajero)) {
                $pasajero = $pasajero[0];
                // Obtener vuelo del boleto
                $vuelo = DB::select('
                    SELECT v.*, ao.Nombre as aeropuerto_origen, ad.Nombre as aeropuerto_destino
                    FROM vuelo v
                    LEFT JOIN aeropuertos ao ON v.idAeropuertoOrigen = ao.idAeropuerto
                    LEFT JOIN aeropuertos ad ON v.idAeropuertoDestino = ad.idAeropuerto
                    WHERE v.idVuelo = ?
                ', [$boleto->idVuelo]);

                if (!empty($vuelo)) {
                    $vuelo = $vuelo[0];
                }
            }
        }

        $data = [
            'factura' => $facturaData,
            'boleto' => $boleto,
            'pasajero' => $pasajero,
            'vuelo' => $vuelo,
            'servicios' => $detallesPago['servicios'] ?? [],
            'asiento' => $detallesPago['asiento'] ?? null,
        ];

        $pdf = Pdf::loadView('facturas.pdf', $data);

        // Descargar automáticamente el PDF
        return $pdf->download('factura_' . $facturaData['idFactura'] . '.pdf');
    }
}
