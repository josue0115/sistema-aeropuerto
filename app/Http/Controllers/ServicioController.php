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
        // Obtener boleto creado en el paso anterior
        $boletoCreado = null;
        if (session()->has('boleto_creado')) {
            $boletoCreado = Boleto::obtenerPorId(session('boleto_creado'));
            if (!empty($boletoCreado)) {
                $boletoCreado = $boletoCreado[0];
            }
        }

        $boletos = Boleto::listar();
        $tipoServicios = TipoServicio::all();
        return view('servicios.create', compact('boletos', 'tipoServicios', 'boletoCreado'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'idBoleto' => 'nullable|integer',
            'Fecha' => 'nullable|date',
            'Estado' => 'nullable|string|max:20',
            'servicios' => 'required|array|min:1',
            'servicios.*.idTipoServicio' => 'required|integer|exists:tipo_servicio,idTipoServicio',
            'servicios.*.Cantidad' => 'required|numeric|min:0.01',
            'servicios.*.CostoTotal' => 'nullable|numeric',
        ]);

        $idBoleto = $request->input('idBoleto');
        $fecha = $request->input('Fecha');
        $estado = $request->input('Estado');
        $servicios = $request->input('servicios');

        // Calcular el total de servicios
        $totalServicios = 0;
        foreach ($servicios as $servicioData) {
            $totalServicios += $servicioData['CostoTotal'];
        }

        // Sumar el total de servicios al total acumulado en la sesión
        $totalActual = session('total_acumulado', 0);
        session(['total_acumulado' => $totalActual + $totalServicios]);

        // Insertar cada servicio
        foreach ($servicios as $servicioData) {
            // Obtener el costo del tipo de servicio
            $tipoServicio = TipoServicio::find($servicioData['idTipoServicio']);
            $costo = $tipoServicio ? $tipoServicio->Costo : 0;
            $costoTotal = $costo * $servicioData['Cantidad'];

            $data = [
                'idBoleto' => $idBoleto,
                'Fecha' => $fecha,
                'idTipoServicio' => $servicioData['idTipoServicio'],
                'Costo' => $costo,
                'Cantidad' => $servicioData['Cantidad'],
                'costoTotal' => $costoTotal,
                'Estado' => $estado,
            ];

            Servicio::insertar($data);
        }

        // Verificar si se presionó el botón "Siguiente: Asientos"
        if ($request->input('action') === 'next') {
            // Obtener el vuelo del boleto para preseleccionar en asientos
            $boleto = Boleto::obtenerPorId($idBoleto);
            if (!empty($boleto)) {
                $boleto = $boleto[0];
                session(['vuelo_para_asientos' => $boleto->idVuelo]);
            }

            // Redirigir a la creación de asientos
            return redirect()->route('asientos.create')->with('success', 'Servicios creados exitosamente. Ahora selecciona los asientos.');
        }

        return redirect()->route('servicios.index')->with('success', 'Servicios creados exitosamente.');
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
        $boletos = Boleto::listar();
        $tipoServicios = TipoServicio::all();
        return view('servicios.edit', compact('servicio', 'boletos', 'tipoServicios'));
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

        $data = $request->all();

        // Si se actualiza idTipoServicio o Cantidad, recalcular Costo y costoTotal
        if (isset($data['idTipoServicio']) || isset($data['Cantidad'])) {
            $servicio = Servicio::find($id);
            $tipoServicioId = $data['idTipoServicio'] ?? $servicio->idTipoServicio;
            $cantidad = $data['Cantidad'] ?? $servicio->Cantidad;

            $tipoServicio = TipoServicio::find($tipoServicioId);
            $costo = $tipoServicio ? $tipoServicio->Costo : $servicio->Costo;
            $data['Costo'] = $costo;
            $data['costoTotal'] = $costo * $cantidad;
        }

        Servicio::actualizar($id, $data);

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
