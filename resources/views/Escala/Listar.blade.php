<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Escalas</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
</head>
<body>
<div class="container mt-4">
    <h1 class="mb-4">Lista de Escalas</h1>

    <!-- Botón para crear -->
    <a href="{{ route('escala.create') }}" class="btn btn-primary mb-3">Agregar Escala</a>

    <!-- Tabla -->
    <table id="tablaEscalas" class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Vuelo</th>
                <th>Aeropuerto</th>
                <th>Hora Salida</th>
                <th>Hora Llegada</th>
                <th>Tiempo Espera (min)</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($escalas as $escala)
            <tr>
                <td>{{ $escala->IdEscala }}</td>
                <td>{{ $escala->vuelo->IdVuelo ?? 'N/A' }} - {{ $escala->vuelo->aeropuertoOrigen->NombreAeropuerto ?? 'N/A' }} → {{ $escala->vuelo->aeropuertoDestino->NombreAeropuerto ?? 'N/A' }}</td>
                <td>{{ $escala->aeropuerto->IdAeropuerto ?? 'N/A' }} - {{ $escala->aeropuerto->NombreAeropuerto ?? 'N/A' }}</td>
                <td>{{ $escala->HoraSalida }}</td>
                <td>{{ $escala->HoraLlegada }}</td>
                <td>{{ $escala->TiempoEspera }}</td>
                <td>{{ $escala->Estado }}</td>
                <td>
                    <a href="{{ route('escala.show', $escala) }}" class="btn btn-info btn-sm">Ver</a>
                    <a href="{{ route('escala.edit', $escala) }}" class="btn btn-warning btn-sm">Editar</a>
                    <a href="{{ route('escala.delete', $escala) }}" class="btn btn-danger btn-sm">Eliminar</a>
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
    $('#tablaEscalas').DataTable({
        "language": {
            "lengthMenu": "Mostrar _MENU_ entradas",
            "zeroRecords": "No se encontraron resultados",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ entradas",
            "infoEmpty": "Mostrando 0 a 0 de 0 entradas",
            "infoFiltered": "(filtrado de _MAX_ entradas totales)",
            "search": "Buscar:",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            }
        }
    });
});
</script>
</body>
</html>
