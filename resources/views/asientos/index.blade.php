@extends('layouts.app')

@section('page-title', 'Lista de Asientos')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="material-card">
                <div class="card-header" style="background: linear-gradient(135deg, var(--color-primary), var(--color-primary-light)); color: white; border: none; padding: 24px;">
                    <h3 class="card-title mb-0" style="font-weight: 600; font-size: 1.5rem;">
                        <i class="material-icons" style="vertical-align: middle; margin-right: 12px;">event_seat</i>
                        Gestión de Asientos
                    </h3>
                    <div class="card-tools">
                        <a href="{{ route('asientos.create') }}" class="material-btn material-btn-primary">
                            <i class="material-icons" style="font-size: 1rem; margin-right: 8px;">add</i>
                            Nuevo Asiento
                        </a>
                    </div>
                </div>
                <div class="card-body" style="padding: 0;">
                    @if(session('success'))
                        <div class="alert alert-success" style="margin: 20px; margin-bottom: 0;">
                            <i class="material-icons" style="vertical-align: middle; margin-right: 8px;">check_circle</i>
                            {{ session('success') }}
                        </div>
                    @endif

                    <table id="tablaAsientos" class="table table-striped">
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
                                    <td style="font-weight: 600; color: var(--color-primary);">{{ $asiento->NumeroAsiento }}</td>
                                    <td>
                                        <span class="badge" style="background: linear-gradient(135deg, var(--color-secondary), var(--color-accent)); color: white; padding: 6px 12px; border-radius: 20px; font-weight: 500;">
                                            {{ $asiento->Clase ?: 'N/A' }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge" style="background: {{ $asiento->Estado == 'Disponible' ? 'linear-gradient(135deg, #38a169, #48bb78)' : ($asiento->Estado == 'Reservado' ? 'linear-gradient(135deg, #d69e2e, #ed8936)' : 'linear-gradient(135deg, #e53e3e, #f56565)') }}; color: white; padding: 6px 12px; border-radius: 20px; font-weight: 500;">
                                            {{ $asiento->Estado ?: 'N/A' }}
                                        </span>
                                    </td>
                                    <td style="white-space: nowrap;">
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('asientos.show', $asiento->idAsiento) }}" class="material-btn material-btn-primary" style="padding: 6px 12px; font-size: 0.8rem; margin-right: 4px;">
                                                <i class="material-icons" style="font-size: 1rem;">visibility</i>
                                            </a>
                                            <a href="{{ route('asientos.edit', $asiento->idAsiento) }}" class="material-btn" style="background: linear-gradient(135deg, #d69e2e, #ed8936); color: white; padding: 6px 12px; font-size: 0.8rem; margin-right: 4px;">
                                                <i class="material-icons" style="font-size: 1rem;">edit</i>
                                            </a>
                                            <form action="{{ route('asientos.destroy', $asiento->idAsiento) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="material-btn" style="background: linear-gradient(135deg, #e53e3e, #f56565); color: white; padding: 6px 12px; font-size: 0.8rem; border: none;" onclick="return confirm('¿Estás seguro de eliminar este asiento?')">
                                                    <i class="material-icons" style="font-size: 1rem;">delete</i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center" style="padding: 40px; color: var(--color-text-muted); font-style: italic;">
                                        <i class="material-icons" style="font-size: 3rem; opacity: 0.5; display: block; margin-bottom: 16px;">event_seat</i>
                                        No hay asientos registrados.
                                    </td>
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

@section('scripts')
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>
$(document).ready(function() {
    $('#tablaAsientos').DataTable({
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
        },
        responsive: true,
        pageLength: 10,
        lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "Todos"]],
        columnDefs: [
            { orderable: false, targets: -1 }
        ]
    });
});
</script>
@endsection
