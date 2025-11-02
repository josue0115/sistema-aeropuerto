@extends('layouts.app')

@section('page-title', 'Ver Avión - ' . $avion->Placa)

@section('content')
<div class="container mx-auto px-4 py-8 flex justify-center items-start min-h-[70vh]">

    <div class="material-card shadow-xl rounded-lg max-w-2xl w-full border-t-4 border-purple-600 mt-8">
        <div class="p-6">
            
            <div class="flex items-center justify-between mb-6 pb-4 border-b border-gray-200">
                <h2 class="text-3xl font-bold text-gray-800 flex items-center">
                    <i class="material-icons text-purple-600 mr-2 text-3xl">airplanemode_active</i>
                    Avión **#{{ $avion->IdAvion }}**
                </h2>
                <a href="{{ route('avion.listar') }}" class="text-gray-400 hover:text-gray-600 transition">
                    <i class="material-icons text-xl">close</i>
                </a>
            </div>

            <div class="space-y-6">
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-purple-50 p-6 rounded-lg border border-purple-200">
                    
                    <div class="detail-group border-b-0 pb-0">
                        <label class="detail-label text-base"><i class="material-icons text-base mr-1 align-middle">credit_card</i> **PLACA DE REGISTRO**</label>
                        {{-- AUMENTADO a 4XL --}}
                        <p class="detail-value **text-4xl** font-extrabold text-purple-800">
                            {{ $avion->Placa }}
                        </p>
                    </div>

                    <div class="detail-group border-b-0 pb-0">
                        <label class="detail-label text-base"><i class="material-icons text-base mr-1 align-middle">flight</i> Aerolínea</label>
                        {{-- AUMENTADO a 2XL --}}
                        <p class="detail-value **text-2xl** font-bold text-gray-800">
                            {{ $avion->aerolinea->NombreAerolinea ?? 'N/A' }} 
                            <span class="text-base font-normal text-gray-500 block">({{ $avion->IdAerolinea }})</span>
                        </p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                    <div class="detail-group">
                        <label class="detail-label text-base"><i class="material-icons text-base mr-1 align-middle">category</i> Tipo</label>
                        {{-- AUMENTADO a XL --}}
                        <p class="detail-value **text-xl** font-semibold">{{ $avion->Tipo }}</p>
                    </div>

                    <div class="detail-group">
                        <label class="detail-label text-base"><i class="material-icons text-base mr-1 align-middle">build</i> Modelo</label>
                        {{-- AUMENTADO a XL --}}
                        <p class="detail-value **text-xl** font-semibold">{{ $avion->Modelo }}</p>
                    </div>
                    
                    <div class="detail-group">
                        <label class="detail-label text-base"><i class="material-icons text-base mr-1 align-middle">people</i> Capacidad (Asientos)</label>
                        {{-- AUMENTADO a 3XL --}}
                        <p class="detail-value **text-3xl** font-extrabold text-green-700">{{ $avion->Capacidad }}</p>
                    </div>

                </div>

                <div class="detail-group border-b-0 pb-0 pt-4 border-t border-gray-100">
                    <label class="detail-label text-base"><i class="material-icons text-base mr-1 align-middle">toggle_on</i> Estado Actual</label>
                    @php
                        $statusClass = [
                            'Activo' => 'bg-green-100 text-green-800',
                            'Inactivo' => 'bg-red-100 text-red-800',
                            'default' => 'bg-gray-100 text-gray-800'
                        ];
                    @endphp
                    {{-- AUMENTADO a 2XL --}}
                    <span class="px-4 py-1 rounded-full **text-2xl** font-bold {{ $statusClass[$avion->Estado] ?? $statusClass['default'] }}">
                        {{ $avion->Estado }}
                    </span>
                </div>
            </div>

            <div class="mt-8 pt-4 border-t border-gray-200 flex justify-end">
                <a href="{{ route('avion.listar') }}" class="material-btn material-btn-secondary">
                    <i class="material-icons text-sm mr-2">arrow_back</i>
                    Cerrar y Volver
                </a>
            </div>
        </div>
    </div>
</div>

<style>
    /* Estilos de utilidad para agrupar la información */
    .detail-group {
        /* Se mantiene el padding vertical para acomodar el texto más grande */
        @apply mb-4 pb-2 border-b border-gray-100;
    }
    .detail-label {
        /* Se hizo el label más grande (text-base) */
        @apply block font-medium text-gray-500 mb-0.5 flex items-center;
    }
    .detail-value {
        @apply text-gray-900;
    }
</style>
@endsection