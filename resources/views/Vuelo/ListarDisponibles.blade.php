@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Vuelos Disponibles</h4>
                    @php
                        $origen = \App\Models\Aeropuerto::find($busquedaData['origen']);
                        $destino = \App\Models\Aeropuerto::find($busquedaData['destino']);
                    @endphp
                    <p class="mb-0">Vuelos de {{ $origen ? $origen->Nombre : $busquedaData['origen'] }} a {{ $destino ? $destino->Nombre : $busquedaData['destino'] }}</p>
                </div>
                <div class="card-body">
                    @if($vuelos->count() > 0)
                        <div class="table-responsive">
                            <table id="tablaVuelosDisponibles" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Avión</th>
                                        <th>Aeropuerto Origen</th>
                                        <th>Aeropuerto Destino</th>
                                        <th>Fecha Salida</th>
                                        <th>Fecha Llegada</th>
                                        <th>Precio</th>
                                        <th>Estado</th>
                                        <th>Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($vuelos as $vuelo)
                                    <tr>
                                        <td>{{ $vuelo->avion->Modelo ?? 'N/A' }}</td>
                                        <td>{{ $vuelo->aeropuertoOrigen->Nombre ?? 'N/A' }}</td>
                                        <td>{{ $vuelo->aeropuertoDestino->Nombre ?? 'N/A' }}</td>
                                        <td>{{ $vuelo->FechaSalida }}</td>
                                        <td>{{ $vuelo->FechaLlegada }}</td>
                                        <td>Q{{ number_format($vuelo->Precio, 2) }}</td>
                                        <td>{{ $vuelo->Estado }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('pasajeros.create', ['vuelo_id' => $vuelo->idVuelo]) }}" class="btn btn-success btn-sm">Seleccionar</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="alert alert-info">
                            <h5>No hay vuelos disponibles</h5>
                            <p>No se encontraron vuelos programados para la ruta seleccionada.</p>
                        </div>
                    @endif

                    <div class="mt-3">
                        <a href="{{ route('home') }}" class="btn btn-secondary">Nueva Búsqueda</a>
                        <a href="{{ route('vuelos.create') }}" class="btn btn-primary">Crear Nuevo Vuelo</a>
                        <a href="{{ route('pasajeros.create') }}" class="btn btn-info">Ir a Pasajeros</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    $('#tablaVuelosDisponibles').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json"
        }
    });
});
</script>
@endsection
