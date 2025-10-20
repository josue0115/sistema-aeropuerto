<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Vuelo</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h1 class="mb-4">Ver Vuelo</h1>

    <!-- Modal Ver -->
    <div class="modal fade show" id="modalVer" tabindex="-1" aria-labelledby="modalVerLabel" aria-hidden="false" style="display: block;">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalVerLabel">Detalles del Vuelo</h5>
            <a href="{{ route('vuelo.index') }}" class="btn-close"></a>
          </div>
          <div class="modal-body">
              <div class="mb-3">
                  <label>ID</label>
                  <input type="text" class="form-control" value="{{ $vuelo->IdVuelo }}" readonly>
              </div>
              <div class="mb-3">
                  <label>Avión</label>
                  <input type="text" class="form-control" value="{{ $vuelo->avion->IdAvion ?? 'N/A' }} - {{ $vuelo->avion->Placa ?? 'N/A' }}" readonly>
              </div>
              <div class="mb-3">
                  <label>Aeropuerto Origen</label>
                  <input type="text" class="form-control" value="{{ $vuelo->aeropuertoOrigen->IdAeropuerto ?? 'N/A' }} - {{ $vuelo->aeropuertoOrigen->NombreAeropuerto ?? 'N/A' }}" readonly>
              </div>
              <div class="mb-3">
                  <label>Aeropuerto Destino</label>
                  <input type="text" class="form-control" value="{{ $vuelo->aeropuertoDestino->IdAeropuerto ?? 'N/A' }} - {{ $vuelo->aeropuertoDestino->NombreAeropuerto ?? 'N/A' }}" readonly>
              </div>
              <div class="mb-3">
                  <label>Fecha Salida</label>
                  <input type="date" class="form-control" value="{{ $vuelo->FechaSalida }}" readonly>
              </div>
              <div class="mb-3">
                  <label>Fecha Llegada</label>
                  <input type="date" class="form-control" value="{{ $vuelo->FechaLlegada }}" readonly>
              </div>
              <div class="mb-3">
                  <label>Precio (Q)</label>
                  <input type="number" class="form-control" value="{{ $vuelo->Precio }}" readonly>
              </div>
              <div class="mb-3">
                  <label>Estado</label>
                  <input type="text" class="form-control" value="{{ $vuelo->Estado }}" readonly>
              </div>
          </div>
          <div class="modal-footer">
            <a href="{{ route('vuelo.index') }}" class="btn btn-secondary">Cerrar</a>
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
