@extends('layouts.app')

@section('page-title', 'Lista de Asientos')

@section('content')
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Asientos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    
    <style>
        /* Variables de color */
        :root {
            --color-primary: #1976D2; /* Azul Material Design */
            --color-primary-light: #42A5F5;
            --color-secondary: #607D8B; /* Gris pizarra para la clase */
            --color-accent: #90A4AE;
            --color-success: #38a169; /* Verde (Disponible) */
            --color-danger: #E53E3E; /* Rojo (Ocupado/Eliminar) */
            --color-warning-dark: #d69e2e; /* Naranja (Reservado/Editar) */
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

        #tablaAsientos thead th {
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
                        <i class="material-icons" style="vertical-align: middle; margin-right: 12px;">event_seat</i>
                        Gestión de Asientos
                    </h3>
                    <div class="card-tools">
                        @if(auth()->user()->role === 'operador')
                        {{-- Botón Nuevo Asiento con estilo degradado --}}
                        <a href="{{ route('asientos.create') }}" class="material-btn material-btn-primary">
                            <i class="material-icons" style="font-size: 1rem; margin-right: 8px;">add</i>
                            Nuevo Asiento
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

                    <table id="tablaAsientos" class="table table-striped w-100">
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
                                    <td>{{ $asiento->vuelo_info ?? 'N/A' }}</td>
                                    <td style="font-weight: 600; color: var(--color-primary);">{{ $asiento->NumeroAsiento }}</td>
                                    <td>
                                        @php
    $claseColor = match($asiento->Clase) {
        'Primera' => '#FFC107', // Amarillo
        'Ejecutiva' => '#4CAF50', // Verde
        'Económica' => '#2196F3', // Azul
        default => 'var(--color-secondary)' // CORRECCIÓN: Se usa la variable CSS como una cadena.
    };
@endphp
                                        <span class="badge" style="background-color: {{ $claseColor }}; color: white; padding: 6px 12px; border-radius: 20px; font-weight: 500;">
                                            {{ $asiento->Clase ?: 'N/A' }}
                                        </span>
                                    </td>
                                    <td>
                                        {{-- Badge para el Estado --}}
                                        @php
                                            $estadoStyles = match($asiento->Estado) {
                                                'Disponible' => 'linear-gradient(135deg, var(--color-success), #48bb78)',
                                                'Reservado' => 'linear-gradient(135deg, var(--color-warning-dark), #ed8936)',
                                                'Ocupado' => 'linear-gradient(135deg, var(--color-danger), #f56565)',
                                                default => 'linear-gradient(135deg, #718096, #a0aec0)' 
                                            };
                                        @endphp
                                        <span class="badge" style="background: {{ $estadoStyles }}; color: white; padding: 6px 12px; border-radius: 20px; font-weight: 500;">
                                            {{ $asiento->Estado ?: 'N/A' }}
                                        </span>
                                    </td>
                                    <td style="white-space: nowrap;">
                                        <div class="btn-group" role="group">
                                            {{-- Botón Ver --}}
                                            <a href="{{ route('asientos.show', $asiento->idAsiento) }}" class="material-btn material-btn-primary" style="padding: 6px 12px; font-size: 0.8rem; margin-right: 4px;">
                                                <i class="material-icons" style="font-size: 1rem;">visibility</i>
                                            </a>
                                            
                                            @if(auth()->user()->role === 'operador')
                                            {{-- Botón Editar --}}
                                            <a href="{{ route('asientos.edit', $asiento->idAsiento) }}" class="material-btn" style="background: linear-gradient(135deg, var(--color-warning-dark), #ed8936); color: white; padding: 6px 12px; font-size: 0.8rem; margin-right: 4px;">
                                                <i class="material-icons" style="font-size: 1rem;">edit</i>
                                            </a> 
                                            {{-- Botón Eliminar --}}
                                            <form action="{{ route('asientos.destroy', $asiento->idAsiento) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="material-btn" style="background: linear-gradient(135deg, var(--color-danger), #f56565); color: white; padding: 6px 12px; font-size: 0.8rem; border: none;" onclick="return confirm('¿Estás seguro de eliminar este asiento?')">
                                                    <i class="material-icons" style="font-size: 1rem;">delete</i>
                                                </button>
                                            </form>
                                            @endif
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>
$(document).ready(function() {
    // Inicializar DataTables con opciones en español y responsive
    $('#tablaAsientos').DataTable({
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