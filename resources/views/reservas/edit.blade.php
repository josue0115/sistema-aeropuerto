@extends('layouts.app')

@section('page-title', 'Editar Reserva - Sistema Aeropuerto')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-6">
        <div class="flex items-center justify-between mb-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-800 mb-1 flex items-center">
                    <i class="material-icons text-yellow-600 mr-2 text-3xl">edit</i>
                    Editar Reserva
                </h1>
                <p class="text-gray-600 text-lg">Modifique los detalles de la reserva #{{ $reserva->idReserva }}</p>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('reservas.index') }}" class="material-btn material-btn-secondary flex items-center">
                    <i class="material-icons text-sm mr-2">list</i>
                    Volver a Reservas
                </a>
            </div>
        </div>
    </div>
    
    <div class="material-card shadow-xl rounded-lg">
        <div class="p-6">
            <form action="{{ route('reservas.update', $reserva->idReserva) }}" method="POST">
                @csrf
                @method('PUT')

                <input type="hidden" id="idReserva" name="idReserva" value="{{ $reserva->idReserva }}">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    <div>
                        <label for="idPasajero" class="block text-sm font-medium text-gray-700 mb-1 flex items-center">
                            <i class="material-icons text-gray-500 mr-1 text-sm">person_pin</i>Código Pasajero
                        </label>
                        <select class="form-select @error('idPasajero') border-red-500 @enderror w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                                id="idPasajero" 
                                name="idPasajero" 
                                required>
                            <option value="">Seleccione un pasajero</option>
                            @foreach($pasajeros as $pasajero)
                                <option value="{{ $pasajero->idPasajero }}" {{ old('idPasajero', $reserva->idPasajero) == $pasajero->idPasajero ? 'selected' : '' }}>
                                    {{ $pasajero->idPasajero }} - {{ $pasajero->Nombre }} {{ $pasajero->Apellido }}
                                </option>
                            @endforeach
                        </select>
                        @error('idPasajero')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="idVuelo" class="block text-sm font-medium text-gray-700 mb-1 flex items-center">
                            <i class="material-icons text-gray-500 mr-1 text-sm">flight</i>Código Vuelo
                        </label>
                        <select class="form-select @error('idVuelo') border-red-500 @enderror w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                                id="idVuelo" 
                                name="idVuelo" 
                                required>
                            <option value="">Seleccione un vuelo</option>
                            @foreach($vuelos as $vuelo)
                                <option value="{{ $vuelo->IdVuelo }}" 
                                        data-precio="{{ $vuelo->Precio }}" 
                                        data-fecha-salida="{{ $vuelo->FechaSalida }}" 
                                        {{ old('idVuelo', $reserva->idVuelo) == $vuelo->IdVuelo ? 'selected' : '' }}>
                                    {{ $vuelo->IdVuelo }} - {{ $vuelo->aeropuertoOrigen->NombreAeropuerto ?? 'N/A' }} a {{ $vuelo->aeropuertoDestino->NombreAeropuerto ?? 'N/A' }}
                                </option>
                            @endforeach
                        </select>
                        @error('idVuelo')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div id="historial-reservas" class="mt-6" style="display: none;">
                    <div class="material-card border border-gray-200 bg-gray-50 p-4 rounded-lg shadow-sm">
                        <h6 class="text-lg font-semibold text-gray-700 mb-3 flex items-center">
                            <i class="material-icons text-blue-500 mr-2 text-xl">history</i>
                            Reservas Anteriores del Pasajero
                        </h6>
                        <div id="historial-content" class="text-sm text-gray-600">
                            </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                    <div>
                        <label for="FechaReserva" class="block text-sm font-medium text-gray-700 mb-1 flex items-center">
                            <i class="material-icons text-gray-500 mr-1 text-sm">event_note</i>Fecha Reserva
                        </label>
                        <input type="datetime-local" 
                               class="form-input @error('FechaReserva') border-red-500 @enderror w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                               id="FechaReserva" 
                               name="FechaReserva" 
                               value="{{ old('FechaReserva', $reserva->FechaReserva ? \Carbon\Carbon::parse($reserva->FechaReserva)->format('Y-m-d\TH:i') : date('Y-m-d\TH:i')) }}" 
                               min="{{ date('Y-m-d\TH:i') }}" 
                               required>
                        @error('FechaReserva')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="FechaVuelo" class="block text-sm font-medium text-gray-700 mb-1 flex items-center">
                            <i class="material-icons text-gray-500 mr-1 text-sm">flight_takeoff</i>Fecha Vuelo
                        </label>
                        <input type="datetime-local" 
                               class="form-input @error('FechaVuelo') border-red-500 @enderror w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                               id="FechaVuelo" 
                               name="FechaVuelo" 
                               value="{{ old('FechaVuelo', $reserva->FechaVuelo ? \Carbon\Carbon::parse($reserva->FechaVuelo)->format('Y-m-d\TH:i') : '') }}" 
                               min="{{ date('Y-m-d\TH:i') }}" 
                               required>
                        @error('FechaVuelo')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                    <div>
                        <label for="MontoAnticipado" class="block text-sm font-medium text-gray-700 mb-1 flex items-center">
                            <i class="material-icons text-gray-500 mr-1 text-sm">attach_money</i>Monto Anticipado (10% del vuelo)
                        </label>
                        <input type="number" 
                               step="0.01" 
                               class="form-input w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 cursor-not-allowed" 
                               id="MontoAnticipado" 
                               name="MontoAnticipado" 
                               value="{{ old('MontoAnticipado', $reserva->MontoAnticipado) }}" 
                               readonly>
                    </div>

                    <div>
                        <label for="Estado" class="block text-sm font-medium text-gray-700 mb-1 flex items-center">
                            <i class="material-icons text-gray-500 mr-1 text-sm">toggle_on</i>Estado
                        </label>
                        <select class="form-select @error('Estado') border-red-500 @enderror w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                                id="Estado" 
                                name="Estado" 
                                required>
                            <option value="">Seleccione un estado</option>
                            <option value="Activo" {{ old('Estado', $reserva->Estado) == 'Activo' ? 'selected' : '' }}>Activo</option>
                            <option value="Inactivo" {{ old('Estado', $reserva->Estado) == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                            <option value="Pendiente" {{ old('Estado', $reserva->Estado) == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                            <option value="Confirmado" {{ old('Estado', $reserva->Estado) == 'Confirmado' ? 'selected' : '' }}>Confirmado</option>
                            <option value="Cancelado" {{ old('Estado', $reserva->Estado) == 'Cancelado' ? 'selected' : '' }}>Cancelado</option>
                        </select>
                        @error('Estado')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex flex-row justify-start gap-4 mt-8 pt-6 border-t border-gray-200">
                    <button type="submit" class="material-btn material-btn-primary flex items-center px-6">
                        <i class="material-icons text-sm mr-2">save</i>
                        Actualizar Reserva
                    </button>
                    <a href="{{ route('reservas.index') }}" class="material-btn material-btn-secondary flex items-center px-6">
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
    const pasajeroSelect = document.getElementById('idPasajero');
    const vueloSelect = document.getElementById('idVuelo');
    const fechaReservaInput = document.getElementById('FechaReserva');
    const fechaVueloInput = document.getElementById('FechaVuelo');
    const montoAnticipadoInput = document.getElementById('MontoAnticipado');
    const historialDiv = document.getElementById('historial-reservas');
    const historialContent = document.getElementById('historial-content');

    // Datos de reservas existentes pasados desde el controlador
    const reservasExistentes = @json($reservasExistentes ?? []);

    function mostrarHistorialReservas(idPasajero) {
        const reservasPasajero = reservasExistentes.filter(r => r.idPasajero == idPasajero);

        if (reservasPasajero.length > 0) {
            let html = '<ul class="list-disc list-inside space-y-2">';
            reservasPasajero.forEach(reserva => {
                // Se actualizan las clases del botón para usar Tailwind/material-btn
                html += `<li class="text-gray-700">
                    <strong class="font-medium text-blue-600">Vuelo ${reserva.vuelo_id}</strong> - ${reserva.origen} a ${reserva.destino}
                    <button type="button" class="material-btn material-btn-xs material-btn-info ms-3" onclick="seleccionarVuelo(${reserva.vuelo_id})">
                        <i class="material-icons text-xs mr-1">check_circle</i>Seleccionar este vuelo
                    </button>
                </li>`;
            });
            html += '</ul>';
            historialContent.innerHTML = html;
            historialDiv.style.display = 'block';
        } else {
            historialContent.innerHTML = '<p>Este pasajero no tiene reservas anteriores registradas.</p>';
            historialDiv.style.display = 'block'; // Mostrar la sección aunque esté vacía o usar 'none' según preferencia
        }
    }

    function actualizarCamposDesdeVuelo() {
        const selectedOption = vueloSelect.options[vueloSelect.selectedIndex];
        if (selectedOption && selectedOption.value) {
            // Calcular monto anticipado
            const precio = parseFloat(selectedOption.getAttribute('data-precio')) || 0;
            const montoAnticipado = precio * 0.10; // 10% del precio del vuelo
            montoAnticipadoInput.value = montoAnticipado.toFixed(2);

            // Llenar fecha de vuelo desde la fecha de salida del vuelo
            const fechaSalida = selectedOption.getAttribute('data-fecha-salida');
            if (fechaSalida) {
                // Convertir la fecha de MySQL a formato datetime-local
                const fecha = new Date(fechaSalida);
                const formattedFecha = fecha.toISOString().slice(0, 16); // YYYY-MM-DDTHH:MM
                fechaVueloInput.value = formattedFecha;
            }
        } else {
            montoAnticipadoInput.value = '';
            fechaVueloInput.value = '';
        }
    }

    // Función global para seleccionar un vuelo desde el historial
    window.seleccionarVuelo = function(idVuelo) {
        vueloSelect.value = idVuelo;
        actualizarCamposDesdeVuelo();
        // Scroll suave al selector de vuelo
        vueloSelect.scrollIntoView({ behavior: 'smooth', block: 'center' });
        vueloSelect.focus();
    };

    // Evento para mostrar historial cuando se selecciona un pasajero
    pasajeroSelect.addEventListener('change', function() {
        const idPasajero = this.value;
        if (idPasajero) {
            mostrarHistorialReservas(idPasajero);
        } else {
            historialDiv.style.display = 'none';
        }
    });

    // Evento para actualizar campos cuando se selecciona un vuelo
    vueloSelect.addEventListener('change', actualizarCamposDesdeVuelo);

    // Inicializar campos al cargar la página
    actualizarCamposDesdeVuelo();
    const idPasajeroActual = pasajeroSelect.value;
    if (idPasajeroActual) {
        mostrarHistorialReservas(idPasajeroActual);
    }
});
</script>
@endsection