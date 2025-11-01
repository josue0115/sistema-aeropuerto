<?php

namespace App\Http\Controllers;

use App\Models\Boleto;
use App\Models\Vuelo;
use App\Models\Avion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DisponibilidadBoletosExport;
use App\Exports\BoletosFacturadosExport;

class ReporteController extends Controller
{
    /**
     * Mostrar el formulario para generar reporte de disponibilidad de boletos
     */
    public function disponibilidadBoletos()
    {
        $vuelos = Vuelo::with(['aeropuertoOrigen', 'aeropuertoDestino'])->get();
        return view('reportes.disponibilidad-boletos', compact('vuelos'));
    }

    /**
     * Mostrar el formulario para generar reporte de boletos facturados
     */
    public function boletosFacturados()
    {
        return view('reportes.boletos-facturados');
    }

    /**
     * Mostrar reporte de disponibilidad de boletos con filtros por defecto (fecha actual)
     */
    public function verDisponibilidadBoletos()
    {
        $fecha = date('Y-m-d');
        $idVuelo = null;

        // Consulta para obtener disponibilidad de boletos por vuelo y fecha
        $query = DB::table('vuelo as v')
            ->leftJoin('boletos as b', 'v.IdVuelo', '=', 'b.IdVuelo')
            ->leftJoin('aeropuerto as ao', 'v.IdAeropuertoOrigen', '=', 'ao.IdAeropuerto')
            ->leftJoin('aeropuerto as ad', 'v.IdAeropuertoDestino', '=', 'ad.IdAeropuerto')
            ->leftJoin('avion as a', 'v.IdAvion', '=', 'a.IdAvion')
            ->select(
                'v.IdVuelo',
                'ao.NombreAeropuerto as origen',
                'ad.NombreAeropuerto as destino',
                'v.FechaSalida',
                'v.FechaLlegada',
                'a.Capacidad',
                DB::raw('COALESCE(SUM(b.Cantidad), 0) as boletos_vendidos'),
                DB::raw('a.Capacidad - COALESCE(SUM(b.Cantidad), 0) as boletos_disponibles')
            )
            ->whereDate('v.FechaSalida', '=', $fecha)
            ->groupBy('v.IdVuelo', 'ao.NombreAeropuerto', 'ad.NombreAeropuerto', 'v.FechaSalida', 'v.FechaLlegada', 'a.Capacidad');

        $reporte = $query->get();

        return view('reportes.disponibilidad-boletos', compact('reporte', 'fecha', 'idVuelo'));
    }

    /**
     * Mostrar reporte de boletos facturados con filtros por defecto (últimos 30 días)
     */
    public function verBoletosFacturados()
    {
        $fechaInicio = date('Y-m-d', strtotime('-30 days'));
        $fechaFin = date('Y-m-d');

        // Consulta para obtener boletos facturados en el período
        $reporteFacturados = DB::table('boletos as b')
            ->leftJoin('pasajeros as p', 'b.IdPasajero', '=', 'p.IdPasajero')
            ->leftJoin('vuelo as v', 'b.IdVuelo', '=', 'v.IdVuelo')
            ->select(
                'b.IdBoleto',
                'p.Nombre',
                'p.Apellido',
                'b.IdVuelo',
                'b.FechaCompra',
                'b.Precio'
            )
            ->whereBetween('b.FechaCompra', [$fechaInicio, $fechaFin])
            ->orderBy('b.FechaCompra', 'desc')
            ->get();

        return view('reportes.boletos-facturados', compact('reporteFacturados', 'fechaInicio', 'fechaFin'));
    }

