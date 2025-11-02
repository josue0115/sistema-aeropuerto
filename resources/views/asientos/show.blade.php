@extends('layouts.app')

@section('page-title', 'Detalles del Asiento - ' . $asiento[0]->NumeroAsiento)

@section('content')
<div class="container mx-auto px-4 py-8 flex justify-center items-start min-h-[70vh]">

    <div class="material-card shadow-xl rounded-lg max-w-2xl w-full border-t-4 border-indigo-600 mt-8">
        <div class="p-6">
            
            <div class="flex items-center justify-between mb-6 pb-4 border-b border-gray-200">
                <h2 class="text-3xl font-bold text-gray-800 flex items-center">
                    <i class="material-icons text-indigo-600 mr-2 text-3xl">chair</i>
                    Detalles del Asiento
                </h2>
                
            </div>

            <div class="space-y-6">
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-indigo-50 p-4 rounded-lg border border-indigo-200">
                    
                    <div class="detail-group border-b-0 pb-0">
                        <label class="detail-label text-base"><i class="material-icons text-base mr-1 align-middle">tag</i> ID Asiento</label>
                        <p class="detail-value **text-2xl** font-extrabold text-indigo-800">
                            {{ $asiento[0]->idAsiento }}
                        </p>
                    </div>

                    <div class="detail-group border-b-0 pb-0">
                        <label class="detail-label text-base"><i class="material-icons text-base mr-1 align-middle">vpn_key</i> Número de Asiento</label>
                        <p class="detail-value **text-2xl** font-extrabold text-gray-800">
                            {{ $asiento[0]->NumeroAsiento }}
                        </p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div class="detail-group">
                        <label class="detail-label text-base"><i class="material-icons text-base mr-1 align-middle">flight_takeoff</i> Vuelo Asignado</label>
                        <p class="detail-value **text-xl** font-semibold text-gray-900">
                            {{ $asiento[0]->vuelo_info ?: 'N/A' }}
                        </p>
                    </div>

                    <div class="detail-group">
                        <label class="detail-label text-base"><i class="material-icons text-base mr-1 align-middle">group</i> Clase</label>
                        <p class="detail-value **text-xl** font-semibold text-gray-900">
                            {{ $asiento[0]->Clase ?: 'N/A' }}
                        </p>
                    </div>
                </div>

                <div class="detail-group border-b-0 pb-0 pt-4 border-t border-gray-100">
                    <label class="detail-label text-base"><i class="material-icons text-base mr-1 align-middle">info</i> Estado</label>
                    @php
                        $statusText = $asiento[0]->Estado ?: 'N/A';
                        $statusClass = [
                            'Disponible' => 'bg-green-100 text-green-800',
                            'Reservado' => 'bg-yellow-100 text-yellow-800',
                            'Ocupado' => 'bg-red-100 text-red-800',
                            'default' => 'bg-gray-100 text-gray-800'
                        ];
                    @endphp
                    <span class="px-4 py-1 rounded-full **text-xl** font-bold {{ $statusClass[$statusText] ?? $statusClass['default'] }}">
                        {{ $statusText }}
                    </span>
                </div>
            </div>

            <div class="mt-8 pt-4 border-t border-gray-200 flex justify-end">
                <a href="{{ route('asientos.index') }}" class="material-btn material-btn-secondary">
                    <i class="material-icons text-sm mr-2">arrow_back</i>
                    Volver al Listado
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
        @apply block font-medium text-gray-500 mb-0.5 flex items-center;
    }
</style>
@endsection