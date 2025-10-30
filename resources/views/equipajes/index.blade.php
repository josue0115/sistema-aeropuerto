@extends('layouts.app')

@section('page-title', 'Lista de Equipajes')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="material-card">
                <div class="card-header" style="background: linear-gradient(135deg, var(--color-primary), var(--color-primary-light)); color: white; border: none; padding: 24px;">
                    <h3 class="card-title mb-0" style="font-weight: 600; font-size: 1.5rem;">
                        <i class="material-icons" style="vertical-align: middle; margin-right: 12px;">luggage</i>
                        Gestión de Equipajes
                    </h3>
                    <div class="card-tools">
                        <a href="{{ route('equipajes.create') }}" class="material-btn material-btn-primary">
                            <i class="material-icons" style="font-size: 1rem; margin-right: 8px;">add</i>
                            Nuevo Equipaje
                        </a>
                    </div>
                </div>
                <div class="card-body" style="padding: 0;">
                    <table id="tablaEquipajes" class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>ID Boleto</th>
                                <th>Costo</th>
                                <th>Dimensiones</th>
                                <th>Peso</th>
                                <th>Monto Total</th>
                                <th>Costo Extra</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($equipajes ?? [] as $equipaje)
                                <tr>
                                    <td>{{ $equipaje->idEquipaje }}</td>
                                    <td>{{ $equipaje->idBoleto }}</td>
                                    <td style="font-weight: 600; color: var(--color-success);">
                                        Q{{ number_format($equipaje->Costo ?? 0, 2) }}
                                    </td>
                                    <td>{{ $equipaje->Dimensiones }}</td>
                                    <td>{{ $equipaje->Peso ?? 'N/A' }} kg</td>
                                    <td style="font-weight: 600; color: var(--color-primary); font-size: 1.1rem;">
                                        Q{{ number_format($equipaje->Monto ?? 0, 2) }}
                                    </td>
                                    <td style="color: var(--color-warning);">
                                        Q{{ number_format($equipaje->CostoExtra ?? 0, 2) }}
                                    </td>
                                    <td>
                                        <span class="badge" style="background: {{ $equipaje->Estado == 'Entregado' ? 'linear-gradient(135deg, #38a169, #48bb78)' : ($equipaje->Estado == 'EnTransito' ? 'linear-gradient(135deg, #d69e2e, #ed8936)' : ($equipaje->Estado == 'Registrado' ? 'linear-gradient(135deg, #4299e1, #3182ce)' : 'linear-gradient(135deg, #e53e3e, #f56565)')) }}; color: white; padding: 6px 12px; border-radius: 20px; font-weight: 500;">
                                            {{ $equipaje->Estado ?? 'N/A' }}
                                        </span>
                                    </td>
                                    <td style="white-space: nowrap;">
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('equipajes.show', $equipaje->idEquipaje) }}" class="material-btn material-btn-primary" style="padding: 6px 12px; font-size: 0.8rem; margin-right: 4px;">
                                                <i class="material-icons" style="font-size: 1rem;">visibility</i>
                                            </a>
                                            <a href="{{ route('equipajes.edit', $equipaje->idEquipaje) }}" class="material-btn" style="background: linear-gradient(135deg, #d69e2e, #ed8936); color: white; padding: 6px 12px; font-size: 0.8rem; margin-right: 4px;">
                                                <i class="material-icons" style="font-size: 1rem;">edit</i>
                                            </a>
                                            <form action="{{ route('equipajes.destroy', $equipaje->idEquipaje) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="material-btn" style="background: linear-gradient(135deg, #e53e3e, #f56565); color: white; padding: 6px 12px; font-size: 0.8rem; border: none;" onclick="return confirm('¿Está seguro de eliminar este equipaje?')">
                                                    <i class="material-icons" style="font-size: 1rem;">delete</i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center" style="padding: 40px; color: var(--color-text-muted); font-style: italic;">
                                        <i class="material-icons" style="font-size: 3rem; opacity: 0.5; display: block; margin-bottom: 16px;">luggage</i>
                                        No hay equipajes registrados.
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
    $('#tablaEquipajes').DataTable({
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
