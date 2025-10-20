@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Crear Nueva Factura
                        <a href="{{ route('facturas.index') }}" class="btn btn-secondary float-end">Volver</a>
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('facturas.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="idFactura" class="form-label">ID Factura</label>
                            <input type="number" class="form-control @error('idFactura') is-invalid @enderror" id="idFactura" name="idFactura" value="{{ old('idFactura') }}" required>
                            @error('idFactura')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="idBoleto" class="form-label">ID Boleto</label>
                            <input type="number" class="form-control @error('idBoleto') is-invalid @enderror" id="idBoleto" name="idBoleto" value="{{ old('idBoleto') }}">
                            @error('idBoleto')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="FechaEmision" class="form-label">Fecha Emisión</label>
                            <input type="datetime-local" class="form-control @error('FechaEmision') is-invalid @enderror" id="FechaEmision" name="FechaEmision" value="{{ old('FechaEmision') }}">
                            @error('FechaEmision')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="monto" class="form-label">Monto</label>
                            <input type="number" step="0.01" class="form-control @error('monto') is-invalid @enderror" id="monto" name="monto" value="{{ old('monto') }}">
                            @error('monto')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="impuesto" class="form-label">Impuesto</label>
                            <input type="number" step="0.01" class="form-control @error('impuesto') is-invalid @enderror" id="impuesto" name="impuesto" value="{{ old('impuesto') }}">
                            @error('impuesto')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="MontoTotal" class="form-label">Monto Total</label>
                            <input type="number" step="0.01" class="form-control @error('MontoTotal') is-invalid @enderror" id="MontoTotal" name="MontoTotal" value="{{ old('MontoTotal') }}" readonly>
                            @error('MontoTotal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="Estado" class="form-label">Estado</label>
                            <select class="form-control @error('Estado') is-invalid @enderror" id="Estado" name="Estado">
                                <option value="">Seleccione un estado</option>
                                <option value="Activo" {{ old('Estado') == 'Activo' ? 'selected' : '' }}>Activo</option>
                                <option value="Inactivo" {{ old('Estado') == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                                <option value="Pendiente" {{ old('Estado') == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                            </select>
                            @error('Estado')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Crear Factura</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const montoInput = document.getElementById('monto');
    const impuestoInput = document.getElementById('impuesto');
    const montoTotalInput = document.getElementById('MontoTotal');

    function calcularMontoTotal() {
        const monto = parseFloat(montoInput.value) || 0;
        const impuesto = parseFloat(impuestoInput.value) || 0;
        const total = monto + impuesto;
        montoTotalInput.value = total.toFixed(2);
    }

    montoInput.addEventListener('input', calcularMontoTotal);
    impuestoInput.addEventListener('input', calcularMontoTotal);
});
</script>
@endsection
