    @extends('layouts.app')

@section('page-title', 'Dashboard - Sistema Aeropuerto')

@section('content')
<!-- Statistics Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="material-stats-card">
        <div class="flex items-center justify-between">
            <div>
                <div class="stat-icon">
                    <i class="material-icons">flight_takeoff</i>
                </div>
                <div class="stat-value">{{ $stats['vuelos'] ?? 0 }}</div>
                <div class="stat-label">VUELOS ACTIVOS</div>
            </div>
        </div>
    </div>

    <div class="material-stats-card">
        <div class="flex items-center justify-between">
            <div>
                <div class="stat-icon">
                    <i class="material-icons">people</i>
                </div>
                <div class="stat-value">{{ $stats['pasajeros'] ?? 0 }}</div>
                <div class="stat-label">PASAJEROS</div>
            </div>
        </div>
    </div>

    <div class="material-stats-card">
        <div class="flex items-center justify-between">
            <div>
                <div class="stat-icon">
                    <i class="material-icons">event_note</i>
                </div>
                <div class="stat-value">{{ $stats['reservas'] ?? 0 }}</div>
                <div class="stat-label">RESERVAS</div>
            </div>
        </div>
    </div>

    <div class="material-stats-card">
        <div class="flex items-center justify-between">
            <div>
                <div class="stat-icon">
                    <i class="material-icons">attach_money</i>
                </div>
                <div class="stat-value">${{ number_format($stats['ingresos'] ?? 0, 0) }}</div>
                <div class="stat-label">INGRESOS TOTALES</div>
            </div>
        </div>
    </div>
</div>

