<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Personal</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h1 class="mb-4">Ver Personal</h1>

    <!-- Modal Ver -->
    <div class="modal fade show" id="modalVer" tabindex="-1" aria-labelledby="modalVerLabel" aria-hidden="false" style="display: block;">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalVerLabel">Detalles del Personal</h5>
            <a href="{{ route('personal.listar') }}" class="btn-close"></a>
          </div>
          <div class="modal-body">
              <div class="mb-3">
                  <label>ID</label>
                  <input type="text" class="form-control" value="{{ $personal->IdPersonal }}" readonly>
              </div>
              <div class="mb-3">
                  <label>Nombre</label>
                  <input type="text" class="form-control" value="{{ $personal->Nombre }}" readonly>
              </div>
              <div class="mb-3">
                  <label>Apellido</label>
                  <input type="text" class="form-control" value="{{ $personal->Apellido }}" readonly>
              </div>
              <div class="mb-3">
                  <label>Cargo</label>
                  <input type="text" class="form-control" value="{{ $personal->Cargo }}" readonly>
              </div>
              <div class="mb-3">
                  <label>Fecha Ingreso</label>
                  <input type="date" class="form-control" value="{{ $personal->FechaIngreso }}" readonly>
              </div>
              <div class="mb-3">
                  <label>Salario (Q)</label>
                  <input type="number" class="form-control" value="{{ $personal->Salario }}" readonly>
              </div>
              <div class="mb-3">
                  <label>Estado</label>
                  <input type="text" class="form-control" value="{{ $personal->Estado }}" readonly>
              </div>
              <div class="mb-3">
                  <label>Teléfono</label>
                  <input type="number" class="form-control" value="{{ $personal->Telefono }}" readonly>
              </div>
              <div class="mb-3">
                  <label>Correo</label>
                  <input type="email" class="form-control" value="{{ $personal->Correo }}" readonly>
              </div>
              <div class="mb-3">
                  <label>Dirección</label>
                  <input type="text" class="form-control" value="{{ $personal->Direccion }}" readonly>
              </div>
          </div>
          <div class="modal-footer">
            <a href="{{ route('personal.listar') }}" class="btn btn-secondary">Cerrar</a>
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
