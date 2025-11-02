@extends('layouts.app')

@section('page-title', 'Crear Aerolínea - Sistema Aeropuerto')

@section('content')
<div class="container mx-auto px-4 py-8">

    <div class="material-card shadow-xl rounded-lg max-w-4xl mx-auto border-t-4 border-cyan-600">
        
        <div class="p-6 border-b border-gray-200">
            <h1 class="text-2xl font-bold text-gray-800 flex items-center">
                <i class="material-icons text-cyan-600 mr-2 text-3xl">add_business</i>
                Crear Nueva Aerolínea
            </h1>
            <p class="text-gray-600 mt-1">Complete la información para registrar una nueva aerolínea en el sistema.</p>
        </div>

        <div class="p-6">
            <form method="POST" action="{{ route('aerolinea.store') }}" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div>
                        <label for="Nombre" class="block text-sm font-medium text-gray-700 mb-2 detail-label-with-icon">
                            <i class="material-icons text-sm mr-1">business</i> Nombre de la Aerolínea *
                        </label>
                        <input type="text" name="Nombre" id="Nombre" 
                               class="form-input w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-cyan-500 @error('Nombre') border-red-500 @enderror" 
                               value="{{ old('Nombre') }}" required>
                        @error('Nombre')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="IATA" class="block text-sm font-medium text-gray-700 mb-2 detail-label-with-icon">
                            <i class="material-icons text-sm mr-1">flight</i> Código IATA
                        </label>
                        <input type="hidden" name="IATA" id="IATA" value="{{ $iataPreview ?? 'N/A' }}">
                        <input type="text" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 text-gray-700 font-semibold" 
                               value="{{ $iataPreview ?? 'Generación automática' }}" readonly>
                        <p class="mt-1 text-xs text-gray-500">Este valor se asignará automáticamente (ej. IATA: AA)</p>
                    </div>

                    <div>
                        <label for="Ciudad" class="block text-sm font-medium text-gray-700 mb-2 detail-label-with-icon">
                            <i class="material-icons text-sm mr-1">location_city</i> Ciudad Base *
                        </label>
                        <input type="text" name="Ciudad" id="Ciudad" 
                               class="form-input w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-cyan-500 @error('Ciudad') border-red-500 @enderror" 
                               value="{{ old('Ciudad') }}" required>
                        @error('Ciudad')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="Pais" class="block text-sm font-medium text-gray-700 mb-2 detail-label-with-icon">
                            <i class="material-icons text-sm mr-1">flag</i> País Base *
                        </label>
                        <input type="text" name="Pais" id="Pais" 
                               class="form-input w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-cyan-500 @error('Pais') border-red-500 @enderror" 
                               value="{{ old('Pais') }}" required>
                        @error('Pais')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="Estado" class="block text-sm font-medium text-gray-700 mb-2 detail-label-with-icon">
                            <i class="material-icons text-sm mr-1">toggle_on</i> Estado Operacional *
                        </label>
                        <select name="Estado" id="Estado" 
                                class="form-select w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-cyan-500 @error('Estado') border-red-500 @enderror" 
                                required>
                            <option value="Activo" {{ old('Estado') == 'Activo' ? 'selected' : '' }}>Activo</option>
                            <option value="Inactivo" {{ old('Estado') == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                        </select>
                        @error('Estado')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
                    <a href="{{ route('aerolinea.Listar') }}" class="material-btn material-btn-secondary">
                        <i class="material-icons text-sm mr-2">cancel</i>
                        Cancelar
                    </a>
                    <button type="submit" class="material-btn material-btn-primary">
                        <i class="material-icons text-sm mr-2">save</i>
                        Crear Aerolínea
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection