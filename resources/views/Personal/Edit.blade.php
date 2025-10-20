<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Personal</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h1 class="mb-4">Editar Personal</h1>

    <!-- Modal Editar -->
    <div class="modal fade show" id="modalEditar" tabindex="-1" aria-labelledby="modalEditarLabel" aria-hidden="false" style="display: block;">
      <div class="modal-dialog">
        <div class="modal-content">
          <form method="POST" action="{{ route('personal.update', $personal->IdPersonal) }}">
            @csrf
            @method('PUT')
            <div class="modal-header">
              <h5 class="modal-title" id="modalEditarLabel">Editar Personal</h5>
              <a href="{{ route('personal.listar') }}" class="btn-close"></a>
            </div>
            <div class="modal-body">
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
                    <select name="Cargo" class="form-select" required>
                        <option value="">Seleccione</option>
                        <option value="Piloto" {{ $personal->Cargo == 'Piloto' ? 'selected' : '' }}>Piloto</option>
                        <option value="Copiloto" {{ $personal->Cargo == 'Copiloto' ? 'selected' : '' }}>Copiloto</option>
                        <option value="Azafata" {{ $personal->Cargo == 'Azafata' ? 'selected' : '' }}>Azafata</option>
                        <option value="Mecánico" {{ $personal->Cargo == 'Mecánico' ? 'selected' : '' }}>Mecánico</option>
                        <option value="Administrador" {{ $personal->Cargo == 'Administrador' ? 'selected' : '' }}>Administrador</option>
                        <option value="Recepcionista" {{ $personal->Cargo == 'Recepcionista' ? 'selected' : '' }}>Recepcionista</option>
                        <option value="Seguridad" {{ $personal->Cargo == 'Seguridad' ? 'selected' : '' }}>Seguridad</option>
                        <option value="Limpieza" {{ $personal->Cargo == 'Limpieza' ? 'selected' : '' }}>Limpieza</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label>Fecha Ingreso</label>
                    <input type="date" name="FechaIngreso" class="form-control" value="{{ $personal->FechaIngreso }}" min="{{ date('Y-m-d') }}" required>
                </div>
                <div class="mb-3">
                    <label>Salario (Q)</label>
                    <input type="number" name="Salario" class="form-control" readonly>
                </div>
                <div class="mb-3">
                    <label>Estado</label>
                    <select name="Estado" class="form-select">
                        <option value="Activo" {{ $personal->Estado == 'Activo' ? 'selected' : '' }}>Activo</option>
                        <option value="Inactivo" {{ $personal->Estado == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label>Teléfono</label>
                    <input type="number" name="Telefono" class="form-control" value="{{ $personal->Telefono }}" required>
                </div>
                <div class="mb-3">
                    <label>Correo</label>
                    <input type="email" name="Correo" class="form-control" value="{{ $personal->Correo }}" required>
                </div>
                <div class="mb-3">
                    <label>Dirección</label>
                    <input type="text" name="Direccion" class="form-control" value="{{ $personal->Direccion }}" required>
                </div>
            </div>
            <div class="modal-footer">
              <a href="{{ route('personal.listar') }}" class="btn btn-secondary">Cancelar</a>
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

<script>
$(document).ready(function() {
    // Auto-fill salario based on cargo
    $('select[name="Cargo"]').change(function() {
        var cargo = $(this).val();
        var salario = 0;
        switch(cargo) {
            case 'Piloto': salario = 5000.00; break;
            case 'Copiloto': salario = 4000.00; break;
            case 'Azafata': salario = 2500.00; break;
            case 'Mecánico': salario = 3000.00; break;
            case 'Administrador': salario = 3500.00; break;
            case 'Recepcionista': salario = 2000.00; break;
            case 'Seguridad': salario = 2200.00; break;
            case 'Limpieza': salario = 1800.00; break;
        }
        $('input[name="Salario"]').val(salario.toFixed(2));
    });

    // Set initial salario
    $('select[name="Cargo"]').trigger('change');
});
</script>
</body>
</html>
