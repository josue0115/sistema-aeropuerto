@extends('layouts.app')

@section('page-title', 'Editar Escala - Sistema Aeropuerto')

@section('content')
<div class="container mx-auto px-4 py-8">
    
    <div class="mb-6 flex items-center justify-between">
        <h1 class="text-3xl font-bold text-gray-800 flex items-center">
            <i class="material-icons text-purple-600 mr-2 text-3xl">edit</i>
            Editar Escala
        </h1>
        <a href="{{ route('escala.index') }}" class="material-btn material-btn-secondary flex items-center">
            <i class="material-icons text-sm mr-2">arrow_back</i>
            Volver a Escalas
        </a>
    </div>

    <div class="material-card shadow-xl rounded-lg max-w-2xl mx-auto border-t-4 border-purple-500">
        <div class="p-6">
            
            <h2 class="text-xl font-semibold text-gray-700 mb-6 border-b pb-3">
                Modificar Parada Técnica: **#{{ $escala->IdEscala }}**
            </h2>

            <form method="POST" action="{{ route('escala.update', $escala) }}">
                @csrf
                @method('PUT')

                <div class="mb-5">
                    <label for="IdVuelo" class="block text-sm font-medium text-gray-700 mb-1">
                        <i class="material-icons text-gray-500 mr-1 text-sm align-middle">flight_takeoff</i>Vuelo *
                    </label>
                    <select name="IdVuelo" id="IdVuelo" class="form-select w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 @error('IdVuelo') border-red-500 @enderror" required>
                        <option value="">Seleccione un vuelo</option>
                        @foreach($vuelos as $vuelo)
                            <option value="{{ $vuelo->IdVuelo }}" 
                                {{ $vuelo->IdVuelo == old('IdVuelo', $escala->IdVuelo) ? 'selected' : '' }}>
                                Vuelo #{{ $vuelo->IdVuelo }} -
                                {{ $vuelo->aeropuertoOrigen->NombreAeropuerto ?? 'N/A' }} →
                                {{ $vuelo->aeropuertoDestino->NombreAeropuerto ?? 'N/A' }}
                            </option>
                        @endforeach
                    </select>
                    @error('IdVuelo')
                        <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="IdAeropuerto" class="block text-sm font-medium text-gray-700 mb-1">
                        <i class="material-icons text-gray-500 mr-1 text-sm align-middle">location_city</i>Aeropuerto de Escala *
                    </label>
                    <select name="IdAeropuerto" id="IdAeropuerto" class="form-select w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 @error('IdAeropuerto') border-red-500 @enderror" required>
                        <option value="">Seleccione un aeropuerto</option>
                        @foreach($aeropuertos as $aeropuerto)
                            <option value="{{ $aeropuerto->IdAeropuerto }}" 
                                {{ $aeropuerto->IdAeropuerto == old('IdAeropuerto', $escala->IdAeropuerto) ? 'selected' : '' }}>
                                {{ $aeropuerto->IdAeropuerto }} - {{ $aeropuerto->NombreAeropuerto }}
                            </option>
                        @endforeach
                    </select>
                    @error('IdAeropuerto')
                        <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    <div class="mb-5">
                        <label for="HoraSalida" class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="material-icons text-gray-500 mr-1 text-sm align-middle">access_time</i>Hora Salida de Escala *
                        </label>
                        <input type="time" name="HoraSalida" id="HoraSalida" 
                               class="form-input w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 @error('HoraSalida') border-red-500 @enderror" 
                               value="{{ old('HoraSalida', $escala->HoraSalida) }}" required>
                        @error('HoraSalida')
                            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-5">
                        <label for="HoraLlegada" class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="material-icons text-gray-500 mr-1 text-sm align-middle">schedule</i>Hora Llegada a Escala *
                        </label>
                        <input type="time" name="HoraLlegada" id="HoraLlegada" 
                               class="form-input w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 @error('HoraLlegada') border-red-500 @enderror" 
                               value="{{ old('HoraLlegada', $escala->HoraLlegada) }}" required>
                        @error('HoraLlegada')
                            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-5">
                    <label for="TiempoEspera" class="block text-sm font-medium text-gray-700 mb-1">
                        <i class="material-icons text-gray-500 mr-1 text-sm align-middle">timelapse</i>Tiempo de Espera (minutos) *
                    </label>
                    <input type="number" name="TiempoEspera" id="TiempoEspera" 
                           class="form-input w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 @error('TiempoEspera') border-red-500 @enderror" 
                           min="0" value="{{ old('TiempoEspera', $escala->TiempoEspera) }}" required>
                    @error('TiempoEspera')
                        <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="Estado" class="block text-sm font-medium text-gray-700 mb-1">
                        <i class="material-icons text-gray-500 mr-1 text-sm align-middle">flag</i>Estado *
                    </label>
                    <select name="Estado" id="Estado" class="form-select w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 @error('Estado') border-red-500 @enderror" required>
                        <option value="">Seleccione un estado</option>
                        <option value="Activo" {{ old('Estado', $escala->Estado) == 'Activo' ? 'selected' : '' }}>Activo</option>
                        <option value="Inactivo" {{ old('Estado', $escala->Estado) == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                        <option value="Cancelado" {{ old('Estado', $escala->Estado) == 'Cancelado' ? 'selected' : '' }}>Cancelado</option>
                        <option value="Programada" {{ old('Estado', $escala->Estado) == 'Programada' ? 'selected' : '' }}>Programada</option>
                        <option value="Finalizada" {{ old('Estado', $escala->Estado) == 'Finalizada' ? 'selected' : '' }}>Finalizada</option>
                    </select>
                    @error('Estado')
                        <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="flex justify-end gap-4 pt-4 border-t border-gray-200">
                    <a href="{{ route('escala.index') }}" class="material-btn material-btn-secondary flex-none px-6">
                        <i class="material-icons text-sm mr-2">cancel</i> Cancelar
                    </a>
                    <button type="submit" class="material-btn material-btn-primary flex-none px-6">
                        <i class="material-icons text-sm mr-2">save</i> Actualizar Escala
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Aseguramos que jQuery esté disponible antes de usarlo
    if (typeof jQuery !== 'undefined') {
        $(document).ready(function() {
            // Validar que la hora de salida sea anterior a la hora de llegada
            $('#HoraSalida, #HoraLlegada').on('change', function() {
                const salida = $('#HoraSalida').val();
                const llegada = $('#HoraLlegada').val();
                
                // Solo validar si ambas horas están seleccionadas
                if (salida && llegada) {
                    // Si la hora de llegada es igual o anterior a la hora de salida
                    if (llegada <= salida) {
                        alert('La Hora de Salida de la escala debe ser posterior a la Hora de Llegada a la escala.');
                        // Limpiar la hora que se acaba de introducir para forzar la corrección
                        $(this).val(''); 
                    }
                }
            });
        });
    } else {
        // En caso de que se necesite una versión sin jQuery:
        document.addEventListener('DOMContentLoaded', function() {
            const horaSalida = document.getElementById('HoraSalida');
            const horaLlegada = document.getElementById('HoraLlegada');

            function validarHoras() {
                const salida = horaSalida.value;
                const llegada = horaLlegada.value;

                if (salida && llegada && llegada <= salida) {
                    alert('La Hora de Salida de la escala debe ser posterior a la Hora de Llegada a la escala.');
                    // Limpiar el campo que fue editado
                    if (this === horaLlegada) {
                        horaLlegada.value = '';
                    } else if (this === horaSalida) {
                         // Esto es más complejo, mejor dejarlo a discreción del usuario
                    }
                }
            }
            
            horaSalida.addEventListener('change', validarHoras);
            horaLlegada.addEventListener('change', validarHoras);
        });
    }
</script>
@endsection