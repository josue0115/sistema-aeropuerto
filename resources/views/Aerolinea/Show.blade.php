<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Aerolínea</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h1 class="mb-4">Detalles de Aerolínea</h1>

    <!-- Modal Ver -->
    <div class="modal fade show" id="modalVer" tabindex="-1" aria-labelledby="modalVerLabel" aria-hidden="false" style="display: block;">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalVerLabel">Detalles de Aerolínea</h5>
            <a href="{{ route('aerolinea.Listar') }}" class="btn-close"></a>
          </div>
          <div class="modal-body">
              <div class="mb-3">
                  <label>ID</label>
                  <input type="text" class="form-control" value="{{ $aerolinea->IdAerolinea }}" readonly>
              </div>
              <div class="mb-3">
                  <label>Nombre</label>
                  <input type="text" class="form-control" value="{{ $aerolinea->NombreAerolinea }}" readonly>
              </div>
              <div class="mb-3">
                  <label>País</label>
                  <input type="text" class="form-control" value="{{ $aerolinea->Pais }}" readonly>
              </div>
              <div class="mb-3">
                  <label>Ciudad</label>
                  <input type="text" class="form-control" value="{{ $aerolinea->Ciudad }}" readonly>
              </div>
              <div class="mb-3">
                  <label>Estado</label>
                  <input type="text" class="form-control" value="{{ $aerolinea->Estado }}" readonly>
              </div>
          </div>
          <div class="modal-footer">
            <a href="{{ route('aerolinea.Listar') }}" class="btn btn-secondary">Cerrar</a>
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
