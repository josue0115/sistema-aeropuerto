@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Crear Nuevo Vuelo</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('vuelos.store') }}" method="POST">
                        @csrf

                        <div class="row">
                            <!-- <div class="col-md-6" style="display: none;">
                                <div class="form-group mb-3">
                                    <label for="idVuelo">ID Vuelo</label>
                                    <input type="number" name="idVuelo" id="idVuelo" class="form-control" value="{{ old('idVuelo') }}" required>
                                    <small class="form-text text-muted">ID generado automáticamente</small>
                                    @error('idVuelo')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div> -->

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="idAvion">Avión</label>
                                    <select name="idAvion" id="idAvion" class="form-control" required>
                                        <option value="">Seleccionar Avión</option>
                                        @foreach($aviones as $avion)
                                            <option value="{{ $avion->idAvion }}" {{ old('idAvion') == $avion->idAvion ? 'selected' : '' }}>
                                                {{ $avion->Modelo }} ({{ $avion->Matricula }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('idAvion')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="idAeropuertoOrigen">Aeropuerto Origen</label>
                                    <select name="idAeropuertoOrigen" id="idAeropuertoOrigen" class="form-control" required>
                                        <option value="">Seleccionar Aeropuerto Origen</option>
                                        @foreach($aeropuertos as $aeropuerto)
                                            <option value="{{ $aeropuerto->idAeropuerto }}" {{ (isset($busquedaData) && $busquedaData['origen'] == $aeropuerto->idAeropuerto) || old('idAeropuertoOrigen') == $aeropuerto->idAeropuerto ? 'selected' : '' }}>
                                                {{ $aeropuerto->Nombre }} ({{ $aeropuerto->Ciudad }}, {{ $aeropuerto->Pais }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('idAeropuertoOrigen')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="idAeropuertoDestino">Aeropuerto Destino</label>
                                    <select name="idAeropuertoDestino" id="idAeropuertoDestino" class="form-control" required>
                                        <option value="">Seleccionar Aeropuerto Destino</option>
                                        @foreach($aeropuertos as $aeropuerto)
                                            <option value="{{ $aeropuerto->idAeropuerto }}" {{ (isset($busquedaData) && $busquedaData['destino'] == $aeropuerto->idAeropuerto) || old('idAeropuertoDestino') == $aeropuerto->idAeropuerto ? 'selected' : '' }}>
                                                {{ $aeropuerto->Nombre }} ({{ $aeropuerto->Ciudad }}, {{ $aeropuerto->Pais }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('idAeropuertoDestino')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                           <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="FechaSalida">Fecha Salida</label>
                                    <input 
                                        type="datetime-local" 
                                        name="FechaSalida" 
                                        id="FechaSalida" 
                                        class="form-control" 
                                        value="{{ isset($busquedaData) ? date('Y-m-d\TH:i', strtotime($busquedaData['fecha_ida'])) : old('FechaSalida') }}" 
                                        required
                                        min="{{ date('Y-m-d\TH:i') }}"
                                    >
                                    @error('FechaSalida')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6" id="fecha_llegada_container" style="{{ isset($busquedaData) && isset($busquedaData['fecha_vuelta']) ? '' : '' }}">
                                <div class="form-group mb-3">
                                    <label for="FechaLlegada">Fecha Llegada</label>
                                    <input 
                                        type="datetime-local" 
                                        name="FechaLlegada" 
                                        id="FechaLlegada" 
                                        class="form-control" 
                                        value="{{ isset($busquedaData) && isset($busquedaData['fecha_vuelta']) ? date('Y-m-d\TH:i', strtotime($busquedaData['fecha_vuelta'])) : old('FechaLlegada') }}" 
                                        {{ isset($busquedaData) && isset($busquedaData['fecha_vuelta']) ? 'required' : '' }}
                                        min="{{ date('Y-m-d\TH:i') }}"
                                    >
                                    @error('FechaLlegada')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="Precio">Precio</label>
                                    <input type="number" step="0.01" name="Precio" id="Precio" class="form-control" value="{{ isset($precioSugerido) ? $precioSugerido : old('Precio') }}" required>
                                    @if(isset($precioSugerido))
                                        <small class="form-text text-muted">Precio sugerido basado en vuelos existentes para esta ruta</small>
                                    @endif
                                    @error('Precio')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="Estado">Estado</label>
                                    <select name="Estado" id="Estado" class="form-control" required>
                                        <option value="Programado" {{ old('Estado', 'Programado') == 'Programado' ? 'selected' : '' }}>Programado</option>
                                        <option value="EnVuelo" {{ old('Estado') == 'EnVuelo' ? 'selected' : '' }}>En Vuelo</option>
                                        <option value="Llegado" {{ old('Estado') == 'Llegado' ? 'selected' : '' }}>Llegado</option>
                                        <option value="Retrasado" {{ old('Estado') == 'Retrasado' ? 'selected' : '' }}>Retrasado</option>
                                        <option value="Cancelado" {{ old('Estado') == 'Cancelado' ? 'selected' : '' }}>Cancelado</option>
                                    </select>
                                    @error('Estado')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Crear Vuelo</button>
                        <a href="{{ route('vuelos.index') }}" class="btn btn-secondary">Cancelar</a>
                        <a href="{{ route('home') }}" class="btn btn-warning ">Regresar</a>
                        <a href="{{ route('pasajeros.create') }}" class="btn btn-success float-end">Continuar a Pasajeros</a>
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
    // 1. Obtención ÚNICA de los elementos
   // const idVueloInput = document.getElementById('idVuelo');
    const origenSelect = document.getElementById('idAeropuertoOrigen');
    const destinoSelect = document.getElementById('idAeropuertoDestino');
    const fechaSalidaInput = document.getElementById('FechaSalida');
    const fechaLlegadaInput = document.getElementById('FechaLlegada');

    // --- LÓGICA DE CÁLCULO DE FECHA DE LLEGADA ---
    function formatDateTimeLocal(date) {
        const yyyy = date.getFullYear();
        const mm = String(date.getMonth() + 1).padStart(2, '0');
        const dd = String(date.getDate()).padStart(2, '0');
        const hh = String(date.getHours()).padStart(2, '0');
        const min = String(date.getMinutes()).padStart(2, '0');
        return `${yyyy}-${mm}-${dd}T${hh}:${min}`;
    }

    function actualizarFechaLlegada() {
        const fechaSalidaValue = fechaSalidaInput.value;
        if (!fechaSalidaValue) {
            fechaLlegadaInput.value = '';
            return;
        }
        
        // Convertir el valor del input a objeto Date
        const fechaSalida = new Date(fechaSalidaValue);
        
        // Clonar la fecha y sumarle 1 día (24 horas * 60 minutos * 60 segundos * 1000 milisegundos)
        const fechaLlegada = new Date(fechaSalida.getTime() + (24 * 60 * 60 * 1000));
        
        // Asignar el nuevo valor formateado
        fechaLlegadaInput.value = formatDateTimeLocal(fechaLlegada);
    }

    // --- INICIALIZACIÓN Y EVENTOS ---

    // 2. Ejecutar al cargar la página si ya hay valor en FechaSalida (proveniente del formulario anterior)
    if (fechaSalidaInput.value && !fechaLlegadaInput.value) {
        // Ejecuta la actualización solo si FechaLlegada está vacía
        actualizarFechaLlegada();
    }
    
    // Escuchar el evento 'change' en la fecha de salida para actualizar la llegada
    fechaSalidaInput.addEventListener('change', actualizarFechaLlegada);


    // --- OTRAS LÓGICAS (Mantenidas) ---

    // Generar ID automático para vuelo
    // if (!idVueloInput.value) {
    //     const timestamp = Date.now();
    //     idVueloInput.value = timestamp.toString().slice(-6);
    // }

    // Validación para asegurar que origen y destino sean diferentes
    function validarAeropuertos() {
        if (origenSelect.value && destinoSelect.value && origenSelect.value === destinoSelect.value) {
            destinoSelect.setCustomValidity('El aeropuerto de destino debe ser diferente al de origen');
        } else {
            destinoSelect.setCustomValidity('');
        }
    }

    origenSelect.addEventListener('change', validarAeropuertos);
    destinoSelect.addEventListener('change', validarAeropuertos);

    // Validación de fechas
    function validarFechas() {
        // Note: Se usa fechaSalidaInput y fechaLlegadaInput definidos al inicio
        const fechaSalida = new Date(fechaSalidaInput.value);
        const fechaLlegada = new Date(fechaLlegadaInput.value);
        const ahora = new Date();

        // Lógica de validación
        if (fechaSalida < ahora) {
            fechaSalidaInput.setCustomValidity('La fecha de salida debe ser futura');
        } else {
            fechaSalidaInput.setCustomValidity('');
        }

        if (fechaLlegada && fechaLlegada <= fechaSalida) {
            fechaLlegadaInput.setCustomValidity('La fecha de llegada debe ser posterior a la de salida');
        } else {
            fechaLlegadaInput.setCustomValidity('');
        }
    }

    fechaSalidaInput.addEventListener('change', validarFechas);
    fechaLlegadaInput.addEventListener('change', validarFechas);
});
</script>
@endsection