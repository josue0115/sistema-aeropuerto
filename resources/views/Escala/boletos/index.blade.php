@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Lista de Boletos</h4>
                    <a href="{{ route('boletos.create') }}" class="btn btn-primary">Crear Nuevo Boleto</a>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID Boleto</th>
                                <th>ID Vuelo</th>
                                <th>ID Pasajero</th>
                                <th>Fecha Compra</th>
                                <th>Precio</th>
                                <th>Cantidad</th>
                                <th>Descuento</th>
                                <th>Impuesto</th>
                                <th>Total</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($boletos as $boleto)
                            <tr>
                                <td>{{ $boleto->idBoleto }}</td>
                                <td>{{ $boleto->idVuelo }}</td>
                                <td>{{ $boleto->idPasajero }}</td>
                                <td>{{ $boleto->FechaCompra }}</td>
                                <td>{{ $boleto->Precio }}</td>
                                <td>{{ $boleto->Cantidad }}</td>
                                <td>{{ $boleto->Descuento }}</td>
                                <td>{{ $boleto->Impuesto }}</td>
                                <td>{{ $boleto->Total }}</td>
                                <td>
                                    <a href="{{ route('boletos.show', $boleto->idBoleto) }}" class="btn btn-info btn-sm">Ver</a>
                                    <!-- <a href="{{ route('boletos.edit', $boleto->idBoleto) }}" class="btn btn-warning btn-sm">Editar</a> -->
                                     <a href="{{ route('boletos.edit', $boleto->idBoleto) }}" class="btn btn-warning btn-sm">Editar</a>

                                    <form action="{{ route('boletos.destroy', $boleto->idBoleto) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este boleto?')">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
