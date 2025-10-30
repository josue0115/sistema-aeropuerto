@extends('layouts.app')

@section('page-title', 'Lista de Reservas')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="material-card">
                <div class="card-header" style="background: linear-gradient(135deg, var(--color-primary), var(--color-primary-light)); color: white; border: none; padding: 24px;">
                    <h3 class="card-title mb-0" style="font-weight: 600; font-size: 1.5rem;">
                        <i class="material-icons" style="vertical-align: middle; margin-right: 12px;">event_available</i>
                        Gestión de Reservas
                    </h3>
                    <div class="card-tools">
                        <a href="{{ route('reservas.create') }}" class="material-btn material-btn-primary">
                            <i class="material-icons" style="font-size: 1rem; margin-right: 8px;">add</i>
                            Nueva Reserva
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

                    <table id="tablaReservas" class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID Reserva</th>
                                <th>ID Pasajero</th>
                                <th>ID Vuelo</th>
                                <th>Fecha Reserva</th>
                                <th>Fecha Vuelo</th>
                                <th>Monto Anticipado</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($reservas as $reserva)
                                <tr>
                                    <td>{{ $reserva->idReserva }}</td>
                                    <td>{{ $reserva->idPasajero }}</td>
                                    <td>{{ $reserva->idVuelo }}</td>
                                    <td>{{ $reserva->FechaReserva ? \Carbon\Carbon::parse($reserva->FechaReserva)->format('d/m/Y H:i') : 'N/A' }}</td>
                                    <td>{{ $reserva->FechaVuelo ? \Carbon\Carbon::parse($reserva->FechaVuelo)->format('d/m/Y H:i') : 'N/A' }}</td>
                                    <td style="font-weight: 600; color: var(--color-success);">
                                        Q{{ number_format($reserva->MontoAnticipado ?? 0, 2) }}
                                    </td>
                                    <td>
                                        <span class="badge" style="background: {{ $reserva->Estado == 'Confirmada' ? 'linear-gradient(135deg, #38a169, #48bb78)' : ($reserva->Estado == 'Pendiente' ? 'linear-gradient(135deg, #d69e2e, #ed8936)' : 'linear-gradient(135deg, #e53e3e, #f56565)') }}; color: white; padding: 6px 12px; border-radius: 20px; font-weight: 500;">
                                            {{ $reserva->Estado ?? 'N/A' }}
                                        </span>
                                    </td>
                                    <td style="white-space: nowrap;">
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('reservas.show', $reserva->idReserva) }}" class="material-btn material-btn-primary" style="padding: 6px 12px; font-size: 0.8rem; margin-right: 4px;">
                                                <i class="material-icons" style="font-size: 1rem;">visibility</i>
                                            </a>
                                            <a href="{{ route('reservas.edit', $reserva->idReserva) }}" class="material-btn" style="background: linear-gradient(135deg, #d69e2e, #ed8936); color: white; padding: 6px 12px; font-size: 0.8rem; margin-right: 4px;">
                                                <i class="material-icons" style="font-size: 1rem;">edit</i>
                                            </a>
                                            <form action="{{ route('reservas.destroy', $reserva->idReserva) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="material-btn" style="background: linear-gradient(135deg, #e53e3e, #f56565); color: white; padding: 6px 12px; font-size: 0.8rem; border: none;" onclick="return confirm('¿Estás seguro de eliminar esta reserva?')">
                                                    <i class="material-icons" style="font-size: 1rem;">delete</i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center" style="padding: 40px; color: var(--color-text-muted); font-style: italic;">
                                        <i class="material-icons" style="font-size: 3rem; opacity: 0.5; display: block; margin-bottom: 16px;">event_available</i>
                                        No hay reservas registradas.
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
    $('#tablaReservas').DataTable({
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
