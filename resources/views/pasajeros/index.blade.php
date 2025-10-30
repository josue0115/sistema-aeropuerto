@extends('layouts.app')

@section('page-title', 'Lista de Pasajeros')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="material-card">
                <div class="card-header" style="background: linear-gradient(135deg, var(--color-primary), var(--color-primary-light)); color: white; border: none; padding: 24px;">
                    <h3 class="card-title mb-0" style="font-weight: 600; font-size: 1.5rem;">
                        <i class="material-icons" style="vertical-align: middle; margin-right: 12px;">people</i>
                        Gestión de Pasajeros
                    </h3>
                    <div class="card-tools">
                        <a href="{{ route('pasajeros.create') }}" class="material-btn material-btn-primary">
                            <i class="material-icons" style="font-size: 1rem; margin-right: 8px;">add</i>
                            Nuevo Pasajero
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

                    <table id="tablaPasajeros" class="table table-striped">
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
                                    <td style="font-weight: 600;">{{ $pasajero->Nombre }}</td>
                                    <td style="font-weight: 600;">{{ $pasajero->Apellido }}</td>
                                    <td>{{ $pasajero->Pais }}</td>
                                    <td>
                                        <span class="badge" style="background: linear-gradient(135deg, var(--color-secondary), var(--color-accent)); color: white; padding: 6px 12px; border-radius: 20px; font-weight: 500;">
                                            {{ $pasajero->TipoPasajero ?? 'N/A' }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge" style="background: {{ $pasajero->Estado == 'Activo' ? 'linear-gradient(135deg, #38a169, #48bb78)' : 'linear-gradient(135deg, #e53e3e, #f56565)' }}; color: white; padding: 6px 12px; border-radius: 20px; font-weight: 500;">
                                            {{ $pasajero->Estado ?? 'N/A' }}
                                        </span>
                                    </td>
                                    <td style="white-space: nowrap;">
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('pasajeros.show', $pasajero->idPasajero) }}" class="material-btn material-btn-primary" style="padding: 6px 12px; font-size: 0.8rem; margin-right: 4px;">
                                                <i class="material-icons" style="font-size: 1rem;">visibility</i>
                                            </a>
                                            <a href="{{ route('pasajeros.edit', $pasajero->idPasajero) }}" class="material-btn" style="background: linear-gradient(135deg, #d69e2e, #ed8936); color: white; padding: 6px 12px; font-size: 0.8rem; margin-right: 4px;">
                                                <i class="material-icons" style="font-size: 1rem;">edit</i>
                                            </a>
                                            <form action="{{ route('pasajeros.destroy', $pasajero->idPasajero) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="material-btn" style="background: linear-gradient(135deg, #e53e3e, #f56565); color: white; padding: 6px 12px; font-size: 0.8rem; border: none;" onclick="return confirm('¿Estás seguro de eliminar este pasajero?')">
                                                    <i class="material-icons" style="font-size: 1rem;">delete</i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center" style="padding: 40px; color: var(--color-text-muted); font-style: italic;">
                                        <i class="material-icons" style="font-size: 3rem; opacity: 0.5; display: block; margin-bottom: 16px;">people</i>
                                        No hay pasajeros registrados.
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
    $('#tablaPasajeros').DataTable({
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
