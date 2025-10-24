<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Aeropuertos</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
</head>
<body>
<div class="container mt-4">
    <h1 class="mb-4">Lista de Aeropuertos</h1>

    <!-- Botón para crear -->
    <a href="{{ route('aeropuerto.create') }}" class="btn btn-primary mb-3">Agregar Aeropuerto</a>

    <!-- Tabla -->
    <table id="tablaAeropuertos" class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>País</th>
                <th>Ciudad</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($aeropuertos as $aero)
            <tr>
                <td>{{ $aero->IdAeropuerto }}</td>
                <td>{{ $aero->NombreAeropuerto }}</td>
                <td>{{ $aero->Pais }}</td>
                <td>{{ $aero->Ciudad }}</td>
                <td>{{ $aero->Estado }}</td>
                <td>
                    <a href="{{ route('aeropuerto.show', $aero) }}" class="btn btn-info btn-sm">Ver</a>
                    <a href="{{ route('aeropuerto.edit', $aero) }}" class="btn btn-warning btn-sm">Editar</a>
                    <a href="{{ route('aeropuerto.delete', $aero) }}" class="btn btn-danger btn-sm">Eliminar</a>
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
    $('#tablaAeropuertos').DataTable();
});
</script>
</body>
</html>
