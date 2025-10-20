<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Aviones</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h1 class="mb-4">Lista de Aviones</h1>

    <!-- Botón para ir a página de crear -->
    <a href="{{ route('avion.create') }}" class="btn btn-primary mb-3">Agregar Avión</a>

    <!-- Tabla de aviones -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Aerolínea</th>
                <th>Placa</th>
                <th>Tipo</th>
                <th>Modelo</th>
                <th>Capacidad</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($aviones as $avion)
            <tr>
                <td>{{ $avion->IdAvion }}</td>
                <td>{{ $avion->aerolinea->NombreAerolinea ?? '-' }}</td>
                <td>{{ $avion->Placa }}</td>
                <td>{{ $avion->Tipo }}</td>
                <td>{{ $avion->Modelo }}</td>
                <td>{{ $avion->Capacidad }}</td>
                <td>{{ $avion->Estado }}</td>
                <td>
                    <a href="{{ route('avion.show', $avion->IdAvion) }}" class="btn btn-info btn-sm">Ver</a>
                    <a href="{{ route('avion.edit', $avion->IdAvion) }}" class="btn btn-warning btn-sm">Editar</a>
                    <a href="{{ route('avion.delete', $avion->IdAvion) }}" class="btn btn-danger btn-sm">Eliminar</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>



</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
