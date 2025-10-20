<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Horario</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h1 class="mb-4">Editar Horario</h1>

    <!-- Modal Editar -->
    <div class="modal fade show" id="modalEditar" tabindex="-1" aria-labelledby="modalEditarLabel" aria-hidden="false" style="display: block;">
      <div class="modal-dialog">
        <div class="modal-content">
          <form method="POST" action="{{ route('horario.update', $horario) }}">
            @csrf
            @method('PUT')
            <div class="modal-header">
              <h5 class="modal-title" id="modalEditarLabel">Editar Horario #{{ $horario->IdHorario }}</h5>
              <a href="{{ route('horario.index') }}" class="btn-close"></a>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label>Vuelo</label>
                    <select name="IdVuelo" class="form-select" required>
                        <option value="">Seleccione</option>
                        @foreach($vuelos as $vuelo)
                        <option value="{{ $vuelo->IdVuelo }}" {{ $vuelo->IdVuelo == $horario->IdVuelo ? 'selected' : '' }}>{{ $vuelo->IdVuelo }} - {{ $vuelo->aeropuertoOrigen->NombreAeropuerto ?? 'N/A' }} → {{ $vuelo->aeropuertoDestino->NombreAeropuerto ?? 'N/A' }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label>Hora Salida</label>
                    <input type="time" name="HoraSalida" class="form-control" value="{{ $horario->HoraSalida }}" required>
                </div>
                <div class="mb-3">
                    <label>Hora Llegada</label>
                    <input type="time" name="HoraLlegada" class="form-control" value="{{ $horario->HoraLlegada }}" required>
                </div>
                <div class="mb-3">
                    <label>Tiempo Espera (minutos)</label>
                    <input type="number" name="TiempoEspera" class="form-control" min="0" value="{{ $horario->TiempoEspera }}" required>
                </div>
                <div class="mb-3">
                    <label>Estado</label>
                    <select name="Estado" class="form-select" required>
                        <option value="">Seleccione</option>
                        <option value="Activo" {{ $horario->Estado == 'Activo' ? 'selected' : '' }}>Activo</option>
                        <option value="Inactivo" {{ $horario->Estado == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                        <option value="Cancelado" {{ $horario->Estado == 'Cancelado' ? 'selected' : '' }}>Cancelado</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
              <a href="{{ route('horario.index') }}" class="btn btn-secondary">Cancelar</a>
              <button type="submit" class="btn btn-primary">Actualizar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
$(document).ready(function() {
    // Validate HoraLlegada > HoraSalida
    $('input[name="HoraLlegada"]').change(function() {
        var horaSalida = $('input[name="HoraSalida"]').val();
        var horaLlegada = $(this).val();
        if (horaSalida && horaLlegada && horaLlegada <= horaSalida) {
            alert('La hora de llegada debe ser posterior a la hora de salida.');
            $(this).val('');
        }
    });
});
</script>
</body>
</html>
