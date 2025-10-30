@extends('layouts.app')

@section('page-title', 'Crear Servicio - Sistema Aeropuerto')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header Section -->
    <div class="mb-8">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-3xl font-bold text-gray-800 mb-2">
                    <i class="material-icons text-blue-600 mr-2">room_service</i>
                    Crear Servicio
                </h1>
                <p class="text-gray-600 text-lg">Complete la información del servicio</p>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('boletos.create') }}" class="material-btn material-btn-secondary">
                    <i class="material-icons text-sm mr-2">arrow_back</i>
                    Volver a Boletos
                </a>
                <a href="{{ route('servicios.index') }}" class="material-btn material-btn-secondary">
                    <i class="material-icons text-sm mr-2">list</i>
                    Ver Servicios
                </a>
            </div>
        </div>
    </div>

    <!-- Info Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        @if(isset($boletoCreado))
        <div class="material-card">
            <div class="p-4">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                        <i class="material-icons text-green-600">confirmation_number</i>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-800">Boleto Seleccionado</h3>
                        <p class="text-gray-600">
                            #{{ $boletoCreado->idBoleto }} -
                            Pasajero: {{ $boletoCreado->idPasajero }} - Vuelo: {{ $boletoCreado->idVuelo }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <div class="material-card">
            <div class="p-4">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                        <i class="material-icons text-blue-600">room_service</i>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-800">Información del Servicio</h3>
                        <p class="text-gray-600">Complete todos los campos requeridos</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Form Card -->
    <div class="material-card">
        <div class="p-6">
            <form action="{{ route('servicios.store') }}" method="POST" id="servicio-form">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="idBoleto" class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="material-icons text-gray-500 mr-1 text-sm">confirmation_number</i>Código Boleto
                        </label>
                        <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('idBoleto') border-red-500 @enderror" id="idBoleto" name="idBoleto" required>
                            <option value="">Seleccione un boleto</option>
                            @if(isset($boletoCreado))
                                <option value="{{ $boletoCreado->idBoleto }}" selected>
                                    {{ $boletoCreado->idBoleto }} - {{ $boletoCreado->idPasajero }}
                                </option>
                            @endif
                            @foreach($boletos as $boleto)
                                <option value="{{ $boleto->idBoleto }}" {{ old('idBoleto') == $boleto->idBoleto ? 'selected' : '' }}>
                                    {{ $boleto->idBoleto }} - {{ $boleto->idPasajero }}
                                </option>
                            @endforeach
                        </select>
                        @error('idBoleto')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="Fecha" class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="material-icons text-gray-500 mr-1 text-sm">event</i>Fecha
                        </label>
                        <input type="datetime-local" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('Fecha') border-red-500 @enderror" id="Fecha" name="Fecha" value="{{ old('FechaCompra', date('Y-m-d\TH:i')) }}" min="{{ date('Y-m-d\TH:i') }}">
                        @error('Fecha')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <hr class="mb-6">
                <h5 class="text-xl font-semibold text-gray-800 mb-4">Servicios Adicionales</h5>

                <div id="servicios-container"></div>

                <button type="button" class="material-btn material-btn-info mb-6" id="agregar-servicio">
                    <i class="material-icons text-sm mr-2">add</i>
                    Agregar Otro Servicio
                </button>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <div>
                        <label for="Estado" class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="material-icons text-gray-500 mr-1 text-sm">info</i>Estado
                        </label>
                        <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('Estado') border-red-500 @enderror" id="Estado" name="Estado" required>
                            <option value="">Seleccione un estado</option>
                            <option value="Activo" {{ old('Estado', 'Activo') == 'Activo' || !old('Estado') ? 'selected' : '' }}>Activo</option>
                            <option value="Inactivo" {{ old('Estado') == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                            <option value="Pendiente" {{ old('Estado') == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                        </select>
                        @error('Estado')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="GranTotal" class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="material-icons text-gray-500 mr-1 text-sm">calculate</i>Total Acumulado de Servicios
                        </label>
                        <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 bg-gray-50 font-bold text-right" id="GranTotal" value="$0.00" readonly>
                        <input type="hidden" name="TotalAcumuladoFinal" id="TotalAcumuladoFinal">
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-row justify-center gap-4 mt-8 pt-6 border-t border-gray-200">
                    <button type="submit" class="material-btn material-btn-primary flex-none px-6">
                        <i class="material-icons text-sm mr-2">save</i>
                        Crear Servicios
                    </button>
                    <button type="submit" name="action" value="next" class="material-btn material-btn-success flex-none px-6">
                        <i class="material-icons text-sm mr-2">arrow_forward</i>
                        Siguiente: Asiento
                    </button>
                    <a href="{{ route('servicios.index') }}" class="material-btn material-btn-secondary flex-none px-6">
                        <i class="material-icons text-sm mr-2">cancel</i>
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- TEMPLATE CORREGIDO -->
<template id="servicio-template">
    <div class="servicio-item flex items-end gap-4 mb-4 p-4 border border-gray-200 rounded-lg bg-gray-50 flex-wrap md:flex-nowrap">
        <!-- Tipo Servicio -->
        <div class="flex-1 min-w-[250px]">
            <label class="block text-sm font-medium text-gray-700 mb-1">Tipo Servicio</label>
            <select
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 servicio-select"
                name="servicios[0][idTipoServicio]" required>
                <option value="">Seleccione un tipo de servicio</option>
                @foreach($tipoServicios as $tipoServicio)
                    <option value="{{ $tipoServicio->idTipoServicio }}" data-costo="{{ $tipoServicio->Costo }}">
                        {{ $tipoServicio->Nombre }} (${{ number_format($tipoServicio->Costo, 2) }})
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Cantidad -->
        <div class="w-32 flex-shrink-0">
            <label class="block text-sm font-medium text-gray-700 mb-1">Cantidad</label>
            <input type="number" step="1"
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 cantidad-input"
                name="servicios[0][Cantidad]" value="1" min="1" required>
        </div>

        <!-- Costo Total -->
        <div class="w-40 flex-shrink-0">
            <label class="block text-sm font-medium text-gray-700 mb-1">Costo Total</label>
            <input type="text"
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white"
                readonly value="0.00">
            <input type="hidden" class="costo-total-hidden" name="servicios[0][CostoTotal]">
        </div>

        <!-- Botón eliminar -->
        <div class="flex-shrink-0">
            <button type="button" class="material-btn material-btn-danger justify-center remove-servicio" title="Eliminar Servicio">
                <i class="material-icons text-sm">delete</i>
            </button>
        </div>
    </div>
</template>

@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const container = document.getElementById('servicios-container');
        const addButton = document.getElementById('agregar-servicio');
        const template = document.getElementById('servicio-template');
        const granTotalInput = document.getElementById('GranTotal');
        const granTotalHidden = document.getElementById('TotalAcumuladoFinal');
        let servicioIndex = 0;

        function calcularFila(row) {
            const select = row.querySelector('.servicio-select');
            const cantidadInput = row.querySelector('.cantidad-input');
            const costoTotalHidden = row.querySelector('.costo-total-hidden');
            const costoTotalVisible = costoTotalHidden.previousElementSibling;
            const selectedOption = select.options[select.selectedIndex];
            const costo = parseFloat(selectedOption.getAttribute('data-costo')) || 0;
            const cantidad = parseFloat(cantidadInput.value) || 0;
            const total = costo * cantidad;
            if (costoTotalVisible) costoTotalVisible.value = total.toFixed(2);
            costoTotalHidden.value = total.toFixed(2);
            actualizarGranTotal();
        }

        function actualizarGranTotal() {
            let granTotal = 0;
            document.querySelectorAll('.costo-total-hidden').forEach(input => {
                granTotal += parseFloat(input.value) || 0;
            });
            granTotalInput.value = '$' + granTotal.toFixed(2);
            granTotalHidden.value = granTotal.toFixed(2);
        }

        function addServicioRow() {
            const clone = template.content.cloneNode(true);
            const newRow = clone.querySelector('.servicio-item');
            newRow.querySelectorAll('[name*="servicios[0]"]').forEach(el => {
                el.name = el.name.replace('[0]', `[${servicioIndex}]`);
            });

            const select = newRow.querySelector('.servicio-select');
            const cantidadInput = newRow.querySelector('.cantidad-input');
            const removeButton = newRow.querySelector('.remove-servicio');

            select.addEventListener('change', () => calcularFila(newRow));
            cantidadInput.addEventListener('input', () => calcularFila(newRow));
            removeButton.addEventListener('click', () => {
                newRow.remove();
                actualizarGranTotal();
            });

            container.appendChild(newRow);
            calcularFila(newRow);
            servicioIndex++;
        }

        addButton.addEventListener('click', addServicioRow);
        addServicioRow();
        actualizarGranTotal();
    });
</script>
@endsection
