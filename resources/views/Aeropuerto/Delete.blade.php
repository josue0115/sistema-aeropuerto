<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Aeropuerto</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h1 class="mb-4">Eliminar Aeropuerto</h1>

    <!-- Modal Eliminar -->
    <div class="modal fade show" id="modalEliminar" tabindex="-1" aria-labelledby="modalEliminarLabel" aria-hidden="false" style="display: block;">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalEliminarLabel">Confirmar Eliminación</h5>
            <a href="{{ route('aeropuerto.listar') }}" class="btn-close"></a>
          </div>
          <div class="modal-body">
              <p>¿Estás seguro de que deseas eliminar este aeropuerto?</p>
              <div class="mb-3">
                  <label>ID</label>
                  <input type="text" class="form-control" value="{{ $aeropuerto->IdAeropuerto }}" readonly>
              </div>
              <div class="mb-3">
                  <label>Nombre</label>
                  <input type="text" class="form-control" value="{{ $aeropuerto->NombreAeropuerto }}" readonly>
              </div>
              <div class="mb-3">
                  <label>País</label>
                  <input type="text" class="form-control" value="{{ $aeropuerto->Pais }}" readonly>
              </div>
              <div class="mb-3">
                  <label>Ciudad</label>
                  <input type="text" class="form-control" value="{{ $aeropuerto->Ciudad }}" readonly>
              </div>
              <div class="mb-3">
                  <label>Estado</label>
                  <input type="text" class="form-control" value="{{ $aeropuerto->Estado }}" readonly>
              </div>
          </div>
          <div class="modal-footer">
            <a href="{{ route('aeropuerto.listar') }}" class="btn btn-secondary">Cancelar</a>
            <form action="{{ route('aeropuerto.destroy', $aeropuerto->IdAeropuerto) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Eliminar</button>
            </form>
          </div>
        </div>
      </div>
    </div>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.7.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
