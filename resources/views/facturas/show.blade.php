@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Detalles de la Factura
                        <a href="{{ route('facturas.index') }}" class="btn btn-secondary float-end">Volver</a>
                    </h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>ID Factura:</h5>
                            <p>{{ $factura[0]->idFactura }}</p>
                        </div>
                        <div class="col-md-6">
                            <h5>ID Boleto:</h5>
                            <p>{{ $factura[0]->idBoleto }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Fecha Emisión:</h5>
                            <p>{{ $factura[0]->FechaEmision }}</p>
                        </div>
                        <div class="col-md-6">
                            <h5>Monto:</h5>
                            <p>{{ $factura[0]->monto }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Impuesto:</h5>
                            <p>{{ $factura[0]->impuesto }}</p>
                        </div>
                        <div class="col-md-6">
                            <h5>Monto Total:</h5>
                            <p>{{ $factura[0]->MontoTotal }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Estado:</h5>
                            <p>{{ $factura[0]->Estado }}</p>
                        </div>
                    </div>
                    <div class="mt-3">
                        <a href="{{ route('facturas.edit', $factura[0]->idFactura) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('facturas.destroy', $factura[0]->idFactura) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar esta factura?')">Eliminar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
