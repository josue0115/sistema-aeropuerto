<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Mantenimientos</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
</head>
<body>
<div class="container mt-4">
    <h1 class="mb-4">Lista de Mantenimientos</h1>

    <!-- Botón para crear -->
    <a href="{{ route('mantenimiento.create') }}" class="btn btn-primary mb-3">Agregar Mantenimiento</a>

    <!-- Tabla -->
    <table id="tablaMantenimientos" class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Avión</th>
                <th>Personal</th>
                <th>Fecha Ingreso</th>
                <th>Fecha Salida</th>
                <th>Tipo</th>
                <th>Estado</th>
                <th>Costo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($mantenimientos as $mantenimiento)
            <tr>
                <td>{{ $mantenimiento->Id_mantenimiento }}</td>
                <td>{{ $mantenimiento->avion->IdAvion ?? 'N/A' }} - {{ $mantenimiento->avion->Placa ?? 'N/A' }}</td>
                <td>{{ $mantenimiento->personal->IdPersonal ?? 'N/A' }} - {{ $mantenimiento->personal->Nombre ?? 'N/A' }} {{ $mantenimiento->personal->Apellido ?? 'N/A' }}</td>
                <td>{{ $mantenimiento->FechaIngreso }}</td>
                <td>{{ $mantenimiento->FechaSalida }}</td>
                <td>{{ $mantenimiento->Tipo }}</td>
                <td>{{ $mantenimiento->Estado }}</td>
                <td>Q{{ number_format($mantenimiento->Costo + $mantenimiento->CostoExtra, 2) }}</td>
                <td>
                    <a href="{{ route('mantenimiento.show', $mantenimiento->Id_mantenimiento) }}" class="btn btn-info btn-sm">Ver</a>
                    <a href="{{ route('mantenimiento.edit', $mantenimiento->Id_mantenimiento) }}" class="btn btn-warning btn-sm">Editar</a>
                    <a href="{{ route('mantenimiento.delete', $mantenimiento->Id_mantenimiento) }}" class="btn btn-danger btn-sm">Eliminar</a>
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
    $('#tablaMantenimientos').DataTable();
});
</script>
</body>
</html>
