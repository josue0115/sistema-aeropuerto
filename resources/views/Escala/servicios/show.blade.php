@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Detalles del Servicio
                        <a href="{{ route('servicios.index') }}" class="btn btn-secondary float-end">Volver</a>
                    </h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>ID Servicio:</h5>
                            <p>{{ $servicio[0]->idServicio }}</p>
                        </div>
                        <div class="col-md-6">
                            <h5>ID Boleto:</h5>
                            <p>{{ $servicio[0]->idBoleto }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Fecha:</h5>
                            <p>{{ $servicio[0]->Fecha }}</p>
                        </div>
                        <div class="col-md-6">
                            <h5>Tipo Servicio:</h5>
                            <p>{{ $servicio[0]->TipoServicio }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Costo:</h5>
                            <p>{{ $servicio[0]->Costo }}</p>
                        </div>
                        <div class="col-md-6">
                            <h5>Cantidad:</h5>
                            <p>{{ $servicio[0]->Cantidad }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Costo Total:</h5>
                            <p>{{ $servicio[0]->CostoTotal }}</p>
                        </div>
                        <div class="col-md-6">
                            <h5>Estado:</h5>
                            <p>{{ $servicio[0]->Estado }}</p>
                        </div>
                    </div>
                    <div class="mt-3">
                        <a href="{{ route('servicios.edit', $servicio[0]->idServicio) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('servicios.destroy', $servicio[0]->idServicio) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar este servicio?')">Eliminar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
