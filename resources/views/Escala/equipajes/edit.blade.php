@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Editar Equipaje
                        <a href="{{ route('equipajes.index') }}" class="btn btn-secondary float-end">Volver</a>
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('equipajes.update', $equipaje->idEquipaje) }}" method="POST" id="equipaje-form">
                        @csrf
                        @method('PUT')

                        <!-- ID Equipaje oculto -->
                        <input type="hidden" id="idEquipaje" name="idEquipaje" value="{{ $equipaje->idEquipaje }}">

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="idBoleto" class="form-label">Código Boleto</label>
                                <select class="form-control @error('idBoleto') is-invalid @enderror" id="idBoleto" name="idBoleto" required>
                                    <option value="">Seleccione un boleto</option>
                                    @foreach($boletos as $boleto)
                                        <option value="{{ $boleto->idBoleto }}" {{ old('idBoleto', $equipaje->idBoleto) == $boleto->idBoleto ? 'selected' : '' }}>
                                            {{ $boleto->idBoleto }} - {{ $boleto->pasajero_nombre ?? 'N/A' }} {{ $boleto->pasajero_apellido ?? '' }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('idBoleto')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="Costo" class="form-label">Costo</label>
                                <input type="number" step="0.01" min="0" class="form-control @error('Costo') is-invalid @enderror" id="Costo" name="Costo" value="{{ old('Costo', $equipaje->Costo) }}" required>
                                @error('Costo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="Dimensiones" class="form-label">Dimensiones (ej: 50x30x20)</label>
                                <input type="text" class="form-control @error('Dimensiones') is-invalid @enderror" id="Dimensiones" name="Dimensiones" value="{{ old('Dimensiones', $equipaje->Dimensiones) }}" placeholder="50x30x20" pattern="[0-9x\s]+" title="Solo números y 'x' permitidos" required>
                                @error('Dimensiones')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="Peso" class="form-label">Peso (kg)</label>
                                <input type="number" step="0.01" min="0" class="form-control @error('Peso') is-invalid @enderror" id="Peso" name="Peso" value="{{ old('Peso', $equipaje->Peso ?? '') }}" required>
                                @error('Peso')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="CostoExtra" class="form-label">Costo Extra</label>
                                <input type="number" step="0.01" class="form-control" id="CostoExtra" name="CostoExtra" value="{{ old('CostoExtra', $equipaje->CostoExtra ?? 0) }}" readonly>
                                <small class="form-text text-muted">Calculado automáticamente: $30 por cada 23kg</small>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="Monto" class="form-label">Monto Total</label>
                                <input type="number" step="0.01" class="form-control" id="Monto" name="Monto" value="{{ old('Monto', $equipaje->Monto) }}" readonly>
                                <small class="form-text text-muted">Costo + Costo Extra</small>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="Estado" class="form-label">Estado</label>
                                <select class="form-control @error('Estado') is-invalid @enderror" id="Estado" name="Estado" required>
                                    <option value="">Seleccione un estado</option>
                                    <option value="Registrado" {{ old('Estado', $equipaje->Estado) == 'Registrado' ? 'selected' : '' }}>Registrado</option>
                                    <option value="EnTransito" {{ old('Estado', $equipaje->Estado) == 'EnTransito' ? 'selected' : '' }}>En Tránsito</option>
                                    <option value="Entregado" {{ old('Estado', $equipaje->Estado) == 'Entregado' ? 'selected' : '' }}>Entregado</option>
                                    <option value="Perdido" {{ old('Estado', $equipaje->Estado) == 'Perdido' ? 'selected' : '' }}>Perdido</option>
                                    <option value="Dañado" {{ old('Estado', $equipaje->Estado) == 'Dañado' ? 'selected' : '' }}>Dañado</option>
                                </select>
                                @error('Estado')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Actualizar Equipaje</button>
                        <a href="{{ route('equipajes.index') }}" class="btn btn-secondary">Cancelar</a>
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
    const costoInput = document.getElementById('Costo');
    const pesoInput = document.getElementById('Peso');
    const costoExtraInput = document.getElementById('CostoExtra');
    const montoInput = document.getElementById('Monto');

    function calcularMontos() {
        const costo = parseFloat(costoInput.value) || 0;
        const peso = parseFloat(pesoInput.value) || 0;

        // Calcular costo extra: $30 por cada 23kg
        const costoExtra = (peso / 23) * 30;
        costoExtraInput.value = costoExtra.toFixed(2);

        // Calcular monto total: costo + costo extra
        const montoTotal = costo + costoExtra;
        montoInput.value = montoTotal.toFixed(2);
    }

    // Validación en tiempo real para dimensiones
    document.getElementById('Dimensiones').addEventListener('input', function() {
        const value = this.value;
        // Solo permitir números, 'x' y espacios
        if (!/^[0-9x\s]*$/.test(value)) {
            this.value = value.replace(/[^0-9x\s]/g, '');
        }
    });

    // Validación para costo (no negativo)
    costoInput.addEventListener('input', function() {
        if (this.value < 0) {
            this.value = 0;
        }
        calcularMontos();
    });

    // Validación para peso (no negativo)
    pesoInput.addEventListener('input', function() {
        if (this.value < 0) {
            this.value = 0;
        }
        calcularMontos();
    });

    // Calcular inicialmente
    calcularMontos();
});
</script>
@endsection
