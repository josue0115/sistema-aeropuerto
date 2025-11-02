@extends('layouts.app')

@section('page-title', 'Crear Boleto - Sistema Aeropuerto')

@section('content')
<div class="container mx-auto px-4 py-8" style="max-height: 800px; overflow-y: scroll;">
    <!-- Header Section -->
    <div class="mb-3">
        <div class="flex items-center justify-between mb-2">
            <div>
                <h1 class="text-3xl font-bold text-gray-800 mb-2">
                    <i class="material-icons text-blue-600 mr-2">confirmation_number</i>
                    Crear Boleto
                </h1>
                <p class="text-gray-600 text-lg">Complete la información del boleto</p>
            </div>
            <div class="flex space-x-3">
                 @if(isset($vueloSeleccionado))
                <a href="{{ route('pasajeros.create') }}" class="material-btn material-btn-secondary">
                    <i class="material-icons text-sm mr-2">arrow_back</i>
                    Volver a Pasajeros
                </a>
                @endif
                 @if(in_array(auth()->user()->role, ['operador']))
                <a href="{{ route('boletos.index') }}" class="material-btn material-btn-secondary">
                    <i class="material-icons text-sm mr-2">list</i>
                    Ver Boletos
                </a>
                @endif
            </div>
        </div>
    </div>

    <!-- Info Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-2">
        @if(isset($vueloSeleccionado))
        <div class="material-card">
            <div class="p-4">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                        <i class="material-icons text-green-600">flight</i>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-800">Vuelo Seleccionado</h3>
                        <p class="text-gray-600">
                            #{{ $vueloSeleccionado->IdVuelo }} -
                            {{ $vueloSeleccionado->aeropuertoOrigen->NombreAeropuerto ?? 'N/A' }} →
                            {{ $vueloSeleccionado->aeropuertoDestino->NombreAeropuerto ?? 'N/A' }}
                        </p>
                        <p class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($vueloSeleccionado->FechaSalida)->format('d/m/Y H:i') }}</p>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <div class="material-card">
            <div class="p-4">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                        <i class="material-icons text-blue-600">person</i>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-800">Información del Boleto</h3>
                        <p class="text-gray-600">Complete todos los campos requeridos</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Form Card -->
    <div class="material-card">
        <div class="p-6">
                    <form action="{{ route('boletos.store') }}" method="POST">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div style="display: none;">
                                <label for="idBoleto" class="block text-sm font-medium text-gray-700 mb-1">
                                    <i class="material-icons text-gray-500 mr-1 text-sm">tag</i>ID Boleto
                                </label>
                                <input type="number" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('idBoleto') border-red-500 @enderror" id="idBoleto" name="idBoleto" value="{{ old('idBoleto') }}">
                                @error('idBoleto')
                                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <label for="idVuelo" class="block text-sm font-medium text-gray-700 mb-1">
                                    <i class="material-icons text-gray-500 mr-1 text-sm">flight</i>Código Vuelo
                                </label>
                                <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('idVuelo') border-red-500 @enderror" id="idVuelo" name="idVuelo" required>
                                    <option value="">Seleccione un vuelo</option>
                                    @foreach($vuelos as $vuelo)
                                        <option value="{{ $vuelo->IdVuelo }}" data-precio="{{ $vuelo->Precio }}"
                                                {{ (isset($vueloSeleccionado) && $vueloSeleccionado->IdVuelo == $vuelo->IdVuelo) || old('IdVuelo') == $vuelo->IdVuelo ? 'selected' : '' }}>
                                            {{ $vuelo->IdVuelo }} - {{ $vuelo->aeropuertoOrigen->NombreAeropuerto ?? 'N/A' }} a {{ $vuelo->aeropuertoDestino->NombreAeropuerto ?? 'N/A' }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('IdVuelo')
                                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label for="idPasajero" class="block text-sm font-medium text-gray-700 mb-1">
                                    <i class="material-icons text-gray-500 mr-1 text-sm">person</i>Pasajero
                                </label>
                                <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('idPasajero') border-red-500 @enderror" id="idPasajero" name="idPasajero" required>
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
                                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <label for="FechaCompra" class="block text-sm font-medium text-gray-700 mb-1">
                                    <i class="material-icons text-gray-500 mr-1 text-sm">event</i>Fecha Compra
                                </label>
                                <input type="datetime-local" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('FechaCompra') border-red-500 @enderror" id="FechaCompra" name="FechaCompra" value="{{ old('FechaCompra', date('Y-m-d\TH:i')) }}" min="{{ date('Y-m-d\TH:i') }}">
                                @error('FechaCompra')
                                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label for="Precio" class="block text-sm font-medium text-gray-700 mb-1">
                                    <i class="material-icons text-gray-500 mr-1 text-sm">attach_money</i>Precio
                                </label>
                                <input type="number" step="0.01" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('Precio') border-red-500 @enderror" id="Precio" name="Precio" value="{{ isset($vueloSeleccionado) ? $vueloSeleccionado->Precio : old('Precio') }}" min="0" readonly>
                                @error('Precio')
                                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <label for="Cantidad" class="block text-sm font-medium text-gray-700 mb-1">
                                    <i class="material-icons text-gray-500 mr-1 text-sm">format_list_numbered</i>Cantidad
                                </label>
                                <input type="number" step="0.01" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('Cantidad') border-red-500 @enderror" id="Cantidad" name="Cantidad" value="{{ old('Cantidad', $cantidadDefault ?? 1) }}" min="0">
                                @error('Cantidad')
                                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label for="Descuento" class="block text-sm font-medium text-gray-700 mb-1">
                                    <i class="material-icons text-gray-500 mr-1 text-sm">local_offer</i>Descuento
                                </label>
                                <input type="number" step="0.01" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('Descuento') border-red-500 @enderror" id="Descuento" name="Descuento" value="{{ old('Descuento') }}" readonly>
                                @error('Descuento')
                                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <label for="Impuesto" class="block text-sm font-medium text-gray-700 mb-1">
                                    <i class="material-icons text-gray-500 mr-1 text-sm">account_balance</i>Impuesto
                                </label>
                                <input type="number" step="0.01" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('Impuesto') border-red-500 @enderror" id="Impuesto" name="Impuesto" value="{{ old('Impuesto') }}" readonly>
                                @error('Impuesto')
                                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                            <div>
                                <label for="Total" class="block text-sm font-medium text-gray-700 mb-1">
                                    <i class="material-icons text-gray-500 mr-1 text-sm">calculate</i>Total (Calculado automáticamente)
                                </label>
                                <input type="number" step="0.01" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 bg-gray-50" id="Total" name="Total" readonly>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex flex-row justify-center gap-4 mt-8 pt-6 border-t border-gray-200">
                            @if(!isset($vueloSeleccionado))
                                <button type="submit" class="material-btn material-btn-primary flex-1 justify-center" name="action" value="create">
                                    <i class="material-icons text-sm mr-2">save</i>
                                    Crear Boleto
                                </button>
                            @endif
                            @if(isset($vueloSeleccionado))
                               <button 
                                    type="button" 
                                    id="btn-siguiente-equipaje"
                                    name="action"
                                    value="next"
                                    style="display: flex; align-items: center; justify-content: center; flex: 1; 
                                        padding: 0.5rem 1rem; font-weight: 600; color: white; border-radius: 0.375rem; 
                                        box-shadow: 0 2px 6px rgba(0,0,0,0.2); background: linear-gradient(to right, #22c55e, #059669); 
                                        transition: all 0.2s ease;"
                                    onmouseover="this.style.background='linear-gradient(to right, #16a34a, #047857)';"
                                    onmouseout="this.style.background='linear-gradient(to right, #22c55e, #059669)';"
                                >
                                    <i class="material-icons" style="font-size: 14px; margin-right: 0.5rem;">arrow_forward</i>
                                    Siguiente: Equipajes
                                </button>


                            @endif
                            

                            <a href="{{ route('boletos.index') }}" class="material-btn material-btn-secondary flex-1 justify-center">
                                <i class="material-icons text-sm mr-2">cancel</i>
                                Cancelar
                            </a>
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
        const vueloSelect = document.getElementById('idVuelo');
        const precioInput = document.getElementById('Precio');
        const cantidadInput = document.getElementById('Cantidad');
        const descuentoInput = document.getElementById('Descuento');
        const impuestoInput = document.getElementById('Impuesto');
        const totalInput = document.getElementById('Total');
        const btnSiguienteEquipaje = document.getElementById('btn-siguiente-equipaje');
        const form = document.querySelector('form');
        const pasajeroSelect = document.getElementById('idPasajero');
        const fechaCompraInput = document.getElementById('FechaCompra');

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
            const cantidad = parseFloat(cantidadInput.value) || 1;

            const subtotal = precio * cantidad;
            const descuento = 0;
            const impuesto = subtotal * 0.12;
            const total = subtotal + impuesto;

            descuentoInput.value = descuento.toFixed(2);
            impuestoInput.value = impuesto.toFixed(2);
            totalInput.value = total.toFixed(2);
        }

        // Evento para seleccionar vuelo y asignar precio
        vueloSelect.addEventListener('change', function() {
            const selectedOption = vueloSelect.options[vueloSelect.selectedIndex];
            const precio = selectedOption.getAttribute('data-precio') || 0;
            precioInput.value = precio;
            if (precio > 0) {
                calcularTotal();
            }
        });

        // Eventos para calcular automáticamente en tiempo real
        const events = ['input', 'change', 'keyup', 'blur'];
        events.forEach(event => {
            cantidadInput.addEventListener(event, function() {
                if (precioInput.value && precioInput.value > 0) {
                    calcularTotal();
                }
            });
        });

        // Calcular inicialmente si hay precio
        if (precioInput.value && precioInput.value > 0) {
            calcularTotal();
        }

        // Auto-seleccionar vuelo si hay uno preseleccionado y asignar precio
        if (vueloSelect.value) {
            vueloSelect.dispatchEvent(new Event('change'));
        }

        // Si hay un vuelo preseleccionado desde la sesión, forzar la selección y cálculo
        @if(isset($vueloSeleccionado))
        setTimeout(() => {
            vueloSelect.value = '{{ $vueloSeleccionado->IdVuelo }}';
            // Asignar precio directamente desde el vuelo seleccionado
            precioInput.value = '{{ $vueloSeleccionado->Precio }}';
            vueloSelect.dispatchEvent(new Event('change'));
            // Forzar cálculo después de seleccionar el vuelo
            setTimeout(() => {
                calcularTotal();
            }, 200);
        }, 100);
        @endif

        // Evento para el botón "Finalizar Reserva"
        btnSiguienteEquipaje.addEventListener('click', function() {
            // Verificar campos requeridos
            if (!vueloSelect.value) {
                alert('Por favor seleccione un vuelo.');
                vueloSelect.focus();
                return;
            }

            if (!pasajeroSelect.value) {
                alert('Por favor seleccione un pasajero.');
                pasajeroSelect.focus();
                return;
            }

            if (!precioInput.value || precioInput.value <= 0) {
                alert('El precio del vuelo no es válido. Por favor seleccione un vuelo.');
                vueloSelect.focus();
                return;
            }

            if (!cantidadInput.value || cantidadInput.value <= 0) {
                alert('Por favor ingrese una cantidad válida.');
                cantidadInput.focus();
                return;
            }

            if (!totalInput.value || totalInput.value <= 0) {
                alert('El total no se ha calculado correctamente.');
                return;
            }

            // Deshabilitar botón para evitar múltiples envíos
            btnSiguienteEquipaje.disabled = true;
            btnSiguienteEquipaje.innerHTML = '<i class="material-icons text-sm mr-2">hourglass_empty</i>Procesando...';

            // Crear FormData con los datos del formulario
            const formData = new FormData();

            formData.append('idVuelo', vueloSelect.value);
            formData.append('idPasajero', pasajeroSelect.value);
            formData.append('Precio', precioInput.value);
            formData.append('Cantidad', cantidadInput.value);
            formData.append('Descuento', descuentoInput.value || '0');
            formData.append('Impuesto', impuestoInput.value || '0');
            formData.append('Total', totalInput.value);
            formData.append('FechaCompra', fechaCompraInput.value);
            formData.append('action', 'next');

            // Agregar el token CSRF
            formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));

            // Mostrar preloader de pantalla completa
            showFullscreenLoader();

            // Mostrar el preloader por al menos 2 segundos antes de enviar la petición AJAX
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
                            // Mostrar errores específicos de validación
                            if (err.errors) {
                                let errorMessages = 'Errores de validación:\n';
                                for (let field in err.errors) {
                                    errorMessages += `- ${err.errors[field].join(', ')}\n`;
                                }
                                throw new Error(errorMessages);
                            }
                            throw new Error(err.message || 'Error en la solicitud');
                        });
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.boleto_id) {
                        // Abrir PDF en nueva pestaña
                        window.open('{{ url("/boletos") }}/' + data.boleto_id + '/pdf', '_blank');

                        // Redirigir a equipajes create después de un breve delay
                        setTimeout(() => {
                            window.location.href = '{{ route("equipajes.create") }}';
                        }, 1000);
                    } else {
                        hideFullscreenLoader();
                        alert('Error al crear el boleto');
                        btnSiguiente.disabled = false;
                        btnSiguiente.innerHTML = '<i class="material-icons text-sm mr-2">arrow_forward</i>Siguiente: Equipajes';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    hideFullscreenLoader();
                    alert('Error al procesar la solicitud: ' + error.message);
                    btnFinalizarReserva.disabled = false;
                });
            }, 2000);
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