<!-- Main Content Grid -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Flight Search Card -->
    <div class="lg:col-span-2">
        <div class="material-card">
            <div class="p-6 border-b border-gray-200">
                <h3 class="text-xl font-semibold text-gray-800 mb-2">
                    <i class="material-icons text-blue-600 mr-2">search</i>
                    Buscar Vuelos Disponibles
                </h3>
                <p class="text-gray-600">Encuentra y reserva los mejores vuelos para tu viaje</p>
            </div>
            <div class="p-6">
                <form id="busqueda-vuelos" method="GET" action="{{ route('vuelos.disponibles') }}">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-4">
                        <div>
                            <label for="tipo_viaje" class="block text-sm font-medium text-gray-700 mb-2">Tipo de Viaje</label>
                            <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" id="tipo_viaje" name="tipo_viaje" required>
                                <option value="ida">Solo Ida</option>
                                <option value="ida_vuelta">Ida y Vuelta</option>
                            </select>
                        </div>
                        <div>
                            <label for="origen" class="block text-sm font-medium text-gray-700 mb-2">Origen</label>
                            <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" id="origen" name="origen" required>
                                <option value="">Seleccionar Origen</option>
                                @foreach($aeropuertos as $aeropuerto)
                                    <option value="{{ $aeropuerto->IdAeropuerto }}">{{ $aeropuerto->NombreAeropuerto }} ({{ $aeropuerto->Ciudad }}, {{ $aeropuerto->Pais }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="destino" class="block text-sm font-medium text-gray-700 mb-2">Destino</label>
                            <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" id="destino" name="destino" required>
                                <option value="">Seleccionar Destino</option>
                                @foreach($aeropuertos as $aeropuerto)
                                    <option value="{{ $aeropuerto->IdAeropuerto }}">{{ $aeropuerto->NombreAeropuerto }} ({{ $aeropuerto->Ciudad }}, {{ $aeropuerto->Pais }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="pasajeros" class="block text-sm font-medium text-gray-700 mb-2">Pasajeros</label>
                            <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" id="pasajeros" name="pasajeros" required>
                                <option value="1">1 Pasajero</option>
                                <option value="2">2 Pasajeros</option>
                                <option value="3">3 Pasajeros</option>
                                <option value="4">4 Pasajeros</option>
                                <option value="5">5 Pasajeros</option>
                                <option value="6">6 Pasajeros</option>
                                <option value="7">7 Pasajeros</option>
                                <option value="8">8 Pasajeros</option>
                                <option value="9">9 Pasajeros</option>
                            </select>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
                        <div>
                            <label for="fecha_ida" class="block text-sm font-medium text-gray-700 mb-2">Fecha de Ida</label>
                            <input type="date" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" id="fecha_ida" name="fecha_ida" min="{{ date('Y-m-d') }}" required>
                        </div>
                        <div id="fecha_vuelta_container" style="display: none;">
                            <label for="fecha_vuelta" class="block text-sm font-medium text-gray-700 mb-2">Fecha de Vuelta</label>
                            <input type="date" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" id="fecha_vuelta" name="fecha_vuelta1" min="{{ date('Y-m-d') }}">
                        </div>
                        <div>
                            <button type="submit" class="w-full material-btn material-btn-primary py-2 px-4">
                                <i class="material-icons text-sm mr-2">search</i>
                                Buscar Vuelos
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @if(in_array(auth()->user()->role, [ 'operador']))
    <!-- Quick Actions Card -->
    <div>
        <div class="material-card">
            <div class="p-6 border-b border-gray-200">
                <h3 class="text-xl font-semibold text-gray-800 mb-2">
                    <i class="material-icons text-green-600 mr-2">flash_on</i>
                    Acciones Rápidas
                </h3>
                <p class="text-gray-600 text-sm">Operaciones comunes del sistema</p>
            </div>
            <div class="p-6 space-y-3">
                <a href="{{ route('reservas.create') }}" class="flex items-center p-3 rounded-md hover:bg-gray-50 transition-colors border border-gray-200">
                    <i class="material-icons text-blue-600 mr-3">add_circle</i>
                    <div>
                        <div class="font-medium text-gray-800">Nueva Reserva</div>
                        <div class="text-sm text-gray-600">Crear reserva de vuelo</div>
                    </div>
                </a>
                <a href="{{ route('pasajeros.create') }}" class="flex items-center p-3 rounded-md hover:bg-gray-50 transition-colors border border-gray-200">
                    <i class="material-icons text-green-600 mr-3">person_add</i>
                    <div>
                        <div class="font-medium text-gray-800">Registrar Pasajero</div>
                        <div class="text-sm text-gray-600">Agregar nuevo pasajero</div>
                    </div>
                </a>
                <a href="{{ route('boletos.create') }}" class="flex items-center p-3 rounded-md hover:bg-gray-50 transition-colors border border-gray-200">
                    <i class="material-icons text-purple-600 mr-3">confirmation_number</i>
                    <div>
                        <div class="font-medium text-gray-800">Emitir Boleto</div>
                        <div class="text-sm text-gray-600">Generar boleto de vuelo</div>
                    </div>
                </a>
                <a href="{{ route('pagos.create') }}" class="flex items-center p-3 rounded-md hover:bg-gray-50 transition-colors border border-gray-200">
                    <i class="material-icons text-orange-600 mr-3">payment</i>
                    <div>
                        <div class="font-medium text-gray-800">Procesar Pago</div>
                        <div class="text-sm text-gray-600">Registrar pago de servicios</div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    @endif
</div>

<!-- Module Cards Grid -->
  @if(in_array(auth()->user()->role, [ 'operador']))
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mt-8">
    <div class="material-card">
        <div class="p-6">
            <div class="flex items-center mb-4">
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mr-4">
                    <i class="material-icons text-blue-600">flight_takeoff</i>
                </div>
                <div>
                    <h4 class="text-lg font-semibold text-gray-800">Gestión de Vuelos</h4>
                    <p class="text-gray-600 text-sm">Administrar vuelos disponibles</p>
                </div>
            </div>
                <a href="{{ route('vuelos.disponibles') }}" class="material-btn material-btn-primary w-full">
                    <i class="material-icons text-sm mr-2">flight_takeoff</i>
                    Listar Vuelos Disponibles
                </a>
        </div>
    </div>

    <div class="material-card">
        <div class="p-6">
            <div class="flex items-center mb-4">
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mr-4">
                    <i class="material-icons text-green-600">people</i>
                </div>
                <div>
                    <h4 class="text-lg font-semibold text-gray-800">Pasajeros</h4>
                    <p class="text-gray-600 text-sm">Administrar información de pasajeros</p>
                </div>
            </div>
            <a href="{{ route('pasajeros.index') }}" class="material-btn material-btn-primary w-full">
                Gestionar Pasajeros
            </a>
        </div>
    </div>

    <div class="material-card">
        <div class="p-6">
            <div class="flex items-center mb-4">
                <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mr-4">
                    <i class="material-icons text-purple-600">event_note</i>
                </div>
                <div>
                    <h4 class="text-lg font-semibold text-gray-800">Reservas</h4>
                    <p class="text-gray-600 text-sm">Sistema completo de reservas</p>
                </div>
            </div>
            <a href="{{ route('reservas.index') }}" class="material-btn material-btn-primary w-full">
                Gestionar Reservas
            </a>
        </div>
    </div>

    <div class="material-card">
        <div class="p-6">
            <div class="flex items-center mb-4">
                <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center mr-4">
                    <i class="material-icons text-orange-600">confirmation_number</i>
                </div>
                <div>
                    <h4 class="text-lg font-semibold text-gray-800">Boletos</h4>
                    <p class="text-gray-600 text-sm">Emisión y control de boletos</p>
                </div>
            </div>
            <a href="{{ route('boletos.index') }}" class="material-btn material-btn-primary w-full">
                Gestionar Boletos
            </a>
        </div>
    </div>

    <div class="material-card">
        <div class="p-6">
            <div class="flex items-center mb-4">
                <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center mr-4">
                    <i class="material-icons text-red-600">room_service</i>
                </div>
                <div>
                    <h4 class="text-lg font-semibold text-gray-800">Servicios</h4>
                    <p class="text-gray-600 text-sm">Servicios aeroportuarios</p>
                </div>
            </div>
            <a href="{{ route('servicios.index') }}" class="material-btn material-btn-primary w-full">
                Gestionar Servicios
            </a>
        </div>
    </div>

    <div class="material-card">
        <div class="p-6">
            <div class="flex items-center mb-4">
                <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center mr-4">
                    <i class="material-icons text-indigo-600">event_seat</i>
                </div>
                <div>
                    <h4 class="text-lg font-semibold text-gray-800">Asientos</h4>
                    <p class="text-gray-600 text-sm">Gestión de asientos disponibles</p>
                </div>
            </div>
            <a href="{{ route('asientos.index') }}" class="material-btn material-btn-primary w-full">
                Gestionar Asientos
            </a>
        </div>
    </div>

    <div class="material-card">
        <div class="p-6">
            <div class="flex items-center mb-4">
                <div class="w-12 h-12 bg-teal-100 rounded-lg flex items-center justify-center mr-4">
                    <i class="material-icons text-teal-600">payment</i>
                </div>
                <div>
                    <h4 class="text-lg font-semibold text-gray-800">Pagos</h4>
                    <p class="text-gray-600 text-sm">Sistema de pagos y facturación</p>
                </div>
            </div>
            <a href="{{ route('pagos.index') }}" class="material-btn material-btn-primary w-full">
                Gestionar Pagos
            </a>
        </div>
    </div>

    <div class="material-card">
        <div class="p-6">
            <div class="flex items-center mb-4">
                <div class="w-12 h-12 bg-gray-100 rounded-lg flex items-center justify-center mr-4">
                    <i class="material-icons text-gray-600">receipt</i>
                </div>
                <div>
                    <h4 class="text-lg font-semibold text-gray-800">Facturas</h4>
                    <p class="text-gray-600 text-sm">Sistema de facturación</p>
                </div>
            </div>
            <a href="{{ route('facturas.index') }}" class="material-btn material-btn-primary w-full">
                Gestionar Facturas
            </a>
        </div>
    </div>
</div>

<!-- Additional Modules Section -->
<div class="mt-8">
    <h3 class="text-2xl font-semibold text-gray-800 mb-6">Módulos Administrativos</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        <div class="material-card">
            <div class="p-6">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-cyan-100 rounded-lg flex items-center justify-center mr-4">
                        <i class="material-icons text-cyan-600">business</i>
                    </div>
                    <div>
                        <h4 class="text-lg font-semibold text-gray-800">Aerolíneas</h4>
                        <p class="text-gray-600 text-sm">Gestión de aerolíneas</p>
                    </div>
                </div>
                <a href="{{ route('aerolineas.index') }}" class="material-btn material-btn-primary w-full">
                    <i class="material-icons text-sm mr-2">business</i>
                    Gestionar Aerolíneas
                </a>
            </div>
        </div>

        <div class="material-card">
            <div class="p-6">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-lime-100 rounded-lg flex items-center justify-center mr-4">
                        <i class="material-icons text-lime-600">location_city</i>
                    </div>
                    <div>
                        <h4 class="text-lg font-semibold text-gray-800">Aeropuertos</h4>
                        <p class="text-gray-600 text-sm">Administrar aeropuertos</p>
                    </div>
                </div>
                <a href="{{ route('aeropuertos.index') }}" class="material-btn material-btn-primary w-full">
                    Gestionar Aeropuertos
                </a>
            </div>
        </div>

        <div class="material-card">
            <div class="p-6">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-amber-100 rounded-lg flex items-center justify-center mr-4">
                        <i class="material-icons text-amber-600">airplanemode_active</i>
                    </div>
                    <div>
                        <h4 class="text-lg font-semibold text-gray-800">Aviones</h4>
                        <p class="text-gray-600 text-sm">Flota de aviones</p>
                    </div>
                </div>
                <a href="{{ route('avion.listar') }}" class="material-btn material-btn-primary w-full">
                    Gestionar Aviones
                </a>
            </div>
        </div>

        <div class="material-card">
            <div class="p-6">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-rose-100 rounded-lg flex items-center justify-center mr-4">
                        <i class="material-icons text-rose-600">engineering</i>
                    </div>
                    <div>
                        <h4 class="text-lg font-semibold text-gray-800">Personal</h4>
                        <p class="text-gray-600 text-sm">Gestión del personal</p>
                    </div>
                </div>
                <a href="{{ route('personal.listar') }}" class="material-btn material-btn-primary w-full">
                    Gestionar Personal
                </a>
            </div>
        </div>

        <div class="material-card">
            <div class="p-6">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-emerald-100 rounded-lg flex items-center justify-center mr-4">
                        <i class="material-icons text-emerald-600">build</i>
                    </div>
                    <div>
                        <h4 class="text-lg font-semibold text-gray-800">Mantenimiento</h4>
                        <p class="text-gray-600 text-sm">Programas de mantenimiento</p>
                    </div>
                </div>
                <a href="{{ route('mantenimiento.listar') }}" class="material-btn material-btn-primary w-full">
                    Gestionar Mantenimiento
                </a>
            </div>
        </div>

        <div class="material-card">
            <div class="p-6">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-violet-100 rounded-lg flex items-center justify-center mr-4">
                        <i class="material-icons text-violet-600">schedule</i>
                    </div>
                    <div>
                        <h4 class="text-lg font-semibold text-gray-800">Horarios</h4>
                        <p class="text-gray-600 text-sm">Horarios de vuelos</p>
                    </div>
                </div>
                <a href="{{ route('horario.index') }}" class="material-btn material-btn-primary w-full">
                    Gestionar Horarios
                </a>
            </div>
        </div>

        <div class="material-card">
            <div class="p-6">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-slate-100 rounded-lg flex items-center justify-center mr-4">
                        <i class="material-icons text-slate-600">transfer_within_a_station</i>
                    </div>
                    <div>
                        <h4 class="text-lg font-semibold text-gray-800">Escalas</h4>
                        <p class="text-gray-600 text-sm">Puntos de escala</p>
                    </div>
                </div>
                <a href="{{ route('escala.index') }}" class="material-btn material-btn-primary w-full">
                    Gestionar Escalas
                </a>
            </div>
        </div>

        <div class="material-card">
            <div class="p-6">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-stone-100 rounded-lg flex items-center justify-center mr-4">
                        <i class="material-icons text-stone-600">category</i>
                    </div>
                    <div>
                        <h4 class="text-lg font-semibold text-gray-800">Tipo Servicios</h4>
                        <p class="text-gray-600 text-sm">Categorías de servicios</p>
                    </div>
                </div>
                <a href="{{ route('tipo_servicios.index') }}" class="material-btn material-btn-primary w-full">
                    Gestionar Tipos
                </a>
            </div>
        </div>
    </div>
</div>
 @endif
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const tipoViajeSelect = document.getElementById('tipo_viaje');
    const fechaVueltaContainer = document.getElementById('fecha_vuelta_container');
    const fechaVueltaInput = document.getElementById('fecha_vuelta');
    const fechaIdaInput = document.getElementById('fecha_ida');
    const origenSelect = document.getElementById('origen');
    const destinoSelect = document.getElementById('destino');

    // Mostrar/ocultar fecha de vuelta según tipo de viaje
    tipoViajeSelect.addEventListener('change', function() {
        if (this.value === 'ida_vuelta') {
            fechaVueltaContainer.style.display = 'block';
            fechaVueltaInput.required = true;
        } else {
            fechaVueltaContainer.style.display = 'none';
            fechaVueltaInput.required = false;
            fechaVueltaInput.value = '';
        }
    });

    // Validar que origen y destino sean diferentes
    function validarAeropuertos() {
        if (origenSelect.value && destinoSelect.value && origenSelect.value === destinoSelect.value) {
            destinoSelect.setCustomValidity('El destino debe ser diferente al origen');
        } else {
            destinoSelect.setCustomValidity('');
        }
    }

    origenSelect.addEventListener('change', validarAeropuertos);
    destinoSelect.addEventListener('change', validarAeropuertos);

    // Validar fechas
    fechaIdaInput.addEventListener('change', function() {
        const fechaIda = new Date(this.value);
        const hoy = new Date();
        hoy.setHours(0, 0, 0, 0);

        if (fechaIda < hoy) {
            this.setCustomValidity('La fecha de ida debe ser hoy o posterior');
        } else {
            this.setCustomValidity('');
        }

        // Actualizar fecha mínima de vuelta
        if (tipoViajeSelect.value === 'ida_vuelta') {
            fechaVueltaInput.min = this.value;
            if (fechaVueltaInput.value && new Date(fechaVueltaInput.value) < fechaIda) {
                fechaVueltaInput.value = this.value;
            }
        }
    });

    fechaVueltaInput.addEventListener('change', function() {
        const fechaVuelta = new Date(this.value);
        const fechaIda = new Date(fechaIdaInput.value);

        if (fechaVuelta < fechaIda) {
            this.setCustomValidity('La fecha de vuelta debe ser posterior a la fecha de ida');
        } else {
            this.setCustomValidity('');
        }
    });

    // Guardar datos en sessionStorage para usar en otras páginas
    document.getElementById('busqueda-vuelos').addEventListener('submit', function(e) {
        const formData = new FormData(this);
        const searchData = {
            tipo_viaje: formData.get('tipo_viaje'),
            origen: formData.get('origen'),
            destino: formData.get('destino'),
            pasajeros: formData.get('pasajeros'),
            fecha_ida: formData.get('fecha_ida'),
            fecha_vuelta: formData.get('fecha_vuelta')
        };
        sessionStorage.setItem('busquedaVuelos', JSON.stringify(searchData));
    });
});
</script>
@endsection
