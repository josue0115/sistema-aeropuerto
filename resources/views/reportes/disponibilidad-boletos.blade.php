@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Reporte de Disponibilidad de Boletos</h1>
            <a href="{{ route('reportes.index') }}"
               class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Volver a Reportes
            </a>
        </div>

        <p class="text-gray-600 mb-6">Reporte de disponibilidad de boletos por vuelo y fecha</p>

        <!-- Formulario de filtros -->
        <form method="POST" action="{{ route('reportes.disponibilidad-boletos.generar') }}" class="mb-6 bg-gray-50 p-4 rounded-lg">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label for="fecha" class="block text-sm font-medium text-gray-700 mb-2">Fecha</label>
                    <input type="date" id="fecha" name="fecha" value="{{ old('fecha', isset($fecha) ? $fecha : date('Y-m-d')) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div>
                    <label for="id_vuelo" class="block text-sm font-medium text-gray-700 mb-2">Vuelo (Opcional)</label>
                    <select id="id_vuelo" name="id_vuelo" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Todos los vuelos</option>
                        @if(isset($vuelos))
                            @foreach($vuelos as $vuelo)
                                <option value="{{ $vuelo->IdVuelo }}" {{ (isset($idVuelo) && $idVuelo == $vuelo->IdVuelo) ? 'selected' : '' }}>
                                    Vuelo {{ $vuelo->IdVuelo }} - {{ $vuelo->aeropuertoOrigen->NombreAeropuerto ?? 'N/A' }} → {{ $vuelo->aeropuertoDestino->NombreAeropuerto ?? 'N/A' }}
                                </option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="flex items-end space-x-2">
                    <button type="submit" class="flex-1 bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <svg class="w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        Buscar Reporte
                    </button>
                    <button type="button" onclick="exportDisponibilidad()" class="flex-1 bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500">
                        <svg class="w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Descargar Excel
                    </button>
                </div>
            </div>
        </form>

        @if(isset($reporte))
            <!-- Botón de exportar -->
            <div class="mb-4">
                <a href="{{ route('reportes.disponibilidad-boletos.exportar', array_filter(['fecha' => $fecha, 'id_vuelo' => $idVuelo])) }}"
                   class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    Descargar Excel
                </a>
            </div>

            <!-- Tabla de resultados -->
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-300">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID Vuelo</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Origen</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Destino</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha Salida</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha Llegada</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Capacidad Total</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Boletos Vendidos</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Boletos Disponibles</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($reporte as $item)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $item->IdVuelo }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $item->origen }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $item->destino }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ \Carbon\Carbon::parse($item->FechaSalida)->format('d/m/Y H:i') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ \Carbon\Carbon::parse($item->FechaLlegada)->format('d/m/Y H:i') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $item->Capacidad }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $item->boletos_vendidos }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium {{ $item->boletos_disponibles > 0 ? 'text-green-600' : 'text-red-600' }}">
                                    {{ $item->boletos_disponibles }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-6 py-4 text-center text-sm text-gray-500">
                                    No se encontraron resultados para los criterios seleccionados.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($reporte->count() > 0)
                <div class="mt-4 text-sm text-gray-600 bg-gray-50 p-4 rounded-lg">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <strong>Total de vuelos mostrados:</strong> {{ $reporte->count() }}
                        </div>
                        <div>
                            <strong>Fecha del reporte:</strong> {{ \Carbon\Carbon::parse($fecha)->format('d/m/Y') }}
                        </div>
                    </div>
                </div>
            @endif
        @endif
    </div>
</div>
@endsection

<script>
function exportDisponibilidad() {
    const fecha = document.getElementById('fecha').value;
    const idVuelo = document.getElementById('id_vuelo').value;
    const url = `/reportes/disponibilidad-boletos/exportar?fecha=${fecha}&id_vuelo=${idVuelo}`;
    window.location.href = url;
}
</script>
