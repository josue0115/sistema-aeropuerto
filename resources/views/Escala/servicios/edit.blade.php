@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Editar Servicio
                        <a href="{{ route('servicios.index') }}" class="btn btn-secondary float-end">Volver</a>
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('servicios.update', $servicio[0]->idServicio) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="idBoleto" class="form-label">ID Boleto</label>
                            <input type="number" class="form-control @error('idBoleto') is-invalid @enderror" id="idBoleto" name="idBoleto" value="{{ old('idBoleto', $servicio[0]->idBoleto) }}">
                            @error('idBoleto')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="Fecha" class="form-label">Fecha</label>
                            <input type="datetime-local" class="form-control @error('Fecha') is-invalid @enderror" id="Fecha" name="Fecha" value="{{ old('Fecha', $servicio[0]->Fecha ? \Carbon\Carbon::parse($servicio[0]->Fecha)->format('Y-m-d\TH:i') : '') }}">
                            @error('Fecha')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="TipoServicio" class="form-label">Tipo Servicio</label>
                            <input type="text" class="form-control @error('TipoServicio') is-invalid @enderror" id="TipoServicio" name="TipoServicio" value="{{ old('TipoServicio', $servicio[0]->TipoServicio) }}" maxlength="10">
                            @error('TipoServicio')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="Costo" class="form-label">Costo</label>
                            <input type="number" step="0.01" class="form-control @error('Costo') is-invalid @enderror" id="Costo" name="Costo" value="{{ old('Costo', $servicio[0]->Costo) }}">
                            @error('Costo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="Cantidad" class="form-label">Cantidad</label>
                            <input type="number" step="0.01" class="form-control @error('Cantidad') is-invalid @enderror" id="Cantidad" name="Cantidad" value="{{ old('Cantidad', $servicio[0]->Cantidad) }}">
                            @error('Cantidad')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="CostoTotal" class="form-label">Costo Total</label>
                            <input type="number" step="0.01" class="form-control @error('CostoTotal') is-invalid @enderror" id="CostoTotal" name="CostoTotal" value="{{ old('CostoTotal', $servicio[0]->CostoTotal) }}">
                            @error('CostoTotal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="Estado" class="form-label">Estado</label>
                            <input type="text" class="form-control @error('Estado') is-invalid @enderror" id="Estado" name="Estado" value="{{ old('Estado', $servicio[0]->Estado) }}" maxlength="10">
                            @error('Estado')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Actualizar Servicio</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
