@extends('layouts.app')

@section('page-title', 'Editar Factura - Sistema Aeropuerto')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-6">
        <div class="flex items-center justify-between mb-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-800 mb-1 flex items-center">
                    <i class="material-icons text-yellow-600 mr-2 text-3xl">edit_note</i>
                    Editar Factura #{{ $factura[0]->idFactura }}
                </h1>
                <p class="text-gray-600 text-lg">Modifique los detalles de la factura emitida.</p>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('facturas.index') }}" class="material-btn material-btn-secondary flex items-center">
                    <i class="material-icons text-sm mr-2">list</i>
                    Volver a Facturas
                </a>
            </div>
        </div>
    </div>
    
    <div class="material-card shadow-xl rounded-lg">
        <div class="p-6">
            <form action="{{ route('facturas.update', $factura[0]->idFactura) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-6 p-3 bg-indigo-50 border-l-4 border-indigo-500 rounded-md">
                    <p class="text-sm font-semibold text-indigo-700">ID Factura:</p>
                    <span class="text-lg font-bold text-indigo-900">{{ $factura[0]->idFactura }}</span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    <div>
                        <label for="idBoleto" class="block text-sm font-medium text-gray-700 mb-1 flex items-center">
                            <i class="material-icons text-gray-500 mr-1 text-sm">confirmation_number</i>ID Boleto
                        </label>
                        <input type="number" 
                               class="form-input @error('idBoleto') border-red-500 @enderror w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                               id="idBoleto" 
                               name="idBoleto" 
                               value="{{ old('idBoleto', $factura[0]->idBoleto) }}">
                        @error('idBoleto')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="FechaEmision" class="block text-sm font-medium text-gray-700 mb-1 flex items-center">
                            <i class="material-icons text-gray-500 mr-1 text-sm">event</i>Fecha Emisión
                        </label>
                        <input type="datetime-local" 
                               class="form-input @error('FechaEmision') border-red-500 @enderror w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                               id="FechaEmision" 
                               name="FechaEmision" 
                               value="{{ old('FechaEmision', $factura[0]->FechaEmision ? \Carbon\Carbon::parse($factura[0]->FechaEmision)->format('Y-m-d\TH:i') : '') }}">
                        @error('FechaEmision')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                    <div>
                        <label for="monto" class="block text-sm font-medium text-gray-700 mb-1 flex items-center">
                            <i class="material-icons text-gray-500 mr-1 text-sm">attach_money</i>Monto Base ($)
                        </label>
                        <input type="number" 
                               step="0.01" 
                               class="form-input @error('monto') border-red-500 @enderror w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                               id="monto" 
                               name="monto" 
                               value="{{ old('monto', $factura[0]->monto) }}"
                               placeholder="0.00">
                        @error('monto')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="impuesto" class="block text-sm font-medium text-gray-700 mb-1 flex items-center">
                            <i class="material-icons text-gray-500 mr-1 text-sm">account_balance</i>Impuesto ($)
                        </label>
                        <input type="number" 
                               step="0.01" 
                               class="form-input @error('impuesto') border-red-500 @enderror w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                               id="impuesto" 
                               name="impuesto" 
                               value="{{ old('impuesto', $factura[0]->impuesto) }}"
                               placeholder="0.00">
                        @error('impuesto')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                    <div>
                        <label for="MontoTotal" class="block text-sm font-medium text-gray-700 mb-1 flex items-center">
                            <i class="material-icons text-gray-500 mr-1 text-sm">payments</i>Monto Total ($)
                        </label>
                        <input type="number" 
                               step="0.01" 
                               class="form-input w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 cursor-not-allowed" 
                               id="MontoTotal" 
                               name="MontoTotal" 
                               value="{{ old('MontoTotal', $factura[0]->MontoTotal) }}" 
                               readonly
                               placeholder="0.00">
                        <p class="text-xs text-gray-500 mt-1">Calculado automáticamente (Monto Base + Impuesto).</p>
                        @error('MontoTotal')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="Estado" class="block text-sm font-medium text-gray-700 mb-1 flex items-center">
                            <i class="material-icons text-gray-500 mr-1 text-sm">check_circle</i>Estado de la Factura
                        </label>
                        <select class="form-select @error('Estado') border-red-500 @enderror w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                                id="Estado" 
                                name="Estado">
                            <option value="">Seleccione un estado</option>
                            <option value="Activo" {{ old('Estado', $factura[0]->Estado) == 'Activo' ? 'selected' : '' }}>Activo</option>
                            <option value="Inactivo" {{ old('Estado', $factura[0]->Estado) == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                            <option value="Pendiente" {{ old('Estado', $factura[0]->Estado) == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                        </select>
                        @error('Estado')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex justify-start mt-8 pt-6 border-t border-gray-200">
                    <button type="submit" class="material-btn material-btn-primary flex items-center px-6">
                        <i class="material-icons text-sm mr-2">save</i>
                        Actualizar Factura
                    </button>
                    <a href="{{ route('facturas.index') }}" class="material-btn material-btn-secondary ml-3 flex items-center px-6">
                        <i class="material-icons text-sm mr-2">cancel</i>
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const montoInput = document.getElementById('monto');
    const impuestoInput = document.getElementById('impuesto');
    const montoTotalInput = document.getElementById('MontoTotal');

    function calcularMontoTotal() {
        // Usamos Number() para asegurar que el valor sea tratado como número, usando 0 si es inválido
        const monto = Number(montoInput.value) || 0;
        const impuesto = Number(impuestoInput.value) || 0;
        const total = monto + impuesto;
        montoTotalInput.value = total.toFixed(2);
    }

    // Inicializar el cálculo al cargar
    calcularMontoTotal();

    // Event listeners para actualizar el total
    montoInput.addEventListener('input', calcularMontoTotal);
    impuestoInput.addEventListener('input', calcularMontoTotal);
});
</script>
@endsection