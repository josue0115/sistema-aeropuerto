@extends('layouts.app')

@section('page-title', 'Reporte de Boletos Facturados')

@section('content')
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Boletos Facturados</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    
    <style>
        /* Variables de color (Usaremos Indigo para Reportes y Naranja para la ganancia) */
        :root {
            --color-primary: #303F9F; /* Indigo Oscuro Material Design */
            --color-primary-light: #5C6BC0;
            --color-financial: #F57C00; /* Deep Orange para Total Facturado */
            --color-success: #48BB78;
            --color-text-muted: #6c757d;
            --color-background-light: #F8F9FA;
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
            cursor: pointer;
        }

        .report-header {
            /* Encabezado con degradado Indigo */
            background: linear-gradient(135deg, var(--color-primary), var(--color-primary-light));
            color: white;
            border: none;
            padding: 24px;
            border-top-left-radius: 6px;
            border-top-right-radius: 6px;
            margin-bottom: 20px;
        }
        
        /* Estilos específicos de la tabla de Reportes */
        .report-table thead th {
            background-color: var(--color-background-light);
            font-weight: 600;
            color: #333;
            border-bottom: 2px solid var(--color-primary-light);
            text-transform: uppercase;
            font-size: 0.8rem;
            padding: 12px 24px;
        }

        .report-table tbody td {
            font-size: 0.9rem;
            padding: 12px 24px;
            vertical-align: middle;
        }

        /* Scrollbar personalizado para la tabla */
        .table-scroll-container {
            overflow-x: auto;
            overflow-y: auto;
            max-height: 500px; /* Altura máxima para la tabla */
            border-radius: 6px;
            border: 1px solid #dee2e6;
        }

        .table-scroll-container::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        .table-scroll-container::-webkit-scrollbar-thumb {
            background-color: #9ca3af;
            border-radius: 4px;
        }
        .table-scroll-container::-webkit-scrollbar-track {
            background-color: #f3f4f6;
        }
    </style>
