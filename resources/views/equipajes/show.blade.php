@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Detalles del Equipaje</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>ID Equipaje:</strong> {{ $equipaje->idEquipaje }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>ID Boleto:</strong> {{ $equipaje->idBoleto }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Costo:</strong> {{ $equipaje->Costo }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Dimensiones:</strong> {{ $equipaje->Dimensiones }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Monto:</strong> {{ $equipaje->Monto }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Costo Extra:</strong> {{ $equipaje->CostoExtra }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Estado:</strong> {{ $equipaje->Estado }}</p>
                        </div>
                    </div>

                    <a href="{{ route('equipajes.index') }}" class="btn btn-secondary">Volver</a>
                    <a href="{{ route('equipajes.edit', $equipaje->idEquipaje) }}" class="btn btn-warning">Editar</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
