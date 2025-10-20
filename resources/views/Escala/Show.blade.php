<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Escala</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h1 class="mb-4">Detalles de Escala</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Escala #{{ $escala->IdEscala }}</h5>
            <p class="card-text"><strong>Vuelo:</strong> {{ $escala->vuelo->IdVuelo ?? 'N/A' }} - {{ $escala->vuelo->aeropuertoOrigen->NombreAeropuerto ?? 'N/A' }} → {{ $escala->vuelo->aeropuertoDestino->NombreAeropuerto ?? 'N/A' }}</p>
            <p class="card-text"><strong>Aeropuerto:</strong> {{ $escala->aeropuerto->IdAeropuerto ?? 'N/A' }} - {{ $escala->aeropuerto->NombreAeropuerto ?? 'N/A' }}</p>
            <p class="card-text"><strong>Hora Salida:</strong> {{ $escala->HoraSalida }}</p>
            <p class="card-text"><strong>Hora Llegada:</strong> {{ $escala->HoraLlegada }}</p>
            <p class="card-text"><strong>Tiempo Espera:</strong> {{ $escala->TiempoEspera }} min</p>
            <p class="card-text"><strong>Estado:</strong> {{ $escala->Estado }}</p>
            <a href="{{ route('escala.index') }}" class="btn btn-secondary">Volver</a>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