    /**
     * Generar reporte de disponibilidad de boletos por vuelo y fecha
     */
    public function generarDisponibilidadBoletos(Request $request)
    {
        $request->validate([
            'fecha' => 'required|date',
            'id_vuelo' => 'nullable|integer|exists:vuelo,IdVuelo'
        ]);

        $fecha = $request->fecha;
        $idVuelo = $request->id_vuelo;

        // Consulta para obtener disponibilidad de boletos por vuelo y fecha
        $query = DB::table('vuelo as v')
            ->leftJoin('boletos as b', 'v.IdVuelo', '=', 'b.IdVuelo')
            ->leftJoin('aeropuerto as ao', 'v.IdAeropuertoOrigen', '=', 'ao.IdAeropuerto')
            ->leftJoin('aeropuerto as ad', 'v.IdAeropuertoDestino', '=', 'ad.IdAeropuerto')
            ->leftJoin('avion as a', 'v.IdAvion', '=', 'a.IdAvion')
            ->select(
                'v.IdVuelo',
                'ao.NombreAeropuerto as origen',
                'ad.NombreAeropuerto as destino',
                'v.FechaSalida',
                'v.FechaLlegada',
                'a.Capacidad',
                DB::raw('COALESCE(SUM(b.Cantidad), 0) as boletos_vendidos'),
                DB::raw('a.Capacidad - COALESCE(SUM(b.Cantidad), 0) as boletos_disponibles')
            )
            ->whereDate('v.FechaSalida', '=', $fecha)
            ->groupBy('v.IdVuelo', 'ao.NombreAeropuerto', 'ad.NombreAeropuerto', 'v.FechaSalida', 'v.FechaLlegada', 'a.Capacidad');

        if ($idVuelo) {
            $query->where('v.IdVuelo', '=', $idVuelo);
        }

        $reporte = $query->get();

        $vuelos = Vuelo::with(['aeropuertoOrigen', 'aeropuertoDestino'])->get();

        return view('reportes.disponibilidad-boletos', compact('reporte', 'fecha', 'idVuelo', 'vuelos'));
    }

    /**
     * Exportar reporte de disponibilidad de boletos a Excel
     */
    public function exportarDisponibilidadBoletos(Request $request)
    {
        $request->validate([
            'fecha' => 'required|date',
            'id_vuelo' => 'nullable|integer|exists:vuelo,IdVuelo'
        ]);

        $fecha = $request->fecha;
        $idVuelo = $request->id_vuelo;

        return Excel::download(new DisponibilidadBoletosExport($fecha, $idVuelo), 'reporte_disponibilidad_boletos_' . $fecha . '.xlsx');
    }

    /**
     * Generar reporte de boletos facturados por cliente y fecha
     */
    public function generarBoletosFacturados(Request $request)
    {
        $request->validate([
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio'
        ]);

        $fechaInicio = $request->fecha_inicio;
        $fechaFin = $request->fecha_fin;

        // Consulta para obtener boletos facturados en el período
        $reporteFacturados = DB::table('boletos as b')
            ->leftJoin('pasajeros as p', 'b.IdPasajero', '=', 'p.IdPasajero')
            ->leftJoin('vuelo as v', 'b.IdVuelo', '=', 'v.IdVuelo')
            ->select(
                'b.IdBoleto',
                'p.Nombre',
                'p.Apellido',
                'b.IdVuelo',
                'b.FechaCompra',
                'b.Precio'
            )
            ->whereBetween('b.FechaCompra', [$fechaInicio, $fechaFin])
            ->orderBy('b.FechaCompra', 'desc')
            ->get();

        return view('reportes.boletos-facturados', compact('reporteFacturados', 'fechaInicio', 'fechaFin'));
    }

    /**
     * Exportar reporte de boletos facturados a Excel
     */
    public function exportarBoletosFacturados(Request $request)
    {
        $request->validate([
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio'
        ]);

        $fechaInicio = $request->fecha_inicio;
        $fechaFin = $request->fecha_fin;

        return Excel::download(new BoletosFacturadosExport($fechaInicio, $fechaFin), 'reporte_boletos_facturados_' . $fechaInicio . '_a_' . $fechaFin . '.xlsx');
    }
}
