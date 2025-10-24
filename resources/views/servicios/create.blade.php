@extends('layouts.app')

@section('content')
<div class="container mt-0">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Crear Nuevo Servicio
                        <a href="{{ route('servicios.index') }}" class="btn btn-secondary float-end">Volver</a>
                    </h4>
                    @if(isset($boletoCreado))
                        <div class="alert alert-info mt-2">
                            <strong>Boleto Seleccionado:</strong> {{ $boletoCreado->idBoleto }} -
                            Pasajero: {{ $boletoCreado->idPasajero }} - Vuelo: {{ $boletoCreado->idVuelo }}
                        </div>
                    @endif
                </div>
                <div class="card-body">
                    <form action="{{ route('servicios.store') }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="idBoleto" class="form-label">Código Boleto</label>
                                    <select class="form-control @error('idBoleto') is-invalid @enderror" id="idBoleto" name="idBoleto" required>
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
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="Fecha" class="form-label">Fecha</label>
                                    <input type="datetime-local" class="form-control @error('Fecha') is-invalid @enderror" id="Fecha" name="Fecha" value="{{ old('FechaCompra', date('Y-m-d\TH:i')) }}" min="{{ date('Y-m-d\TH:i') }}">
                                    @error('Fecha')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <hr>
                        <h5 class="mb-3">Servicios Adicionales</h5>

                        <div id="servicios-container">
                            </div>

                        <button type="button" class="btn btn-info btn-sm mb-3" id="agregar-servicio">
                            <i class="fas fa-plus-circle me-1"></i> Agregar Otro Servicio
                        </button>
                        
                        <div class="row mt-3 align-items-end">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="Estado" class="form-label">Estado</label>
                                    <select class="form-control @error('Estado') is-invalid @enderror" id="Estado" name="Estado" required>
                                        <option value="">Seleccione un estado</option>
                                        <option value="Activo" {{ old('Estado', 'Activo') == 'Activo' || !old('Estado') ? 'selected' : '' }}>Activo</option>
                                        <option value="Inactivo" {{ old('Estado') == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                                        <option value="Pendiente" {{ old('Estado') == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                                    </select>
                                    @error('Estado')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4 offset-md-4">
                                <div class="mb-3 text-end">
                                    <label class="form-label fs-5">Total Acumulado de Servicios</label>
                                    <input type="text" class="form-control form-control-lg text-end fw-bold bg-light" id="GranTotal" value="$0.00" readonly>
                                    <input type="hidden" name="TotalAcumuladoFinal" id="TotalAcumuladoFinal">
                                </div>
                            </div>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">Crear Servicios</button>
                            <button type="submit" name="action" value="next" class="btn btn-success">Siguiente: Asientos</button>
                            <a href="{{ route('servicios.index') }}" class="btn btn-secondary">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- <div class="container mt-4">
        <div class="row">
            <div class="col-12 text-center">
                <a href="{{ route('boletos.create') }}" class="btn btn-warning btn-lg me-2">Anterior: Boletos</a>
                <a href="{{ route('asientos.create') }}" class="btn btn-success btn-lg">Siguiente: Asientos</a>
            </div>
        </div>
    </div> -->
</div>

<template id="servicio-template">
    <div class="row servicio-item mb-3 align-items-end border-bottom pb-3">
        <div class="col-md-5">
            <div class="mb-0">
                <label class="form-label">Tipo Servicio</label>
                <select class="form-control servicio-select" name="servicios[0][idTipoServicio]" required>
                    <option value="">Seleccione un tipo de servicio</option>
                    @foreach($tipoServicios as $tipoServicio)
                        <option value="{{ $tipoServicio->idTipoServicio }}" data-costo="{{ $tipoServicio->Costo }}">
                            {{ $tipoServicio->Nombre }} (${{ number_format($tipoServicio->Costo, 2) }})
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-3">
            <div class="mb-0">
                <label class="form-label">Cantidad</label>
                <input type="number" step="1" class="form-control cantidad-input" name="servicios[0][Cantidad]" value="1" min="1" required>
            </div>
        </div>

        <div class="col-md-3">
            <div class="mb-0">
                <label class="form-label">Costo Total</label>
                <input type="text" class="form-control costo-total-input bg-white" readonly value="0.00">
                <input type="hidden" class="costo-total-hidden" name="servicios[0][CostoTotal]">
            </div>
        </div>
        
        <div class="col-md-1">
            <button type="button" class="btn btn-danger remove-servicio" title="Eliminar Servicio"><i class="fas fa-trash">X</i></button>
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
        let servicioIndex = 0; // Contador para nombres de arrays únicos

        // Función que calcula el costo total de una fila específica
        function calcularFila(row) {
            const select = row.querySelector('.servicio-select');
            const cantidadInput = row.querySelector('.cantidad-input');
            const costoTotalInput = row.querySelector('.costo-total-input');
            const costoTotalHidden = row.querySelector('.costo-total-hidden');

            const selectedOption = select.options[select.selectedIndex];
            
            // Obtener el costo del atributo data-costo
            const costo = parseFloat(selectedOption.getAttribute('data-costo')) || 0;
            const cantidad = parseFloat(cantidadInput.value) || 0;

            const total = costo * cantidad;
            
            costoTotalInput.value = total.toFixed(2);
            costoTotalHidden.value = total.toFixed(2);
            
            actualizarGranTotal();
        }

        // Función que suma los totales de todas las filas
        function actualizarGranTotal() {
            let granTotal = 0;
            // Suma los valores de todos los campos ocultos de costo total
            document.querySelectorAll('.costo-total-hidden').forEach(input => {
                granTotal += parseFloat(input.value) || 0;
            });
            granTotalInput.value = '$' + granTotal.toFixed(2);
            granTotalHidden.value = granTotal.toFixed(2);
        }
        
        // Función para agregar una nueva fila de servicio
        function addServicioRow() {
            const clone = template.content.cloneNode(true);
            const newRow = clone.querySelector('.servicio-item');

            // 1. Actualizar los atributos `name` para que sean únicos y se envíen como un array (ej. servicios[1][...])
            newRow.querySelectorAll('[name*="servicios[0]"]').forEach(element => {
                element.name = element.name.replace('[0]', `[${servicioIndex}]`);
            });

            // 2. Adjuntar los listeners
            const select = newRow.querySelector('.servicio-select');
            const cantidadInput = newRow.querySelector('.cantidad-input');
            const removeButton = newRow.querySelector('.remove-servicio');
            
            select.addEventListener('change', () => calcularFila(newRow));
            cantidadInput.addEventListener('input', () => calcularFila(newRow));
            
            // 3. Listener para eliminar la fila
            removeButton.addEventListener('click', function() {
                newRow.remove();
                actualizarGranTotal(); // Recalcular al eliminar
            });

            container.appendChild(clone);
            
            // 4. Inicializar el costo para la nueva fila
            calcularFila(newRow);
            servicioIndex++;
        }

        // Evento para el botón de agregar
        addButton.addEventListener('click', addServicioRow);

        // Agrega una fila inicial al cargar la página
        addServicioRow();

        // Inicializar el total general al cargar la página (útil si hay old data)
        actualizarGranTotal();
    });
</script>
@endsection