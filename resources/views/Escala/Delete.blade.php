<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Escala</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h1 class="mb-4">Eliminar Escala</h1>

    <!-- Modal Eliminar -->
    <div class="modal fade show" id="modalEliminar" tabindex="-1" aria-labelledby="modalEliminarLabel" aria-hidden="false" style="display: block;">
      <div class="modal-dialog">
        <div class="modal-content">
          <form method="POST" action="{{ route('escala.destroy', $escala) }}">
            @csrf
            @method('DELETE')
            <div class="modal-header">
              <h5 class="modal-title" id="modalEliminarLabel">Confirmar Eliminación</h5>
              <a href="{{ route('escala.index') }}" class="btn-close"></a>
            </div>
            <div class="modal-body">
                <p>¿Estás seguro de que deseas eliminar esta escala?</p>
                <div class="card">
                    <div class="card-body">
                        <p><strong>Vuelo:</strong> {{ $escala->vuelo->IdVuelo ?? 'N/A' }} - {{ $escala->vuelo->aeropuertoOrigen->NombreAeropuerto ?? 'N/A' }} → {{ $escala->vuelo->aeropuertoDestino->NombreAeropuerto ?? 'N/A' }}</p>
                        <p><strong>Aeropuerto:</strong> {{ $escala->aeropuerto->IdAeropuerto ?? 'N/A' }} - {{ $escala->aeropuerto->NombreAeropuerto ?? 'N/A' }}</p>
                        <p><strong>Hora Salida:</strong> {{ $escala->HoraSalida }}</p>
                        <p><strong>Hora Llegada:</strong> {{ $escala->HoraLlegada }}</p>
                        <p><strong>Tiempo Espera:</strong> {{ $escala->TiempoEspera }} min</p>
                        <p><strong>Estado:</strong> {{ $escala->Estado }}</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <a href="{{ route('escala.index') }}" class="btn btn-secondary">Cancelar</a>
              <button type="submit" class="btn btn-danger">Eliminar</button>
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
