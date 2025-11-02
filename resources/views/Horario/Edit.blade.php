@extends('layouts.app')

@section('page-title', 'Editar Horario')

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
<div class="container mt-4">
    <h1 class="mb-4">Editar Horario </h1>

    <form method="POST" action="{{ route('horario.update', $horario) }}">
        @csrf
        @method('PUT')

        <div class="card shadow-sm">
            <div class="card-body">

                {{-- Campo: Vuelo --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Vuelo</label>
                    <select name="IdVuelo" class="form-select" required>
                        <option value="">Seleccione</option>
                        @foreach($vuelos as $vuelo)
                            <option value="{{ $vuelo->IdVuelo }}" 
                                {{ $vuelo->IdVuelo == $horario->IdVuelo ? 'selected' : '' }}>
                                {{ $vuelo->IdVuelo }} - {{ $vuelo->aeropuertoOrigen->NombreAeropuerto ?? 'N/A' }} →
                                {{ $vuelo->aeropuertoDestino->NombreAeropuerto ?? 'N/A' }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Campo: Hora de Salida --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Hora Salida</label>
                    <input type="time" name="HoraSalida" class="form-control" value="{{ $horario->HoraSalida }}" required>
                </div>

                {{-- Campo: Hora de Llegada --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Hora Llegada</label>
                    <input type="time" name="HoraLlegada" class="form-control" value="{{ $horario->HoraLlegada }}" required>
                </div>

                {{-- Campo: Tiempo de Espera --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Tiempo de Espera (minutos)</label>
                    <input type="number" name="TiempoEspera" class="form-control" min="0" value="{{ $horario->TiempoEspera }}" required>
                </div>

                {{-- Campo: Estado --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Estado</label>
                    <select name="Estado" class="form-select" required>
                        <option value="">Seleccione</option>
                        <option value="Activo" {{ $horario->Estado == 'Activo' ? 'selected' : '' }}>Activo</option>
                        <option value="Inactivo" {{ $horario->Estado == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                        <option value="Cancelado" {{ $horario->Estado == 'Cancelado' ? 'selected' : '' }}>Cancelado</option>
                    </select>
                </div>
            </div>

            {{-- Botones de acción --}}
            <div class="card-footer text-end bg-white border-top-0">
                <a href="{{ route('horario.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Cancelar
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Actualizar
                </button>
            </div>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
$(document).ready(function() {
    // Validar que la hora de llegada sea posterior a la de salida
    $('input[name="HoraLlegada"]').change(function() {
        const horaSalida = $('input[name="HoraSalida"]').val();
        const horaLlegada = $(this).val();
        if (horaSalida && horaLlegada && horaLlegada <= horaSalida) {
            alert('La hora de llegada debe ser posterior a la hora de salida.');
            $(this).val('');
        }
    });
});
</script>
@endsection
</body>
</html>
