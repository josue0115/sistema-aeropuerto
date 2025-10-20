@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Editar Tipo de Servicio
                        <a href="{{ route('tipo_servicios.index') }}" class="btn btn-secondary float-end">Volver</a>
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('tipo_servicios.update', $tipoServicio[0]->idTipoServicio) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="Nombre" class="form-label">Nombre</label>
                                    <input type="text" class="form-control @error('Nombre') is-invalid @enderror" id="Nombre" name="Nombre" value="{{ old('Nombre', $tipoServicio[0]->Nombre) }}" required maxlength="50">
                                    @error('Nombre')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="Costo" class="form-label">Costo</label>
                                    <input type="number" step="0.01" class="form-control @error('Costo') is-invalid @enderror" id="Costo" name="Costo" value="{{ old('Costo', $tipoServicio[0]->Costo) }}" required min="0">
                                    @error('Costo')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="Descripcion" class="form-label">Descripción</label>
                            <textarea class="form-control @error('Descripcion') is-invalid @enderror" id="Descripcion" name="Descripcion" rows="3">{{ old('Descripcion', $tipoServicio[0]->Descripcion) }}</textarea>
                            @error('Descripcion')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Actualizar Tipo de Servicio</button>
                        <a href="{{ route('tipo_servicios.index') }}" class="btn btn-secondary">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
