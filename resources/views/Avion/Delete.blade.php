@extends('layouts.app')

@section('page-title', 'Eliminar Avión - Sistema Aeropuerto')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="material-card">
        <div class="p-6 border-b border-gray-200">
            <h1 class="text-2xl font-semibold text-gray-800">
                <i class="material-icons text-red-600 mr-2">delete</i>
                Eliminar Avión
            </h1>
            <p class="text-gray-600 mt-1">¿Estás seguro de que deseas eliminar este avión? Esta acción no se puede deshacer.</p>
        </div>

        <div class="p-6">
            <div class="bg-red-50 border border-red-200 rounded-md p-4 mb-6">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="material-icons text-red-400">warning</i>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-red-800">
                            Confirmación de Eliminación
                        </h3>
                        <div class="mt-2 text-sm text-red-700">
                            <p>Una vez eliminado, no podrás recuperar este avión ni sus datos asociados.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="material-icons text-sm mr-1">flight</i>
                        ID Avión
                    </label>
                    <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100" value="{{ $avion->IdAvion }}" readonly>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="material-icons text-sm mr-1">flight</i>
                        Aerolínea
                    </label>
                    <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100" value="{{ $avion->aerolinea->NombreAerolinea ?? 'N/A' }}" readonly>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="material-icons text-sm mr-1">category</i>
                        Tipo
                    </label>
                    <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100" value="{{ $avion->Tipo }}" readonly>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="material-icons text-sm mr-1">build</i>
                        Modelo
                    </label>
                    <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100" value="{{ $avion->Modelo }}" readonly>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="material-icons text-sm mr-1">people</i>
                        Capacidad
                    </label>
                    <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100" value="{{ $avion->Capacidad }}" readonly>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="material-icons text-sm mr-1">credit_card</i>
                        Placa
                    </label>
                    <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100" value="{{ $avion->Placa }}" readonly>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="material-icons text-sm mr-1">toggle_on</i>
                        Estado
                    </label>
                    <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100" value="{{ $avion->Estado }}" readonly>
                </div>
            </div>

            <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
                <a href="{{ route('avion.listar') }}" class="material-btn border border-gray-300 text-gray-700 hover:bg-gray-50">
                    <i class="material-icons text-sm mr-2">cancel</i>
                    Cancelar
                </a>
                <form method="POST" action="{{ route('avion.destroy', $avion->IdAvion) }}" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="material-btn material-btn-danger">
                        <i class="material-icons text-sm mr-2">delete</i>
                        Eliminar Avión
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
