@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Tipos de Servicio
                        <a href="{{ route('tipo_servicios.create') }}" class="btn btn-primary float-end">Crear Nuevo Tipo de Servicio</a>
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
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Costo</th>
                                <th>Descripción</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($tipoServicios as $tipoServicio)
                                <tr>
                                    <td>{{ $tipoServicio->idTipoServicio }}</td>
                                    <td>{{ $tipoServicio->Nombre }}</td>
                                    <td>${{ number_format($tipoServicio->Costo, 2) }}</td>
                                    <td>{{ $tipoServicio->Descripcion }}</td>
                                    <td>
                                        <a href="{{ route('tipo_servicios.show', $tipoServicio->idTipoServicio) }}" class="btn btn-info btn-sm">Ver</a>
                                        <a href="{{ route('tipo_servicios.edit', $tipoServicio->idTipoServicio) }}" class="btn btn-warning btn-sm">Editar</a>
                                        <form action="{{ route('tipo_servicios.destroy', $tipoServicio->idTipoServicio) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">No hay tipos de servicio registrados.</td>
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
