@extends('layouts.app')

@section('content')
<div class="container mt-0">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Crear Nuevo Servicio
                        <a href="{{ route('servicios.index') }}" class="btn btn-secondary float-end">Volver</a>
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('servicios.store') }}" method="POST">
                        @csrf

                        <div class="row">

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="idBoleto" class="form-label">Código Boleto</label>
                                    <select class="form-control @error('idBoleto') is-invalid @enderror" id="idBoleto" name="idBoleto" required>
                                        <option value="">Seleccione un boleto</option>
                                        @foreach($boletos as $boleto)
                                            <option value="{{ $boleto->idBoleto }}" {{ old('idBoleto') == $boleto->idBoleto ? 'selected' : '' }}>
                                                {{ $boleto->idBoleto }} - {{ $boleto->idPasajero }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('idBoleto')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="Fecha" class="form-label">Fecha</label>
                                    <input type="datetime-local" class="form-control @error('Fecha') is-invalid @enderror" id="Fecha" name="Fecha" value="{{ old('FechaCompra', date('Y-m-d\TH:i')) }}" min="{{ date('Y-m-d\TH:i') }}">
                                    @error('Fecha')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="idTipoServicio" class="form-label">Tipo Servicio</label>
                                    <select class="form-control @error('idTipoServicio') is-invalid @enderror" id="idTipoServicio" name="idTipoServicio" required>
                                        <option value="">Seleccione un tipo de servicio</option>
                                        @foreach($tipoServicios as $tipoServicio)
                                            <option value="{{ $tipoServicio->idTipoServicio }}" data-costo="{{ $tipoServicio->Costo }}" {{ old('idTipoServicio') == $tipoServicio->idTipoServicio ? 'selected' : '' }}>
                                                {{ $tipoServicio->Nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('idTipoServicio')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="Cantidad" class="form-label">Cantidad</label>
                                    <input type="number" step="0.01" class="form-control @error('Cantidad') is-invalid @enderror" id="Cantidad" name="Cantidad" value="{{ old('Cantidad') }}" min="0.01" required>
                                    @error('Cantidad')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="CostoTotal" class="form-label">Costo Total</label>
                                    <input type="number" step="0.01" class="form-control" id="CostoTotal" name="CostoTotal" value="{{ old('CostoTotal') }}" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="Estado" class="form-label">Estado</label>
                                    <select class="form-control @error('Estado') is-invalid @enderror" id="Estado" name="Estado" required>
                                        <option value="">Seleccione un estado</option>
                                        <option value="Activo" {{ old('Estado') == 'Activo' ? 'selected' : '' }}>Activo</option>
                                        <option value="Inactivo" {{ old('Estado') == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                                        <option value="Pendiente" {{ old('Estado') == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                                    </select>
                                    @error('Estado')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Crear Servicio</button>
                        <a href="{{ route('servicios.index') }}" class="btn btn-secondary">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Navigation Buttons -->
    <div class="container mt-4">
        <div class="row">
            <div class="col-12 text-center">
                <a href="{{ route('boletos.create') }}" class="btn btn-warning btn-lg me-2">Anterior: Boletos</a>
                <a href="{{ route('asientos.create') }}" class="btn btn-success btn-lg">Siguiente: Asientos</a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const tipoServicioSelect = document.getElementById('idTipoServicio');
        const cantidadInput = document.getElementById('Cantidad');
        const costoTotalInput = document.getElementById('CostoTotal');

        function actualizarCostoTotal() {
            const selectedOption = tipoServicioSelect.options[tipoServicioSelect.selectedIndex];
            const costo = parseFloat(selectedOption.getAttribute('data-costo')) || 0;
            const cantidad = parseFloat(cantidadInput.value) || 0;

            const total = costo * cantidad;
            costoTotalInput.value = total.toFixed(2);
        }

        tipoServicioSelect.addEventListener('change', actualizarCostoTotal);
        cantidadInput.addEventListener('input', actualizarCostoTotal);

        // Inicializar el total al cargar la página
        actualizarCostoTotal();
    });
</script>
@endsection
