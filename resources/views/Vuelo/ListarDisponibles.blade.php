@extends('layouts.app')

@section('page-title', 'Vuelos Disponibles - Sistema Aeropuerto')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-5xl">
    <!-- Header Section -->
    <div class="mb-8">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-3xl font-bold text-gray-800 mb-2">
                    <i class="material-icons text-blue-600 mr-2">flight_takeoff</i>
                    Vuelos Disponibles
                </h1>
                @php
                    $origen = \App\Models\Aeropuerto::find($busquedaData['origen']);
                    $destino = \App\Models\Aeropuerto::find($busquedaData['destino']);
                @endphp
                <p class="text-gray-600 text-lg">
                    Vuelos de <span class="font-semibold text-blue-600">{{ $origen ? $origen->NombreAeropuerto : $busquedaData['origen'] }}</span>
                    a <span class="font-semibold text-blue-600">{{ $destino ? $destino->NombreAeropuerto : $busquedaData['destino'] }}</span>
                </p>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('home') }}" class="material-btn material-btn-secondary">
                    <i class="material-icons text-sm mr-2">search</i>
                    Nueva Búsqueda
                </a>

               @if(in_array(auth()->user()->role, ['operador', 'cliente']))
                    <a href="{{ route('vuelo.create') }}" class="material-btn material-btn-primary">
                        <i class="material-icons text-sm mr-2">add</i>
                        Crear Nuevo Vuelo
                    </a>
                @endif
            </div>
        </div>
    </div>

    <!-- Flights Grid -->
    @if($vuelos->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($vuelos as $vuelo)
            <div class="material-card">
                <div class="p-6">
                    <!-- Flight Header -->
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                <i class="material-icons text-blue-600">flight</i>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800">{{ $vuelo->avion->Modelo ?? 'N/A' }}</h3>
                                <p class="text-sm text-gray-600">Vuelo #{{ $vuelo->IdVuelo }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="text-2xl font-bold text-green-600">Q{{ number_format($vuelo->Precio, 0) }}</div>
                            <div class="text-sm text-gray-600">por persona</div>
                        </div>
                    </div>

                    <!-- Flight Details -->
                    <div class="space-y-3 mb-6">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <i class="material-icons text-gray-400 mr-2">flight_takeoff</i>
                                <div>
                                    <div class="font-medium text-gray-800">{{ $vuelo->aeropuertoOrigen->NombreAeropuerto ?? 'N/A' }}</div>
                                    <div class="text-sm text-gray-600">{{ \Carbon\Carbon::parse($vuelo->FechaSalida)->format('d/m/Y H:i') }}</div>
                                </div>
                            </div>
                            <div class="flex-1 mx-4">
                                <div class="flex items-center">
                                    <div class="flex-1 border-t border-gray-300"></div>
                                    <i class="material-icons text-blue-600 mx-2">arrow_forward</i>
                                    <div class="flex-1 border-t border-gray-300"></div>
                                </div>
                            </div>
                            <div class="flex items-center">
                                <i class="material-icons text-gray-400 mr-2">flight_land</i>
                                <div class="text-right">
                                    <div class="font-medium text-gray-800">{{ $vuelo->aeropuertoDestino->NombreAeropuerto ?? 'N/A' }}</div>
                                    <div class="text-sm text-gray-600">{{ \Carbon\Carbon::parse($vuelo->FechaLlegada)->format('d/m/Y H:i') }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Flight Status -->
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                @if($vuelo->Estado === 'Disponible') bg-green-100 text-green-800
                                @elseif($vuelo->Estado === 'Programado') bg-blue-100 text-blue-800
                                @elseif($vuelo->Estado === 'Cancelado') bg-red-100 text-red-800
                                @else bg-gray-100 text-gray-800 @endif">
                                <i class="material-icons text-xs mr-1">
                                    @if($vuelo->Estado === 'Disponible') check_circle
                                    @elseif($vuelo->Estado === 'Programado') schedule
                                    @elseif($vuelo->Estado === 'Cancelado') cancel
                                    @else info @endif
                                </i>
                                {{ $vuelo->Estado }}
                            </span>
                        </div>
                        <div class="text-sm text-gray-600">
                            Duración: {{ \Carbon\Carbon::parse($vuelo->FechaSalida)->diff(\Carbon\Carbon::parse($vuelo->FechaLlegada))->format('%Hh %Im') }}
                        </div>
                    </div>

                    <!-- Action Button -->
                    <div class="flex justify-center">
                        @if($vuelo->Estado === 'Programado' || $vuelo->Estado === 'Disponible')
                            <a href="{{ route('pasajeros.create', ['vuelo_id' => $vuelo->IdVuelo]) }}"
                               class="material-btn material-btn-primary w-full justify-center">
                                <i class="material-icons text-sm mr-2">check_circle</i>
                                Seleccionar Vuelo
                            </a>
                        @else
                            <button disabled class="material-btn material-btn-secondary w-full justify-center opacity-50 cursor-not-allowed">
                                <i class="material-icons text-sm mr-2">block</i>
                                No Disponible
                            </button>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-8 flex justify-center">
            {{ $vuelos->links() }}
        </div>
    @else
        <!-- No Flights Found -->
        <div class="material-card">
            <div class="p-12 text-center">
                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="material-icons text-gray-400 text-4xl">flight_takeoff</i>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">No hay vuelos disponibles</h3>
                <p class="text-gray-600 mb-6">No se encontraron vuelos programados para la ruta seleccionada en las fechas especificadas.</p>
                <div class="flex justify-center space-x-3">
                    <a href="{{ route('home') }}" class="material-btn material-btn-primary">
                        <i class="material-icons text-sm mr-2">search</i>
                        Nueva Búsqueda
                    </a>
                    <a href="{{ route('pasajeros.create') }}" class="material-btn material-btn-secondary">
                        <i class="material-icons text-sm mr-2">people</i>
                        Ir a Pasajeros
                    </a>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection

@section('scripts')
<script>
// Optional: Add any interactive features here if needed
document.addEventListener('DOMContentLoaded', function() {
    // You can add JavaScript for flight selection animations or other interactions
    console.log('Vuelos disponibles cargados');
});
</script>
@endsection
