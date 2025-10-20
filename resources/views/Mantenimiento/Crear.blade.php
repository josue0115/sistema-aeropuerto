<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Mantenimiento</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h1 class="mb-4">Crear Mantenimiento</h1>

    <!-- Modal Crear -->
    <div class="modal fade show" id="modalCrear" tabindex="-1" aria-labelledby="modalCrearLabel" aria-hidden="false" style="display: block;">
      <div class="modal-dialog">
        <div class="modal-content">
          <form method="POST" action="{{ route('mantenimiento.store') }}">
            @csrf
            <div class="modal-header">
              <h5 class="modal-title" id="modalCrearLabel">Crear Mantenimiento</h5>
              <a href="{{ route('mantenimiento.listar') }}" class="btn-close"></a>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label>Avión</label>
                    <select name="IdAvion" class="form-select" required>
                        <option value="">Seleccione</option>
                        @foreach($aviones as $avion)
                        <option value="{{ $avion->IdAvion }}">{{ $avion->IdAvion }} - {{ $avion->Placa }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label>Personal</label>
                    <select name="IdPersonal" class="form-select" required>
                        <option value="">Seleccione</option>
                        @foreach($personales as $personal)
                        <option value="{{ $personal->IdPersonal }}">{{ $personal->IdPersonal }} - {{ $personal->Nombre }} {{ $personal->Apellido }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label>Fecha Ingreso</label>
                    <input type="date" name="FechaIngreso" class="form-control" min="{{ date('Y-m-d') }}" required>
                </div>
                <div class="mb-3">
                    <label>Fecha Salida</label>
                    <input type="date" name="FechaSalida" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Tipo</label>
                    <select name="Tipo" class="form-select" required>
                        <option value="">Seleccione</option>
                        <option value="Preventivo">Preventivo</option>
                        <option value="Correctivo">Correctivo</option>
                        <option value="Emergencia">Emergencia</option>
                        <option value="Inspección">Inspección</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label>Estado</label>
                    <select name="Estado" class="form-select" required>
                        <option value="">Seleccione</option>
                        <option value="Pendiente">Pendiente</option>
                        <option value="En Progreso">En Progreso</option>
                        <option value="Completado">Completado</option>
                        <option value="Cancelado">Cancelado</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label>Descripción</label>
                    <textarea name="Descripcion" class="form-control" required></textarea>
                </div>
                <div class="mb-3">
                    <label>Costo</label>
                    <input type="number" name="Costo" class="form-control" readonly>
                </div>
                <div class="mb-3">
                    <label>Costo Extra</label>
                    <input type="number" name="CostoExtra" class="form-control" min="0" step="0.01">
                </div>
            </div>
            <div class="modal-footer">
              <a href="{{ route('mantenimiento.listar') }}" class="btn btn-secondary">Cancelar</a>
              <button type="submit" class="btn btn-primary">Crear</button>
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
