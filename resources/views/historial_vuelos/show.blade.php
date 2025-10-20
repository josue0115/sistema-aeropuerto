<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Historial de Vuelo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Detalles del Historial de Vuelo</h1>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Historial ID: {{ $historial[0]->id_historial_vuelo }}</h5>

                <div class="row">
                    <div class="col-md-6">
                        <p><strong>ID Historial:</strong> {{ $historial[0]->idhistorial }}</p>
                        <p><strong>ID Vuelo:</strong> {{ $historial[0]->idvuelo }}</p>
                        <p><strong>ID Pasajero:</strong> {{ $historial[0]->idPasajero }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Fecha:</strong> {{ $historial[0]->Fecha }}</p>
                        <p><strong>Detalle:</strong> {{ $historial[0]->Detalle }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-3">
            <a href="{{ route('historial_vuelos.index') }}" class="btn btn-secondary">Volver a la Lista</a>
            <a href="{{ route('historial_vuelos.edit', $historial[0]->id_historial_vuelo) }}" class="btn btn-warning">Editar</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
