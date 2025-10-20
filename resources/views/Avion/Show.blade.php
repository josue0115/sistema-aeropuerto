<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Avión</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h1 class="mb-4">Detalles de Avión</h1>

    <!-- Modal Ver -->
    <div class="modal fade show" id="modalVer" tabindex="-1" aria-labelledby="modalVerLabel" aria-hidden="false" style="display: block;">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalVerLabel">Detalles de Avión</h5>
            <a href="{{ route('avion.listar') }}" class="btn-close"></a>
          </div>
          <div class="modal-body">
              <div class="mb-3">
                  <label>ID Avión</label>
                  <input type="text" class="form-control" value="{{ $avion->IdAvion }}" readonly>
              </div>
              <div class="mb-3">
                  <label>Código Aerolínea</label>
                  <input type="text" class="form-control" value="{{ $avion->IdAerolinea }} - {{ $avion->aerolinea->NombreAerolinea ?? '-' }}" readonly>
              </div>
              <div class="mb-3">
                  <label>Placa</label>
                  <input type="text" class="form-control" value="{{ $avion->Placa }}" readonly>
              </div>
              <div class="mb-3">
                  <label>Tipo</label>
                  <input type="text" class="form-control" value="{{ $avion->Tipo }}" readonly>
              </div>
              <div class="mb-3">
                  <label>Modelo</label>
                  <input type="text" class="form-control" value="{{ $avion->Modelo }}" readonly>
              </div>
              <div class="mb-3">
                  <label>Capacidad</label>
                  <input type="text" class="form-control" value="{{ $avion->Capacidad }}" readonly>
              </div>
              <div class="mb-3">
                  <label>Estado</label>
                  <input type="text" class="form-control" value="{{ $avion->Estado }}" readonly>
              </div>
          </div>
          <div class="modal-footer">
            <a href="{{ route('avion.listar') }}" class="btn btn-secondary">Cerrar</a>
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
