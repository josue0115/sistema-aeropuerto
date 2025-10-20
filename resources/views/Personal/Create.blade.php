<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Personal</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h1 class="mb-4">Crear Personal</h1>

    <!-- Modal Crear -->
    <div class="modal fade show" id="modalCrear" tabindex="-1" aria-labelledby="modalCrearLabel" aria-hidden="false" style="display: block;">
      <div class="modal-dialog">
        <div class="modal-content">
          <form method="POST" action="{{ route('personal.store') }}">
            @csrf
            <div class="modal-header">
              <h5 class="modal-title" id="modalCrearLabel">Agregar Personal</h5>
              <a href="{{ route('personal.listar') }}" class="btn-close"></a>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label>Nombre</label>
                    <input type="text" name="Nombre" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Apellido</label>
                    <input type="text" name="Apellido" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Cargo</label>
                    <select name="Cargo" class="form-select" required>
                        <option value="">Seleccione</option>
                        <option value="Piloto">Piloto</option>
                        <option value="Copiloto">Copiloto</option>
                        <option value="Azafata">Azafata</option>
                        <option value="Mecánico">Mecánico</option>
                        <option value="Administrador">Administrador</option>
                        <option value="Recepcionista">Recepcionista</option>
                        <option value="Seguridad">Seguridad</option>
                        <option value="Limpieza">Limpieza</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label>Fecha Ingreso</label>
                    <input type="date" name="FechaIngreso" class="form-control" min="{{ date('Y-m-d') }}" required>
                </div>
                <div class="mb-3">
                    <label>Salario (Q)</label>
                    <input type="number" name="Salario" class="form-control" readonly>
                </div>
                <div class="mb-3">
                    <label>Estado</label>
                    <select name="Estado" class="form-select">
                        <option value="Activo">Activo</option>
                        <option value="Inactivo">Inactivo</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label>Teléfono</label>
                    <input type="number" name="Telefono" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Correo</label>
                    <input type="email" name="Correo" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Dirección</label>
                    <input type="text" name="Direccion" class="form-control" required>
                </div>
            </div>
            <div class="modal-footer">
              <a href="{{ route('personal.listar') }}" class="btn btn-secondary">Cancelar</a>
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
});
</script>
</body>
</html>
