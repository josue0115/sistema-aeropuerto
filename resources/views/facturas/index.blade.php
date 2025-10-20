@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Facturas
                        <a href="{{ route('facturas.create') }}" class="btn btn-primary float-end">Crear Nueva Factura</a>
                    </h4>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID Factura</th>
                                <th>ID Boleto</th>
                                <th>Fecha Emisión</th>
                                <th>Monto</th>
                                <th>Impuesto</th>
                                <th>Monto Total</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($facturas as $factura)
                                <tr>
                                    <td>{{ $factura->idFactura }}</td>
                                    <td>{{ $factura->idBoleto }}</td>
                                    <td>{{ $factura->FechaEmision }}</td>
                                    <td>{{ $factura->monto }}</td>
                                    <td>{{ $factura->impuesto }}</td>
                                    <td>{{ $factura->MontoTotal }}</td>
                                    <td>{{ $factura->Estado }}</td>
                                    <td>
                                        <a href="{{ route('facturas.show', $factura->idFactura) }}" class="btn btn-info btn-sm">Ver</a>
                                        <a href="{{ route('facturas.edit', $factura->idFactura) }}" class="btn btn-warning btn-sm">Editar</a>
                                        <form action="{{ route('facturas.destroy', $factura->idFactura) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">No hay facturas registradas.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
