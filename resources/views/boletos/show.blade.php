@extends('layouts.app')

@section('page-title', 'Detalles del Boleto - Sistema Aeropuerto')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-6">
        <div class="flex items-center justify-between mb-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-800 mb-1 flex items-center">
                    <i class="material-icons text-blue-600 mr-2 text-3xl">confirmation_number</i>
                    Detalles del Boleto
                </h1>
                <p class="text-gray-600 text-lg">Información completa del boleto #{{ $boletoData[0]->idBoleto }}</p>
            </div>
            
        </div>
    </div>

    <div class="material-card shadow-xl rounded-lg">
        <div class="p-6">
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-y-4 gap-x-8 text-base">
                
                <div>
                    <div class="mb-3">
                        <i class="material-icons text-gray-500 mr-2 text-base align-middle">vpn_key</i>
                        <strong class="font-semibold text-gray-700">ID Boleto:</strong> 
                        <span class="text-gray-900 font-mono bg-gray-100 px-2 py-0.5 rounded">{{ $boletoData[0]->idBoleto }}</span>
                    </div>
                    <div class="mb-3">
                        <i class="material-icons text-gray-500 mr-2 text-base align-middle">flight</i>
                        <strong class="font-semibold text-gray-700">ID Vuelo:</strong> 
                        <span class="text-gray-900">{{ $boletoData[0]->idVuelo }}</span>
                    </div>
                    <div class="mb-3">
                        <i class="material-icons text-gray-500 mr-2 text-base align-middle">person_pin</i>
                        <strong class="font-semibold text-gray-700">ID Pasajero:</strong> 
                        <span class="text-gray-900">{{ $boletoData[0]->idPasajero }}</span>
                    </div>
                    <div class="mb-3">
                        <i class="material-icons text-gray-500 mr-2 text-base align-middle">event_note</i>
                        <strong class="font-semibold text-gray-700">Fecha Compra:</strong> 
                        <span class="text-gray-900">{{ $boletoData[0]->FechaCompra }}</span>
                    </div>
                </div>

                <div>
                    <div class="mb-3">
                        <i class="material-icons text-gray-500 mr-2 text-base align-middle">attach_money</i>
                        <strong class="font-semibold text-gray-700">Precio Unitario:</strong> 
                        <span class="text-gray-900 font-medium">${{ number_format($boletoData[0]->Precio, 2) }}</span>
                    </div>
                    <div class="mb-3">
                        <i class="material-icons text-gray-500 mr-2 text-base align-middle">filter_1</i>
                        <strong class="font-semibold text-gray-700">Cantidad:</strong> 
                        <span class="text-gray-900">{{ $boletoData[0]->Cantidad }}</span>
                    </div>
                    <div class="mb-3">
                        <i class="material-icons text-gray-500 mr-2 text-base align-middle">redeem</i>
                        <strong class="font-semibold text-gray-700">Descuento:</strong> 
                        <span class="text-red-600 font-medium">-${{ number_format($boletoData[0]->Descuento, 2) }}</span>
                    </div>
                    <div class="mb-3">
                        <i class="material-icons text-gray-500 mr-2 text-base align-middle">paid</i>
                        <strong class="font-semibold text-gray-700">Impuesto:</strong> 
                        <span class="text-green-600 font-medium">+${{ number_format($boletoData[0]->Impuesto, 2) }}</span>
                    </div>
                    <div class="mt-4 p-3 bg-blue-50 border-l-4 border-blue-500 rounded-r-lg">
                        <i class="material-icons text-blue-600 mr-2 text-base align-middle">payments</i>
                        <strong class="font-bold text-blue-700 text-lg">TOTAL FINAL:</strong> 
                        <span class="text-blue-900 font-extrabold text-xl ml-2">${{ number_format($boletoData[0]->Total, 2) }}</span>
                    </div>
                </div>
            </div>

            ---
            
            <div class="flex justify-start gap-4 mt-6">
                <div class="flex space-x-3">
                <a href="{{ route('boletos.index') }}" class="material-btn material-btn-secondary flex items-center">
                    <i class="material-icons text-sm mr-2">list</i>
                    Volver a Boletos
                </a>
            </div>
                @if(auth()->user()->role === 'operador')
                <a href="{{ route('boletos.pdf', $boletoData[0]->idBoleto) }}" class="material-btn material-btn-primary flex items-center px-6" target="_blank">
                    <i class="material-icons text-sm mr-2">download</i>
                    Descargar PDF
                </a><a href="{{ route('boletos.edit', $boletoData[0]->idBoleto) }}" class="material-btn material-btn-secondary flex items-center">
                    <i class="material-icons text-sm mr-2">edit</i>
                    Editar Boleto
                @endif
                
              
            </div>
            
        </div>
    </div>
</div>
@endsection