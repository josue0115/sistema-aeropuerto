<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Vuelo</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h1 class="mb-4">Crear Vuelo</h1>

    <!-- Modal Crear -->
    <div class="modal fade show" id="modalCrear" tabindex="-1" aria-labelledby="modalCrearLabel" aria-hidden="false" style="display: block;">
      <div class="modal-dialog">
        <div class="modal-content">
          <form method="POST" action="{{ route('vuelo.store') }}">
            @csrf
            <div class="modal-header">
              <h5 class="modal-title" id="modalCrearLabel">Agregar Vuelo</h5>
              <a href="{{ route('vuelo.index') }}" class="btn-close"></a>
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
                    <label>Aeropuerto Origen</label>
                    <select name="AeropuertoOrigen" class="form-select" required>
                        <option value="">Seleccione</option>
                        @foreach($aeropuertos as $aeropuerto)
                        <option value="{{ $aeropuerto->IdAeropuerto }}">{{ $aeropuerto->IdAeropuerto }} - {{ $aeropuerto->NombreAeropuerto }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label>Aeropuerto Destino</label>
                    <select name="AeropuertoDestino" class="form-select" required>
                        <option value="">Seleccione</option>
                        @foreach($aeropuertos as $aeropuerto)
                        <option value="{{ $aeropuerto->IdAeropuerto }}">{{ $aeropuerto->IdAeropuerto }} - {{ $aeropuerto->NombreAeropuerto }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label>Fecha Salida</label>
                    <input type="date" name="FechaSalida" class="form-control" min="{{ date('Y-m-d') }}" required>
                </div>
                <div class="mb-3">
                    <label>Fecha Llegada</label>
                    <input type="date" name="FechaLlegada" class="form-control" min="{{ date('Y-m-d') }}" required>
                </div>
                <div class="mb-3">
                    <label>Precio (Q)</label>
                    <input type="number" name="Precio" class="form-control" readonly step="0.01">
                </div>
                <div class="mb-3">
                    <label>Estado</label>
                    <select name="Estado" class="form-select" required>
                        <option value="">Seleccione</option>
                        <option value="Programado">Programado</option>
                        <option value="En Vuelo">En Vuelo</option>
                        <option value="Aterrizado">Aterrizado</option>
                        <option value="Cancelado">Cancelado</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
              <a href="{{ route('vuelo.index') }}" class="btn btn-secondary">Cancelar</a>
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
