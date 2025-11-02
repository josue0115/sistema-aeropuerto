@extends('layouts.app')

@section('page-title', 'Detalles del Equipaje - Sistema Aeropuerto')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-6">
        <div class="flex items-center justify-between mb-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-800 mb-1 flex items-center">
                    <i class="material-icons text-blue-600 mr-2 text-3xl">luggage</i>
                    Detalles del Equipaje
                </h1>
                <p class="text-gray-600 text-lg">Información completa del equipaje #{{ $equipaje->idEquipaje }}</p>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('equipajes.index') }}" class="material-btn material-btn-secondary flex items-center">
                    <i class="material-icons text-sm mr-2">list</i>
                    Volver a Equipajes
                </a>
            </div>
        </div>
    </div>

    ---

    <div class="material-card shadow-xl rounded-lg">
        <div class="p-6">
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-y-5 gap-x-8 text-base">
                
                <div>
                    <h5 class="text-xl font-semibold text-gray-800 border-b pb-2 mb-3 flex items-center">
                        <i class="material-icons text-indigo-500 mr-2">info</i>
                        Datos Generales
                    </h5>
                    
                    <div class="detail-item mb-3">
                        <strong class="font-semibold text-gray-700 block">ID Equipaje:</strong> 
                        <span class="text-gray-900 font-mono bg-gray-100 px-2 py-0.5 rounded">{{ $equipaje->idEquipaje }}</span>
                    </div>
                    
                    <div class="detail-item mb-3">
                        <strong class="font-semibold text-gray-700 block">ID Boleto Asociado:</strong> 
                        <span class="text-gray-900 flex items-center">
                            <i class="material-icons text-gray-500 mr-1 text-sm">confirmation_number</i>
                            {{ $equipaje->idBoleto }}
                        </span>
                    </div>

                    <div class="detail-item mb-3">
                        <strong class="font-semibold text-gray-700 block">Dimensiones (cm):</strong> 
                        <span class="text-gray-900 flex items-center">
                            <i class="material-icons text-gray-500 mr-1 text-sm">straighten</i>
                            {{ $equipaje->Dimensiones }}
                        </span>
                    </div>
                    
                    <div class="detail-item mb-3">
                        <strong class="font-semibold text-gray-700 block">Peso (kg):</strong> 
                        <span class="text-gray-900 flex items-center">
                            <i class="material-icons text-gray-500 mr-1 text-sm">fitness_center</i>
                            {{ number_format($equipaje->Peso, 2) }} kg
                        </span>
                    </div>
                </div>

                <div>
                    <h5 class="text-xl font-semibold text-gray-800 border-b pb-2 mb-3 flex items-center">
                        <i class="material-icons text-teal-500 mr-2">monetization_on</i>
                        Detalles Financieros y Estado
                    </h5>

                    <div class="detail-item mb-3">
                        <strong class="font-semibold text-gray-700 block">Costo Base:</strong> 
                        <span class="text-gray-900 font-medium">${{ number_format($equipaje->Costo, 2) }}</span>
                    </div>

                    <div class="detail-item mb-3">
                        <strong class="font-semibold text-gray-700 block">Costo Extra:</strong> 
                        <span class="text-orange-600 font-medium">+ ${{ number_format($equipaje->CostoExtra, 2) }}</span>
                    </div>
                    
                    <div class="detail-item mb-4">
                        <strong class="font-bold text-blue-700 block text-lg">MONTO TOTAL:</strong> 
                        <span class="text-blue-900 font-extrabold text-xl">
                            ${{ number_format($equipaje->Monto, 2) }}
                        </span>
                    </div>
                    
                    <div class="detail-item mb-3">
                        <strong class="font-semibold text-gray-700 block">Estado Actual:</strong> 
                        @php
                            $estado = $equipaje->Estado;
                            $color = match ($estado) {
                                'Registrado' => 'bg-green-100 text-green-800',
                                'Entregado' => 'bg-blue-100 text-blue-800',
                                'EnTransito' => 'bg-yellow-100 text-yellow-800',
                                'Perdido', 'Dañado' => 'bg-red-100 text-red-800',
                                default => 'bg-gray-100 text-gray-800',
                            };
                        @endphp
                        <span class="px-3 py-1 text-sm font-semibold rounded-full {{ $color }}">{{ $estado }}</span>
                    </div>
                </div>
            </div>

         ---   

            <div class="flex justify-start gap-4 mt-6">
                <a href="{{ route('equipajes.index') }}" class="material-btn material-btn-secondary flex items-center px-6">
                    <i class="material-icons text-sm mr-2">arrow_back</i>
                    Volver al Listado
                </a>
               
            </div>
            
        </div>
    </div>
</div>
@endsection