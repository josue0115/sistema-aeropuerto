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
        $vuelos = Vuelo::listar();
        return view('Vuelo.Listar', compact('vuelos'));
    }

    // Mostrar formulario para crear vuelo
    public function create(Request $request)
    {
        $aviones = Avion::all();
        $aeropuertos = Aeropuerto::all();
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
                ->where('IdAeropuertoOrigen', $busquedaData['origen'])
                ->where('IdAeropuertoDestino', $busquedaData['destino'])
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

        $query = Vuelo::with(['avion', 'aeropuertoOrigen', 'aeropuertoDestino'])
            ->where('IdAeropuertoOrigen', $busquedaData['origen'])
            ->where('IdAeropuertoDestino', $busquedaData['destino'])
            ->whereIn('Estado', ['Disponible', 'Programado']);

        // Filtrar por fecha si se proporciona
        if ($busquedaData['fecha_ida']) {
            $query->whereDate('FechaSalida', $busquedaData['fecha_ida']);
        }

        $vuelos = $query->paginate(9); // 9 vuelos por página (3x3 grid)

        return view('Vuelo.ListarDisponibles', compact('vuelos', 'busquedaData'));
    }

    // Mostrar detalles de un vuelo
    public function show($id)
    {
        $vuelo = Vuelo::obtenerPorId($id);
        
        // Verificar que el vuelo exista
        if (!$vuelo) {
            return redirect()->route('vuelos.index')
                            ->with('error', 'Vuelo no encontrado');
        }
        
        return view('Vuelo.Show', compact('vuelo'));
    }
//  public function show($id)
//     {
//         $vuelo = Vuelo::obtenerPorId($id);
//         return view('Vuelo.Show', compact('vuelo'));
//     }


    // Mostrar formulario para editar vuelo
    public function edit($id)
    {
        $vuelo = Vuelo::obtenerPorId($id);
        $aviones = Avion::listar();
        $aeropuertos = Aeropuerto::listar();
        return view('Vuelo.Edit', compact('vuelo', 'aviones', 'aeropuertos'));
    }

    // Mostrar formulario para eliminar vuelo
    public function delete($id)
    {
        $vuelo = Vuelo::obtenerPorId($id);
        return view('Vuelo.Delete', compact('vuelo'));
    }

    // Guardar un nuevo vuelo
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'idAvion' => 'required|integer|exists:aviones,idAvion',
            'idAeropuertoOrigen' => 'required|integer|exists:aeropuerto,idAeropuerto',
            'idAeropuertoDestino' => 'required|integer|exists:aeropuerto,idAeropuerto|different:idAeropuertoOrigen',
            'FechaSalida' => 'required|date|after_or_equal:today',
            'FechaLlegada' => 'nullable|date|after:FechaSalida',
            'Precio' => 'required|numeric|min:0',
            'Estado' => 'required|string|max:45',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Generar ID automático si no se proporciona
        $data = $request->except('_token');

        // Generar ID automático (MAX + 1)
        if (!isset($data['idVuelo']) || empty($data['idVuelo'])) {
            $maxId = DB::table('vuelo')->max('idVuelo');
            $data['idVuelo'] = $maxId + 1;
        }

        $insertData = [
            'idVuelo' => $data['idVuelo'],
            'idAvion' => $data['idAvion'],
            'idAeropuertoOrigen' => $data['idAeropuertoOrigen'],
            'idAeropuertoDestino' => $data['idAeropuertoDestino'],
            'FechaSalida' => $data['FechaSalida'],
            'FechaLlegada' => $data['FechaLlegada'] ?? null,
            'Precio' => $data['Precio'],
            'Estado' => $data['Estado'],
        ];

        Vuelo::create($insertData);

        return redirect()->route('vuelos.index')->with('success', 'Vuelo creado exitosamente.');
    }

    // Actualizar un vuelo
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'idAvion' => 'required|integer|exists:avion,idAvion',
            'idAeropuertoOrigen' => 'required|integer|exists:aeropuerto,idAeropuerto',
            'idAeropuertoDestino' => 'required|integer|exists:aeropuerto,idAeropuerto|different:idAeropuertoOrigen',
            'FechaSalida' => 'required|date|after_or_equal:today',
            'FechaLlegada' => 'nullable|date|after:FechaSalida',
            'Precio' => 'required|numeric|min:0',
            'Estado' => 'required|string|max:45',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $vuelo = Vuelo::findOrFail($id);
        $vuelo->update($request->all());

        return redirect()->route('vuelos.index')->with('success', 'Vuelo actualizado exitosamente.');
    }

    // Eliminar un vuelo
    public function destroy($id)
    {
        $vuelo = Vuelo::findOrFail($id);
        $vuelo->delete();

        return redirect()->route('vuelos.index')
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