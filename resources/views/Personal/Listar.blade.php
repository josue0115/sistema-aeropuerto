@extends('layouts.app')

@section('page-title', 'Lista de Personal')

@section('content')
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Personal</title>
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
                        <i class="material-icons" style="vertical-align: middle; margin-right: 12px;">group</i>
                        Gestión de Personal
                    </h3>
                    <div class="card-tools">
                        @if(auth()->user()->role !== 'admin')
                        <a href="{{ route('personal.create') }}" class="material-btn material-btn-primary">
                            <i class="material-icons" style="font-size: 1rem; margin-right: 8px;">person_add</i>
                            Agregar Personal
                        </a>
                        @endif
                    </div>
                </div>
                <div class="card-body" style="padding: 0;">
                    <table id="tablaPersonal" class="table table-striped w-100">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Cargo</th>
                                <th>Fecha Ingreso</th>
                                <th>Salario</th>
                                <th>Estado</th>
                                <th>Teléfono</th>
                                <th>Correo</th>
                                <th>Dirección</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($personal ?? [] as $p)
                            <tr>
                                <td>{{ $p->IdPersonal }}</td>
                                <td>{{ $p->Nombre }}</td>
                                <td>{{ $p->Apellido }}</td>
                                <td>{{ $p->Cargo }}</td>
                                <td>{{ $p->FechaIngreso ? \Carbon\Carbon::parse($p->FechaIngreso)->format('d/m/Y') : 'N/A' }}</td>
                                <td style="font-weight: 600; color: var(--color-success); font-size: 1.1rem; white-space: nowrap;">
                                     Q{{ number_format($p->Salario ?? 0, 2) }}
                                </td>
                                <td>
                                    @php
                                        $estado = $p->Estado ?? 'Inactivo';
                                        $color = '';
                                        if ($estado == 'Activo') {
                                            $color = 'linear-gradient(135deg, #38a169, #48bb78)'; // Verde
                                        } elseif ($estado == 'Inactivo') {
                                            $color = 'linear-gradient(135deg, #e53e3e, #f56565)'; // Rojo
                                        } else {
                                            $color = 'linear-gradient(135deg, #d69e2e, #ed8936)'; // Naranja para otros
                                        }
                                    @endphp
                                    <span class="badge" style="background: {{ $color }}; color: white; padding: 6px 12px; border-radius: 20px; font-weight: 500;">
                                        {{ $estado }}
                                    </span>
                                </td>
                                <td>{{ $p->Telefono }}</td>
                                <td>{{ $p->Correo }}</td>
                                <td>{{ $p->Direccion }}</td>
                                <td style="white-space: nowrap;">
                                    <div class="btn-group" role="group">
                                        {{-- Botón Ver --}}
                                        <a href="{{ route('personal.show', $p->IdPersonal) }}" class="material-btn material-btn-primary" style="padding: 6px 12px; font-size: 0.8rem; margin-right: 4px;">
                                            <i class="material-icons" style="font-size: 1rem;">visibility</i>
                                        </a>

                                        @if(auth()->user()->role !== 'admin')
                                        {{-- Botón Editar --}}
                                        <a href="{{ route('personal.edit', $p->IdPersonal) }}" class="material-btn" style="background: linear-gradient(135deg, var(--color-secondary), var(--color-accent)); color: white; padding: 6px 12px; font-size: 0.8rem; margin-right: 4px;">
                                            <i class="material-icons" style="font-size: 1rem;">edit</i>
                                        </a>
                                        
                                        <a href="{{ route('personal.delete', $p->IdPersonal) }}"
                                            class="material-btn"
                                            style="background: linear-gradient(135deg, var(--color-danger), #f56565); color: white; padding: 6px 12px; font-size: 0.8rem;"
                                            >
                                            <i class="material-icons" style="font-size: 1rem;">delete</i>
                                            </a>
                                         @endif                 

                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="11" class="text-center" style="padding: 40px; color: var(--color-text-muted); font-style: italic;">
                                    <i class="material-icons" style="font-size: 3rem; opacity: 0.5; display: block; margin-bottom: 16px;">people_outline</i>
                                    No hay personal registrado.
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
    $('#tablaPersonal').DataTable({
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
        },
        responsive: true,
        pageLength: 10,
        lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "Todos"]],
        columnDefs: [
            { orderable: false, targets: -1 } // Deshabilita la ordenación en la columna de Acciones
        ],
        // Mantiene el scrollX activado para la tabla de personal que tiene más columnas
        scrollX: true 
    });
});
</script>
@endsection