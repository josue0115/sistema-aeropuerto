@extends('layouts.app')

@section('page-title', 'Lista de Personal')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Lista de Personal</h1>

    <!-- Botón Agregar Personal -->
    <a href="{{ route('personal.create') }}" class="btn btn-primary mb-3">Agregar Personal</a>

    <!-- Tabla de Personal -->
    <table id="tablaPersonal" class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Cargo</th>
                <th>Fecha Ingreso</th>
                <th>Salario</th>
                <th>Estado</th>
                <th>Teléfono</th>
                <th>Correo</th>
                <th>Dirección</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($personal as $p)
            <tr>
                <td>{{ $p->IdPersonal }}</td>
                <td>{{ $p->Nombre }}</td>
                <td>{{ $p->Apellido }}</td>
                <td>{{ $p->Cargo }}</td>
                <td>{{ $p->FechaIngreso }}</td>
                <td>Q{{ number_format($p->Salario, 2) }}</td>
                <td>{{ $p->Estado }}</td>
                <td>{{ $p->Telefono }}</td>
                <td>{{ $p->Correo }}</td>
                <td>{{ $p->Direccion }}</td>
                <td>
                    <a href="{{ route('personal.show', $p->IdPersonal) }}" class="btn btn-info btn-sm">Ver</a>
                    <a href="{{ route('personal.edit', $p->IdPersonal) }}" class="btn btn-warning btn-sm">Editar</a>
                    <a href="{{ route('personal.delete', $p->IdPersonal) }}" class="btn btn-danger btn-sm">Eliminar</a>
                </td>
            </tr>

            @endforeach
        </tbody>
    </table>
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>
$(document).ready(function() {
    $('#tablaPersonal').DataTable();
});
</script>
@endsection
