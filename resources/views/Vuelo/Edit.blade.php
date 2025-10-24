<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Vuelo</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h1 class="mb-4">Editar Vuelo</h1>

    <!-- Modal Editar -->
    <div class="modal fade show" id="modalEditar" tabindex="-1" aria-labelledby="modalEditarLabel" aria-hidden="false" style="display: block;">
      <div class="modal-dialog">
        <div class="modal-content">
          <form method="POST" action="{{ route('vuelo.update', $vuelo) }}">
            @csrf
            @method('PUT')
            <div class="modal-header">
              <h5 class="modal-title" id="modalEditarLabel">Editar Vuelo</h5>
              <a href="{{ route('vuelo.index') }}" class="btn-close"></a>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label>Avión</label>
                    <select name="IdAvion" class="form-select" required>
                        <option value="">Seleccione</option>
                        @foreach($aviones as $avion)
                        <option value="{{ $avion->IdAvion }}" {{ $vuelo->idAvion == $avion->IdAvion ? 'selected' : '' }}>{{ $avion->Modelo }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label>Aeropuerto Origen</label>
                    <select name="idAeropuertoOrigen" class="form-select" required>
                        <option value="">Seleccione</option>
                        @foreach($aeropuertos as $aeropuerto)
                        <option value="{{ $aeropuerto->IdAeropuerto }}" {{ $vuelo->idAeropuertoOrigen == $aeropuerto->IdAeropuerto ? 'selected' : '' }}>{{ $aeropuerto->NombreAeropuerto }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label>Aeropuerto Destino</label>
                    <select name="idAeropuertoDestino" class="form-select" required>
                        <option value="">Seleccione</option>
                        @foreach($aeropuertos as $aeropuerto)
                        <option value="{{ $aeropuerto->IdAeropuerto }}" {{ $vuelo->idAeropuertoDestino == $aeropuerto->IdAeropuerto ? 'selected' : '' }}>{{ $aeropuerto->NombreAeropuerto }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label>Fecha Salida</label>
                    <input type="date" name="FechaSalida" class="form-control" value="{{ $vuelo->FechaSalida }}" min="{{ date('Y-m-d') }}" required>
                </div>
                <div class="mb-3">
                    <label>Fecha Llegada</label>
                    <input type="date" name="FechaLlegada" class="form-control" value="{{ $vuelo->FechaLlegada }}" min="{{ date('Y-m-d') }}" required>
                </div>
                <div class="mb-3">
                    <label>Precio (Q)</label>
                    <input type="number" name="Precio" class="form-control" readonly step="0.01">
                </div>
                <div class="mb-3">
                    <label>Estado</label>
                    <select name="Estado" class="form-select" required>
                        <option value="">Seleccione</option>
                        <option value="Programado" {{ $vuelo->Estado == 'Programado' ? 'selected' : '' }}>Programado</option>
                        <option value="En Vuelo" {{ $vuelo->Estado == 'En Vuelo' ? 'selected' : '' }}>En Vuelo</option>
                        <option value="Aterrizado" {{ $vuelo->Estado == 'Aterrizado' ? 'selected' : '' }}>Aterrizado</option>
                        <option value="Cancelado" {{ $vuelo->Estado == 'Cancelado' ? 'selected' : '' }}>Cancelado</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
              <a href="{{ route('vuelo.index') }}" class="btn btn-secondary">Cancelar</a>
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
    // Auto-fill precio based on origen and destino
    function updatePrecio() {
        var origen = $('select[name="AeropuertoOrigen"]').val();
        var destino = $('select[name="AeropuertoDestino"]').val();
        if (origen && destino) {
            // Aquí puedes hacer una llamada AJAX para obtener el precio basado en países
            // Por simplicidad, asumimos precios fijos
            var precio = 500.00; // Nacional por defecto
            $('input[name="Precio"]').val(precio.toFixed(2));
        }
    }

    $('select[name="AeropuertoOrigen"], select[name="AeropuertoDestino"]').change(updatePrecio);

    // Set initial precio
    updatePrecio();

    // Validate FechaLlegada >= FechaSalida
    $('input[name="FechaLlegada"]').change(function() {
        var fechaSalida = $('input[name="FechaSalida"]').val();
        var fechaLlegada = $(this).val();
        if (fechaSalida && fechaLlegada && fechaLlegada < fechaSalida) {
            alert('La fecha de llegada debe ser igual o posterior a la fecha de salida.');
            $(this).val('');
        }
    });

    // Update min for FechaLlegada when FechaSalida changes
    $('input[name="FechaSalida"]').change(function() {
        var fechaSalida = $(this).val();
        $('input[name="FechaLlegada"]').attr('min', fechaSalida);
    });
});
</script>
</body>
</html>
