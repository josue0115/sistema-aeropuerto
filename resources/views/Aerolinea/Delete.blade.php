@extends('layouts.app')

@section('page-title', 'Eliminar Aerolínea')

@section('content')
<div class="container mx-auto px-4 py-8 flex justify-center items-start min-h-[70vh]">

    <div class="material-card shadow-xl rounded-lg max-w-xl w-full border-t-4 border-red-600 mt-8">
        
        <div class="p-6 bg-red-100 border-b border-red-300">
            <h1 class="text-2xl font-bold text-red-800 flex items-center">
                <i class="material-icons text-red-600 mr-2 text-3xl">delete_forever</i>
                Confirmar Eliminación de Aerolínea
            </h1>
            <p class="mt-2 text-red-700 font-semibold">
                ¿Estás seguro de que deseas eliminar esta aerolínea? **Esta acción no se puede deshacer.**
            </p>
        </div>

        <form action="{{ route('aerolinea.destroy', $aerolinea->IdAerolinea) }}" method="POST">
            @csrf
            @method('DELETE')

            <div class="p-6 space-y-4">
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 bg-gray-50 p-4 rounded-md border border-gray-200">
                    
                    <div class="detail-group">
                        <label class="detail-label text-sm"><i class="material-icons text-xs mr-1 align-middle">tag</i> ID Aerolínea</label>
                        <p class="detail-value text-lg font-semibold text-gray-800">{{ $aerolinea->IdAerolinea }}</p>
                    </div>

                    <div class="detail-group">
                        <label class="detail-label text-sm"><i class="material-icons text-xs mr-1 align-middle">business</i> Nombre Comercial</label>
                        <p class="detail-value text-lg font-semibold text-gray-800">{{ $aerolinea->NombreAerolinea }}</p>
                    </div>

                    <div class="detail-group">
                        <label class="detail-label text-sm"><i class="material-icons text-xs mr-1 align-middle">flight</i> Código IATA</label>
                        <p class="detail-value text-lg font-semibold text-gray-800">{{ $aerolinea->IATA }}</p>
                    </div>
                    
                    <div class="detail-group">
                        <label class="detail-label text-sm"><i class="material-icons text-xs mr-1 align-middle">location_city</i> Ciudad Base</label>
                        <p class="detail-value text-lg font-semibold text-gray-800">{{ $aerolinea->Ciudad }}</p>
                    </div>

                    <div class="detail-group col-span-2">
                        <label class="detail-label text-sm"><i class="material-icons text-xs mr-1 align-middle">flag</i> País</label>
                        <p class="detail-value text-lg font-semibold text-gray-800">{{ $aerolinea->Pais }}</p>
                    </div>
                    
                    <div class="detail-group col-span-2">
                        <label class="detail-label text-sm"><i class="material-icons text-xs mr-1 align-middle">toggle_on</i> Estado</label>
                        <p class="detail-value text-lg font-semibold text-gray-800">{{ $aerolinea->Estado }}</p>
                    </div>
                </div>

                <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
                    <a href="{{ route('aerolinea.Listar') }}" class="material-btn material-btn-secondary">
                        <i class="material-icons text-sm mr-2">cancel</i>
                        Cancelar
                    </a>
                    <button type="submit" style="background-color: #dc2626;" class="material-btn text-white hover:bg-red-700 focus:ring-red-500">
                        <i class="material-icons text-sm mr-2">delete</i>
                        Sí, Eliminar Permanentemente
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<style>
    /* Estilos de utilidad para detalles (manteniendo la consistencia) */
    .detail-group {
        @apply mb-0;
    }
    .detail-label {
        @apply block font-medium text-gray-500 mb-0.5 flex items-center;
    }
</style>
@endsection 