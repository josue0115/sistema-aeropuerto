@extends('layouts.app')

@section('page-title', 'Lista de Escalas')

@section('content')
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Escalas</title>
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
                        <i class="material-icons" style="vertical-align: middle; margin-right: 12px;">connecting_airports</i>
                        Gestión de Escalas
                    </h3>
                    <div class="card-tools">
                        @if(auth()->user()->role === 'operador')                                    
                        <a href="{{ route('escala.create') }}" class="material-btn material-btn-primary">
                            <i class="material-icons" style="font-size: 1rem; margin-right: 8px;">add</i>
                            Nueva Escala
                        </a>
                        @endif
                    </div>
                </div>
                <div class="card-body" style="padding: 0;">
                    <table id="tablaEscalas" class="table table-striped w-100">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Vuelo (Origen → Destino)</th>
                                <th>Aeropuerto</th>
                                <th>Hora Salida</th>
                                <th>Hora Llegada</th>
                                <th>Tiempo Espera</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($escalas ?? [] as $escala)
                                {{-- Saltar si el objeto escala es nulo o si IdEscala es nulo o vacío --}}
                                @if (is_null($escala) || is_null($escala->IdEscala) || empty($escala->IdEscala))
                                    @continue
                                @endif
                                <tr>
                                    <td>{{ $escala->IdEscala }}</td>
                                    <td style="font-weight: 500;">
                                        <span class="badge" style="background-color: #f0f0f0; color: #333; padding: 4px 8px;">Vuelo: {{ data_get($escala, 'vuelo.IdVuelo', 'N/A') }}</span>
                                        <br>
                                        <span style="font-size: 0.9em; color: var(--color-text-muted);">
                                            {{ data_get($escala, 'vuelo.aeropuertoOrigen.NombreAeropuerto', 'N/A') }} 
                                            <i class="material-icons" style="font-size: 0.8rem; vertical-align: middle;">arrow_forward</i>
                                            {{ data_get($escala, 'vuelo.aeropuertoDestino.NombreAeropuerto', 'N/A') }}
                                        </span>
                                    </td>
                                    <td>
                                        <span style="font-weight: 500;">
                                            {{ data_get($escala, 'aeropuerto.NombreAeropuerto', 'N/A') }}
                                        </span>
                                        <span style="font-size: 0.8em; color: var(--color-text-muted);">
                                            ({{ data_get($escala, 'aeropuerto.IdAeropuerto', 'N/A') }})
                                        </span>
                                    </td>
                                    <td style="white-space: nowrap;">{{ \Carbon\Carbon::parse($escala->HoraSalida)->format('d/m/Y H:i') }}</td>
                                    <td style="white-space: nowrap;">{{ \Carbon\Carbon::parse($escala->HoraLlegada)->format('d/m/Y H:i') }}</td>
                                    <td style="font-weight: 600; color: var(--color-accent); font-size: 1.1rem; text-align: center;">
                                        {{ $escala->TiempoEspera }} min
                                    </td>
                                    <td>
                                        @php
                                            $estadoStyles = match($escala->Estado) {
                                                'Programado' => 'linear-gradient(135deg, #38a169, #48bb78)', // Verde
                                                'Confirmado' => 'linear-gradient(135deg, #805ad5, #9f7aea)', // Púrpura
                                                'Cancelado' => 'linear-gradient(135deg, #e53e3e, #f56565)',   // Rojo
                                                'Retrasado' => 'linear-gradient(135deg, #d69e2e, #ed8936)', // Naranja
                                                'Completado' => 'linear-gradient(135deg, #3182ce, #4299e1)', // Azul Claro
                                                default => 'linear-gradient(135deg, #718096, #a0aec0)'     // Gris
                                            };
                                        @endphp
                                        <span class="badge" style="background: {{ $estadoStyles }}; color: white; padding: 6px 12px; border-radius: 20px; font-weight: 500;">
                                            {{ $escala->Estado }}
                                        </span>
                                    </td>
                                    <td style="white-space: nowrap;">
                                        <div class="btn-group" role="group">
                                            {{-- Botón Ver --}}
                                            <a href="{{ route('escala.show', $escala->IdEscala) }}" class="material-btn material-btn-primary" style="padding: 6px 12px; font-size: 0.8rem; margin-right: 4px;">
                                                <i class="material-icons" style="font-size: 1rem;">visibility</i>
                                            </a>
                                            
                                            @if(auth()->user()->role === 'operador')
                                            {{-- Botón Editar --}}
                                            <a href="{{ route('escala.edit', $escala->IdEscala) }}" class="material-btn" style="background: linear-gradient(135deg, #d69e2e, #ed8936); color: white; padding: 6px 12px; font-size: 0.8rem; margin-right: 4px;">
                                                <i class="material-icons" style="font-size: 1rem;">edit</i>
                                            </a>
                                            {{-- Botón Eliminar --}}
                                            <a href="{{ route('escala.destroy', $escala->IdEscala) }}" class="material-btn" style="background: linear-gradient(135deg, #e53e3e, #f56565); color: white; padding: 6px 12px; font-size: 0.8rem; border: none;" onclick="return confirm('¿Está seguro de eliminar esta escala?')">
                                                <i class="material-icons" style="font-size: 1rem;">delete</i>
                                            </a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center" style="padding: 40px; color: var(--color-text-muted); font-style: italic;">
                                        <i class="material-icons" style="font-size: 3rem; opacity: 0.5; display: block; margin-bottom: 16px;">connecting_airports</i>
                                        No hay escalas registradas en este momento.
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
<script src="https://code.jquery.com/jquery-3.7.1.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
{{-- Script para Bootstrap no es necesario si ya está en el layout principal, pero lo dejo por si acaso --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
$(document).ready(function() {
    $('#tablaEscalas').DataTable({
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
</body>
</html>