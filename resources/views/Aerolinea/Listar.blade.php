@extends('layouts.app')

@section('page-title', 'Lista de Aerolíneas')

@section('content')
<div class="container mt-4">
    <h1>Lista de Aerolíneas</h1>

    <!-- Botón para ir a página de crear -->
    <a href="{{ route('aerolinea.create') }}" class="btn btn-primary mb-3">Agregar Aerolínea</a>

    <table id="tablaAerolineas" class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>IATA</th>
                <th>Ciudad</th>
                <th>País</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($aerolineas as $aero)
            <tr>
                <td>{{ $aero->idAerolinea }}</td>
                <td>{{ $aero->Nombre }}</td>
                <td>{{ $aero->IATA }}</td>
                <td>{{ $aero->Ciudad }}</td>
                <td>{{ $aero->Pais }}</td>
                <td>{{ $aero->Estado }}</td>
                <td>
                    <a href="{{ route('aerolinea.show', $aero->idAerolinea) }}" class="btn btn-info btn-sm">Ver</a>
                    <a href="{{ route('aerolinea.edit', $aero->idAerolinea) }}" class="btn btn-warning btn-sm">Editar</a>
                    <a href="{{ route('aerolinea.delete', $aero->idAerolinea) }}" class="btn btn-danger btn-sm">Eliminar</a>
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
    $('#tablaAerolineas').DataTable();
});
</script>
@endsection
