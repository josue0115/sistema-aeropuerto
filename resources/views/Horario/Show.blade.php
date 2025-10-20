<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Horario</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h1 class="mb-4">Detalles del Horario</h1>

    <!-- Modal Ver -->
    <div class="modal fade show" id="modalVer" tabindex="-1" aria-labelledby="modalVerLabel" aria-hidden="false" style="display: block;">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalVerLabel">Horario #{{ $horario->IdHorario }}</h5>
            <a href="{{ route('horario.index') }}" class="btn-close"></a>
          </div>
          <div class="modal-body">
            <div class="mb-3">
                <strong>Vuelo:</strong> {{ $horario->vuelo->IdVuelo ?? 'N/A' }} - {{ $horario->vuelo->aeropuertoOrigen->NombreAeropuerto ?? 'N/A' }} → {{ $horario->vuelo->aeropuertoDestino->NombreAeropuerto ?? 'N/A' }}
            </div>
            <div class="mb-3">
                <strong>Hora Salida:</strong> {{ $horario->HoraSalida }}
            </div>
            <div class="mb-3">
                <strong>Hora Llegada:</strong> {{ $horario->HoraLlegada }}
            </div>
            <div class="mb-3">
                <strong>Tiempo Espera:</strong> {{ $horario->TiempoEspera }} minutos
            </div>
            <div class="mb-3">
                <strong>Estado:</strong> {{ $horario->Estado }}
            </div>
          </div>
          <div class="modal-footer">
            <a href="{{ route('horario.index') }}" class="btn btn-secondary">Cerrar</a>
          </div>
        </div>
      </div>
    </div>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
