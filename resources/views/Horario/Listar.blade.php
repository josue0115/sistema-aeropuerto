@extends('layouts.app')

@section('page-title', 'Lista de Horarios')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Lista de Horarios</h1>

    <!-- Botón para crear -->
    <a href="{{ route('horario.create') }}" class="btn btn-primary mb-3">Agregar Horario</a>

    <!-- Tabla -->
    <table id="tablaHorarios" class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Vuelo</th>
                <th>Hora Salida</th>
                <th>Hora Llegada</th>
                <th>Tiempo Espera (min)</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($horarios as $horario)
            <tr>
                <td>{{ $horario->IdHorario }}</td>
                <td>{{ $horario->vuelo->IdVuelo ?? 'N/A' }} - {{ $horario->vuelo->aeropuertoOrigen->NombreAeropuerto ?? 'N/A' }} → {{ $horario->vuelo->aeropuertoDestino->NombreAeropuerto ?? 'N/A' }}</td>
                <td>{{ $horario->HoraSalida }}</td>
                <td>{{ $horario->HoraLlegada }}</td>
                <td>{{ $horario->TiempoEspera }}</td>
                <td>{{ $horario->Estado }}</td>
                <td>
                    <a href="{{ route('horario.show', $horario) }}" class="btn btn-info btn-sm">Ver</a>
                    <a href="{{ route('horario.edit', $horario) }}" class="btn btn-warning btn-sm">Editar</a>
                    <a href="{{ route('horario.delete', $horario) }}" class="btn btn-danger btn-sm">Eliminar</a>
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
    $('#tablaHorarios').DataTable({
        "language": {
            "lengthMenu": "Mostrar _MENU_ entradas",
            "zeroRecords": "No se encontraron resultados",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ entradas",
            "infoEmpty": "Mostrando 0 a 0 de 0 entradas",
            "infoFiltered": "(filtrado de _MAX_ entradas totales)",
            "search": "Buscar:",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            }
        }
    });
});
</script>
@endsection
