@extends('layouts.app')

@section('page-title', 'Crear Aeropuerto - Sistema Aeropuerto')

@section('content')
<div class="container mx-auto px-4 py-8">

    <div class="material-card shadow-xl rounded-lg max-w-4xl mx-auto border-t-4 border-lime-600">
        
        <div class="p-6 border-b border-gray-200">
            <h1 class="text-2xl font-bold text-gray-800 flex items-center">
                <i class="material-icons text-lime-600 mr-2 text-3xl">add_location_alt</i>
                Crear Nuevo Aeropuerto
            </h1>
            <p class="text-gray-600 mt-1">Complete la información para agregar un nuevo aeropuerto a la red.</p>
        </div>

        <div class="p-6">
            <form method="POST" action="{{ route('aeropuerto.store') }}" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div>
                        <label for="NombreAeropuerto" class="block text-sm font-medium text-gray-700 mb-2 detail-label-with-icon">
                            <i class="material-icons text-sm mr-1">business</i> Nombre del Aeropuerto *
                        </label>
                        <input type="text" name="NombreAeropuerto" id="NombreAeropuerto" 
                               class="form-input w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-lime-500 @error('NombreAeropuerto') border-red-500 @enderror" 
                               value="{{ old('NombreAeropuerto') }}" required>
                        @error('NombreAeropuerto')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="Pais" class="block text-sm font-medium text-gray-700 mb-2 detail-label-with-icon">
                            <i class="material-icons text-sm mr-1">flag</i> País *
                        </label>
                        <input type="text" name="Pais" id="Pais" 
                               class="form-input w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-lime-500 @error('Pais') border-red-500 @enderror" 
                               value="{{ old('Pais') }}" required>
                        @error('Pais')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="Ciudad" class="block text-sm font-medium text-gray-700 mb-2 detail-label-with-icon">
                            <i class="material-icons text-sm mr-1">location_city</i> Ciudad *
                        </label>
                        <input type="text" name="Ciudad" id="Ciudad" 
                               class="form-input w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-lime-500 @error('Ciudad') border-red-500 @enderror" 
                               value="{{ old('Ciudad') }}" required>
                        @error('Ciudad')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div></div>

                    <div>
                        <label for="Estado" class="block text-sm font-medium text-gray-700 mb-2 detail-label-with-icon">
                            <i class="material-icons text-sm mr-1">toggle_on</i> Estado *
                        </label>
                        <select name="Estado" id="Estado" 
                                class="form-select w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-lime-500 @error('Estado') border-red-500 @enderror" 
                                required>
                            <option value="Activo" {{ old('Estado') == 'Activo' ? 'selected' : '' }}>Activo (En servicio)</option>
                            <option value="Inactivo" {{ old('Estado') == 'Inactivo' ? 'selected' : '' }}>Inactivo (Cerrado temporalmente)</option>
                        </select>
                        @error('Estado')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
                    <a href="{{ route('aeropuerto.listar') }}" class="material-btn material-btn-secondary">
                        <i class="material-icons text-sm mr-2">cancel</i>
                        Cancelar
                    </a>
                    <button type="submit" class="material-btn material-btn-primary">
                        <i class="material-icons text-sm mr-2">save</i>
                        Crear Aeropuerto
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection