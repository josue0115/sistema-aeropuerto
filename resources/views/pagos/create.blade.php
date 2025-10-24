@extends('layouts.app')

@section('title', 'Procesar Pago')

@section('content')
<div class=" justify-content-center container-fluid py-4">
    <div class="row justify-content-center">
        <!-- Formulario de Pago -->
        <div class="col-lg-5">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">
                        <i class="fas fa-credit-card me-2"></i>
                        Información de Pago
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('pagos.store') }}" method="POST">
                        @csrf

                        <div class="row">
                            <!-- Número de Tarjeta -->
                            <div class="col-12 mb-3">
                                <label for="numero_tarjeta" class="form-label">Número de Tarjeta</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-credit-card"></i></span>
                                    <input type="text" class="form-control @error('numero_tarjeta') is-invalid @enderror"
                                           id="numero_tarjeta" name="numero_tarjeta"
                                           placeholder="1234 5678 9012 3456"
                                           value="{{ old('numero_tarjeta') }}"
                                           maxlength="16" required>
                                    @error('numero_tarjeta')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Fecha de Expiración y CVV -->
                            <div class="col-md-6 mb-3">
                                <label for="fecha_expiracion" class="form-label">Fecha de Expiración</label>
                                <input type="text" class="form-control @error('fecha_expiracion') is-invalid @enderror"
                                       id="fecha_expiracion" name="fecha_expiracion"
                                       placeholder="MM/AA"
                                       value="{{ old('fecha_expiracion') }}"
                                       maxlength="5" required>
                                @error('fecha_expiracion')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="cvv" class="form-label">CVV</label>
                                <input type="text" class="form-control @error('cvv') is-invalid @enderror"
                                       id="cvv" name="cvv"
                                       placeholder="123"
                                       value="{{ old('cvv') }}"
                                       maxlength="3" required>
                                @error('cvv')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Nombre del Titular -->
                            <div class="col-12 mb-4">
                                <label for="nombre_titular" class="form-label">Nombre del Titular</label>
                                <input type="text" class="form-control @error('nombre_titular') is-invalid @enderror"
                                       id="nombre_titular" name="nombre_titular"
                                       placeholder="Como aparece en la tarjeta"
                                       value="{{ old('nombre_titular') }}"
                                       required>
                                @error('nombre_titular')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Botones -->
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('reservas.create') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-2"></i>
                                Volver
                            </a>
                            <button type="submit" class="btn btn-success btn-lg" id="btn-procesar-pago">
                                <i class="fas fa-lock me-2"></i>
                                Procesar Pago Seguro
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Resumen del Pago -->
        <div class="col-lg-4">
            <div class="card shadow-sm sticky-top" style="top: 20px;">
                <div class="card-header bg-light">
                    <h5 class="mb-0">
                        <i class="fas fa-receipt me-2"></i>
                        Resumen del Pago
                    </h5>
                </div>
                <div class="card-body">
                    <!-- Boleto -->
                    @if($detallesPago['boleto'])
                    <div class="mb-3">
                        <h6 class="text-muted mb-2">BOLETO</h6>
                        <div class="d-flex justify-content-between">
                            <span>Vuelo {{ $detallesPago['boleto']->idVuelo }}</span>
                            <span>${{ number_format($detallesPago['boleto']->Precio, 2) }}</span>
                        </div>
                        <small class="text-muted">
                            Pasajero: {{ $detallesPago['boleto']->idPasajero }}
                        </small>
                    </div>
                    @endif

                    <!-- Servicios -->
                    @if(!empty($detallesPago['servicios']))
                    <div class="mb-3">
                        <h6 class="text-muted mb-2">SERVICIOS ADICIONALES</h6>
                        @foreach($detallesPago['servicios'] as $servicio)
                        <div class="d-flex justify-content-between mb-1">
                            <span>{{ $servicio->tipo_servicio }}</span>
                            <span>${{ number_format($servicio->CostoTotal, 2) }}</span>
                        </div>
                        @endforeach
                    </div>
                    @endif

                    <!-- Asiento -->
                    @if($detallesPago['asiento'])
                    <div class="mb-3">
                        <h6 class="text-muted mb-2">ASIENTO</h6>
                        <div class="d-flex justify-content-between">
                            <span>Asiento {{ $detallesPago['asiento']->NumeroAsiento }}</span>
                            <span>${{ number_format($detallesPago['asiento']->precio_vuelo * 0.1, 2) }}</span>
                        </div>
                        <small class="text-muted">
                            {{ $detallesPago['asiento']->aeropuerto_origen }} → {{ $detallesPago['asiento']->aeropuerto_destino }}
                        </small>
                    </div>
                    @endif

                    <hr>

                    <!-- Subtotal -->
                    <div class="d-flex justify-content-between">
                        <span>Subtotal</span>
                        <span>${{ number_format($detallesPago['total'], 2) }}</span>
                    </div>

                    <!-- Impuesto -->
                    <div class="d-flex justify-content-between mb-2">
                        <span>Impuesto (12 % IVA)</span>
                        <span>${{ number_format($detallesPago['total'] * 0.12, 2) }}</span>
                    </div>

                    <hr>

                    <!-- Total -->
                    <div class="d-flex justify-content-between align-items-center">
                        <strong class="h5 mb-0">Total a Pagar</strong>
                        <strong class="h4 mb-0 text-success">${{ number_format($detallesPago['total'] * 1.12, 2) }}</strong>
                    </div>

                    <div class="mt-3 p-3 bg-light rounded">
                        <small class="text-muted">
                            <i class="fas fa-shield-alt me-1"></i>
                            Pago seguro procesado por nuestro sistema bancario.
                            Tus datos están protegidos con encriptación SSL.
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
// Formatear número de tarjeta
document.getElementById('numero_tarjeta').addEventListener('input', function(e) {
    let value = e.target.value.replace(/\D/g, '');
    value = value.replace(/(\d{4})(?=\d)/g, '$1 ');
    e.target.value = value.trim();
});

// Formatear fecha de expiración
document.getElementById('fecha_expiracion').addEventListener('input', function(e) {
    let value = e.target.value.replace(/\D/g, '');
    if (value.length >= 2) {
        value = value.substring(0, 2) + '/' + value.substring(2, 4);
    }
    e.target.value = value;
});

// Solo números para CVV
document.getElementById('cvv').addEventListener('input', function(e) {
    e.target.value = e.target.value.replace(/\D/g, '');
});

// Preloader para el botón de pago
document.getElementById('btn-procesar-pago').addEventListener('click', function(e) {
    const btn = this;
    const form = btn.closest('form');

    // Verificar que el formulario sea válido
    if (!form.checkValidity()) {
        form.reportValidity();
        return;
    }

    // Mostrar preloader de pantalla completa
    showFullscreenLoader();

    // Mostrar el preloader por al menos 3 segundos antes de enviar el formulario
    setTimeout(() => {
        form.submit();
    }, 3000);
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
                <h4 style="color: #007bff; font-weight: bold;">Procesando Pago...</h4>
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
@endpush
@endsection
