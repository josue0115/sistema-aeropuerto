<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Mantenimiento</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h1 class="mb-4">Ver Mantenimiento</h1>

    <!-- Modal Ver -->
    <div class="modal fade show" id="modalVer" tabindex="-1" aria-labelledby="modalVerLabel" aria-hidden="false" style="display: block;">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalVerLabel">Detalles del Mantenimiento</h5>
            <a href="{{ route('mantenimiento.listar') }}" class="btn-close"></a>
          </div>
          <div class="modal-body">
              <div class="mb-3">
                  <label>ID</label>
                  <input type="text" class="form-control" value="{{ $mantenimiento->Id_mantenimiento }}" readonly>
              </div>
              <div class="mb-3">
                  <label>Avión</label>
                  <input type="text" class="form-control" value="{{ $mantenimiento->avion->IdAvion ?? 'N/A' }} - {{ $mantenimiento->avion->Placa ?? 'N/A' }}" readonly>
              </div>
              <div class="mb-3">
                  <label>Personal</label>
                  <input type="text" class="form-control" value="{{ $mantenimiento->personal->IdPersonal ?? 'N/A' }} - {{ $mantenimiento->personal->Nombre ?? 'N/A' }} {{ $mantenimiento->personal->Apellido ?? 'N/A' }}" readonly>
              </div>
              <div class="mb-3">
                  <label>Fecha Ingreso</label>
                  <input type="date" class="form-control" value="{{ $mantenimiento->FechaIngreso }}" readonly>
              </div>
              <div class="mb-3">
                  <label>Fecha Salida</label>
                  <input type="date" class="form-control" value="{{ $mantenimiento->FechaSalida }}" readonly>
              </div>
              <div class="mb-3">
                  <label>Tipo</label>
                  <input type="text" class="form-control" value="{{ $mantenimiento->Tipo }}" readonly>
              </div>
              <div class="mb-3">
                  <label>Estado</label>
                  <input type="text" class="form-control" value="{{ $mantenimiento->Estado }}" readonly>
              </div>
              <div class="mb-3">
                  <label>Descripción</label>
                  <textarea class="form-control" readonly>{{ $mantenimiento->Descripcion }}</textarea>
              </div>
              <div class="mb-3">
                  <label>Costo (Q)</label>
                  <input type="number" class="form-control" value="{{ $mantenimiento->Costo }}" readonly>
              </div>
              <div class="mb-3">
                  <label>Costo Extra (Q)</label>
                  <input type="number" class="form-control" value="{{ $mantenimiento->CostoExtra }}" readonly>
              </div>
              <div class="mb-3">
                  <label>Costo Total (Q)</label>
                  <input type="number" class="form-control" value="{{ $mantenimiento->Costo + $mantenimiento->CostoExtra }}" readonly>
              </div>
          </div>
          <div class="modal-footer">
            <a href="{{ route('mantenimiento.listar') }}" class="btn btn-secondary">Cerrar</a>
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
