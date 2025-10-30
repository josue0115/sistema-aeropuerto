@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white shadow-md rounded-lg p-6 border border-gray-200">
        <div class="flex items-center justify-between mb-4">
            <h4 class="text-xl font-semibold text-gray-800">Crear Nueva Reserva</h4>
            <a href="{{ route('reservas.index') }}" class="material-btn material-btn-secondary">Volver</a>
        </div>

        <div class="p-6">
                    <form action="{{ route('reservas.store.cliente') }}" method="POST" id="reserva-form">
                        @csrf

                        <!-- ID Reserva oculto -->
                        <input type="hidden" id="idReserva" name="idReserva" value="">

                        {{-- Selección de Pasajero y Vuelo --}}
                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <label for="idPasajero" class="block text-sm font-medium text-gray-700 mb-1">Código Pasajero</label>
                                <select class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none @error('idPasajero') border-red-500 @enderror" id="idPasajero" name="idPasajero" required>
                                    <option value="">Seleccione un pasajero</option>
                                    @foreach($pasajeros as $pasajero)
                                        <option value="{{ $pasajero->idPasajero }}" {{ old('idPasajero') == $pasajero->idPasajero ? 'selected' : '' }}>
                                            {{ $pasajero->idPasajero }} - {{ $pasajero->Nombre }} {{ $pasajero->Apellido }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('idPasajero')
                                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <label for="idVuelo" class="block text-sm font-medium text-gray-700 mb-1">Código Vuelo</label>
                                <select class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none @error('idVuelo') border-red-500 @enderror" id="idVuelo" name="idVuelo" required>
                                    <option value="">Seleccione un vuelo</option>
                                    @foreach($vuelos as $vuelo)
                                        <option value="{{ $vuelo->idVuelo }}" data-precio="{{ $vuelo->Precio }}" data-fecha-salida="{{ $vuelo->FechaSalida }}" {{ old('idVuelo') == $vuelo->idVuelo ? 'selected' : '' }}>
                                            {{ $vuelo->idVuelo }} - {{ $vuelo->aeropuerto_origen_nombre ?? 'N/A' }} a {{ $vuelo->aeropuerto_destino_nombre ?? 'N/A' }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('idVuelo')
                                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Historial de reservas del pasajero seleccionado --}}
                        <div id="historial-reservas" class="mb-6" style="display: none;">
                            <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                                <h6 class="text-lg font-semibold text-gray-800 mb-3">Reservas Anteriores del Pasajero</h6>
                                <div id="historial-content">
                                    {{-- El historial se cargará aquí dinámicamente --}}
                                </div>
                            </div>
                        </div>

                        {{-- Fechas --}}
                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <label for="FechaReserva" class="block text-sm font-medium text-gray-700 mb-1">Fecha Reserva</label>
                                <input type="datetime-local" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none @error('FechaReserva') border-red-500 @enderror" id="FechaReserva" name="FechaReserva" value="{{ old('FechaReserva', date('Y-m-d\TH:i')) }}" min="{{ date('Y-m-d\TH:i') }}" required>
                                @error('FechaReserva')
                                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <label for="FechaVuelo" class="block text-sm font-medium text-gray-700 mb-1">Fecha Vuelo</label>
                                <input type="datetime-local" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none @error('FechaVuelo') border-red-500 @enderror" id="FechaVuelo" name="FechaVuelo" value="{{ old('FechaVuelo') }}" min="{{ date('Y-m-d\TH:i') }}" required>
                                @error('FechaVuelo')
                                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Monto Anticipado y Estado --}}
                        <div class="grid md:grid-cols-2 gap-6 mt-6">
                            <div>
                                <label for="MontoAnticipado" class="block text-sm font-medium text-gray-700 mb-1">Monto Anticipado</label>
                                <input type="number" step="0.01" class="w-full border border-gray-300 rounded-md px-3 py-2 bg-gray-100" id="MontoAnticipado" name="MontoAnticipado" value="{{ old('MontoAnticipado') }}" readonly>
                            </div>

                            <div>
                                <label for="Estado" class="block text-sm font-medium text-gray-700 mb-1">Estado</label>
                                <select class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none @error('Estado') border-red-500 @enderror" id="Estado" name="Estado" required>
                                    <option value="">Seleccione un estado</option>
                                    <option value="Activo" {{ old('Estado', 'Confirmado') == 'Activo' ? 'selected' : '' }}>Activo</option>
                                    <option value="Inactivo" {{ old('Estado', 'Confirmado') == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                                    <option value="Pendiente" {{ old('Estado', 'Confirmado') == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                                    <option value="Confirmado" {{ old('Estado', 'Confirmado') == 'Confirmado' ? 'selected' : '' }}>Confirmado</option>
                                    <option value="Cancelado" {{ old('Estado', 'Confirmado') == 'Cancelado' ? 'selected' : '' }}>Cancelado</option>
                                </select>
                                @error('Estado')
                                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Botones --}}
                        <div class="flex flex-wrap gap-3 justify-end mt-8 pt-6 border-t border-gray-200">
                            <button type="submit" class="material-btn material-btn-primary">Crear Reserva</button>
                            <a href="{{ route('reservas.index') }}" class="material-btn material-btn-secondary">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="//unpkg.com/alpinejs@3.x.x" defer></script>
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
            let html = '<p><strong>Este pasajero ha reservado los siguientes vuelos anteriormente:</strong></p><ul>';
            reservasPasajero.forEach(reserva => {
                html += `<li>
                    <strong>Vuelo ${reserva.vuelo_id}</strong> - ${reserva.origen} a ${reserva.destino}
                    <button type="button" class="btn btn-sm btn-outline-primary ms-2" onclick="seleccionarVuelo(${reserva.vuelo_id})">Seleccionar este vuelo</button>
                </li>`;
            });
            html += '</ul>';
            historialContent.innerHTML = html;
            historialDiv.style.display = 'block';
        } else {
            historialDiv.style.display = 'none';
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

    // Función para seleccionar un vuelo desde el historial
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

    // Inicializar fecha de reserva con la fecha actual
    if (!fechaReservaInput.value) {
        const now = new Date();
        const formattedNow = now.toISOString().slice(0, 16);
        fechaReservaInput.value = formattedNow;
    }

    // Calcular inicialmente
    actualizarCamposDesdeVuelo();
});
</script>
@endsection
