<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Avión</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h1 class="mb-4">Editar Avión</h1>

    <!-- Modal Editar -->
    <div class="modal fade show" id="modalEditar" tabindex="-1" aria-labelledby="modalEditarLabel" aria-hidden="false" style="display: block;">
      <div class="modal-dialog">
        <div class="modal-content">
          <form method="POST" action="{{ route('avion.update', $avion->IdAvion) }}">
            @csrf
            @method('PUT')
            <div class="modal-header">
              <h5 class="modal-title" id="modalEditarLabel">Editar Avión</h5>
              <a href="{{ route('avion.listar') }}" class="btn-close"></a>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label>Código Aerolínea</label>
                    <select name="IdAerolinea" class="form-select" required>
                        <option value="">Seleccione</option>
                        @foreach($aerolineas as $aero)
                            <option value="{{ $aero->IdAerolinea }}" {{ $avion->IdAerolinea == $aero->IdAerolinea ? 'selected' : '' }}>{{ $aero->IdAerolinea }} - {{ $aero->NombreAerolinea }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label>Tipo</label>
                    <input type="text" name="Tipo" class="form-control" value="{{ $avion->Tipo }}" required>
                </div>
                <div class="mb-3">
                    <label>Modelo</label>
                    <input type="text" name="Modelo" class="form-control" value="{{ $avion->Modelo }}" required>
                </div>
                <div class="mb-3">
                    <label>Capacidad</label>
                    <input type="number" name="Capacidad" class="form-control" value="{{ $avion->Capacidad }}" required>
                </div>
                <div class="mb-3">
                    <label>Estado</label>
                    <select name="Estado" class="form-select">
                        <option value="Activo" {{ $avion->Estado == 'Activo' ? 'selected' : '' }}>Activo</option>
                        <option value="Inactivo" {{ $avion->Estado == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
              <a href="{{ route('avion.listar') }}" class="btn btn-secondary">Cancelar</a>
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
