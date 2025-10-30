@extends('layouts.app')

@section('page-title', 'Lista de Boletos')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="material-card">
                <div class="card-header" style="background: linear-gradient(135deg, var(--color-primary), var(--color-primary-light)); color: white; border: none; padding: 24px;">
                    <h3 class="card-title mb-0" style="font-weight: 600; font-size: 1.5rem;">
                        <i class="material-icons" style="vertical-align: middle; margin-right: 12px;">confirmation_number</i>
                        Gestión de Boletos
                    </h3>
                    <div class="card-tools">
                        <a href="{{ route('boletos.create') }}" class="material-btn material-btn-primary">
                            <i class="material-icons" style="font-size: 1rem; margin-right: 8px;">add</i>
                            Nuevo Boleto
                        </a>
                    </div>
                </div>
                <div class="card-body" style="padding: 0;">
                    <table id="tablaBoletos" class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID Boleto</th>
                                <th>ID Vuelo</th>
                                <th>ID Pasajero</th>
                                <th>Fecha Compra</th>
                                <th>Precio</th>
                                <th>Cantidad</th>
                                <th>Descuento</th>
                                <th>Impuesto</th>
                                <th>Total</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($boletos as $boleto)
                            <tr>
                                <td>{{ $boleto->idBoleto }}</td>
                                <td>{{ $boleto->idVuelo }}</td>
                                <td>{{ $boleto->idPasajero }}</td>
                                <td>{{ $boleto->FechaCompra ? \Carbon\Carbon::parse($boleto->FechaCompra)->format('d/m/Y') : 'N/A' }}</td>
                                <td style="font-weight: 600; color: var(--color-success);">
                                    Q{{ number_format($boleto->Precio ?? 0, 2) }}
                                </td>
                                <td>{{ $boleto->Cantidad }}</td>
                                <td style="font-weight: 600; color: var(--color-warning);">
                                    Q{{ number_format($boleto->Descuento ?? 0, 2) }}
                                </td>
                                <td style="font-weight: 600; color: var(--color-warning);">
                                    Q{{ number_format($boleto->Impuesto ?? 0, 2) }}
                                </td>
                                <td style="font-weight: 600; color: var(--color-success); font-size: 1.1rem;">
                                    Q{{ number_format($boleto->Total ?? 0, 2) }}
                                </td>
                                <td style="white-space: nowrap;">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('boletos.show', $boleto->idBoleto) }}" class="material-btn material-btn-primary" style="padding: 6px 12px; font-size: 0.8rem; margin-right: 4px;">
                                            <i class="material-icons" style="font-size: 1rem;">visibility</i>
                                        </a>
                                        <a href="{{ route('boletos.edit', $boleto->idBoleto) }}" class="material-btn" style="background: linear-gradient(135deg, #d69e2e, #ed8936); color: white; padding: 6px 12px; font-size: 0.8rem; margin-right: 4px;">
                                            <i class="material-icons" style="font-size: 1rem;">edit</i>
                                        </a>
                                        <form action="{{ route('boletos.destroy', $boleto->idBoleto) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="material-btn" style="background: linear-gradient(135deg, #e53e3e, #f56565); color: white; padding: 6px 12px; font-size: 0.8rem; border: none;" onclick="return confirm('¿Estás seguro de eliminar este boleto?')">
                                                <i class="material-icons" style="font-size: 1rem;">delete</i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
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
    $('#tablaBoletos').DataTable({
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
