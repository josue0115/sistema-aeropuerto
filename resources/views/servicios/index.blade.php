@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Servicios
                        <a href="{{ route('servicios.create') }}" class="btn btn-primary float-end">Crear Nuevo Servicio</a>
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
                                <th>ID Servicio</th>
                                <th>ID Boleto</th>
                                <th>Fecha</th>
                                <th>Tipo Servicio</th>
                                <th>Costo</th>
                                <th>Cantidad</th>
                                <th>Costo Total</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($servicios as $servicio)
                                <tr>
                                    <td>{{ $servicio->idServicio }}</td>
                                    <td>{{ $servicio->idBoleto }}</td>
                                    <td>{{ $servicio->Fecha }}</td>
                                    <td>{{ $servicio->tipo_servicio_nombre ?? $servicio->TipoServicio ?? 'N/A' }}</td>
                                    <td>{{ $servicio->Costo }}</td>
                                    <td>{{ $servicio->Cantidad }}</td>
                                    <td>{{ $servicio->CostoTotal }}</td>
                                    <td>{{ $servicio->Estado }}</td>
                                    <td>
                                        <a href="{{ route('servicios.show', $servicio->idServicio) }}" class="btn btn-info btn-sm">Ver</a>
                                        <a href="{{ route('servicios.edit', $servicio->idServicio) }}" class="btn btn-warning btn-sm">Editar</a>
                                        <form action="{{ route('servicios.destroy', $servicio->idServicio) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center">No hay servicios registrados.</td>
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
