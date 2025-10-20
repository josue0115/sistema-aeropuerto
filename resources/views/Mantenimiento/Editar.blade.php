<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Mantenimiento</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h1 class="mb-4">Editar Mantenimiento</h1>

    <!-- Modal Editar -->
    <div class="modal fade show" id="modalEditar" tabindex="-1" aria-labelledby="modalEditarLabel" aria-hidden="false" style="display: block;">
      <div class="modal-dialog">
        <div class="modal-content">
          <form method="POST" action="{{ route('mantenimiento.update', $mantenimiento->Id_mantenimiento) }}">
            @csrf
            @method('PUT')
            <div class="modal-header">
              <h5 class="modal-title" id="modalEditarLabel">Editar Mantenimiento</h5>
              <a href="{{ route('mantenimiento.listar') }}" class="btn-close"></a>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label>Avión</label>
                    <select name="IdAvion" class="form-select" required>
                        <option value="">Seleccione</option>
                        @foreach($aviones as $avion)
                        <option value="{{ $avion->IdAvion }}" {{ $mantenimiento->IdAvion == $avion->IdAvion ? 'selected' : '' }}>{{ $avion->IdAvion }} - {{ $avion->Placa }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label>Personal</label>
                    <select name="IdPersonal" class="form-select" required>
                        <option value="">Seleccione</option>
                        @foreach($personales as $personal)
                        <option value="{{ $personal->IdPersonal }}" {{ $mantenimiento->IdPersonal == $personal->IdPersonal ? 'selected' : '' }}>{{ $personal->IdPersonal }} - {{ $personal->Nombre }} {{ $personal->Apellido }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label>Fecha Ingreso</label>
                    <input type="date" name="FechaIngreso" class="form-control" value="{{ $mantenimiento->FechaIngreso }}" min="{{ date('Y-m-d') }}" required>
                </div>
                <div class="mb-3">
                    <label>Fecha Salida</label>
                    <input type="date" name="FechaSalida" class="form-control" value="{{ $mantenimiento->FechaSalida }}" required>
                </div>
                <div class="mb-3">
                    <label>Tipo</label>
                    <select name="Tipo" class="form-select" required>
                        <option value="">Seleccione</option>
                        <option value="Preventivo" {{ $mantenimiento->Tipo == 'Preventivo' ? 'selected' : '' }}>Preventivo</option>
                        <option value="Correctivo" {{ $mantenimiento->Tipo == 'Correctivo' ? 'selected' : '' }}>Correctivo</option>
                        <option value="Emergencia" {{ $mantenimiento->Tipo == 'Emergencia' ? 'selected' : '' }}>Emergencia</option>
                        <option value="Inspección" {{ $mantenimiento->Tipo == 'Inspección' ? 'selected' : '' }}>Inspección</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label>Estado</label>
                    <select name="Estado" class="form-select" required>
                        <option value="">Seleccione</option>
                        <option value="Pendiente" {{ $mantenimiento->Estado == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                        <option value="En Progreso" {{ $mantenimiento->Estado == 'En Progreso' ? 'selected' : '' }}>En Progreso</option>
                        <option value="Completado" {{ $mantenimiento->Estado == 'Completado' ? 'selected' : '' }}>Completado</option>
                        <option value="Cancelado" {{ $mantenimiento->Estado == 'Cancelado' ? 'selected' : '' }}>Cancelado</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label>Descripción</label>
                    <textarea name="Descripcion" class="form-control" required>{{ $mantenimiento->Descripcion }}</textarea>
                </div>
                <div class="mb-3">
                    <label>Costo</label>
                    <input type="number" name="Costo" class="form-control" readonly>
                </div>
                <div class="mb-3">
                    <label>Costo Extra</label>
                    <input type="number" name="CostoExtra" class="form-control" value="{{ $mantenimiento->CostoExtra }}" min="0" step="0.01">
                </div>
            </div>
            <div class="modal-footer">
              <a href="{{ route('mantenimiento.listar') }}" class="btn btn-secondary">Cancelar</a>
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
    // Auto-fill costo based on tipo
    $('select[name="Tipo"]').change(function() {
        var tipo = $(this).val();
        var costo = 0;
        switch(tipo) {
            case 'Preventivo': costo = 500.00; break;
            case 'Correctivo': costo = 800.00; break;
            case 'Emergencia': costo = 1200.00; break;
            case 'Inspección': costo = 300.00; break;
        }
        $('input[name="Costo"]').val(costo.toFixed(2));
    });

    // Set initial costo
    $('select[name="Tipo"]').trigger('change');

    // Validate FechaSalida > FechaIngreso
    $('input[name="FechaSalida"]').change(function() {
        var fechaIngreso = $('input[name="FechaIngreso"]').val();
        var fechaSalida = $(this).val();
        if (fechaIngreso && fechaSalida && fechaSalida <= fechaIngreso) {
            alert('La fecha de salida debe ser posterior a la fecha de ingreso.');
            $(this).val('');
        }
    });
});
</script>
</body>
</html>
