@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Detalles del Asiento
                        <a href="{{ route('asientos.index') }}" class="btn btn-secondary float-end">Volver</a>
                    </h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label><strong>ID Asiento:</strong></label>
                                <p>{{ $asiento[0]->idAsiento }}</p>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label><strong>Vuelo:</strong></label>
                                <p>{{ $asiento[0]->vuelo_info ?: 'N/A' }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label><strong>Número de Asiento:</strong></label>
                                <p>{{ $asiento[0]->NumeroAsiento }}</p>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label><strong>Clase:</strong></label>
                                <p>{{ $asiento[0]->Clase ?: 'N/A' }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label><strong>Estado:</strong></label>
                                <p>{{ $asiento[0]->Estado ?: 'N/A' }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <a href="{{ route('asientos.edit', $asiento[0]->idAsiento) }}" class="btn btn-warning">Editar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
