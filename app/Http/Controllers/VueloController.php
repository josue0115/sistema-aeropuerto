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
        $vuelos = Vuelo::with('avion', 'aeropuertoOrigen', 'aeropuertoDestino')->get();
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
        $aviones = Avion::all();
        $aeropuertos = Aeropuerto::all();
        return view('Vuelo.Edit', compact('vuelo', 'aviones', 'aeropuertos'));
    }

    // Mostrar formulario para eliminar vuelo
    public function delete(Vuelo $vuelo)
    {
        $vuelo->load('avion', 'aeropuertoOrigen', 'aeropuertoDestino');
        return view('Vuelo.Delete', compact('vuelo'));
    }

    // Guardar un nuevo vuelo
    public function store(Request $request)
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

        Vuelo::create($request->all());

        return redirect()->route('vuelo.index')
                         ->with('success', 'Vuelo creado correctamente');
    }

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

       // return view('vuelos.create', compact('aviones', 'aeropuertos', 'busquedaData', 'precioSugerido'));
       return view('vuelos.create', compact('aviones', 'aeropuertos', 'busquedaData', 'precioSugerido', 'vuelos'));

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

        $vuelo->update($request->all());

        return redirect()->route('vuelo.index')
                         ->with('success', 'Vuelo actualizado correctamente');
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