</head>
<body>
<div class="container-fluid pt-4">
    <div class="row">
        <div class="col-12">
            <div class="material-card">
                {{-- Card Header con Título (Estilo Material) --}}
                <div class="report-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title mb-0" style="font-weight: 600; font-size: 1.5rem;">
                        <i class="material-icons" style="vertical-align: middle; margin-right: 12px;">receipt_long</i>
                        Reporte de Boletos Facturados
                    </h3>
                    {{-- Botón Volver a Reportes --}}
                    <!-- <a href="{{ route('reportes.index') }}" class="material-btn" style="background: rgba(255, 255, 255, 0.2); border: 1px solid white;">
                        <i class="material-icons" style="font-size: 1rem; margin-right: 8px;">arrow_back</i>
                        Volver a Reportes
                    </a> -->
                </div>
                
                <div class="card-body" style="padding: 24px;">
                    <p class="text-secondary mb-4">Análisis de la facturación de boletos dentro del período de tiempo seleccionado.</p>

                    <form method="POST" action="{{ route('reportes.boletos-facturados.generar') }}" class="p-4 rounded-lg mb-5" style="background-color: var(--color-background-light); border: 1px solid #dee2e6;">
                        @csrf
                        <div class="row g-3 align-items-end">
                            <div class="col-md-3">
                                <label for="fecha_inicio" class="form-label text-sm font-weight-bold text-secondary mb-1">Fecha Inicio</label>
                                <input type="date" id="fecha_inicio" name="fecha_inicio" value="{{ old('fecha_inicio', $fechaInicio ?? date('Y-m-d', strtotime('-30 days'))) }}"
                                    class="form-control" required style="border: 1px solid #ced4da;">
                            </div>
                            <div class="col-md-3">
                                <label for="fecha_fin" class="form-label text-sm font-weight-bold text-secondary mb-1">Fecha Fin</label>
                                <input type="date" id="fecha_fin" name="fecha_fin" value="{{ old('fecha_fin', $fechaFin ?? date('Y-m-d')) }}"
                                    class="form-control" required style="border: 1px solid #ced4da;">
                            </div>
                            <div class="col-md-6 d-flex space-x-2">
                                {{-- Botón Buscar --}}
                                <button type="submit" class="material-btn flex-grow-1 me-2" style="background: linear-gradient(135deg, var(--color-primary), var(--color-primary-light));">
                                    <i class="material-icons" style="font-size: 1rem; margin-right: 8px;">search</i>
                                    Buscar Reporte
                                </button>
                                {{-- Botón Exportar Excel --}}
                                <button type="button" onclick="exportFacturados()" class="material-btn flex-grow-1" style="background: linear-gradient(135deg, var(--color-financial), #FF9800);">
                                    <i class="material-icons" style="font-size: 1rem; margin-right: 8px;">download</i>
                                    Descargar Excel
                                </button>
                            </div>
                        </div>
                    </form>

                    @if(isset($reporteFacturados))
                        {{-- Resumen Financiero --}}
                        @if($reporteFacturados->count() > 0)
                            <div class="mt-4 text-sm bg-light p-4 rounded-lg mb-4" style="border: 1px dashed #ced4da;">
                                <div class="row">
                                    <div class="col-md-4">
                                        <strong style="color: var(--color-primary);">Boletos Facturados:</strong> 
                                        <span class="badge bg-secondary">{{ $reporteFacturados->count() }}</span>
                                    </div>
                                    <div class="col-md-4">
                                        <strong style="color: var(--color-primary);">Período:</strong> 
                                        <span class="badge bg-secondary">{{ \Carbon\Carbon::parse($fechaInicio)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($fechaFin)->format('d/m/Y') }}</span>
                                    </div>
                                    <div class="col-md-4 text-md-end">
                                        <strong style="color: var(--color-financial); font-size: 1.1rem;">Total Facturado:</strong> 
                                        <span class="badge" style="background-color: var(--color-financial); font-size: 1.1rem; font-weight: 700;">
                                            ${{ number_format($reporteFacturados->sum('Precio'), 2) }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endif

                        {{-- Tabla de resultados --}}
                        <div class="table-scroll-container">
                            <table class="report-table table table-hover w-100 mb-0">
                                <thead class="sticky-top">
                                    <tr>
                                        <th>ID Boleto</th>
                                        <th>Cliente</th>
                                        <th>Vuelo (ID)</th>
                                        <th>Fecha Compra</th>
                                        <th class="text-end">Precio Facturado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($reporteFacturados as $boleto)
                                        <tr>
                                            <td class="font-weight-bold" style="color: var(--color-primary);">{{ $boleto->IdBoleto }}</td>
                                            <td><i class="material-icons" style="font-size: 1rem; vertical-align: middle; margin-right: 4px;">person</i> {{ $boleto->Nombre }} {{ $boleto->Apellido }}</td>
                                            <td><i class="material-icons" style="font-size: 1rem; vertical-align: middle; margin-right: 4px; color: var(--color-text-muted);">flight_takeoff</i> Vuelo **{{ $boleto->IdVuelo }}**</td>
                                            <td>{{ \Carbon\Carbon::parse($boleto->FechaCompra)->format('d/m/Y H:i') }}</td>
                                            <td class="text-end font-weight-bold" style="color: var(--color-financial); font-size: 1rem;">${{ number_format($boleto->Precio, 2) }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center" style="padding: 40px; color: var(--color-text-muted); font-style: italic;">
                                                <i class="material-icons" style="font-size: 3rem; opacity: 0.5; display: block; margin-bottom: 16px;">money_off</i>
                                                No se encontraron boletos facturados en el período seleccionado.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>

{{-- Script de Exportar --}}
<script>
function exportFacturados() {
    const fechaInicio = document.getElementById('fecha_inicio').value;
    const fechaFin = document.getElementById('fecha_fin').value;
    // Usamos el helper de ruta de Laravel para mayor seguridad y robustez
    const url = `{{ route('reportes.boletos-facturados.exportar') }}?fecha_inicio=${fechaInicio}&fecha_fin=${fechaFin}`;
    window.location.href = url;
}
</script>
@endsection