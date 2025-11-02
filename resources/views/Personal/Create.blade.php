@extends('layouts.app')

@section('page-title', 'Crear Nuevo Personal')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-6">
        <div class="flex items-center justify-between mb-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-800 mb-1 flex items-center">
                    <i class="material-icons text-indigo-600 mr-2 text-3xl">person_add</i>
                    Agregar Nuevo Personal
                </h1>
                <p class="text-gray-600 text-lg">Ingrese los datos del nuevo empleado del aeropuerto.</p>
            </div>
            <a href="{{ route('personal.listar') }}" class="material-btn material-btn-secondary flex items-center">
                <i class="material-icons text-sm mr-2">list</i>
                Ver Lista de Personal
            </a>
        </div>
    </div>
    
    <div class="material-card shadow-xl rounded-lg max-w-4xl mx-auto">
        <div class="p-6">
            <form method="POST" action="{{ route('personal.store') }}">
                @csrf
                
                <h5 class="text-xl font-semibold text-gray-700 border-b pb-3 mb-6">Detalles del Puesto</h5>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="col-span-1">
                        <label for="Cargo" class="block text-sm font-medium text-gray-700 mb-1">Cargo *</label>
                        <select id="Cargo" name="Cargo" class="form-select @error('Cargo') border-red-500 @enderror w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                            <option value="">Seleccione</option>
                            <option value="Piloto" {{ old('Cargo') == 'Piloto' ? 'selected' : '' }}>Piloto</option>
                            <option value="Copiloto" {{ old('Cargo') == 'Copiloto' ? 'selected' : '' }}>Copiloto</option>
                            <option value="Azafata" {{ old('Cargo') == 'Azafata' ? 'selected' : '' }}>Azafata</option>
                            <option value="Mecánico" {{ old('Cargo') == 'Mecánico' ? 'selected' : '' }}>Mecánico</option>
                            <option value="Administrador" {{ old('Cargo') == 'Administrador' ? 'selected' : '' }}>Administrador</option>
                            <option value="Recepcionista" {{ old('Cargo') == 'Recepcionista' ? 'selected' : '' }}>Recepcionista</option>
                            <option value="Seguridad" {{ old('Cargo') == 'Seguridad' ? 'selected' : '' }}>Seguridad</option>
                            <option value="Limpieza" {{ old('Cargo') == 'Limpieza' ? 'selected' : '' }}>Limpieza</option>
                        </select>
                        @error('Cargo')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="col-span-1">
                        <label for="Salario" class="block text-sm font-medium text-gray-700 mb-1">Salario (Q) *</label>
                        <input type="number" step="0.01" id="Salario" name="Salario" class="form-input w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 cursor-not-allowed" value="{{ old('Salario') }}" readonly>
                        <p class="text-xs text-gray-500 mt-1">Se auto-calcula según el cargo.</p>
                        @error('Salario')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="col-span-1">
                        <label for="FechaIngreso" class="block text-sm font-medium text-gray-700 mb-1">Fecha Ingreso *</label>
                        <input type="date" id="FechaIngreso" name="FechaIngreso" class="form-input @error('FechaIngreso') border-red-500 @enderror w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" min="{{ date('Y-m-d') }}" value="{{ old('FechaIngreso', date('Y-m-d')) }}" required>
                        @error('FechaIngreso')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <h5 class="text-xl font-semibold text-gray-700 border-b pb-3 mb-6 mt-8">Información Personal</h5>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="Nombre" class="block text-sm font-medium text-gray-700 mb-1">Nombre *</label>
                        <input type="text" id="Nombre" name="Nombre" class="form-input @error('Nombre') border-red-500 @enderror w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" value="{{ old('Nombre') }}" required>
                        @error('Nombre')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="Apellido" class="block text-sm font-medium text-gray-700 mb-1">Apellido *</label>
                        <input type="text" id="Apellido" name="Apellido" class="form-input @error('Apellido') border-red-500 @enderror w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" value="{{ old('Apellido') }}" required>
                        @error('Apellido')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="Telefono" class="block text-sm font-medium text-gray-700 mb-1">Teléfono *</label>
                        <input type="number" id="Telefono" name="Telefono" class="form-input @error('Telefono') border-red-500 @enderror w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" value="{{ old('Telefono') }}" required>
                        @error('Telefono')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="Correo" class="block text-sm font-medium text-gray-700 mb-1">Correo *</label>
                        <input type="email" id="Correo" name="Correo" class="form-input @error('Correo') border-red-500 @enderror w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" value="{{ old('Correo') }}" required>
                        @error('Correo')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                    <div>
                        <label for="Direccion" class="block text-sm font-medium text-gray-700 mb-1">Dirección *</label>
                        <input type="text" id="Direccion" name="Direccion" class="form-input @error('Direccion') border-red-500 @enderror w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" value="{{ old('Direccion') }}" required>
                        @error('Direccion')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="Estado" class="block text-sm font-medium text-gray-700 mb-1">Estado</label>
                        <select id="Estado" name="Estado" class="form-select @error('Estado') border-red-500 @enderror w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            <option value="Activo" {{ old('Estado', 'Activo') == 'Activo' ? 'selected' : '' }}>Activo</option>
                            <option value="Inactivo" {{ old('Estado') == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                        </select>
                        @error('Estado')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex justify-start mt-8 pt-6 border-t border-gray-200">
                    <button type="submit" class="material-btn material-btn-primary flex items-center px-6">
                        <i class="material-icons text-sm mr-2">save</i>
                        Guardar Personal
                    </button>
                    <a href="{{ route('personal.listar') }}" class="material-btn material-btn-secondary ml-3 flex items-center px-6">
                        <i class="material-icons text-sm mr-2">cancel</i>
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const cargoSelect = document.getElementById('Cargo');
    const salarioInput = document.getElementById('Salario');

    function actualizarSalario() {
        const cargo = cargoSelect.value;
        let salario = 0;
        
        // Define los salarios basados en tu lógica
        switch(cargo) {
            case 'Piloto': salario = 5000.00; break;
            case 'Copiloto': salario = 4000.00; break;
            case 'Azafata': salario = 2500.00; break;
            case 'Mecánico': salario = 3000.00; break;
            case 'Administrador': salario = 3500.00; break;
            case 'Recepcionista': salario = 2000.00; break;
            case 'Seguridad': salario = 2200.00; break;
            case 'Limpieza': salario = 1800.00; break;
            default: salario = 0.00;
        }
        
        salarioInput.value = salario.toFixed(2);
    }
    
    // Inicializar el salario al cargar la página (útil para old())
    actualizarSalario();

    // Event listener para actualizar el salario al cambiar el cargo
    cargoSelect.addEventListener('change', actualizarSalario);
});
</script>
@endsection