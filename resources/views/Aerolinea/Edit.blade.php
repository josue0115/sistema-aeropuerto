@extends('layouts.app')

@section('page-title', 'Editar Aerolínea - Sistema Aeropuerto')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="material-card">
        <div class="p-6 border-b border-gray-200">
            <h1 class="text-2xl font-semibold text-gray-800">
                <i class="material-icons text-cyan-600 mr-2">edit</i>
                Editar Aerolínea
            </h1>
            <p class="text-gray-600 mt-1">Modifique la información de la aerolínea seleccionada</p>
        </div>

        <div class="p-6">
            <form method="POST" action="{{ route('aerolinea.update', $aerolinea->IdAerolinea) }}" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="IdAerolinea" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="material-icons text-sm mr-1">tag</i>
                            ID de la Aerolínea
                        </label>
                        <input type="text" id="IdAerolinea" class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 text-gray-500" value="{{ $aerolinea->IdAerolinea }}" readonly>
                    </div>

                    <div>
                        <label for="Nombre" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="material-icons text-sm mr-1">business</i>
                            Nombre de la Aerolínea
                        </label>
                        <input type="text" name="Nombre" id="Nombre" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500" value="{{ $aerolinea->NombreAerolinea }}" required>
                        @error('Nombre')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="IATA" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="material-icons text-sm mr-1">flight</i>
                            Código IATA
                        </label>
                        <input type="hidden" name="IATA" id="IATA" value="{{ $aerolinea->IATA }}">
                        <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100" value="{{ $aerolinea->IATA }}" readonly>
                        @error('IATA')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="Ciudad" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="material-icons text-sm mr-1">location_city</i>
                            Ciudad
                        </label>
                        <input type="text" name="Ciudad" id="Ciudad" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500" value="{{ $aerolinea->Ciudad }}" required>
                        @error('Ciudad')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="Pais" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="material-icons text-sm mr-1">flag</i>
                            País
                        </label>
                        <input type="text" name="Pais" id="Pais" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500" value="{{ $aerolinea->Pais }}" required>
                        @error('Pais')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="Estado" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="material-icons text-sm mr-1">toggle_on</i>
                            Estado
                        </label>
                        <select name="Estado" id="Estado" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500" required>
                            <option value="Activo" {{ $aerolinea->Estado == 'Activo' ? 'selected' : '' }}>Activo</option>
                            <option value="Inactivo" {{ $aerolinea->Estado == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                        </select>
                        @error('Estado')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
                    <a href="{{ route('aerolinea.Listar') }}" class="material-btn border border-gray-300 text-gray-700 hover:bg-gray-50">
                        <i class="material-icons text-sm mr-2">cancel</i>
                        Cancelar
                    </a>
                    <button type="submit" class="material-btn material-btn-primary">
                        <i class="material-icons text-sm mr-2">save</i>
                        Actualizar Aerolínea
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
