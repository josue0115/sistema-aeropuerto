@extends('layouts.app')

@section('content')
@if(session()->has('total_acumulado'))
    <!-- <div class="absolute top-3 right-3 bg-blue-600 text-white px-4 py-2 rounded-lg shadow-lg z-10">
        <div class="text-sm font-medium">Total Reserva</div>
        <div class="text-lg font-bold">${{ number_format(session('total_acumulado'), 2) }}</div>
    </div> -->
@endif
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Crear Nueva Reserva
                        <a href="{{ route('reservas.index') }}" class="btn btn-secondary float-end">Volver</a>
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('reservas.store') }}" method="POST" id="reserva-form">
                        @csrf

                        <!-- ID Reserva oculto -->
                        <input type="hidden" id="idReserva" name="idReserva" value="">

                        <div class="row">
                            <div class="col-12 col-md-6 mb-3">
                                <label for="idPasajero" class="form-label">Código Pasajero</label>
                                <select class="form-control @error('idPasajero') is-invalid @enderror" id="idPasajero" name="idPasajero" required>
                                    <option value="">Seleccione un pasajero</option>
                                    @foreach($pasajeros as $pasajero)
                                        <option value="{{ $pasajero->idPasajero }}" {{ old('idPasajero', $pasajeroSeleccionado ?? '') == $pasajero->idPasajero ? 'selected' : '' }}>
                                            {{ $pasajero->idPasajero }} - {{ $pasajero->Nombre }} {{ $pasajero->Apellido }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('idPasajero')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                @if($pasajeroSeleccionado ?? false)
                                    <small class="text-muted">Pasajero preseleccionado de la sesión</small>
                                @endif
                            </div>

                            <div class="col-12 col-md-6 mb-3">
                                <label for="idVuelo" class="form-label">Código Vuelo</label>
                                <select class="form-control @error('idVuelo') is-invalid @enderror" id="idVuelo" name="idVuelo" required>
                                    <option value="">Seleccione un vuelo</option>
                                    @foreach($vuelos as $vuelo)
                                        <option value="{{ $vuelo->idVuelo }}" data-precio="{{ $vuelo->Precio }}" data-fecha-salida="{{ $vuelo->FechaSalida }}" {{ old('idVuelo', $vueloSeleccionado ?? '') == $vuelo->idVuelo ? 'selected' : '' }}>
                                            {{ $vuelo->idVuelo }} - {{ $vuelo->aeropuerto_origen_nombre ?? 'N/A' }} a {{ $vuelo->aeropuerto_destino_nombre ?? 'N/A' }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('idVuelo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                @if($vueloSeleccionado ?? false)
                                    <small class="text-muted">Vuelo preseleccionado de la sesión</small>
                                @endif
                            </div>
                        </div>

                        <!-- Historial de reservas del pasajero seleccionado -->
                        <div id="historial-reservas" class="mb-3" style="display: none;">
                            <div class="card">
                                <div class="card-header">
                                    <h6>Reservas Anteriores del Pasajero</h6>
                                </div>
                                <div class="card-body">
                                    <div id="historial-content">
                                        <!-- El historial se cargará aquí dinámicamente -->
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-md-6 mb-3">
                                <label for="FechaReserva" class="form-label">Fecha Reserva</label>
                                <input type="datetime-local" class="form-control @error('FechaReserva') is-invalid @enderror" id="FechaReserva" name="FechaReserva" value="{{ old('FechaReserva', date('Y-m-d\TH:i')) }}" min="{{ date('Y-m-d\TH:i') }}" required>
                                @error('FechaReserva')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12 col-md-6 mb-3">
                                <label for="FechaVuelo" class="form-label">Fecha Vuelo</label>
                                <input type="datetime-local" class="form-control @error('FechaVuelo') is-invalid @enderror" id="FechaVuelo" name="FechaVuelo" value="{{ old('FechaVuelo') }}" min="{{ date('Y-m-d\TH:i') }}" required>
                                @error('FechaVuelo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-md-6 mb-3">
                                <label for="MontoAnticipado" class="form-label">Monto Anticipado</label>
                                <input type="number" step="0.01" class="form-control" id="MontoAnticipado" name="MontoAnticipado" value="{{ old('MontoAnticipado') }}" readonly>
                            </div>

                            <div class="col-12 col-md-6 mb-3">
                                <label for="Estado" class="form-label">Estado</label>
                                <select class="form-control @error('Estado') is-invalid @enderror" id="Estado" name="Estado" required>
                                    <option value="">Seleccione un estado</option>
                                    <option value="Activo" {{ old('Estado', 'Confirmada') == 'Activo' ? 'selected' : '' }}>Activo</option>
                                    <option value="Inactivo" {{ old('Estado', 'Confirmada') == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                                    <option value="Pendiente" {{ old('Estado', 'Confirmada') == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                                    <option value="Confirmada" {{ old('Estado', 'Confirmada') == 'Confirmada' ? 'selected' : '' }}>Confirmada</option>
                                    <option value="Cancelado" {{ old('Estado', 'Confirmada') == 'Cancelado' ? 'selected' : '' }}>Cancelado</option>
                                </select>
                                @error('Estado')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="submit" name="action" value="create" class="btn btn-primary me-md-2">
                                <i class="fas fa-save me-2"></i>
                                Crear Reserva
                            </button>
                            <button type="submit" name="action" value="pay" class="btn btn-success me-md-2">
                                <i class="fas fa-credit-card me-2"></i>
                                Crear y Pagar
                            </button>
                            <!-- <a href="{{ route('pagos.create') }}" class="btn btn-info me-md-2">
                                <i class="fas fa-money-bill-wave me-2"></i>
                                Ir a Pago
                            </a>
                            <a href="{{ route('reservas.index') }}" class="btn btn-secondary">Cancelar</a>
                             -->
                        </div>
                    </form>
                </div>
            </div>
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
