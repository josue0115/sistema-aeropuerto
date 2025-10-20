@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Detalles del Pasajero</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>ID Pasajero:</strong> {{ $pasajero[0]->idPasajero }}</p>
                            <p><strong>Nombre:</strong> {{ $pasajero[0]->Nombre }}</p>
                            <p><strong>Apellido:</strong> {{ $pasajero[0]->Apellido }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>País:</strong> {{ $pasajero[0]->Pais }}</p>
                            <p><strong>Tipo Pasajero:</strong> {{ $pasajero[0]->TipoPasajero }}</p>
                            <p><strong>Estado:</strong> {{ $pasajero[0]->Estado }}</p>
                        </div>
                    </div>

                    <a href="{{ route('pasajeros.index') }}" class="btn btn-secondary">Volver</a>
                    <a href="{{ route('pasajeros.edit', $pasajero[0]->idPasajero) }}" class="btn btn-warning">Editar</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
