@extends('layouts.app')

@section('title', 'Procesar Pago')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex flex-col lg:flex-row gap-8 justify-center">
        <!-- Formulario de Pago -->
        <div class="w-full lg:w-1/2">
            <div class="bg-white shadow-md rounded-lg border border-gray-200">
                <div class="bg-blue-600 text-white p-6 rounded-t-lg">
                    <h4 class="text-xl font-semibold mb-0">
                        <i class="fas fa-credit-card me-2"></i>
                        Información de Pago
                    </h4>
                </div>
                <div class="p-6">
                    <form action="{{ route('pagos.store') }}" method="POST">
                        @csrf

                        <div class="grid grid-cols-1 gap-6">
                            <!-- Número de Tarjeta -->
                            <div>
                                <label for="numero_tarjeta" class="block text-sm font-medium text-gray-700 mb-2">Número de Tarjeta</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-credit-card text-gray-400"></i>
                                    </div>
                                    <input type="text" class="w-full pl-10 pr-3 py-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none @error('numero_tarjeta') border-red-500 @enderror"
                                           id="numero_tarjeta" name="numero_tarjeta"
                                           placeholder="1234 5678 9012 3456"
                                           value="{{ old('numero_tarjeta') }}"
                                           maxlength="16" required>
                                    @error('numero_tarjeta')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Fecha de Expiración y CVV -->
                            <div class="flex gap-4">
                                <div class="flex-1">
                                    <label for="fecha_expiracion" class="block text-sm font-medium text-gray-700 mb-2">Fecha de Expiración</label>
                                    <input type="text" class="w-full px-3 py-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none @error('fecha_expiracion') border-red-500 @enderror"
                                           id="fecha_expiracion" name="fecha_expiracion"
                                           placeholder="MM/AA"
                                           value="{{ old('fecha_expiracion') }}"
                                           maxlength="5" required>
                                    @error('fecha_expiracion')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="flex-1">
                                    <label for="cvv" class="block text-sm font-medium text-gray-700 mb-2">CVV</label>
                                    <input type="text" class="w-full px-3 py-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none @error('cvv') border-red-500 @enderror"
                                           id="cvv" name="cvv"
                                           placeholder="123"
                                           value="{{ old('cvv') }}"
                                           maxlength="3" required>
                                    @error('cvv')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Nombre del Titular -->
                            <div>
                                <label for="nombre_titular" class="block text-sm font-medium text-gray-700 mb-2">Nombre del Titular</label>
                                <input type="text" class="w-full px-3 py-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none @error('nombre_titular') border-red-500 @enderror"
                                       id="nombre_titular" name="nombre_titular"
                                       placeholder="Como aparece en la tarjeta"
                                       value="{{ old('nombre_titular') }}"
                                       required>
                                @error('nombre_titular')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Botones -->
                        <div class="flex justify-between items-center pt-6">
                            <a href="{{ route('reservas.create') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-md font-medium transition-colors duration-200">
                                <i class="fas fa-arrow-left mr-2"></i>
                                Volver
                            </a>
                            <button type="submit" class="px-8 py-3 rounded-md font-medium transition-colors duration-200" id="btn-procesar-pago" style="background-color: #16a34a; color: white !important;">
                                <i class="fas fa-lock mr-2"></i>
                                Procesar Pago Seguro
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Resumen del Pago -->
        <div class="w-full lg:w-1/3">
            <div class="bg-white shadow-md rounded-lg border border-gray-200 sticky top-6">
                <div class="bg-gray-50 p-6 rounded-t-lg border-b border-gray-200">
                    <h5 class="text-lg font-semibold text-gray-800 mb-0">
                        <i class="fas fa-receipt mr-2 text-blue-600"></i>
                        Resumen del Pago
                    </h5>
                </div>
                <div class="p-6">
                    <!-- Boleto -->
                    @if($detallesPago['boleto'])
                    <div class="mb-4">
                        <h6 class="text-sm font-semibold text-gray-600 mb-3 uppercase tracking-wide">BOLETO</h6>
                        <div class="flex justify-between items-center py-2">
                            <span class="text-gray-800">Vuelo {{ $detallesPago['boleto']->idVuelo }}</span>
                            <span class="font-medium text-gray-900">${{ number_format($detallesPago['boleto']->Precio, 2) }}</span>
                        </div>
                        <p class="text-sm text-gray-500 mt-1">
                            Pasajero: {{ $detallesPago['boleto']->idPasajero }}
                        </p>
                    </div>
                    @endif

                    <!-- Servicios -->
                    @if(!empty($detallesPago['servicios']))
                    <div class="mb-4">
                        <h6 class="text-sm font-semibold text-gray-600 mb-3 uppercase tracking-wide">SERVICIOS ADICIONALES</h6>
                        @foreach($detallesPago['servicios'] as $servicio)
                        <div class="flex justify-between items-center py-2">
                            <span class="text-gray-800">{{ $servicio->tipo_servicio }}</span>
                            <span class="font-medium text-gray-900">${{ number_format($servicio->CostoTotal, 2) }}</span>
                        </div>
                        @endforeach
                    </div>
                    @endif

                    <!-- Asiento -->
                    @if($detallesPago['asiento'])
                    <div class="mb-4">
                        <h6 class="text-sm font-semibold text-gray-600 mb-3 uppercase tracking-wide">ASIENTO</h6>
                        <div class="flex justify-between items-center py-2">
                            <span class="text-gray-800">Asiento {{ $detallesPago['asiento']->NumeroAsiento }}</span>
                            <span class="font-medium text-gray-900">${{ number_format($detallesPago['asiento']->precio_vuelo * 0.1, 2) }}</span>
                        </div>
                        <p class="text-sm text-gray-500 mt-1">
                            {{ $detallesPago['asiento']->aeropuerto_origen }} → {{ $detallesPago['asiento']->aeropuerto_destino }}
                        </p>
                    </div>
                    @endif

                    <!-- Equipajes -->
                    @if(!empty($detallesPago['equipajes']))
                    <div class="mb-4">
                        <h6 class="text-sm font-semibold text-gray-600 mb-3 uppercase tracking-wide">EQUIPAJES</h6>
                        @foreach($detallesPago['equipajes'] as $equipaje)
                        <div class="flex justify-between items-center py-2">
                            <span class="text-gray-800">{{ $equipaje->Dimensiones ?? 'N/A' }} - {{ $equipaje->Peso ?? 0 }}kg</span>
                            <span class="font-medium text-gray-900">${{ number_format($equipaje->Monto ?? 0, 2) }}</span>
                        </div>
                        <p class="text-sm text-gray-500 mt-1">
                            Peso: {{ $equipaje->Peso ?? 0 }}kg | Dimensiones: {{ $equipaje->Dimensiones ?? 'N/A' }}
                        </p>
                        @endforeach
                    </div>
                    @endif

                    <hr class="my-4">

                    <!-- Subtotal -->
                    <div class="flex justify-between items-center py-2">
                        <span class="text-gray-700">Subtotal</span>
                        <span class="font-medium text-gray-900">${{ number_format($detallesPago['total'], 2) }}</span>
                    </div>

                    <!-- Impuesto -->
                    <div class="flex justify-between items-center py-2 mb-4">
                        <span class="text-gray-700">Impuesto (12 % IVA)</span>
                        <span class="font-medium text-gray-900">${{ number_format($detallesPago['total'] * 0.12, 2) }}</span>
                    </div>

                    <hr class="my-4">

                    <!-- Total -->
                    <div class="flex justify-between items-center mb-6">
                        <strong class="text-xl font-bold text-gray-900">Total a Pagar</strong>
                        <strong class="text-2xl font-bold text-green-600">${{ number_format($detallesPago['total'] * 1.12, 2) }}</strong>
                    </div>

                    <div class="bg-blue-50 p-4 rounded-lg border border-blue-200">
                        <div class="flex items-start">
                            <i class="fas fa-shield-alt text-blue-600 mt-1 mr-3"></i>
                            <div>
                                <p class="text-sm text-blue-800 font-medium mb-1">Pago Seguro</p>
                                <p class="text-sm text-blue-700">
                                    Procesado por nuestro sistema bancario. Tus datos están protegidos con encriptación SSL.
                                </p>
                            </div>
                        </div>
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
