@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Reporte de Boletos Facturados</h1>
            <a href="{{ route('reportes.index') }}"
               class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Volver a Reportes
            </a>
        </div>

        <p class="text-gray-600 mb-6">Reporte de boletos facturados por cliente y fecha</p>

        <!-- Formulario de filtros -->
        <form method="POST" action="{{ route('reportes.boletos-facturados.generar') }}" class="mb-6 bg-gray-50 p-4 rounded-lg">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label for="fecha_inicio" class="block text-sm font-medium text-gray-700 mb-2">Fecha Inicio</label>
                    <input type="date" id="fecha_inicio" name="fecha_inicio" value="{{ old('fecha_inicio', isset($fechaInicio) ? $fechaInicio : date('Y-m-d', strtotime('-30 days'))) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div>
                    <label for="fecha_fin" class="block text-sm font-medium text-gray-700 mb-2">Fecha Fin</label>
                    <input type="date" id="fecha_fin" name="fecha_fin" value="{{ old('fecha_fin', isset($fechaFin) ? $fechaFin : date('Y-m-d')) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div class="flex items-end space-x-2">
                    <button type="submit" class="flex-1 bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500">
                        <svg class="w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        Buscar Reporte
                    </button>
                    <button type="button" onclick="exportFacturados()" class="flex-1 bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <svg class="w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Descargar Excel
                    </button>
                </div>
            </div>
        </form>

        @if(isset($reporteFacturados))
            <!-- Botón de exportar -->
            <div class="mb-4">
                <a href="{{ route('reportes.boletos-facturados.exportar', ['fecha_inicio' => $fechaInicio, 'fecha_fin' => $fechaFin]) }}"
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
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID Boleto</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cliente</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Vuelo</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha Compra</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Precio</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($reporteFacturados as $boleto)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $boleto->IdBoleto }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $boleto->Nombre }} {{ $boleto->Apellido }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Vuelo {{ $boleto->IdVuelo }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ \Carbon\Carbon::parse($boleto->FechaCompra)->format('d/m/Y H:i') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${{ number_format($boleto->Precio, 2) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">
                                    No se encontraron boletos facturados en el período seleccionado.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($reporteFacturados->count() > 0)
                <div class="mt-4 text-sm text-gray-600 bg-gray-50 p-4 rounded-lg">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <strong>Total de boletos facturados:</strong> {{ $reporteFacturados->count() }}
                        </div>
                        <div>
                            <strong>Período:</strong> {{ \Carbon\Carbon::parse($fechaInicio)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($fechaFin)->format('d/m/Y') }}
                        </div>
                        <div>
                            <strong>Total facturado:</strong> ${{ number_format($reporteFacturados->sum('Precio'), 2) }}
                        </div>
                    </div>
                </div>
            @endif
        @endif
    </div>
</div>
@endsection

<script>
function exportFacturados() {
    const fechaInicio = document.getElementById('fecha_inicio').value;
    const fechaFin = document.getElementById('fecha_fin').value;
    const url = `/reportes/boletos-facturados/exportar?fecha_inicio=${fechaInicio}&fecha_fin=${fechaFin}`;
    window.location.href = url;
}
</script>
