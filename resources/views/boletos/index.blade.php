@extends('layouts.app')

@section('page-title', 'Lista de Boletos')

@section('content')
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Boletos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    
    <style>
        /* Variables de color (Usaremos Cyan/Turquesa para Boletos) */
        :root {
            --color-primary: #00BCD4; /* Cyan Oscuro Material Design */
            --color-primary-light: #4DD0E1;
            --color-success: #38a169; /* Verde (Precio Total) */
            --color-warning: #d69e2e; /* Naranja (Descuento/Impuesto/Editar) */
            --color-danger: #E53E3E; /* Rojo (Eliminar) */
            --color-text-muted: #6c757d;
        }

        .material-card {
            box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.14), 0 7px 10px -5px rgba(33, 33, 33, 0.4);
            border-radius: 6px;
            margin-bottom: 30px;
            background-color: white;
            padding: 0; 
        }

        .material-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 8px 16px;
            font-size: 0.9rem;
            font-weight: 500;
            text-align: center;
            white-space: nowrap;
            vertical-align: middle;
            user-select: none;
            border: 1px solid transparent;
            border-radius: 4px;
            transition: all 0.15s ease-in-out;
            text-decoration: none;
            color: white;
        }

        .material-btn-primary {
            background: linear-gradient(135deg, var(--color-primary), var(--color-primary-light));
            border-color: var(--color-primary);
        }

        .material-btn-primary:hover {
            opacity: 0.9;
            color: white;
        }

        #tablaBoletos thead th {
            background-color: #f0f0f0;
            font-weight: 600;
            color: #333;
        }
    </style>
</head>
<body>
<div class="container-fluid pt-4">
    <div class="row">
        <div class="col-12">
            <div class="material-card">
                {{-- Card Header con Título (Estilo Material) --}}
                <div class="card-header d-flex justify-content-between align-items-center" style="background: linear-gradient(135deg, var(--color-primary), var(--color-primary-light)); color: white; border: none; padding: 24px;">
                    <h3 class="card-title mb-0" style="font-weight: 600; font-size: 1.5rem;">
                        <i class="material-icons" style="vertical-align: middle; margin-right: 12px;">confirmation_number</i>
                        Gestión de Boletos
                    </h3>
                    <div class="card-tools">
                        @if(auth()->user()->role === 'operador')
                        {{-- Botón Nuevo Boleto con estilo degradado --}}
                        <a href="{{ route('boletos.create') }}" class="material-btn material-btn-primary">
                            <i class="material-icons" style="font-size: 1rem; margin-right: 8px;">add</i>
                            Nuevo Boleto
                        </a>
                        @endif
                    </div>
                </div>
                
                <div class="card-body" style="padding: 0;">
                    @if(session('success'))
                        <div class="alert alert-success d-flex align-items-center" style="margin: 20px; margin-bottom: 0;">
                            <i class="material-icons me-2" style="vertical-align: middle;">check_circle</i>
                            {{ session('success') }}
                        </div>
                    @endif

                    <table id="tablaBoletos" class="table table-striped w-100">
                        <thead>
                            <tr>
                                <th>ID Boleto</th>
                                <th>Vuelo / Pasajero</th>
                                <th>Fecha Compra</th>
                                <th>Precio Unit.</th>
                                <th>Cant.</th>
                                <th>Descuento</th>
                                <th>Impuesto</th>
                                <th>Total</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($boletos as $boleto)
                            <tr>
                                <td style="font-weight: 600; color: var(--color-primary);">{{ $boleto->idBoleto }}</td>
                                <td>
                                    {{-- Combinamos ID Vuelo e ID Pasajero para ser más compacto --}}
                                    <strong style="color: var(--color-primary-light);">Vuelo: {{ $boleto->idVuelo }}</strong>
                                    <br>
                                    <span style="font-size: 0.9em; color: var(--color-text-muted);">Pasajero: {{ $boleto->idPasajero }}</span>
                                </td>
                                <td>
                                    {{-- Formato de fecha de compra --}}
                                    {{ $boleto->FechaCompra ? \Carbon\Carbon::parse($boleto->FechaCompra)->format('d/m/Y') : 'N/A' }}
                                </td>
                                <td style="font-weight: 500;">
                                    Q{{ number_format($boleto->Precio ?? 0, 2) }}
                                </td>
                                <td>
                                    <span class="badge" style="background-color: #f0f0f0; color: #333; font-weight: 600;">
                                        {{ $boleto->Cantidad }}
                                    </span>
                                </td>
                                <td style="font-weight: 600; color: var(--color-warning);">
                                    Q{{ number_format($boleto->Descuento ?? 0, 2) }}
                                </td>
                                <td style="font-weight: 600; color: var(--color-warning);">
                                    Q{{ number_format($boleto->Impuesto ?? 0, 2) }}
                                </td>
                                <td style="font-weight: 700; color: var(--color-success); font-size: 1.15rem;">
                                    Q{{ number_format($boleto->Total ?? 0, 2) }}
                                </td>
                                <td style="white-space: nowrap;">
                                    <div class="btn-group" role="group">
                                        {{-- Botón Ver --}}
                                        <a href="{{ route('boletos.show', $boleto->idBoleto) }}" class="material-btn material-btn-primary" style="padding: 6px 12px; font-size: 0.8rem; margin-right: 4px;">
                                            <i class="material-icons" style="font-size: 1rem;">visibility</i>
                                        </a>
                                        
                                        @if(auth()->user()->role === 'operador')
                                        {{-- Botón Editar --}}
                                        <a href="{{ route('boletos.edit', $boleto->idBoleto) }}" class="material-btn" style="background: linear-gradient(135deg, var(--color-warning), #ed8936); color: white; padding: 6px 12px; font-size: 0.8rem; margin-right: 4px;">
                                            <i class="material-icons" style="font-size: 1rem;">edit</i>
                                        </a>
                                        {{-- Botón Eliminar --}}
                                        <form action="{{ route('boletos.destroy', $boleto->idBoleto) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="material-btn" style="background: linear-gradient(135deg, var(--color-danger), #f56565); color: white; padding: 6px 12px; font-size: 0.8rem; border: none;" onclick="return confirm('¿Estás seguro de eliminar este boleto?')">
                                                <i class="material-icons" style="font-size: 1rem;">delete</i>
                                            </button>
                                        </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="9" class="text-center" style="padding: 40px; color: var(--color-text-muted); font-style: italic;">
                                    <i class="material-icons" style="font-size: 3rem; opacity: 0.5; display: block; margin-bottom: 16px;">confirmation_number</i>
                                    No hay boletos registrados.
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>
$(document).ready(function() {
    // Inicializar DataTables con opciones en español y responsive
    $('#tablaBoletos').DataTable({
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
        },
        responsive: true,
        pageLength: 10,
        lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "Todos"]],
        columnDefs: [
            { orderable: false, targets: -1 } // Deshabilita la ordenación en la columna de Acciones
        ],
        scrollX: true 
    });
});
</script>
@endsection