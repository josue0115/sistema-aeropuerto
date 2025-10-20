@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Detalles del Tipo de Servicio
                        <a href="{{ route('tipo_servicios.index') }}" class="btn btn-secondary float-end">Volver</a>
                    </h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>ID:</h5>
                            <p>{{ $tipoServicio[0]->idTipoServicio }}</p>
                        </div>
                        <div class="col-md-6">
                            <h5>Nombre:</h5>
                            <p>{{ $tipoServicio[0]->Nombre }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Costo:</h5>
                            <p>${{ number_format($tipoServicio[0]->Costo, 2) }}</p>
                        </div>
                        <div class="col-md-6">
                            <h5>Descripción:</h5>
                            <p>{{ $tipoServicio[0]->Descripcion ?: 'Sin descripción' }}</p>
                        </div>
                    </div>
                    <div class="mt-3">
                        <a href="{{ route('tipo_servicios.edit', $tipoServicio[0]->idTipoServicio) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('tipo_servicios.destroy', $tipoServicio[0]->idTipoServicio) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar este tipo de servicio?')">Eliminar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
