@extends('layouts.app')

@section('page-title', 'Crear Equipaje - Sistema Aeropuerto')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header Section -->
    <div class="mb-8">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-3xl font-bold text-gray-800 mb-2">
                    <i class="material-icons text-blue-600 mr-2">work</i>
                    Crear Equipaje
                </h1>
                <p class="text-gray-600 text-lg">Complete la información del equipaje</p>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('boletos.create') }}" class="material-btn material-btn-secondary">
                    <i class="material-icons text-sm mr-2">arrow_back</i>
                    Volver a Boletos
                </a>
                <a href="{{ route('equipajes.index') }}" class="material-btn material-btn-secondary">
                    <i class="material-icons text-sm mr-2">list</i>
                    Ver Equipajes
                </a>
            </div>
        </div>
    </div>

    <!-- Info Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        @if(isset($boletoCreado))
        <div class="material-card">
            <div class="p-4">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                        <i class="material-icons text-green-600">confirmation_number</i>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-800">Boleto Seleccionado</h3>
                        <p class="text-gray-600">
                            #{{ $boletoCreado->idBoleto }} -
                            Pasajero: {{ $boletoCreado->idPasajero }} - Vuelo: {{ $boletoCreado->idVuelo }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <div class="material-card">
            <div class="p-4">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                        <i class="material-icons text-blue-600">work</i>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-800">Información del Equipaje</h3>
                        <p class="text-gray-600">Complete todos los campos requeridos</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Form Card -->
    <div class="material-card">
        <div class="p-6">
            <form action="{{ route('equipajes.store') }}" method="POST" id="equipaje-form">
                @csrf

                <!-- ID Equipaje oculto -->
                <input type="hidden" id="idEquipaje" name="idEquipaje" value="">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="idBoleto" class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="material-icons text-gray-500 mr-1 text-sm">confirmation_number</i>Código Boleto
                        </label>
                        <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('idBoleto') border-red-500 @enderror" id="idBoleto" name="idBoleto" required>
                            <option value="">Seleccione un boleto</option>
                            @if(isset($boletoCreado))
                                <option value="{{ $boletoCreado->idBoleto }}" selected>
                                    {{ $boletoCreado->idBoleto }} - {{ $boletoCreado->idPasajero }}
                                </option>
                            @endif
                            @foreach($boletos as $boleto)
                                <option value="{{ $boleto->idBoleto }}" {{ old('idBoleto') == $boleto->idBoleto ? 'selected' : '' }}>
                                    {{ $boleto->idBoleto }} - {{ $boleto->pasajero_nombre ?? 'N/A' }} {{ $boleto->pasajero_apellido ?? '' }}
                                </option>
                            @endforeach
                        </select>
                        @error('idBoleto')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="Costo" class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="material-icons text-gray-500 mr-1 text-sm">attach_money</i>Costo
                        </label>
                        <input type="number" step="0.01" min="0" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('Costo') border-red-500 @enderror" id="Costo" name="Costo" value="{{ old('Costo') }}" required>
                        @error('Costo')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="Dimensiones" class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="material-icons text-gray-500 mr-1 text-sm">straighten</i>Dimensiones (ej: 50x30x20)
                        </label>
                        <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('Dimensiones') border-red-500 @enderror" id="Dimensiones" name="Dimensiones" value="{{ old('Dimensiones') }}" placeholder="50x30x20" pattern="[0-9x\s]+" title="Solo números y 'x' permitidos" required>
                        @error('Dimensiones')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="Peso" class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="material-icons text-gray-500 mr-1 text-sm">scale</i>Peso (kg)
                        </label>
                        <input type="number" step="0.01" min="0" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('Peso') border-red-500 @enderror" id="Peso" name="Peso" value="{{ old('Peso') }}" required>
                        @error('Peso')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="CostoExtra" class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="material-icons text-gray-500 mr-1 text-sm">add_circle</i>Costo Extra
                        </label>
                        <input type="number" step="0.01" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 bg-gray-50" id="CostoExtra" name="CostoExtra" value="{{ old('CostoExtra', 0) }}" readonly>
                        <small class="text-gray-500 text-sm">Calculado automáticamente: $30 por cada 23kg</small>
                    </div>

                    <div>
                        <label for="Monto" class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="material-icons text-gray-500 mr-1 text-sm">calculate</i>Monto Total
                        </label>
                        <input type="number" step="0.01" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 bg-gray-50" id="Monto" name="Monto" value="{{ old('Monto') }}" readonly>
                        <small class="text-gray-500 text-sm">Costo + Costo Extra</small>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <div>
                        <label for="Estado" class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="material-icons text-gray-500 mr-1 text-sm">info</i>Estado
                        </label>
                        <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('Estado') border-red-500 @enderror" id="Estado" name="Estado" required>
                            <option value="">Seleccione un estado</option>
                            <option value="Registrado" {{ old('Estado', 'Registrado') == 'Registrado' ? 'selected' : '' }}>Registrado</option>
                            <option value="EnTransito" {{ old('Estado') == 'EnTransito' ? 'selected' : '' }}>En Tránsito</option>
                            <option value="Entregado" {{ old('Estado') == 'Entregado' ? 'selected' : '' }}>Entregado</option>
                            <option value="Perdido" {{ old('Estado') == 'Perdido' ? 'selected' : '' }}>Perdido</option>
                            <option value="Dañado" {{ old('Estado') == 'Dañado' ? 'selected' : '' }}>Dañado</option>
                        </select>
                        @error('Estado')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-row justify-center gap-4 mt-8 pt-6 border-t border-gray-200">
                    <button type="submit" class="material-btn material-btn-primary flex-1 justify-center">
                        <i class="material-icons text-sm mr-2">save</i>
                        Crear Equipaje
                    </button>
                    <button type="submit" name="action" value="next" class="material-btn material-btn-success flex-1 justify-center">
                        <i class="material-icons text-sm mr-2">arrow_forward</i>
                        Siguiente: Servicios
                    </button>
                    <a href="{{ route('equipajes.index') }}" class="material-btn material-btn-secondary flex-1 justify-center">
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
    const costoInput = document.getElementById('Costo');
    const pesoInput = document.getElementById('Peso');
    const costoExtraInput = document.getElementById('CostoExtra');
    const montoInput = document.getElementById('Monto');

    function calcularMontos() {
        const costo = parseFloat(costoInput.value) || 0;
        const peso = parseFloat(pesoInput.value) || 0;

        // Calcular costo extra: $30 por cada 23kg
        const costoExtra = (peso / 23) * 30;
        costoExtraInput.value = costoExtra.toFixed(2);

        // Calcular monto total: costo + costo extra
        const montoTotal = costo + costoExtra;
        montoInput.value = montoTotal.toFixed(2);
    }

    // Validación en tiempo real para dimensiones
    document.getElementById('Dimensiones').addEventListener('input', function() {
        const value = this.value;
        // Solo permitir números, 'x' y espacios
        if (!/^[0-9x\s]*$/.test(value)) {
            this.value = value.replace(/[^0-9x\s]/g, '');
        }
    });

    // Validación para costo (no negativo)
    costoInput.addEventListener('input', function() {
        if (this.value < 0) {
            this.value = 0;
        }
        calcularMontos();
    });

    // Validación para peso (no negativo)
    pesoInput.addEventListener('input', function() {
        if (this.value < 0) {
            this.value = 0;
        }
        calcularMontos();
    });

    // Calcular inicialmente
    calcularMontos();
});
</script>
@endsection
