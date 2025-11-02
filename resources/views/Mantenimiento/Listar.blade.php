@extends('layouts.app')

@section('page-title', 'Lista de Mantenimientos')

@section('content')
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Mantenimientos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    
    <style>
        /* Variables de color de ejemplo (ajusta a tu tema real si tienes) */
        :root {
            --color-primary: #1976D2; /* Azul */
            --color-primary-light: #42A5F5;
            --color-secondary: #FFC107; /* Amarillo */
            --color-accent: #FF9800; /* Naranja */
            --color-success: #38a169; /* Verde */
            --color-danger: #E53E3E; /* Rojo */
            --color-info: #00BCD4; /* Turquesa/Cyan */
            --color-text-muted: #6c757d;
        }

        .material-card {
            box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.14), 0 7px 10px -5px rgba(33, 33, 33, 0.4);
            border-radius: 6px;
            margin-bottom: 30px;
            background-color: white;
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
            transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
            text-decoration: none;
        }

        .material-btn-primary {
            color: white;
            background: linear-gradient(135deg, var(--color-primary), var(--color-primary-light));
            border-color: var(--color-primary);
        }

        .material-btn-primary:hover {
            color: white;
            background: var(--color-primary);
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="material-card">
                <div class="card-header d-flex justify-content-between align-items-center" style="background: linear-gradient(135deg, var(--color-primary), var(--color-primary-light)); color: white; border: none; padding: 24px;">
                    <h3 class="card-title mb-0" style="font-weight: 600; font-size: 1.5rem;">
                        <i class="material-icons" style="vertical-align: middle; margin-right: 12px;">build</i>
                        Gestión de Mantenimientos
                    </h3>
                    <div class="card-tools">
                        <a href="{{ route('mantenimiento.create') }}" class="material-btn material-btn-primary">
                            <i class="material-icons" style="font-size: 1rem; margin-right: 8px;">add_circle_outline</i>
                            Agregar Mantenimiento
                        </a>
                    </div>
                </div>
                <div class="card-body" style="padding: 0;">
                    <table id="tablaMantenimientos" class="table table-striped w-100">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Avión</th>
                                <th>Personal</th>
                                <th>Fecha Ingreso</th>
                                <th>Fecha Salida</th>
                                <th>Tipo</th>
                                <th>Estado</th>
                                <th>Costo</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($mantenimientos ?? [] as $mantenimiento)
                            {{-- ** SOLUCIÓN: Saltar o Ignorar si el objeto mantenimiento es nulo o si Id_mantenimiento es nulo o vacío ** --}}
                            @if (is_null($mantenimiento) || is_null($mantenimiento->Id_mantenimiento) || empty($mantenimiento->Id_mantenimiento))
                                @continue
                            @endif
                            <tr>
                                <td>{{ $mantenimiento->Id_mantenimiento }}</td>
                                <td style="font-weight: 500;">
                                    {{ $mantenimiento->avion->Placa ?? 'N/A' }} 
                                    <span style="color: var(--color-text-muted); font-size: 0.85rem;">({{ $mantenimiento->avion->IdAvion ?? 'N/A' }})</span>
                                </td>
                                <td>{{ $mantenimiento->personal->Nombre ?? 'N/A' }} {{ $mantenimiento->personal->Apellido ?? 'N/A' }}</td>
                                <td>{{ $mantenimiento->FechaIngreso ? \Carbon\Carbon::parse($mantenimiento->FechaIngreso)->format('d/m/Y') : 'N/A' }}</td>
                                <td>{{ $mantenimiento->FechaSalida ? \Carbon\Carbon::parse($mantenimiento->FechaSalida)->format('d/m/Y') : 'N/A' }}</td>
                                <td>
                                    @php
                                        $tipo = $mantenimiento->Tipo ?? 'General';
                                        $color = ($tipo == 'Preventivo') ? '#00BCD4' : (($tipo == 'Correctivo') ? '#E53E3E' : '#718096');
                                    @endphp
                                    <span class="badge" style="background-color: {{ $color }}; color: white; padding: 6px 12px; border-radius: 20px; font-weight: 500;">
                                        {{ $tipo }}
                                    </span>
                                </td>
                                <td>
                                    @php
                                        $estado = $mantenimiento->Estado ?? 'Pendiente';
                                        $color = '';
                                        if ($estado == 'Completado') {
                                            $color = 'linear-gradient(135deg, #38a169, #48bb78)'; // Verde
                                        } elseif ($estado == 'En Proceso') {
                                            $color = 'linear-gradient(135deg, #d69e2e, #ed8936)'; // Naranja
                                        } else {
                                            $color = 'linear-gradient(135deg, #718096, #a0aec0)'; // Gris para Pendiente
                                        }
                                    @endphp
                                    <span class="badge" style="background: {{ $color }}; color: white; padding: 6px 12px; border-radius: 20px; font-weight: 500;">
                                        {{ $estado }}
                                    </span>
                                </td>
                                <td style="font-weight: 600; color: var(--color-danger); font-size: 1.1rem; white-space: nowrap;">
                                    Q{{ number_format(($mantenimiento->Costo ?? 0) + ($mantenimiento->CostoExtra ?? 0), 2) }}
                                </td>
                                <td style="white-space: nowrap;">
                                    <div class="btn-group" role="group">
                                        {{-- Botón Ver --}}
                                        <a href="{{ route('mantenimiento.show', $mantenimiento) }}" class="material-btn material-btn-primary" style="padding: 6px 12px; font-size: 0.8rem; margin-right: 4px;">
                                            <i class="material-icons" style="font-size: 1rem;">visibility</i>
                                        </a>

                                        {{-- Botón Editar --}}
                                        <a href="{{ route('mantenimiento.edit', $mantenimiento) }}" class="material-btn" style="background: linear-gradient(135deg, var(--color-secondary), var(--color-accent)); color: white; padding: 6px 12px; font-size: 0.8rem; margin-right: 4px;">
                                            <i class="material-icons" style="font-size: 1rem;">edit</i>
                                        </a>
                                        
                                        {{-- Botón Eliminar (Usando formulario con método DELETE) --}}
                                        <form action="{{ route('mantenimiento.destroy', $mantenimiento) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="material-btn" style="background: linear-gradient(135deg, var(--color-danger), #f56565); color: white; padding: 6px 12px; font-size: 0.8rem; border: none;" onclick="return confirm('¿Está seguro de eliminar este registro de mantenimiento?')">
                                                <i class="material-icons" style="font-size: 1rem;">delete</i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="9" class="text-center" style="padding: 40px; color: var(--color-text-muted); font-style: italic;">
                                    <i class="material-icons" style="font-size: 3rem; opacity: 0.5; display: block; margin-bottom: 16px;">gavel</i>
                                    No hay registros de mantenimiento.
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
{{-- Script para Bootstrap no es necesario si ya está en el layout principal, pero lo dejo por si acaso --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
$(document).ready(function() {
    $('#tablaMantenimientos').DataTable({
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
        },
        responsive: true,
        pageLength: 10,
        lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "Todos"]],
        columnDefs: [
            { orderable: false, targets: -1 } // Deshabilita la ordenación en la columna de Acciones
        ],
        scrollX: true // Útil para tablas con muchas columnas
    });
});
</script>
@endsection