@extends('layouts.app')

@section('page-title', 'Lista de Vuelos')

@section('styles')
<!-- Tailwind CSS CDN -->
<script src="https://cdn.tailwindcss.com"></script>
<script>
    // Configuración para usar la fuente Inter (recomendado por Tailwind)
    tailwind.config = {
        theme: {
            extend: {
                fontFamily: {
                    sans: ['Inter', 'sans-serif'],
                },
            }
        }
    }
</script>
<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
<!-- DataTables CSS (básico sin Bootstrap) -->
<!-- <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/jquery.dataTables.min.css" /> -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css"> <!-- Añadido CSS DataTables -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

<style>
    /* Opcional: pequeños ajustes para que DataTables se vea mejor con Tailwind */
    table.dataTable thead {
        background-color: #1f2937; /* bg-gray-800 */
        color: white;
    }
    table.dataTable.no-footer {
        border-bottom: none;
    }
    table.dataTable tbody tr:hover {
        background-color: #f9fafb; /* bg-gray-50 */
    }
    /* Ajuste de paginación para que encaje con Tailwind */
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        padding: 0.25rem 0.5rem;
        margin-left: 0.25rem;
        margin-right: 0.25rem;
        border-radius: 0.375rem;
        border: 1px solid transparent;
        background: transparent;
        color: #6366f1; /* indigo-500 */
        cursor: pointer;
        transition: background-color 0.3s ease;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button.current,
    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        background-color: #6366f1; /* indigo-500 */
        color: white !important;
        border: 1px solid #4f46e5; /* indigo-600 */
    }
</style>
@endsection

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-8">
    <h1 class="text-3xl font-extrabold text-violet-700 mb-6">Gestión de Vuelos</h1>

    <a href="{{ route('vuelo.create') }}" 
       class="inline-flex items-center bg-gradient-to-tl from-indigo-500 via-purple-600 to-purple-700
              hover:from-indigo-600 hover:via-purple-700 hover:to-purple-800
              text-white font-bold py-2 px-4 rounded-lg shadow-lg transition duration-300 mb-4">
        <i class="bi bi-plus-circle mr-2"></i> Agregar Nuevo Vuelo
    </a>

    <div class="bg-white shadow-xl overflow-hidden rounded-xl">
        <div class="p-6">
            <div class="overflow-x-auto">
                <table id="tablaVuelos" class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th class="px-6 py-3 text-center text-xs font-medium uppercase tracking-wider">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Avión</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Origen</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Destino</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Fecha Salida</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Fecha Llegada</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Precio</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Estado</th>
                            <th class="px-6 py-3 text-center text-xs font-medium uppercase tracking-wider">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($vuelos as $vuelo)
                        <tr class="hover:bg-gray-50 transition duration-150">
                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-bold text-gray-900">{{ $vuelo->idVuelo }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ data_get($vuelo, 'avion.Placa', 'N/A') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ data_get($vuelo, 'aeropuertoOrigen.NombreAeropuerto', 'N/A') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ data_get($vuelo, 'aeropuertoDestino.NombreAeropuerto', 'N/A') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ \Carbon\Carbon::parse($vuelo->FechaSalida)->format('d/m/Y H:i') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $vuelo->FechaLlegada ? \Carbon\Carbon::parse($vuelo->FechaLlegada)->format('d/m/Y H:i') : 'N/A' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800"><strong>Q{{ number_format($vuelo->Precio, 2) }}</strong></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                @php
                                    $badgeClass = match($vuelo->Estado) {
                                        'Programado' => 'bg-green-100 text-green-800',
                                        'Confirmado' => 'bg-violet-100 text-violet-800',
                                        'Cancelado' => 'bg-red-100 text-red-800',
                                        'Retrasado' => 'bg-amber-100 text-amber-800',
                                        default => 'bg-gray-100 text-gray-800'
                                    };
                                @endphp
                                <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium {{ $badgeClass }}">{{ $vuelo->Estado }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                @if(!empty($vuelo->idVuelo))
                                <div class="flex items-center justify-center space-x-2">
                                    <a href="{{ route('vuelo.show', $vuelo->idVuelo) }}" class="text-violet-600 hover:text-violet-900 p-2 rounded-full hover:bg-violet-50 transition duration-150" title="Ver detalles">
                                        <i class="bi bi-eye text-lg"></i>
                                    </a>
                                    <a href="{{ route('vuelo.edit', $vuelo->idVuelo) }}" class="text-sky-600 hover:text-sky-900 p-2 rounded-full hover:bg-sky-50 transition duration-150" title="Editar">
                                        <i class="bi bi-pencil text-lg"></i>
                                    </a>
                                    <a href="{{ route('vuelo.delete', $vuelo->idVuelo) }}" class="text-red-600 hover:text-red-900 p-2 rounded-full hover:bg-red-50 transition duration-150" title="Eliminar">
                                        <i class="bi bi-trash text-lg"></i>
                                    </a>
                                </div>
                                @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">ID Faltante</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="px-6 py-4 text-center text-sm text-gray-500">
                                <i class="bi bi-x-circle mr-1"></i> No hay vuelos registrados en este momento.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script> <!-- Versión estable y actual -->

<!-- Tailwind CSS CDN -->
<script src="https://cdn.tailwindcss.com"></script>

<script>
$(document).ready(function() {
    $('#tablaVuelos').DataTable({
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
        },
        pageLength: 10,
        order: [[0, 'desc']],
        responsive: true,
        autoWidth: false
    });
});
</script>
@endsection
