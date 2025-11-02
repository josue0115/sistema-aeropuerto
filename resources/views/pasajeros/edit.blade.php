@extends('layouts.app')

@section('page-title', 'Editar Pasajero - Sistema Aeropuerto')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-6">
        <div class="flex items-center justify-between mb-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-800 mb-1 flex items-center">
                    <i class="material-icons text-yellow-600 mr-2 text-3xl">edit</i>
                    Editar Pasajero
                </h1>
                <p class="text-gray-600 text-lg">Modifique la información del pasajero #{{ $pasajero[0]->idPasajero }}</p>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('pasajeros.index') }}" class="material-btn material-btn-secondary flex items-center">
                    <i class="material-icons text-sm mr-2">list</i>
                    Ver Pasajeros
                </a>
            </div>
        </div>
    </div>

    <div class="material-card shadow-xl rounded-lg">
        <div class="p-6">
            <form action="{{ route('pasajeros.update', $pasajero[0]->idPasajero) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="Nombre" class="block text-sm font-medium text-gray-700 mb-1 flex items-center">
                            <i class="material-icons text-gray-500 mr-1 text-sm">person</i>Nombre
                        </label>
                        <input type="text" 
                               class="form-input @error('Nombre') border-red-500 @enderror w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                               id="Nombre" 
                               name="Nombre" 
                               value="{{ old('Nombre', $pasajero[0]->Nombre) }}" 
                               maxlength="45"
                               placeholder="Ingrese el nombre">
                        @error('Nombre')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="Apellido" class="block text-sm font-medium text-gray-700 mb-1 flex items-center">
                            <i class="material-icons text-gray-500 mr-1 text-sm">person</i>Apellido
                        </label>
                        <input type="text" 
                               class="form-input @error('Apellido') border-red-500 @enderror w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                               id="Apellido" 
                               name="Apellido" 
                               value="{{ old('Apellido', $pasajero[0]->Apellido) }}" 
                               maxlength="45"
                               placeholder="Ingrese el apellido">
                        @error('Apellido')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                    <div>
                        <label for="Pais" class="block text-sm font-medium text-gray-700 mb-1 flex items-center">
                            <i class="material-icons text-gray-500 mr-1 text-sm">public</i>País
                        </label>
                        <input type="text" 
                               class="form-input @error('Pais') border-red-500 @enderror w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                               id="Pais" 
                               name="Pais" 
                               value="{{ old('Pais', $pasajero[0]->Pais) }}" 
                               maxlength="45"
                               placeholder="Ej: México">
                        @error('Pais')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="TipoPasajero" class="block text-sm font-medium text-gray-700 mb-1 flex items-center">
                            <i class="material-icons text-gray-500 mr-1 text-sm">badge</i>Tipo Pasajero
                        </label>
                        <input type="text" 
                               class="form-input @error('TipoPasajero') border-red-500 @enderror w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                               id="TipoPasajero" 
                               name="TipoPasajero" 
                               value="{{ old('TipoPasajero', $pasajero[0]->TipoPasajero) }}" 
                               maxlength="45"
                               placeholder="Ej: Adulto, Niño">
                        @error('TipoPasajero')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                    <div>
                        <label for="Estado" class="block text-sm font-medium text-gray-700 mb-1 flex items-center">
                            <i class="material-icons text-gray-500 mr-1 text-sm">toggle_on</i>Estado
                        </label>
                        <select class="form-select @error('Estado') border-red-500 @enderror w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                                id="Estado" 
                                name="Estado">
                            <option value="">Seleccione un estado</option>
                            <option value="Activo" {{ old('Estado', $pasajero[0]->Estado) == 'Activo' ? 'selected' : '' }}>Activo</option>
                            <option value="Inactivo" {{ old('Estado', $pasajero[0]->Estado) == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                            <option value="Suspendido" {{ old('Estado', $pasajero[0]->Estado) == 'Suspendido' ? 'selected' : '' }}>Suspendido</option>
                            <option value="Bloqueado" {{ old('Estado', $pasajero[0]->Estado) == 'Bloqueado' ? 'selected' : '' }}>Bloqueado</option>
                        </select>
                        @error('Estado')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <div class="flex flex-row justify-center gap-4 mt-8 pt-6 border-t border-gray-200">
                    <button type="submit" class="material-btn material-btn-primary flex items-center px-6">
                        <i class="material-icons text-sm mr-2">save</i>
                        Actualizar Pasajero
                    </button>
                    <a href="{{ route('pasajeros.index') }}" class="material-btn material-btn-secondary flex items-center px-6">
                        <i class="material-icons text-sm mr-2">cancel</i>
                        Cancelar
                    </a>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection