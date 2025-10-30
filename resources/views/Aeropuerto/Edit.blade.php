@extends('layouts.app')

@section('page-title', 'Editar Aeropuerto - Sistema Aeropuerto')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="material-card">
        <div class="p-6 border-b border-gray-200">
            <h1 class="text-2xl font-semibold text-gray-800">
                <i class="material-icons text-lime-600 mr-2">edit</i>
                Editar Aeropuerto
            </h1>
            <p class="text-gray-600 mt-1">Modifique la información del aeropuerto seleccionado</p>
        </div>

        <div class="p-6">
            <form method="POST" action="{{ route('aeropuerto.update', $aeropuerto->idAeropuerto) }}" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="IdAeropuerto" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="material-icons text-sm mr-1">tag</i>
                            ID del Aeropuerto
                        </label>
                        <input type="text" id="IdAeropuerto" class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 text-gray-500" value="{{ $aeropuerto->idAeropuerto }}" readonly>
                    </div>

                    <div>
                        <label for="NombreAeropuerto" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="material-icons text-sm mr-1">business</i>
                            Nombre del Aeropuerto
                        </label>
                        <input type="text" name="NombreAeropuerto" id="NombreAeropuerto" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-lime-500 focus:border-lime-500" value="{{ $aeropuerto->Nombre }}" required>
                        @error('NombreAeropuerto')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="Pais" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="material-icons text-sm mr-1">flag</i>
                            País
                        </label>
                        <input type="text" name="Pais" id="Pais" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-lime-500 focus:border-lime-500" value="{{ $aeropuerto->Pais }}" required>
                        @error('Pais')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="Ciudad" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="material-icons text-sm mr-1">location_city</i>
                            Ciudad
                        </label>
                        <input type="text" name="Ciudad" id="Ciudad" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-lime-500 focus:border-lime-500" value="{{ $aeropuerto->Ciudad }}" required>
                        @error('Ciudad')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="Estado" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="material-icons text-sm mr-1">toggle_on</i>
                            Estado
                        </label>
                        <select name="Estado" id="Estado" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-lime-500 focus:border-lime-500" required>
                            <option value="Activo" {{ $aeropuerto->Estado == 'Activo' ? 'selected' : '' }}>Activo</option>
                            <option value="Inactivo" {{ $aeropuerto->Estado == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                        </select>
                        @error('Estado')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
                    <a href="{{ route('aeropuerto.listar') }}" class="material-btn border border-gray-300 text-gray-700 hover:bg-gray-50">
                        <i class="material-icons text-sm mr-2">cancel</i>
                        Cancelar
                    </a>
                    <button type="submit" class="material-btn material-btn-primary">
                        <i class="material-icons text-sm mr-2">save</i>
                        Actualizar Aeropuerto
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
