@extends('layouts.app')

@section('page-title', 'Crear Mantenimiento')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-6">
        <div class="flex items-center justify-between mb-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-800 mb-1 flex items-center">
                    <i class="material-icons text-indigo-600 mr-2 text-3xl">build</i>
                    Crear Nuevo Registro de Mantenimiento
                </h1>
                <p class="text-gray-600 text-lg">Asigne el personal, el avión y los detalles del servicio requerido.</p>
            </div>
            <a href="{{ route('mantenimiento.listar') }}" class="material-btn material-btn-secondary flex items-center">
                <i class="material-icons text-sm mr-2">list</i>
                Ver Lista de Mantenimientos
            </a>
        </div>
    </div>
    
    <div class="material-card shadow-xl rounded-lg max-w-4xl mx-auto">
        <div class="p-6">
            <form method="POST" action="{{ route('mantenimiento.store') }}">
                @csrf
                
                <h5 class="text-xl font-semibold text-gray-700 border-b pb-3 mb-6">Información del Servicio y Fechas</h5>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <div class="mb-5">
                            <label for="IdAvion" class="block text-sm font-medium text-gray-700 mb-1">Avión *</label>
                            <select name="IdAvion" id="IdAvion" class="form-select w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                                <option value="">Seleccione</option>
                                @foreach($aviones as $avion)
                                <option value="{{ $avion->IdAvion }}" {{ old('IdAvion') == $avion->IdAvion ? 'selected' : '' }}>{{ $avion->IdAvion }} - {{ $avion->Placa }}</option>
                                @endforeach
                            </select>
                            @error('IdAvion')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="mb-5">
                            <label for="IdPersonal" class="block text-sm font-medium text-gray-700 mb-1">Personal (Mecánico/Técnico) *</label>
                            <select name="IdPersonal" id="IdPersonal" class="form-select w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                                <option value="">Seleccione</option>
                                @foreach($personales as $personal)
                                <option value="{{ $personal->IdPersonal }}" {{ old('IdPersonal') == $personal->IdPersonal ? 'selected' : '' }}>{{ $personal->IdPersonal }} - {{ $personal->Nombre }} {{ $personal->Apellido }}</option>
                                @endforeach
                            </select>
                            @error('IdPersonal')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="mb-5" id="fechaIngresoGroup">
                            <label for="FechaIngreso" class="block text-sm font-medium text-gray-700 mb-1">Fecha Ingreso *</label>
                            <input type="date" name="FechaIngreso" id="FechaIngreso" class="form-input w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" min="{{ date('Y-m-d') }}" value="{{ old('FechaIngreso', date('Y-m-d')) }}" required>
                            <p class="text-xs text-gray-500 mt-1" id="feedbackIngreso"></p>
                            @error('FechaIngreso')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="mb-5" id="fechaSalidaGroup">
                            <label for="FechaSalida" class="block text-sm font-medium text-gray-700 mb-1">Fecha Salida *</label>
                            <input type="date" name="FechaSalida" id="FechaSalida" class="form-input w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" value="{{ old('FechaSalida') }}" required>
                            <p class="text-red-500 text-xs mt-1 hidden" id="feedbackSalida">La fecha de salida debe ser posterior a la fecha de ingreso.</p>
                            @error('FechaSalida')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    
                    <div>
                        <div class="mb-5">
                            <label for="Tipo" class="block text-sm font-medium text-gray-700 mb-1">Tipo de Mantenimiento *</label>
                            <select name="Tipo" id="Tipo" class="form-select w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                                <option value="">Seleccione</option>
                                <option value="Preventivo" {{ old('Tipo') == 'Preventivo' ? 'selected' : '' }}>Preventivo</option>
                                <option value="Correctivo" {{ old('Tipo') == 'Correctivo' ? 'selected' : '' }}>Correctivo</option>
                                <option value="Emergencia" {{ old('Tipo') == 'Emergencia' ? 'selected' : '' }}>Emergencia</option>
                                <option value="Inspección" {{ old('Tipo') == 'Inspección' ? 'selected' : '' }}>Inspección</option>
                            </select>
                            @error('Tipo')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="mb-5">
                            <label for="Estado" class="block text-sm font-medium text-gray-700 mb-1">Estado *</label>
                            <select name="Estado" id="Estado" class="form-select w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                                <option value="">Seleccione</option>
                                <option value="Pendiente" {{ old('Estado') == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                                <option value="En Progreso" {{ old('Estado') == 'En Progreso' ? 'selected' : '' }}>En Progreso</option>
                                <option value="Completado" {{ old('Estado') == 'Completado' ? 'selected' : '' }}>Completado</option>
                                <option value="Cancelado" {{ old('Estado') == 'Cancelado' ? 'selected' : '' }}>Cancelado</option>
                            </select>
                            @error('Estado')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-5">
                            <label for="Costo" class="block text-sm font-medium text-gray-700 mb-1">Costo Base (Q)</label>
                            <input type="number" name="Costo" id="Costo" step="0.01" class="form-input w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 cursor-not-allowed" value="{{ old('Costo', '0.00') }}" readonly>
                            <p class="text-xs text-gray-500 mt-1">Costo base según el tipo de mantenimiento.</p>
                            @error('Costo')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="mb-5">
                            <label for="CostoExtra" class="block text-sm font-medium text-gray-700 mb-1">Costo Extra (Q)</label>
                            <input type="number" name="CostoExtra" id="CostoExtra" class="form-input w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" min="0" step="0.01" value="{{ old('CostoExtra', '0.00') }}">
                            @error('CostoExtra')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="mb-6">
                    <label for="Descripcion" class="block text-sm font-medium text-gray-700 mb-1">Descripción del Trabajo *</label>
                    <textarea name="Descripcion" id="Descripcion" class="form-textarea w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" rows="4" required>{{ old('Descripcion') }}</textarea>
                    @error('Descripcion')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="flex justify-start mt-8 pt-6 border-t border-gray-200">
                    <button type="submit" class="material-btn material-btn-primary flex items-center px-6">
                        <i class="material-icons text-sm mr-2">add</i>
                        Crear Registro
                    </button>
                    <a href="{{ route('mantenimiento.listar') }}" class="material-btn material-btn-secondary ml-3 flex items-center px-6">
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
    const tipoSelect = document.getElementById('Tipo');
    const costoInput = document.getElementById('Costo');
    const fechaIngresoInput = document.getElementById('FechaIngreso');
    const fechaSalidaInput = document.getElementById('FechaSalida');
    const feedbackSalida = document.getElementById('feedbackSalida');
    const form = document.querySelector('form');

    // --- Lógica de Costo ---
    function actualizarCosto() {
        const tipo = tipoSelect.value;
        let costo = 0;
        
        switch(tipo) {
            case 'Preventivo': costo = 500.00; break;
            case 'Correctivo': costo = 800.00; break;
            case 'Emergencia': costo = 1200.00; break;
            case 'Inspección': costo = 300.00; break;
            default: costo = 0.00;
        }
        
        costoInput.value = costo.toFixed(2); 
    }

    tipoSelect.addEventListener('change', actualizarCosto);
    // Llama al iniciar para establecer el valor inicial
    actualizarCosto();

    // --- Lógica de Validación de Fechas ---
    function validateDates(e) {
        const fechaIngreso = fechaIngresoInput.value;
        const fechaSalida = fechaSalidaInput.value;
        let isValid = true;
        
        // Limpia cualquier estado de validación previo de Tailwind/Custom
        fechaSalidaInput.classList.remove('border-red-500', 'border-green-500');
        feedbackSalida.classList.add('hidden');
        
        if (fechaIngreso && fechaSalida) {
            if (new Date(fechaSalida) <= new Date(fechaIngreso)) {
                // Muestra error
                fechaSalidaInput.classList.add('border-red-500');
                fechaSalidaInput.classList.remove('focus:ring-indigo-500');
                fechaSalidaInput.classList.add('focus:ring-red-500');
                feedbackSalida.classList.remove('hidden');
                isValid = false;
            } else {
                // Muestra éxito (opcional, pero buena práctica)
                fechaSalidaInput.classList.add('border-green-500');
                fechaSalidaInput.classList.remove('focus:ring-red-500');
                fechaSalidaInput.classList.add('focus:ring-indigo-500');
            }
        }
        
        return isValid;
    }

    // Adjunta la validación a ambos campos de fecha
    fechaIngresoInput.addEventListener('change', validateDates);
    fechaSalidaInput.addEventListener('change', validateDates);
    
    // Previene el envío del formulario si la validación falla
    form.addEventListener('submit', function(e) {
        if (!validateDates()) {
            e.preventDefault();
            // Scroll al campo con error
            document.getElementById('fechaSalidaGroup').scrollIntoView({
                behavior: 'smooth',
                block: 'center'
            });
            return false;
        }
    });
});
</script>
@endsection