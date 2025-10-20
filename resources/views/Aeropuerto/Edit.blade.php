<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Aeropuerto</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h1 class="mb-4">Editar Aeropuerto</h1>

    <!-- Modal Editar -->
    <div class="modal fade show" id="modalEditar" tabindex="-1" aria-labelledby="modalEditarLabel" aria-hidden="false" style="display: block;">
      <div class="modal-dialog">
        <div class="modal-content">
          <form method="POST" action="{{ route('aeropuerto.update', $aeropuerto->IdAeropuerto) }}">
            @csrf
            @method('PUT')
            <div class="modal-header">
              <h5 class="modal-title" id="modalEditarLabel">Editar Aeropuerto</h5>
              <a href="{{ route('aeropuerto.listar') }}" class="btn-close"></a>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label>ID</label>
                    <input type="text" class="form-control" value="{{ $aeropuerto->IdAeropuerto }}" readonly>
                </div>
                <div class="mb-3">
                    <label>Nombre</label>
                    <input type="text" name="NombreAeropuerto" class="form-control" value="{{ $aeropuerto->NombreAeropuerto }}" required>
                </div>
                <div class="mb-3">
                    <label>País</label>
                    <input type="text" name="Pais" class="form-control" value="{{ $aeropuerto->Pais }}">
                </div>
                <div class="mb-3">
                    <label>Ciudad</label>
                    <input type="text" name="Ciudad" class="form-control" value="{{ $aeropuerto->Ciudad }}">
                </div>
                <div class="mb-3">
                    <label>Estado</label>
                    <select name="Estado" class="form-select">
                        <option value="Activo" {{ $aeropuerto->Estado == 'Activo' ? 'selected' : '' }}>Activo</option>
                        <option value="Inactivo" {{ $aeropuerto->Estado == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
              <a href="{{ route('aeropuerto.listar') }}" class="btn btn-secondary">Cancelar</a>
              <button type="submit" class="btn btn-primary">Actualizar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
