<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Avión</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h1 class="mb-4">Crear Avión</h1>

    <!-- Modal Crear -->
    <div class="modal fade show" id="modalCrear" tabindex="-1" aria-labelledby="modalCrearLabel" aria-hidden="false" style="display: block;">
      <div class="modal-dialog">
        <div class="modal-content">
          <form method="POST" action="{{ route('avion.store') }}">
            @csrf
            <div class="modal-header">
              <h5 class="modal-title" id="modalCrearLabel">Agregar Avión</h5>
              <a href="{{ route('avion.listar') }}" class="btn-close"></a>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label>Código Aerolínea</label>
                    <select name="IdAerolinea" class="form-select" required>
                        <option value="">Seleccione</option>
                        @foreach($aerolineas as $aero)
                            <option value="{{ $aero->IdAerolinea }}">{{ $aero->IdAerolinea }} - {{ $aero->NombreAerolinea }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label>Tipo</label>
                    <input type="text" name="Tipo" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Modelo</label>
                    <input type="text" name="Modelo" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Capacidad</label>
                    <input type="number" name="Capacidad" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Estado</label>
                    <select name="Estado" class="form-select">
                        <option value="Activo">Activo</option>
                        <option value="Inactivo">Inactivo</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
              <a href="{{ route('avion.listar') }}" class="btn btn-secondary">Cancelar</a>
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
