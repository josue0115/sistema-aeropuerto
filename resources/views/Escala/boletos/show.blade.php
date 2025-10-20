@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Detalles del Boleto</h4>
                    <a href="{{ route('boletos.index') }}" class="btn btn-secondary">Volver</a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>ID Boleto:</strong> {{ $boletoData[0]->idBoleto }}</p>
                            <p><strong>ID Vuelo:</strong> {{ $boletoData[0]->idVuelo }}</p>
                            <p><strong>ID Pasajero:</strong> {{ $boletoData[0]->idPasajero }}</p>
                            <p><strong>Fecha Compra:</strong> {{ $boletoData[0]->FechaCompra }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Precio:</strong> {{ $boletoData[0]->Precio }}</p>
                            <p><strong>Cantidad:</strong> {{ $boletoData[0]->Cantidad }}</p>
                            <p><strong>Descuento:</strong> {{ $boletoData[0]->Descuento }}</p>
                            <p><strong>Impuesto:</strong> {{ $boletoData[0]->Impuesto }}</p>
                            <p><strong>Total:</strong> {{ $boletoData[0]->Total }}</p>
                        </div>
                    </div>
                    <div class="mt-3">
                        <a href="{{ route('boletos.edit', $boletoData[0]->idBoleto) }}" class="btn btn-warning">Editar</a>
                        <a href="{{ route('boletos.pdf', $boletoData[0]->idBoleto) }}" class="btn btn-primary" target="_blank">Descargar PDF</a>
                        <form action="{{ route('boletos.destroy', $boletoData[0]->idBoleto) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar este boleto?')">Eliminar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
