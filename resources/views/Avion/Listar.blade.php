@extends('layouts.app')

@section('page-title', 'Lista de Aviones')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Lista de Aviones</h1>

    <!-- Botón para ir a página de crear -->
    <a href="{{ route('avion.create') }}" class="btn btn-primary mb-3">Agregar Avión</a>

    <!-- Tabla de aviones -->
    <table id="tablaAviones" class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Aerolínea</th>
                <th>Placa</th>
                <th>Tipo</th>
                <th>Modelo</th>
                <th>Capacidad</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($aviones as $avion)
            <tr>
                <td>{{ $avion->idAvion }}</td>
                <td>{{ $avion->aerolinea->Nombre ?? '-' }}</td>
                <td>{{ $avion->Placa }}</td>
                <td>{{ $avion->Tipo }}</td>
                <td>{{ $avion->Modelo }}</td>
                <td>{{ $avion->Capacidad }}</td>
                <td>{{ $avion->Estado }}</td>
                <td>
                    <a href="{{ route('avion.show', $avion) }}" class="btn btn-info btn-sm">Ver</a>
                    <a href="{{ route('avion.edit', $avion) }}" class="btn btn-warning btn-sm">Editar</a>
                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $avion->idAvion }}">Eliminar</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

  <!-- Modales de eliminación -->
@foreach($aviones as $avion)
<div class="modal fade" id="deleteModal{{ $avion->idAvion }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $avion->idAvion }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel{{ $avion->idAvion }}">Confirmar Eliminación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>¿Estás seguro de que deseas eliminar este avión?</p>
                <div class="row">
                    <!-- Todos los campos usan col-6 para una distribución de 2 columnas (6 + 6 = 12) -->
                    <div class="col-6 mb-3">
                        <label>ID Avión</label>
                        <input type="text" class="form-control" value="{{ $avion->idAvion }}" readonly>
                    </div>
                    <div class="col-6 mb-3">
                        <label>Aerolínea</label>
                        <input type="text" class="form-control" value="{{ $avion->aerolinea->Nombre ?? '-' }}" readonly>
                    </div>
                    <div class="col-6 mb-3">
                        <label>Placa</label>
                        <input type="text" class="form-control" value="{{ $avion->Placa }}" readonly>
                    </div>
                    <div class="col-6 mb-3">
                        <label>Tipo</label>
                        <input type="text" class="form-control" value="{{ $avion->Tipo }}" readonly>
                    </div>
                    <div class="col-6 mb-3">
                        <label>Modelo</label>
                        <input type="text" class="form-control" value="{{ $avion->Modelo }}" readonly>
                    </div>
                    <div class="col-6 mb-3">
                        <label>Capacidad</label>
                        <input type="text" class="form-control" value="{{ $avion->Capacidad }}" readonly>
                    </div>
                    <div class="col-6 mb-3">
                        <label>Estado</label>
                        <input type="text" class="form-control" value="{{ $avion->Estado }}" readonly>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <form action="{{ route('avion.destroy', $avion) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach


</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>
$(document).ready(function() {
    $('#tablaAviones').DataTable();
});
</script>
@endsection
