<?php

namespace App\Http\Controllers;

use App\Models\Vuelo;
use App\Models\Avion;
use App\Models\Aeropuerto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class VueloController extends Controller
{
    // Mostrar la lista de vuelos
    public function index()
    {
        $vuelos = Vuelo::with(['avion', 'aeropuertoOrigen', 'aeropuertoDestino'])->get();
        $vuelos->load(['avion', 'aeropuertoOrigen', 'aeropuertoDestino']);
        return view('Vuelo.Listar', compact('vuelos'));
    }

    // Mostrar formulario para crear vuelo
    // public function create()
    // {
    //     $aviones = Avion::all();
    //     $aeropuertos = Aeropuerto::all();
    //     return view('Vuelo.Create', compact('aviones', 'aeropuertos'));
    // }

    // Mostrar detalles de un vuelo
    public function show(Vuelo $vuelo)
    {
        $vuelo->load('avion', 'aeropuertoOrigen', 'aeropuertoDestino');
        return view('Vuelo.Show', compact('vuelo'));
    }

    // Mostrar formulario para editar vuelo
    public function edit(Vuelo $vuelo)
    {
        $vuelo->load('avion', 'aeropuertoOrigen', 'aeropuertoDestino');
        $aviones = Avion::listar();
        $aeropuertos = Aeropuerto::listar();
        return view('Vuelo.Edit', compact('vuelo', 'aviones', 'aeropuertos'));
    }

    // Mostrar formulario para eliminar vuelo
    public function delete(Vuelo $vuelo)
    {
        $vuelo->load('avion', 'aeropuertoOrigen', 'aeropuertoDestino');
        return view('Vuelo.Delete', compact('vuelo'));
    }

    // Guardar un nuevo vuelo
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'IdAvion' => 'required|exists:avion,IdAvion',
    //         'idAeropuertoOrigen' => 'required|exists:aeropuerto,IdAeropuerto',
    //         'idAeropuertoDestino' => 'required|exists:aeropuerto,IdAeropuerto|different:idAeropuertoOrigen',
    //         'FechaSalida' => 'required|date|after_or_equal:today',
    //         'FechaLlegada' => 'required|date|after_or_equal:FechaSalida',
    //         'Estado' => 'required|max:10',
    //     ]);

    //     $precio = $this->getPrecioByRuta($request->idAeropuertoOrigen, $request->idAeropuertoDestino);
    //     $request->merge(['Precio' => $precio]);

    //     Vuelo::create($request->all());

    //     return redirect()->route('vuelo.index')
    //                      ->with('success', 'Vuelo creado correctamente');
    // }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $aviones = Avion::listar();
        $aeropuertos = Aeropuerto::listar();

        // Obtener datos de búsqueda desde sessionStorage o parámetros GET
        $busquedaData = null;
        if ($request->session()->has('busquedaVuelos')) {
            $busquedaData = $request->session()->get('busquedaVuelos');
        } elseif ($request->has(['origen', 'destino', 'fecha_ida'])) {
            $busquedaData = [
                'origen' => $request->origen,
                'destino' => $request->destino,
                'fecha_ida' => $request->fecha_ida,
                'fecha_vuelta' => $request->fecha_vuelta,
                'pasajeros' => $request->pasajeros,
                'tipo_viaje' => $request->tipo_viaje
            ];
        }

        // Si hay datos de búsqueda, mostrar vuelos disponibles en lugar del formulario de creación
        if ($busquedaData && isset($busquedaData['origen']) && isset($busquedaData['destino'])) {
            $vuelos = Vuelo::with(['avion', 'aeropuertoOrigen', 'aeropuertoDestino'])
                ->where('idAeropuertoOrigen', $busquedaData['origen'])
                ->where('idAeropuertoDestino', $busquedaData['destino'])
                ->where('Estado', 'Programado')
                ->get();

            return view('Vuelo.ListarDisponibles', compact('vuelos', 'busquedaData'));
        }

        // Buscar precio existente para la ruta
        $precioSugerido = null;
        if ($busquedaData && isset($busquedaData['origen']) && isset($busquedaData['destino'])) {
            $vuelosExistentes = Vuelo::listar();
            foreach ($vuelosExistentes as $vuelo) {
                if ($vuelo->idAeropuertoOrigen == $busquedaData['origen'] &&
                    $vuelo->idAeropuertoDestino == $busquedaData['destino']) {
                    $precioSugerido = $vuelo->Precio;
                    break;
                }
            }
        }

        $vuelos = Vuelo::with(['aeropuertoOrigen', 'aeropuertoDestino'])->get();

        return view('Vuelo.Create', compact('aviones', 'aeropuertos', 'busquedaData', 'precioSugerido', 'vuelos'));
    }

    /**
     * Listar vuelos disponibles.
     */
    public function listarDisponibles(Request $request)
    {
        $busquedaData = [
            'origen' => $request->origen,
            'destino' => $request->destino,
            'fecha_ida' => $request->fecha_ida,
            'fecha_vuelta' => $request->fecha_vuelta,
            'pasajeros' => $request->pasajeros,
            'tipo_viaje' => $request->tipo_viaje
        ];

        $vuelos = Vuelo::with(['avion', 'aeropuertoOrigen', 'aeropuertoDestino'])
            ->where('idAeropuertoOrigen', $busquedaData['origen'])
            ->where('idAeropuertoDestino', $busquedaData['destino'])
            ->where('Estado', 'Programado')
            ->get();

        return view('Vuelo.ListarDisponibles', compact('vuelos', 'busquedaData'));
    }
    // Actualizar un vuelo
    public function update(Request $request, Vuelo $vuelo)
    {
        $request->validate([
            'IdAvion' => 'required|exists:avion,IdAvion',
            'idAeropuertoOrigen' => 'required|exists:aeropuerto,IdAeropuerto',
            'idAeropuertoDestino' => 'required|exists:aeropuerto,IdAeropuerto|different:idAeropuertoOrigen',
            'FechaSalida' => 'required|date|after_or_equal:today',
            'FechaLlegada' => 'required|date|after_or_equal:FechaSalida',
            'Estado' => 'required|max:10',
        ]);

        $precio = $this->getPrecioByRuta($request->idAeropuertoOrigen, $request->idAeropuertoDestino);
        $request->merge(['Precio' => $precio]);

        $vuelo->update([
            'idAvion' => $request->IdAvion,
            'idAeropuertoOrigen' => $request->idAeropuertoOrigen,
            'idAeropuertoDestino' => $request->idAeropuertoDestino,
            'FechaSalida' => $request->FechaSalida,
            'FechaLlegada' => $request->FechaLlegada,
            'Precio' => $request->Precio,
            'Estado' => $request->Estado,
        ]);

        return redirect()->route('vuelo.index')
                         ->with('success', 'Vuelo actualizado correctamente');
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'idAvion' => 'required|integer|exists:aviones,idAvion',
            'idAeropuertoOrigen' => 'required|integer|exists:aeropuertos,idAeropuerto',
            'idAeropuertoDestino' => 'required|integer|exists:aeropuertos,idAeropuerto|different:idAeropuertoOrigen',
            'FechaSalida' => 'required|date|after_or_equal:today',
            'FechaLlegada' => 'nullable|date|after:FechaSalida',
            'Precio' => 'required|numeric|min:0',
            'Estado' => 'required|string|max:45',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Generar ID automático si no se proporciona
        //$data = $request->all();
        $data = $request->except('_token');

       // Generar ID automático (MAX + 1)
        if (!isset($data['idVuelo']) || empty($data['idVuelo'])) {
            // Usamos el query builder de Laravel, que es más limpio y seguro que DB::select
            $maxId = DB::table('vuelo')->max('idVuelo');
            $data['idVuelo'] = $maxId + 1;
        }

        $insertData = [
            'idVuelo' => $data['idVuelo'],
            'idAvion' => $data['idAvion'],
            'idAeropuertoOrigen' => $data['idAeropuertoOrigen'],
            'idAeropuertoDestino' => $data['idAeropuertoDestino'],
            'FechaSalida' => $data['FechaSalida'],
            // FechaLlegada puede ser null si no se proporcionó
            'FechaLlegada' => $data['FechaLlegada'] ?? null,
            'Precio' => $data['Precio'],
            'Estado' => $data['Estado'],
         ];
         
         Vuelo::create($insertData);

        return redirect()->route('vuelos.index')->with('success', 'Vuelo creado exitosamente.');
    }

    // Eliminar un vuelo
    public function destroy(Vuelo $vuelo)
    {
        $vuelo->delete();

        return redirect()->route('vuelo.index')
                         ->with('success', 'Vuelo eliminado correctamente');
    }

    // Método para obtener precio basado en la ruta
    private function getPrecioByRuta($origen, $destino)
    {
        $origenPais = Aeropuerto::where('IdAeropuerto', $origen)->value('Pais');
        $destinoPais = Aeropuerto::where('IdAeropuerto', $destino)->value('Pais');

        if ($origenPais === $destinoPais) {
            return 500.00; // Nacional
        } else {
            return 1500.00; // Internacional
        }
    }
}
