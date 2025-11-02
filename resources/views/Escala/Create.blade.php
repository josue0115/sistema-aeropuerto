@extends('layouts.app')

@section('page-title', 'Crear Escala - Sistema Aeropuerto')

@section('content')
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Personal</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">
                <i class="material-icons me-2">add_circle</i> Crear Escala
            </h4>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('escala.store') }}">
                @csrf

                <!-- Selección de Vuelo -->
                <div class="mb-3">
                    <label for="IdVuelo" class="form-label">Vuelo</label>
                    <select name="IdVuelo" id="IdVuelo" class="form-select" required>
                        <option value="">Seleccione un vuelo</option>
                        @foreach($vuelos as $vuelo)
                            <option value="{{ $vuelo->IdVuelo }}">
                                {{ $vuelo->IdVuelo }} -
                                {{ $vuelo->aeropuertoOrigen->NombreAeropuerto ?? 'N/A' }} →
                                {{ $vuelo->aeropuertoDestino->NombreAeropuerto ?? 'N/A' }}
                            </option>
                        @endforeach
                    </select>
                    @error('IdVuelo')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Selección de Aeropuerto -->
                <div class="mb-3">
                    <label for="IdAeropuerto" class="form-label">Aeropuerto</label>
                    <select name="IdAeropuerto" id="IdAeropuerto" class="form-select" required>
                        <option value="">Seleccione un aeropuerto</option>
                        @foreach($aeropuertos as $aeropuerto)
                            <option value="{{ $aeropuerto->IdAeropuerto }}">
                                {{ $aeropuerto->IdAeropuerto }} - {{ $aeropuerto->NombreAeropuerto }}
                            </option>
                        @endforeach
                    </select>
                    @error('IdAeropuerto')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Horarios -->
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="HoraSalida" class="form-label">Hora Salida</label>
                        <input type="time" name="HoraSalida" id="HoraSalida" class="form-control" required>
                        @error('HoraSalida')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="HoraLlegada" class="form-label">Hora Llegada</label>
                        <input type="time" name="HoraLlegada" id="HoraLlegada" class="form-control" required>
                        @error('HoraLlegada')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <!-- Tiempo de Espera -->
                <div class="mb-3">
                    <label for="TiempoEspera" class="form-label">Tiempo de Espera (minutos)</label>
                    <input type="number" name="TiempoEspera" id="TiempoEspera" class="form-control" min="0" required>
                    @error('TiempoEspera')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Estado -->
                <div class="mb-4">
                    <label for="Estado" class="form-label">Estado</label>
                    <select name="Estado" id="Estado" class="form-select" required>
                        <option value="">Seleccione un estado</option>
                        <option value="Activo">Activo</option>
                        <option value="Inactivo">Inactivo</option>
                        <option value="Cancelado">Cancelado</option>
                    </select>
                    @error('Estado')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Botones -->
                <div class="d-flex justify-content-end">
                    <a href="{{ route('escala.index') }}" class="btn btn-secondary me-2">
                        <i class="material-icons me-1">cancel</i> Cancelar
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="material-icons me-1">save</i> Guardar Escala
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<!-- Bootstrap y jQuery -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
$(document).ready(function() {
    // Validar que la hora de llegada sea posterior a la hora de salida
    $('#HoraLlegada').on('change', function() {
        const salida = $('#HoraSalida').val();
        const llegada = $(this).val();
        if (salida && llegada && llegada <= salida) {
            alert('La hora de llegada debe ser posterior a la hora de salida.');
            $(this).val('');
        }
    });
});
</script>
@endsection
</body>
</html>