@extends('layouts.app')

@section('page-title', 'Lista de Aerolíneas')

@section('content')
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Aerolíneas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <style>
        /* Variables de color */
        :root {
            --color-primary: #8E24AA; /* Púrpura */
            --color-primary-light: #AB47BC;
            --color-accent: #FFC107; /* Amarillo para IATA */
            --color-success: #38a169; /* Verde */
            --color-danger: #E53E3E; /* Rojo */
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

        #tablaAerolineas thead th {
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
                {{-- Card Header con Título --}}
                <div class="card-header d-flex justify-content-between align-items-center" style="background: linear-gradient(135deg, var(--color-primary), var(--color-primary-light)); color: white; border: none; padding: 24px;">
                    <h3 class="card-title mb-0" style="font-weight: 600; font-size: 1.5rem;">
                        <i class="material-icons" style="vertical-align: middle; margin-right: 12px;">flight_class</i>
                        Gestión de Aerolíneas
                    </h3>
                    <div class="card-tools">
                        @if(auth()->user()->role !== 'admin')
                        <a href="{{ route('aerolinea.create') }}" class="material-btn material-btn-primary">
                            <i class="material-icons" style="font-size: 1rem; margin-right: 8px;">add_circle</i>
                            Agregar Aerolínea
                        </a>
                        @endif
                    </div>
                </div>
                
                {{-- Card Body con Tabla --}}
                <div class="card-body" style="padding: 0;">
                    <table id="tablaAerolineas" class="table table-striped w-100">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>IATA</th>
                                <th>Sede (Ciudad/País)</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($aerolineas ?? [] as $aero)
                            <tr>
                                <td>{{ $aero->IdAerolinea }}</td>
                                <td style="font-weight: 600; color: var(--color-primary);">{{ $aero->NombreAerolinea }}</td>
                                <td style="font-weight: 600; color: #333; text-align: center;">
                                    <span class="badge" style="background-color: var(--color-accent); color: #333; padding: 6px 10px;">
                                        {{ $aero->IATA }}
                                    </span>
                                </td>
                                <td>{{ $aero->Ciudad }}, {{ $aero->Pais }}</td>
                                <td>
                                    @php
                                        $estadoStyles = match($aero->Estado) {
                                            'Activa' => 'linear-gradient(135deg, #38a169, #48bb78)', // Verde
                                            'Inactiva' => 'linear-gradient(135deg, #e53e3e, #f56565)', // Rojo
                                            'Suspendida' => 'linear-gradient(135deg, #d69e2e, #ed8936)', // Naranja
                                            default => 'linear-gradient(135deg, #718096, #a0aec0)' // Gris
                                        };
                                    @endphp
                                    <span class="badge" style="background: {{ $estadoStyles }}; color: white; padding: 6px 12px; border-radius: 20px; font-weight: 500;">
                                        {{ $aero->Estado }}
                                    </span>
                                </td>
                                <td style="white-space: nowrap;">
                                    <div class="btn-group" role="group">
                                        {{-- Botón Ver --}}
                                        <a href="{{ route('aerolinea.show', $aero) }}" class="material-btn material-btn-primary" style="padding: 6px 12px; font-size: 0.8rem; margin-right: 4px;">
                                            <i class="bi bi-eye" style="font-size: 1rem;"></i>
                                        </a>
                                        
                                        @if(auth()->user()->role !== 'admin')
                                        {{-- Botón Editar --}}
                                        <a href="{{ route('aerolinea.edit', $aero) }}" class="material-btn" style="background: linear-gradient(135deg, #d69e2e, #ed8936); color: white; padding: 6px 12px; font-size: 0.8rem; margin-right: 4px;">
                                            <i class="bi bi-pencil-square" style="font-size: 1rem;"></i>
                                        </a>
                                        {{-- Botón Eliminar --}}
                                        <a href="{{ route('aerolinea.delete', $aero) }}" class="material-btn" style="background: linear-gradient(135deg, #e53e3e, #f56565); color: white; padding: 6px 12px; font-size: 0.8rem; border: none;" onclick="return confirm('¿Está seguro de eliminar esta aerolínea?')">
                                            <i class="bi bi-trash" style="font-size: 1rem;"></i>
                                        </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center" style="padding: 40px; color: var(--color-text-muted); font-style: italic;">
                                    <i class="material-icons" style="font-size: 3rem; opacity: 0.5; display: block; margin-bottom: 16px;">luggage</i>
                                    No hay aerolíneas registradas en el sistema.
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
$(document).ready(function() {
    // Inicializar DataTables con opciones en español y responsive
    $('#tablaAerolineas').DataTable({
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