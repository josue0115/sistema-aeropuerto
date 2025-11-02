@extends('layouts.app')

@section('page-title', 'Crear Tipo de Servicio - Sistema Aeropuerto')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="material-card">
        <div class="p-6 border-b border-gray-200">
            <h1 class="text-2xl font-semibold text-gray-800">
                <i class="material-icons text-blue-600 mr-2">room_service</i>
                Crear Nuevo Tipo de Servicio
            </h1>
            <p class="text-gray-600 mt-1">Complete la información para agregar un nuevo tipo de servicio al sistema</p>
        </div>

        <div class="p-6">
            <form method="POST" action="{{ route('tipo_servicios.store') }}" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="Nombre" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="material-icons text-sm mr-1">label</i>
                            Nombre
                        </label>
                        <input type="text" name="Nombre" id="Nombre" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" value="{{ old('Nombre') }}" required maxlength="50">
                        @error('Nombre')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="Costo" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="material-icons text-sm mr-1">attach_money</i>
                            Costo
                        </label>
                        <input type="number" step="0.01" name="Costo" id="Costo" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" value="{{ old('Costo') }}" required min="0">
                        @error('Costo')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="Descripcion" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="material-icons text-sm mr-1">description</i>
                        Descripción
                    </label>
                    <textarea name="Descripcion" id="Descripcion" rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('Descripcion') }}</textarea>
                    @error('Descripcion')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
                    <a href="{{ route('tipo_servicios.index') }}" class="material-btn border border-gray-300 text-gray-700 hover:bg-gray-50">
                        <i class="material-icons text-sm mr-2">cancel</i>
                        Cancelar
                    </a>
                    <button type="submit" class="material-btn material-btn-primary">
                        <i class="material-icons text-sm mr-2">save</i>
                        Crear Tipo de Servicio
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
