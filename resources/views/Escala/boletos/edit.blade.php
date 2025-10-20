    @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Editar Boleto</h4>
                </div>
                <div class="card-body">
                  
                    <form action="{{ route('boletos.update', $boleto->idBoleto) }}" method="POST">

                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="idVuelo" class="form-label">ID Vuelo</label>
                                <input type="number" class="form-control @error('idVuelo') is-invalid @enderror" id="idVuelo" name="idVuelo" value="{{ old('idVuelo', $boleto->idVuelo) }}">
                                @error('idVuelo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="idPasajero" class="form-label">ID Pasajero</label>
                                <input type="number" class="form-control @error('idPasajero') is-invalid @enderror" id="idPasajero" name="idPasajero" value="{{ old('idPasajero', $boleto->idPasajero) }}">
                                @error('idPasajero')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="FechaCompra" class="form-label">Fecha Compra</label>
                                <input type="datetime-local" class="form-control @error('FechaCompra') is-invalid @enderror" id="FechaCompra" name="FechaCompra" value="{{ old('FechaCompra', $boleto->FechaCompra ? \Carbon\Carbon::parse($boleto->FechaCompra)->format('Y-m-d\TH:i') : '') }}">
                                @error('FechaCompra')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="Precio" class="form-label">Precio</label>
                                <input type="number" step="0.01" class="form-control @error('Precio') is-invalid @enderror" id="Precio" name="Precio" value="{{ old('Precio', $boleto->Precio) }}">
                                @error('Precio')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="Cantidad" class="form-label">Cantidad</label>
                                <input type="number" step="0.01" class="form-control @error('Cantidad') is-invalid @enderror" id="Cantidad" name="Cantidad" value="{{ old('Cantidad', $boleto->Cantidad) }}">
                                @error('Cantidad')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="Descuento" class="form-label">Descuento</label>
                                <input type="number" step="0.01" class="form-control @error('Descuento') is-invalid @enderror" id="Descuento" name="Descuento" value="{{ old('Descuento', $boleto->Descuento) }}">
                                @error('Descuento')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="Impuesto" class="form-label">Impuesto</label>
                                <input type="number" step="0.01" class="form-control @error('Impuesto') is-invalid @enderror" id="Impuesto" name="Impuesto" value="{{ old('Impuesto', $boleto->Impuesto) }}">
                                @error('Impuesto')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="Total" class="form-label">Total (Calculado automáticamente)</label>
                                <input type="number" step="0.01" class="form-control" id="Total" name="Total" value="{{ old('Total', $boleto->Total) }}" readonly>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Actualizar Boleto</button>
                        <a href="{{ route('boletos.index') }}" class="btn btn-secondary">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const precioInput = document.getElementById('Precio');
        const cantidadInput = document.getElementById('Cantidad');
        const descuentoInput = document.getElementById('Descuento');
        const impuestoInput = document.getElementById('Impuesto');
        const totalInput = document.getElementById('Total');

        function calcularTotal() {
            const precio = parseFloat(precioInput.value) || 0;
            const cantidad = parseFloat(cantidadInput.value) || 0;
            const descuento = parseFloat(descuentoInput.value) || 0;
            const impuesto = parseFloat(impuestoInput.value) || 0;

            const subtotal = precio * cantidad;
            const total = subtotal - descuento + impuesto;

            totalInput.value = total.toFixed(2);
        }

        // Eventos para calcular automáticamente en tiempo real
        const events = ['input', 'change', 'keyup', 'blur'];
        events.forEach(event => {
            precioInput.addEventListener(event, calcularTotal);
            cantidadInput.addEventListener(event, calcularTotal);
            descuentoInput.addEventListener(event, calcularTotal);
            impuestoInput.addEventListener(event, calcularTotal);
        });

        // Calcular inicialmente
        calcularTotal();
    });
</script>
@endsection
