<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Historial de Vuelo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Crear Nuevo Historial de Vuelo</h1>

        <form action="{{ route('historial_vuelos.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="idhistorial" class="form-label">ID Historial</label>
                <input type="number" class="form-control @error('idhistorial') is-invalid @enderror" id="idhistorial" name="idhistorial" value="{{ old('idhistorial') }}" required>
                @error('idhistorial')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="idvuelo" class="form-label">ID Vuelo</label>
                <input type="number" class="form-control @error('idvuelo') is-invalid @enderror" id="idvuelo" name="idvuelo" value="{{ old('idvuelo') }}" required>
                @error('idvuelo')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="idPasajero" class="form-label">ID Pasajero</label>
                <input type="number" class="form-control @error('idPasajero') is-invalid @enderror" id="idPasajero" name="idPasajero" value="{{ old('idPasajero') }}" required>
                @error('idPasajero')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="Fecha" class="form-label">Fecha</label>
                <input type="date" class="form-control @error('Fecha') is-invalid @enderror" id="Fecha" name="Fecha" value="{{ old('Fecha') }}" required>
                @error('Fecha')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="Detalle" class="form-label">Detalle</label>
                <textarea class="form-control @error('Detalle') is-invalid @enderror" id="Detalle" name="Detalle" rows="3" required>{{ old('Detalle') }}</textarea>
                @error('Detalle')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Crear Historial</button>
            <a href="{{ route('historial_vuelos.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
