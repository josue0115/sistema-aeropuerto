@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Lista de Pasajeros
                        <a href="{{ route('pasajeros.create') }}" class="btn btn-primary float-end">Crear Nuevo Pasajero</a>
                    </h4>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID Pasajero</th>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>País</th>
                                    <th>Tipo Pasajero</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pasajeros as $pasajero)
                                    <tr>
                                        <td>{{ $pasajero->idPasajero }}</td>
                                        <td>{{ $pasajero->Nombre }}</td>
                                        <td>{{ $pasajero->Apellido }}</td>
                                        <td>{{ $pasajero->Pais }}</td>
                                        <td>{{ $pasajero->TipoPasajero }}</td>
                                        <td>{{ $pasajero->Estado }}</td>
                                        <td>
                                            <a href="{{ route('pasajeros.show', $pasajero->idPasajero) }}" class="btn btn-sm btn-info">Ver</a>
                                            <a href="{{ route('pasajeros.edit', $pasajero->idPasajero) }}" class="btn btn-sm btn-warning">Editar</a>
                                            <form action="{{ route('pasajeros.destroy', $pasajero->idPasajero) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de eliminar este pasajero?')">Eliminar</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">No hay pasajeros registrados.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
