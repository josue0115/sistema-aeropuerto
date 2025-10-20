<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de Vuelos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Historial de Vuelos</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <a href="{{ route('historial_vuelos.create') }}" class="btn btn-primary mb-3">Crear Nuevo Historial</a>

        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>ID Historial</th>
                        <th>ID Vuelo</th>
                        <th>ID Pasajero</th>
                        <th>Fecha</th>
                        <th>Detalle</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($historiales as $historial)
                        <tr>
                            <td>{{ $historial->id_historial_vuelo }}</td>
                            <td>{{ $historial->idhistorial }}</td>
                            <td>{{ $historial->idvuelo }}</td>
                            <td>{{ $historial->idPasajero }}</td>
                            <td>{{ $historial->Fecha }}</td>
                            <td>{{ $historial->Detalle }}</td>
                            <td>
                                <a href="{{ route('historial_vuelos.show', $historial->id_historial_vuelo) }}" class="btn btn-info btn-sm">Ver</a>
                                <a href="{{ route('historial_vuelos.edit', $historial->id_historial_vuelo) }}" class="btn btn-warning btn-sm">Editar</a>
                                <form action="{{ route('historial_vuelos.destroy', $historial->id_historial_vuelo) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este registro?')">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">No hay registros de historial de vuelos.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
