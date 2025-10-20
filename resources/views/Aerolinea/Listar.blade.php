<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Aerolíneas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
</head>
<body>
<div class="container mt-4">
    <h1>Lista de Aerolíneas</h1>

    <!-- Botón para ir a página de crear -->
    <a href="{{ route('aerolinea.create') }}" class="btn btn-primary mb-3">Agregar Aerolínea</a>

    <table id="tablaAerolineas" class="table table-bordered">
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
            @foreach($aerolineas as $aero)
            <tr>
                <td>{{ $aero->IdAerolinea }}</td>
                <td>{{ $aero->NombreAerolinea }}</td>
                <td>{{ $aero->Pais }}</td>
                <td>{{ $aero->Ciudad }}</td>
                <td>{{ $aero->Estado }}</td>
                <td>
                    <a href="{{ route('aerolinea.show', $aero->IdAerolinea) }}" class="btn btn-info btn-sm">Ver</a>
                    <a href="{{ route('aerolinea.edit', $aero->IdAerolinea) }}" class="btn btn-warning btn-sm">Editar</a>
                    <a href="{{ route('aerolinea.delete', $aero->IdAerolinea) }}" class="btn btn-danger btn-sm">Eliminar</a>
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
    $('#tablaAerolineas').DataTable();
});
</script>
</body>
</html>
