<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Personal</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h1 class="mb-4">Lista de Personal</h1>

    <!-- Botón Agregar Personal -->
    <a href="{{ route('personal.create') }}" class="btn btn-primary mb-3">Agregar Personal</a>

    <!-- Tabla de Personal -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Cargo</th>
                <th>Fecha Ingreso</th>
                <th>Salario</th>
                <th>Estado</th>
                <th>Teléfono</th>
                <th>Correo</th>
                <th>Dirección</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($personal as $p)
            <tr>
                <td>{{ $p->IdPersonal }}</td>
                <td>{{ $p->Nombre }}</td>
                <td>{{ $p->Apellido }}</td>
                <td>{{ $p->Cargo }}</td>
                <td>{{ $p->FechaIngreso }}</td>
                <td>Q{{ number_format($p->Salario, 2) }}</td>
                <td>{{ $p->Estado }}</td>
                <td>{{ $p->Telefono }}</td>
                <td>{{ $p->Correo }}</td>
                <td>{{ $p->Direccion }}</td>
                <td>
                    <a href="{{ route('personal.show', $p->IdPersonal) }}" class="btn btn-info btn-sm">Ver</a>
                    <a href="{{ route('personal.edit', $p->IdPersonal) }}" class="btn btn-warning btn-sm">Editar</a>
                    <a href="{{ route('personal.delete', $p->IdPersonal) }}" class="btn btn-danger btn-sm">Eliminar</a>
                </td>
            </tr>

            @endforeach
        </tbody>
    </table>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
