@extends('layouts.app')

@section('page-title', 'Detalles del Mantenimiento')

@section('content')
<div class="container mx-auto px-4 py-6"> {{-- Reducido py-8 a py-6 --}}
    <div class="mb-5"> {{-- Reducido mb-6 a mb-5 --}}
        <div class="flex items-center justify-between mb-3"> {{-- Reducido mb-4 a mb-3 --}}
            <div>
                <h1 class="text-2xl font-bold text-gray-800 mb-1 flex items-center"> {{-- Reducido text-3xl a text-2xl --}}
                    <i class="material-icons text-blue-600 mr-2 text-2xl">build</i> {{-- Reducido text-3xl a text-2xl --}}
                    Detalles del Mantenimiento ID: **#{{ $mantenimiento->Id_mantenimiento }}**
                </h1>
                <p class="text-gray-600 text-base"> {{-- Reducido text-lg a text-base --}}
                    Información completa sobre el servicio y costos asociados.
                </p>
            </div>
            <div class="flex space-x-2"> {{-- Reducido space-x-3 a space-x-2 --}}
                <a href="{{ route('mantenimiento.listar') }}" class="material-btn material-btn-secondary flex items-center px-4 py-2 text-sm"> {{-- Añadido px-4 py-2 text-sm --}}
                    <i class="material-icons text-xs mr-2">arrow_back</i> {{-- Reducido text-sm a text-xs --}}
                    Volver a la Lista
                </a>
            </div>
        </div>
    </div>
    
    <div class="material-card shadow-xl rounded-lg max-w-5xl mx-auto">
        <div class="p-5"> {{-- Reducido p-6 a p-5 --}}
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-6 border-b pb-5"> {{-- Reducido gap-6 a gap-5, mb-8 a mb-6, pb-6 a pb-5 --}}
                
                <div class="col-span-1 border-r pr-5"> {{-- Reducido pr-6 a pr-5 --}}
                    <p class="text-xs font-semibold text-gray-500 mb-1">Tipo de Servicio</p> {{-- Reducido text-sm a text-xs --}}
                    <p class="text-xl font-bold text-indigo-700">{{ $mantenimiento->Tipo }}</p> {{-- Reducido text-2xl a text-xl --}}
                    <p class="mt-3 text-xs font-semibold text-gray-500 mb-1">Estado</p> {{-- Reducido mt-4 a mt-3, text-sm a text-xs --}}
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                        @if($mantenimiento->Estado == 'Completado') 
                            bg-green-100 text-green-800
                        @elseif($mantenimiento->Estado == 'En Progreso') 
                            bg-yellow-100 text-yellow-800
                        @else 
                            bg-gray-100 text-gray-800 
                        @endif">
                        <i class="material-icons text-xs mr-1">
                            @if($mantenimiento->Estado == 'Completado') check_circle 
                            @elseif($mantenimiento->Estado == 'En Progreso') loop
                            @else schedule 
                            @endif
                        </i>
                        {{ $mantenimiento->Estado }}
                    </span>
                </div>

                <div class="col-span-1 border-r pr-5"> {{-- Reducido pr-6 a pr-5 --}}
                    <p class="text-xs font-semibold text-gray-500 mb-1">Fecha de Ingreso</p> {{-- Reducido text-sm a text-xs --}}
                    <p class="text-base font-bold text-gray-900 flex items-center"> {{-- Reducido text-lg a text-base --}}
                        <i class="material-icons text-xs mr-1">event_available</i> {{-- Reducido text-sm a text-xs --}}
                        {{ \Carbon\Carbon::parse($mantenimiento->FechaIngreso)->locale('es')->isoFormat('D MMMM YYYY') }}
                    </p>
                    <p class="mt-3 text-xs font-semibold text-gray-500 mb-1">Fecha de Salida</p> {{-- Reducido mt-4 a mt-3, text-sm a text-xs --}}
                    <p class="text-base font-bold text-gray-900 flex items-center"> {{-- Reducido text-lg a text-base --}}
                        <i class="material-icons text-xs mr-1">event_busy</i> {{-- Reducido text-sm a text-xs --}}
                        {{ \Carbon\Carbon::parse($mantenimiento->FechaSalida)->locale('es')->isoFormat('D MMMM YYYY') }}
                    </p>
                </div>
                
                <div class="col-span-1">
                    <p class="text-xs font-semibold text-gray-500 mb-1">Costo Total</p> {{-- Reducido text-sm a text-xs --}}
                    <p class="text-xl font-bold text-green-700"> {{-- Reducido text-2xl a text-xl --}}
                        Q {{ number_format($mantenimiento->Costo + $mantenimiento->CostoExtra, 2) }}
                    </p>
                    <p class="text-xs text-gray-500 mt-2">Base: Q {{ number_format($mantenimiento->Costo, 2) }}</p> {{-- Reducido text-sm a text-xs --}}
                    <p class="text-xs text-gray-500">Extra: Q {{ number_format($mantenimiento->CostoExtra, 2) }}</p> {{-- Reducido text-sm a text-xs --}}
                </div>
            </div>
            
            <h5 class="text-base font-semibold text-gray-700 border-b pb-2 mb-4 flex items-center"> {{-- Reducido text-lg a text-base, pb-3 a pb-2, mb-6 a mb-4 --}}
                <i class="material-icons text-xs mr-2 text-gray-500">people</i> {{-- Reducido text-sm a text-xs --}}
                Actores Involucrados
            </h5>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6"> {{-- Reducido gap-6 a gap-4, mb-8 a mb-6 --}}
                
                <div class="bg-gray-50 p-3 rounded-lg border border-gray-200"> {{-- Reducido p-4 a p-3 --}}
                    <p class="text-xs font-semibold text-gray-500 mb-1 flex items-center"><i class="material-icons text-xs mr-1 text-blue-500">flight</i> Avión</p> {{-- Reducido text-sm a text-xs --}}
                    <p class="text-lg font-bold text-gray-900">{{ $mantenimiento->avion->Placa ?? 'N/A' }}</p> {{-- Reducido text-xl a text-lg --}}
                    <p class="text-gray-800 text-xs mt-1">ID: {{ $mantenimiento->avion->IdAvion ?? 'N/A' }}</p> {{-- Reducido text-sm a text-xs --}}
                </div>

                <div class="bg-gray-50 p-3 rounded-lg border border-gray-200"> {{-- Reducido p-4 a p-3 --}}
                    <p class="text-xs font-semibold text-gray-500 mb-1 flex items-center"><i class="material-icons text-xs mr-1 text-orange-500">person</i> Personal Asignado</p> {{-- Reducido text-sm a text-xs --}}
                    <p class="text-lg font-bold text-gray-900">{{ $mantenimiento->personal->Nombre ?? 'N/A' }} {{ $mantenimiento->personal->Apellido ?? 'N/A' }}</p> {{-- Reducido text-xl a text-lg --}}
                    <p class="text-gray-800 text-xs mt-1">ID: {{ $mantenimiento->personal->IdPersonal ?? 'N/A' }}</p> {{-- Reducido text-sm a text-xs --}}
                </div>
            </div>
            
            <h5 class="text-base font-semibold text-gray-700 border-b pb-2 mb-3 flex items-center"> {{-- Reducido text-lg a text-base, pb-3 a pb-2, mb-4 a mb-3 --}}
                <i class="material-icons text-xs mr-2 text-gray-500">description</i> {{-- Reducido text-sm a text-xs --}}
                Descripción del Servicio
            </h5>
            <div class="mb-5 bg-white p-3 border rounded-lg shadow-inner"> {{-- Reducido mb-6 a mb-5, p-4 a p-3 --}}
                <p class="text-sm text-gray-800 whitespace-pre-line">{{ $mantenimiento->Descripcion }}</p> {{-- Reducido text-base a text-sm --}}
            </div>


            <div class="flex justify-start mt-6 pt-5 border-t border-gray-200"> {{-- Reducido mt-8 a mt-6, pt-6 a pt-5 --}}
                <a href="{{ route('mantenimiento.listar') }}" class="material-btn material-btn-secondary flex items-center px-5 py-2 text-sm"> {{-- Reducido px-6 a px-5, text-base a text-sm --}}
                    <i class="material-icons text-xs mr-2">close</i> {{-- Reducido text-sm a text-xs --}}
                    Cerrar Detalles
                </a>
            </div>
        </div>
    </div>
</div>
@endsection