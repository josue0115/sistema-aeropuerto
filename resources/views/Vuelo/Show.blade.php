@extends('layouts.app')

@section('page-title', 'Ver Vuelo - ' . $vuelo->IdVuelo)

@section('content')
<div class="container mx-auto px-4 py-8">
    
    <div class="mb-6 flex items-center justify-between">
        <h1 class="text-3xl font-bold text-gray-800 flex items-center">
            <i class="material-icons text-blue-600 mr-2 text-3xl">flight_takeoff</i>
            Detalles del Vuelo
        </h1>
        
    </div>

    <div class="material-card shadow-xl rounded-lg max-w-2xl mx-auto border-t-4 border-blue-500">
        <div class="p-6">
            
            <h2 class="text-2xl font-semibold text-gray-700 mb-6 border-b pb-3">
                Información General - Vuelo **#{{ $vuelo->IdVuelo }}**
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <div>
                    <div class="detail-group">
                        <label class="detail-label"><i class="material-icons text-sm mr-1 align-middle">vpn_key</i>ID del Vuelo</label>
                        <p class="detail-value text-xl font-bold text-blue-700">{{ $vuelo->IdVuelo }}</p>
                    </div>

                    <div class="detail-group">
                        <label class="detail-label"><i class="material-icons text-sm mr-1 align-middle">airplane_ticket</i>Avión (ID - Placa)</label>
                        <p class="detail-value">{{ $vuelo->avion->IdAvion ?? 'N/A' }} - {{ $vuelo->avion->Placa ?? 'N/A' }}</p>
                    </div>

                    <div class="detail-group">
                        <label class="detail-label"><i class="material-icons text-sm mr-1 align-middle">location_on</i>Aeropuerto Origen</label>
                        <p class="detail-value">{{ $vuelo->aeropuertoOrigen->IdAeropuerto ?? 'N/A' }} - {{ $vuelo->aeropuertoOrigen->NombreAeropuerto ?? 'N/A' }}</p>
                    </div>

                    <div class="detail-group">
                        <label class="detail-label"><i class="material-icons text-sm mr-1 align-middle">flag</i>Estado</label>
                        <p class="detail-value">
                           @php
    $statusClass = [
        'Activo' => 'bg-green-100 text-green-800',
        'Inactivo' => 'bg-red-100 text-red-800',
        'Retrasado' => 'bg-yellow-100 text-yellow-800',
        'Cancelado' => 'bg-red-500 text-white',
        // --- CORRECCIÓN: 'default' debe ser un string ---
        'default' => 'bg-gray-100 text-gray-800' 
    ];
@endphp
<span class="px-2 py-1 rounded-full text-xs font-semibold {{ $statusClass[$vuelo->Estado] ?? $statusClass['default'] }}">
    {{ $vuelo->Estado }}
</span>
                            <span class="px-2 py-1 rounded-full text-xs font-semibold {{ $statusClass[$vuelo->Estado] ?? $statusClass['default'] }}">
                                {{ $vuelo->Estado }}
                            </span>
                        </p>
                    </div>
                </div>

                <div>
                    <div class="detail-group">
                        <label class="detail-label"><i class="material-icons text-sm mr-1 align-middle">public</i>Aeropuerto Destino</label>
                        <p class="detail-value">{{ $vuelo->aeropuertoDestino->IdAeropuerto ?? 'N/A' }} - {{ $vuelo->aeropuertoDestino->NombreAeropuerto ?? 'N/A' }}</p>
                    </div>
                    
                    <div class="detail-group">
                        <label class="detail-label"><i class="material-icons text-sm mr-1 align-middle">calendar_today</i>Fecha de Salida</label>
                        <p class="detail-value font-semibold">{{ \Carbon\Carbon::parse($vuelo->FechaSalida)->format('d/m/Y') }}</p>
                    </div>

                    <div class="detail-group">
                        <label class="detail-label"><i class="material-icons text-sm mr-1 align-middle">calendar_month</i>Fecha de Llegada</label>
                        <p class="detail-value font-semibold">{{ \Carbon\Carbon::parse($vuelo->FechaLlegada)->format('d/m/Y') }}</p>
                    </div>

                    <div class="detail-group">
                        <label class="detail-label"><i class="material-icons text-sm mr-1 align-middle">paid</i>Precio del Boleto (Q)</label>
                        <p class="detail-value text-2xl font-bold text-green-600">Q{{ number_format($vuelo->Precio, 2) }}</p>
                    </div>
                </div>

            </div>

            <div class="mt-8 pt-4 border-t border-gray-200 flex justify-end">
                 <a href="{{ route('vuelo.listar') }}" class="material-btn material-btn-secondary">
                    <i class="material-icons text-sm mr-2">close</i>
                    Cerrar Vista
                </a>
            </div>
        </div>
    </div>
</div>

<style>
    /* Estilos de utilidad para agrupar la información */
    .detail-group {
        @apply mb-4 pb-2 border-b border-gray-100;
    }
    .detail-label {
        @apply block text-sm font-medium text-gray-500 mb-0.5 flex items-center;
    }
    .detail-value {
        @apply text-gray-900 text-lg;
    }
</style>
@endsection