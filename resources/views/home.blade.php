@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header text-center">
                    <h1>Sistema de Aeropuerto</h1>
                    <p class="mb-0">Gestión integral de vuelos, pasajeros y servicios aeroportuarios</p>
                </div>
                <div class="card-body">
                    <!-- Formulario de búsqueda de vuelos -->
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Buscar Vuelos</h5>
                                </div>
                                <div class="card-body">
                                    <form id="busqueda-vuelos" method="GET" action="{{ route('vuelos.create') }}">
                                        <div class="row">
                                            <div class="col-md-3 mb-3">
                                                <label for="tipo_viaje" class="form-label">Tipo de Viaje</label>
                                                <select class="form-control" id="tipo_viaje" name="tipo_viaje" required>
                                                    <option value="ida">Solo Ida</option>
                                                    <option value="ida_vuelta">Ida y Vuelta</option>
                                                </select>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label for="origen" class="form-label">Origen</label>
                                                <select class="form-control" id="origen" name="origen" required>
                                                    <option value="">Seleccionar Origen</option>
                                                    @foreach($aeropuertos as $aeropuerto)
                                                        <option value="{{ $aeropuerto->idAeropuerto }}">{{ $aeropuerto->Nombre }} ({{ $aeropuerto->Ciudad }}, {{ $aeropuerto->Pais }})</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label for="destino" class="form-label">Destino</label>
                                                <select class="form-control" id="destino" name="destino" required>
                                                    <option value="">Seleccionar Destino</option>
                                                    @foreach($aeropuertos as $aeropuerto)
                                                        <option value="{{ $aeropuerto->idAeropuerto }}">{{ $aeropuerto->Nombre }} ({{ $aeropuerto->Ciudad }}, {{ $aeropuerto->Pais }})</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label for="pasajeros" class="form-label">Pasajeros</label>
                                                <select class="form-control" id="pasajeros" name="pasajeros" required>
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
                                        <div class="row">
                                            <div class="col-md-3 mb-3">
                                                <label for="fecha_ida" class="form-label">Fecha de Ida</label>
                                                <input type="date" class="form-control" id="fecha_ida" name="fecha_ida" min="{{ date('Y-m-d') }}" required>
                                            </div>
                                            <div class="col-md-3 mb-3" id="fecha_vuelta_container" style="display: none;">
                                                <label for="fecha_vuelta" class="form-label">Fecha de Vuelta</label>
                                                <input type="date" class="form-control" id="fecha_vuelta" name="fecha_vuelta1" min="{{ date('Y-m-d') }}">
                                            </div>
                                            <div class="col-md-3 mb-3 d-flex align-items-end">
                                                <button type="submit" class="btn btn-primary w-100">Buscar Vuelos</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-body text-center">
                                    <h5 class="card-title">Vuelos</h5>
                                    <p class="card-text">Gestiona los vuelos disponibles en el aeropuerto.</p>
                                    <a href="{{ route('vuelos.index') }}" class="btn btn-primary">Ver Vuelos</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-body text-center">
                                    <h5 class="card-title">Pasajeros</h5>
                                    <p class="card-text">Administra la información de los pasajeros.</p>
                                    <a href="{{ route('pasajeros.index') }}" class="btn btn-success">Ver Pasajeros</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-body text-center">
                                    <h5 class="card-title">Servicios</h5>
                                    <p class="card-text">Controla los servicios disponibles en el aeropuerto.</p>
                                    <a href="{{ route('servicios.index') }}" class="btn btn-info">Ver Servicios</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-body text-center">
                                    <h5 class="card-title">Asientos</h5>
                                    <p class="card-text">Gestiona los asientos disponibles en los vuelos.</p>
                                    <a href="{{ route('asientos.index') }}" class="btn btn-warning">Ver Asientos</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="text-center mb-3">Otras Funcionalidades</h4>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="{{ route('aerolineas.index') }}" class="btn btn-outline-primary btn-block">Aerolineas</a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="{{ route('aeropuertos.index') }}" class="btn btn-outline-secondary btn-block">Aeropuertos</a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="{{ route('avion.listar') }}" class="btn btn-outline-success btn-block">Aviones</a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="{{ route('personal.listar') }}" class="btn btn-outline-info btn-block">Personal</a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="{{ route('mantenimiento.listar') }}" class="btn btn-outline-warning btn-block">Mantenimiento</a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="{{ route('horario.index') }}" class="btn btn-outline-danger btn-block">Horarios</a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="{{ route('escala.index') }}" class="btn btn-outline-dark btn-block">Escalas</a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="{{ route('tipo_servicios.index') }}" class="btn btn-outline-primary btn-block">Tipo Servicios</a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="{{ route('boletos.index') }}" class="btn btn-outline-success btn-block">Boletos</a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="{{ route('reservas.index') }}" class="btn btn-outline-info btn-block">Reservas</a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="{{ route('equipajes.index') }}" class="btn btn-outline-warning btn-block">Equipajes</a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="{{ route('facturas.index') }}" class="btn btn-outline-danger btn-block">Facturas</a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="{{ route('historial_vuelos.index') }}" class="btn btn-outline-dark btn-block">Historial Vuelos</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
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
