@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Lista de Asientos
                        <a href="{{ route('asientos.create') }}" class="btn btn-primary float-end">Crear Nuevo Asiento</a>
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
                                    <th>ID Asiento</th>
                                    <th>Vuelo</th>
                                    <th>Número de Asiento</th>
                                    <th>Clase</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($asientos as $asiento)
                                    <tr>
                                        <td>{{ $asiento->idAsiento }}</td>
                                        <td>{{ $asiento->vuelo_info ? $asiento->vuelo_info : 'N/A' }}</td>
                                        <td>{{ $asiento->NumeroAsiento }}</td>
                                        <td>{{ $asiento->Clase ?: 'N/A' }}</td>
                                        <td>{{ $asiento->Estado ?: 'N/A' }}</td>
                                        <td style="white-space: nowrap;">
                                            <a href="{{ route('asientos.show', $asiento->idAsiento) }}" class="btn btn-sm btn-info" style="margin-right: 5px;">Ver</a>
                                            <a href="{{ route('asientos.edit', $asiento->idAsiento) }}" class="btn btn-sm btn-warning" style="margin-right: 5px;">Editar</a>
                                            <form action="{{ route('asientos.destroy', $asiento->idAsiento) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de eliminar este asiento?')">Eliminar</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">No hay asientos registrados.</td>
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
