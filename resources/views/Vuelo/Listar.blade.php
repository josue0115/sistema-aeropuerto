<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Vuelos</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
</head>
<body>
<div class="container mt-4">
    <h1 class="mb-4">Lista de Vuelos</h1>

    <!-- Botón para crear -->
    <a href="{{ route('vuelo.create') }}" class="btn btn-primary mb-3">Agregar Vuelo</a>

    <!-- Tabla -->
    <table id="tablaVuelos" class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Avión</th>
                <th>Aeropuerto Origen</th>
                <th>Aeropuerto Destino</th>
                <th>Fecha Salida</th>
                <th>Fecha Llegada</th>
                <th>Precio</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($vuelos as $vuelo)
            <tr>
                <td>{{ $vuelo->IdVuelo }}</td>
                <td>{{ $vuelo->avion->IdAvion ?? 'N/A' }} - {{ $vuelo->avion->Placa ?? 'N/A' }}</td>
                <td>{{ $vuelo->aeropuertoOrigen->IdAeropuerto ?? 'N/A' }} - {{ $vuelo->aeropuertoOrigen->NombreAeropuerto ?? 'N/A' }}</td>
                <td>{{ $vuelo->aeropuertoDestino->IdAeropuerto ?? 'N/A' }} - {{ $vuelo->aeropuertoDestino->NombreAeropuerto ?? 'N/A' }}</td>
                <td>{{ $vuelo->FechaSalida }}</td>
                <td>{{ $vuelo->FechaLlegada }}</td>
                <td>Q{{ number_format($vuelo->Precio, 2) }}</td>
                <td>{{ $vuelo->Estado }}</td>
                <td>
                    <a href="{{ route('vuelo.show', $vuelo) }}" class="btn btn-info btn-sm">Ver</a>
                    <a href="{{ route('vuelo.edit', $vuelo) }}" class="btn btn-warning btn-sm">Editar</a>
                    <a href="{{ route('vuelo.delete', $vuelo) }}" class="btn btn-danger btn-sm">Eliminar</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>
$(document).ready(function() {
    $('#tablaVuelos').DataTable();
});
</script>
</body>
</html>
