<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Aerolínea</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h1 class="mb-4">Crear Aerolínea</h1>

    <!-- Modal Crear -->
    <div class="modal fade show" id="modalCrear" tabindex="-1" aria-labelledby="modalCrearLabel" aria-hidden="false" style="display: block;">
      <div class="modal-dialog">
        <div class="modal-content">
          <form method="POST" action="{{ route('aerolinea.store') }}">
            @csrf
            <div class="modal-header">
              <h5 class="modal-title" id="modalCrearLabel">Agregar Aerolínea</h5>
              <a href="{{ route('aerolinea.Listar') }}" class="btn-close"></a>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label>Nombre</label>
                    <input type="text" name="NombreAerolinea" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>País</label>
                    <input type="text" name="Pais" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Ciudad</label>
                    <input type="text" name="Ciudad" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Estado</label>
                    <select name="Estado" class="form-select" required>
                        <option value="Activo">Activo</option>
                        <option value="Inactivo">Inactivo</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
              <a href="{{ route('aerolinea.Listar') }}" class="btn btn-secondary">Cancelar</a>
              <button type="submit" class="btn btn-primary">Guardar</button>
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
