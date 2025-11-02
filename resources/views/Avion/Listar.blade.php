@extends('layouts.app')

@section('page-title', 'Lista de Aviones')

@section('content')
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Aviones</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <style>
        /* Variables de color */
        :root {
            --color-primary: #007bff; /* Azul de Aviones */
            --color-primary-light: #6aa8fc;
            --color-secondary: #6c757d;
            --color-accent: #17a2b8; /* Turquesa para Capacidad */
            --color-success: #28a745; /* Verde */
            --color-danger: #dc3545; /* Rojo */
            --color-warning: #ffc107; /* Amarillo */
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

        .material-modal .modal-header {
            background-color: var(--color-danger);
            color: white;
            border-bottom: none;
        }
    </style>
</head>
<body>
<div class="container-fluid pt-4">
    <div class="row">
        <div class="col-12">
            <div class="material-card">
                {{-- Card Header con Título --}}
                <div class="card-header d-flex justify-content-between align-items-center" style="background: linear-gradient(135deg, var(--color-primary), var(--color-primary-light)); color: white; border: none; padding: 24px;">
                    <h3 class="card-title mb-0" style="font-weight: 600; font-size: 1.5rem;">
                        <i class="material-icons" style="vertical-align: middle; margin-right: 12px;">flight_takeoff</i>
                        Gestión de Aviones
                    </h3>
                    <div class="card-tools">
                        @if(auth()->user()->role !== 'admin')
                        <a href="{{ route('avion.create') }}" class="material-btn material-btn-primary">
                            <i class="material-icons" style="font-size: 1rem; margin-right: 8px;">add_box</i>
                            Agregar Avión
                        </a>
                        @endif
                    </div>
                </div>
                
                {{-- Card Body con Tabla --}}
                <div class="card-body" style="padding: 0;">
                    <table id="tablaAviones" class="table table-striped w-100">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Aerolínea</th>
                                <th>Placa</th>
                                <th>Tipo/Modelo</th>
                                <th>Capacidad</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($aviones ?? [] as $avion)
                            @if (is_null($avion) || is_null($avion->IdAvion) || empty($avion->IdAvion))
                                @continue
                            @endif
                            <tr>
                                <td>{{ $avion->IdAvion }}</td>
                                <td>{{ $avion->aerolinea->NombreAerolinea ?? 'N/A' }}</td>
                                <td style="font-weight: 600; color: var(--color-primary);">{{ $avion->Placa }}</td>
                                <td>
                                    <span class="badge bg-secondary me-1">{{ $avion->Tipo }}</span> 
                                    {{ $avion->Modelo }}
                                </td>
                                <td style="font-weight: 600; color: var(--color-accent); text-align: center;">
                                    {{ $avion->Capacidad }} <i class="bi bi-person-fill" style="vertical-align: middle;"></i>
                                </td>
                                <td>
                                    @php
                                        $estadoStyles = match($avion->Estado) {
                                            'Operativo' => 'linear-gradient(135deg, #28a745, #49ad61)', // Verde
                                            'Mantenimiento' => 'linear-gradient(135deg, #ffc107, #ffcd39)', // Amarillo
                                            'Inactivo' => 'linear-gradient(135deg, #6c757d, #8f969d)', // Gris
                                            default => 'linear-gradient(135deg, #007bff, #42a5f5)' 
                                        };
                                    @endphp
                                    <span class="badge" style="background: {{ $estadoStyles }}; color: white; padding: 6px 12px; border-radius: 20px; font-weight: 500;">
                                        {{ $avion->Estado }}
                                    </span>
                                </td>
                                <td style="white-space: nowrap;">
                                    <div class="btn-group" role="group">
                                        {{-- Botón Ver --}}
                                        <a href="{{ route('avion.show', $avion) }}" class="material-btn material-btn-primary" style="padding: 6px 12px; font-size: 0.8rem; margin-right: 4px;">
                                            <i class="bi bi-eye" style="font-size: 1rem;"></i>
                                        </a>
                                        
                                        @if(auth()->user()->role !== 'admin')
                                        {{-- Botón Editar --}}
                                        <a href="{{ route('avion.edit', $avion) }}" class="material-btn" style="background: linear-gradient(135deg, #ffc107, #ffcd39); color: white; padding: 6px 12px; font-size: 0.8rem; margin-right: 4px;">
                                            <i class="bi bi-pencil-square" style="font-size: 1rem;"></i>
                                        </a>
                                        {{-- Botón Eliminar (Abre Modal) --}}
                                        <button type="button" class="material-btn" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $avion->IdAvion }}" style="background: linear-gradient(135deg, #dc3545, #e05e6b); color: white; padding: 6px 12px; font-size: 0.8rem; border: none;">
                                            <i class="bi bi-trash" style="font-size: 1rem;"></i>
                                        </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center" style="padding: 40px; color: var(--color-text-muted); font-style: italic;">
                                    <i class="material-icons" style="font-size: 3rem; opacity: 0.5; display: block; margin-bottom: 16px;">airplane_ticket</i>
                                    No hay aviones registrados en este momento.
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

@foreach($aviones ?? [] as $avion)
@if (is_null($avion) || is_null($avion->IdAvion) || empty($avion->IdAvion))
    @continue
@endif
<div class="modal fade material-modal" id="deleteModal{{ $avion->IdAvion }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $avion->IdAvion }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel{{ $avion->IdAvion }}">
                    <i class="material-icons me-2" style="vertical-align: middle;">warning</i>
                    Confirmar Eliminación de Avión
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="lead text-danger">⚠️ **Atención:** Está a punto de eliminar el avión **{{ $avion->Placa }}**.</p>
                <p>¿Estás seguro de que deseas continuar? Esta acción no se puede deshacer.</p>
                <hr>
                <div class="row small text-muted">
                    <div class="col-6 mb-2"><strong>ID Avión:</strong> {{ $avion->IdAvion }}</div>
                    <div class="col-6 mb-2"><strong>Aerolínea:</strong> {{ $avion->aerolinea->NombreAerolinea ?? '-' }}</div>
                    <div class="col-6 mb-2"><strong>Tipo:</strong> {{ $avion->Tipo }}</div>
                    <div class="col-6 mb-2"><strong>Modelo:</strong> {{ $avion->Modelo }}</div>
                    <div class="col-6 mb-2"><strong>Capacidad:</strong> {{ $avion->Capacidad }}</div>
                    <div class="col-6 mb-2"><strong>Estado:</strong> {{ $avion->Estado }}</div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <form action="{{ route('avion.destroy', $avion) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="material-btn" style="background: var(--color-danger);">
                        <i class="bi bi-trash me-1"></i> Eliminar Permanentemente
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>
$(document).ready(function() {
    // Inicializar DataTables con opciones en español y responsive
    $('#tablaAviones').DataTable({
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