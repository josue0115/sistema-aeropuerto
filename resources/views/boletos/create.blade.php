@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Crear Nuevo Boleto</h4>
                    @if(isset($vueloSeleccionado))
                        <div class="alert alert-info mt-2">
                            <strong>Vuelo Seleccionado:</strong> {{ $vueloSeleccionado->idVuelo }} -
                            {{ $vueloSeleccionado->aeropuertoOrigen->Nombre ?? 'N/A' }} a {{ $vueloSeleccionado->aeropuertoDestino->Nombre ?? 'N/A' }}
                            ({{ $vueloSeleccionado->FechaSalida }})
                        </div>
                    @endif
                </div>
                <div class="card-body">
                    <form action="{{ route('boletos.store') }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-md-6 mb-3" style="display: none;">
                                <label for="idBoleto" class="form-label">ID Boleto</label>
                                <input type="number" class="form-control @error('idBoleto') is-invalid @enderror" id="idBoleto" name="idBoleto" value="{{ old('idBoleto') }}">
                                @error('idBoleto')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="idVuelo" class="form-label">Código Vuelo</label>
                                <select class="form-control @error('idVuelo') is-invalid @enderror" id="idVuelo" name="idVuelo" required>
                                    <option value="">Seleccione un vuelo</option>
                                    @foreach($vuelos as $vuelo)
                                        <option value="{{ $vuelo->idVuelo }}" data-precio="{{ $vuelo->Precio }}"
                                                {{ (isset($vueloSeleccionado) && $vueloSeleccionado->idVuelo == $vuelo->idVuelo) || old('idVuelo') == $vuelo->idVuelo ? 'selected' : '' }}>
                                            {{ $vuelo->idVuelo }} - {{ $vuelo->aeropuertoOrigen->Nombre ?? 'N/A' }} a {{ $vuelo->aeropuertoDestino->Nombre ?? 'N/A' }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('idVuelo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="idPasajero" class="form-label">Pasajero</label>
                                <select class="form-control @error('idPasajero') is-invalid @enderror" id="idPasajero" name="idPasajero" required>
                                    <option value="">Seleccione un pasajero</option>
                                    @php
                                        $pasajerosCreados = session('pasajeros_creados', []);
                                        $primerPasajeroId = !empty($pasajerosCreados) ? $pasajerosCreados[0] : null;
                                    @endphp
                                    @if($pasajeros instanceof \Illuminate\Database\Eloquent\Collection)
                                        @foreach($pasajeros as $pasajero)
                                            <option value="{{ $pasajero->idPasajero }}"
                                                    {{ (old('idPasajero') == $pasajero->idPasajero || (!$loop->first && $primerPasajeroId == $pasajero->idPasajero)) ? 'selected' : '' }}>
                                                {{ $pasajero->idPasajero }} - {{ $pasajero->Nombre }} {{ $pasajero->Apellido }}
                                            </option>
                                        @endforeach
                                    @else
                                        @foreach($pasajeros as $index => $pasajero)
                                            <option value="{{ $pasajero->idPasajero }}"
                                                    {{ (old('idPasajero') == $pasajero->idPasajero || ($index == 0 && $primerPasajeroId == $pasajero->idPasajero)) ? 'selected' : '' }}>
                                                {{ $pasajero->idPasajero }} - {{ $pasajero->Nombre }} {{ $pasajero->Apellido }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('idPasajero')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="FechaCompra" class="form-label">Fecha Compra</label>
                                <input type="datetime-local" class="form-control @error('FechaCompra') is-invalid @enderror" id="FechaCompra" name="FechaCompra" value="{{ old('FechaCompra', date('Y-m-d\TH:i')) }}" min="{{ date('Y-m-d\TH:i') }}">
                                @error('FechaCompra')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="Precio" class="form-label">Precio</label>
                                <input type="number" step="0.01" class="form-control @error('Precio') is-invalid @enderror" id="Precio" name="Precio" value="{{ old('Precio') }}" min="0" readonly>
                                @error('Precio')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="Cantidad" class="form-label">Cantidad</label>
                                <input type="number" step="0.01" class="form-control @error('Cantidad') is-invalid @enderror" id="Cantidad" name="Cantidad" value="{{ old('Cantidad', $cantidadDefault ?? 1) }}" min="0">
                                @error('Cantidad')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="Descuento" class="form-label">Descuento</label>
                                <input type="number" step="0.01" class="form-control @error('Descuento') is-invalid @enderror" id="Descuento" name="Descuento" value="{{ old('Descuento') }}" readonly>
                                @error('Descuento')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="Impuesto" class="form-label">Impuesto</label>
                                <input type="number" step="0.01" class="form-control @error('Impuesto') is-invalid @enderror" id="Impuesto" name="Impuesto" value="{{ old('Impuesto') }}" readonly>
                                @error('Impuesto')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="Total" class="form-label">Total (Calculado automáticamente)</label>
                                <input type="number" step="0.01" class="form-control" id="Total" name="Total" readonly>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary" name="action" value="create">Crear Boleto</button>
                        <button type="button" class="btn btn-success" id="btn-siguiente-servicios">Siguiente: Servicios</button>
                        <a href="{{ route('boletos.index') }}" class="btn btn-secondary">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Navigation Buttons -->
    <!-- <div class="container mt-4">
        <div class="row">
            <div class="col-12 text-center">
                <a href="{{ route('pasajeros.create') }}" class="btn btn-warning btn-lg me-2">Anterior: Pasajeros</a>
                <a href="{{ route('servicios.create') }}" class="btn btn-success btn-lg">Siguiente: Servicios</a>
            </div>
        </div>
    </div> -->
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const vueloSelect = document.getElementById('idVuelo');
        const precioInput = document.getElementById('Precio');
        const cantidadInput = document.getElementById('Cantidad');
        const descuentoInput = document.getElementById('Descuento');
        const impuestoInput = document.getElementById('Impuesto');
        const totalInput = document.getElementById('Total');
        const btnSiguiente = document.getElementById('btn-siguiente-servicios');
        const form = document.querySelector('form');

        function calcularDescuento(cantidad) {
            if (cantidad >= 5 && cantidad < 10) return 0.05;
            if (cantidad >= 10 && cantidad < 15) return 0.10;
            if (cantidad >= 15) return 0.15;
            return 0;
        }

        function calcularImpuesto(subtotal) {
            return subtotal * 0.12;
        }

        function calcularTotal() {
            const precio = parseFloat(precioInput.value) || 0;
            const cantidad = parseFloat(cantidadInput.value) || 0;

            const subtotal = precio * cantidad;
            const descuentoPorcentaje = calcularDescuento(cantidad);
            const descuento = subtotal * descuentoPorcentaje;
            const impuesto = calcularImpuesto(subtotal);
            const total = subtotal - descuento + impuesto;

            descuentoInput.value = descuento.toFixed(2);
            impuestoInput.value = impuesto.toFixed(2);
            totalInput.value = total.toFixed(2);
        }

        // Evento para seleccionar vuelo y asignar precio
        vueloSelect.addEventListener('change', function() {
            const selectedOption = vueloSelect.options[vueloSelect.selectedIndex];
            const precio = selectedOption.getAttribute('data-precio') || 0;
            precioInput.value = precio;
            calcularTotal();
        });

        // Eventos para calcular automáticamente en tiempo real
        const events = ['input', 'change', 'keyup', 'blur'];
        events.forEach(event => {
            cantidadInput.addEventListener(event, calcularTotal);
        });

        // Calcular inicialmente
        calcularTotal();

        // Auto-seleccionar vuelo si hay uno preseleccionado
        if (vueloSelect.value) {
            vueloSelect.dispatchEvent(new Event('change'));
        }

        // Evento para el botón "Siguiente: Servicios"
        btnSiguiente.addEventListener('click', function() {
            // Crear FormData con los datos del formulario
            const formData = new FormData(form);
            formData.append('action', 'next');

            // Mostrar preloader de pantalla completa
            showFullscreenLoader();

            // Mostrar el preloader por al menos 3 segundos antes de enviar la petición AJAX
            setTimeout(() => {
                // Enviar petición AJAX
                fetch('{{ route("boletos.store") }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        return response.json().then(err => {
                            throw new Error(err.message || 'Error en la solicitud');
                        });
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.boleto_id) {
                        // Abrir PDF en nueva pestaña
                        window.open('{{ url("/boletos") }}/' + data.boleto_id + '/pdf', '_blank');

                        // Redirigir a servicios después de un breve delay
                        setTimeout(() => {
                            window.location.href = '{{ route("servicios.create") }}';
                        }, 500);
                    } else {
                        hideFullscreenLoader();
                        alert('Error al crear el boleto');
                        btnSiguiente.disabled = false;
                        btnSiguiente.innerHTML = 'Siguiente: Servicios';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    hideFullscreenLoader();
                    alert('Error al procesar la solicitud: ' + error.message);
                    btnSiguiente.disabled = false;
                    btnSiguiente.innerHTML = 'Siguiente: Servicios';
                });
            }, 3000);
        });
    });

    // Función para mostrar preloader de pantalla completa
    function showFullscreenLoader() {
        let loader = document.getElementById('fullscreen-loader');
        if (!loader) {
            loader = document.createElement('div');
            loader.id = 'fullscreen-loader';
            loader.innerHTML = `
                <div style="
                    position: fixed;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    background-color: rgba(255, 255, 255, 0.95);
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    z-index: 9999;
                    flex-direction: column;
                    border: 2px solid #007bff;
                    border-radius: 10px;
                    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
                ">
                    <img src="{{ asset('images/plane-loader.gif') }}" alt="Cargando..." style="width: 250px; height: 250px; margin-bottom: 20px;">
                    <h4 style="color: #007bff; font-weight: bold;">Procesando...</h4>
                </div>
            `;
            document.body.appendChild(loader);
        }
        loader.style.display = 'flex';
    }

    // Función para ocultar preloader de pantalla completa
    function hideFullscreenLoader() {
        const loader = document.getElementById('fullscreen-loader');
        if (loader) {
            loader.style.display = 'none';
        }
    }
</script>
@endsection
