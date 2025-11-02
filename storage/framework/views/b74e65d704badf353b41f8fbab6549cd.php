<?php $__env->startSection('page-title', 'Editar Servicio - Sistema Aeropuerto'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mx-auto px-4 py-8">
    
    <div class="mb-6">
        <div class="flex items-center justify-between mb-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-800 mb-2 flex items-center">
                    <i class="material-icons text-orange-600 mr-2 text-3xl">edit</i>
                    Editar Servicios Adicionales
                </h1>
                <p class="text-gray-600 text-lg">Modifique la colección de servicios para el boleto **#<?php echo e($servicio[0]->idBoleto); ?>**.</p>
            </div>
            <a href="<?php echo e(route('servicios.index')); ?>" class="material-btn material-btn-secondary flex items-center">
                <i class="material-icons text-sm mr-2">arrow_back</i>
                Volver a Servicios
            </a>
        </div>
    </div>
    
    <div class="material-card border-l-4 border-green-500 shadow-md mb-6">
        <div class="p-4">
            <div class="flex items-center">
                <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                    <i class="material-icons text-green-600 text-xl">confirmation_number</i>
                </div>
                <div>
                    <h3 class="font-semibold text-gray-800">Boleto en Edición</h3>
                    <p class="text-gray-600 text-sm">
                        **#<?php echo e($servicio[0]->idBoleto); ?>** | Pasajero: **<?php echo e($servicio[0]->idPasajero ?? 'N/A'); ?>** | Fecha Original: **<?php echo e(\Carbon\Carbon::parse($servicio[0]->Fecha ?? 'now')->format('Y-m-d H:i')); ?>**
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="material-card shadow-xl rounded-lg">
        <div class="p-6">
            
            <form action="<?php echo e(route('servicios.update', $servicio[0]->idServicio)); ?>" method="POST" id="servicio-form">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                <h5 class="text-xl font-semibold text-gray-700 border-b pb-3 mb-6">Detalles de la Transacción</h5>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    
                    <div>
                        <label for="idBoleto" class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="material-icons text-gray-500 mr-1 text-sm align-middle">confirmation_number</i>
                            Código Boleto *
                        </label>
                        <select class="form-select w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 cursor-not-allowed" id="idBoleto" name="idBoleto" disabled>
                            
                            <option value="<?php echo e($servicio[0]->idBoleto); ?>" selected>
                                <?php echo e($servicio[0]->idBoleto); ?> - Pasajero: <?php echo e($servicio[0]->idPasajero ?? 'N/A'); ?>

                            </option>
                        </select>
                        <input type="hidden" name="idBoleto" value="<?php echo e($servicio[0]->idBoleto); ?>">
                    </div>

                    <div>
                        <label for="Fecha" class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="material-icons text-gray-500 mr-1 text-sm align-middle">event</i>Fecha y Hora de Servicio *
                        </label>
                        <input type="datetime-local" class="form-input w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 <?php $__errorArgs = ['Fecha'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="Fecha" name="Fecha" value="<?php echo e(old('Fecha', $servicio[0]->Fecha ? \Carbon\Carbon::parse($servicio[0]->Fecha)->format('Y-m-d\TH:i') : date('Y-m-d\TH:i'))); ?>" required>
                        <?php $__errorArgs = ['Fecha'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="text-red-500 text-xs mt-1"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>

                <hr class="mb-6 border-gray-200">
                <h5 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                    <i class="material-icons text-orange-500 mr-2">shopping_cart</i>
                    Servicios Adicionales
                </h5>

                <div id="servicios-container">
                    
                </div>

                
                <button type="button" class="material-btn material-btn-info flex items-center px-4 py-2 text-sm mb-6 shadow-md" id="agregar-servicio">
                    <i class="material-icons text-base mr-2" style="color: white; background-color: #3b82f6; border-radius: 9999px; padding: 2px;">add</i>
                    Agregar Otro Servicio
                </button>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8 pt-6 border-t border-gray-200">
                    <div>
                        <label for="Estado" class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="material-icons text-gray-500 mr-1 text-sm align-middle">info</i>Estado del Servicio(s) *
                        </label>
                        <select class="form-select w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 <?php $__errorArgs = ['Estado'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="Estado" name="Estado" required>
                            <option value="">Seleccione un estado</option>
                            <option value="Activo" <?php echo e(old('Estado', $servicio[0]->Estado ?? '') == 'Activo' ? 'selected' : ''); ?>>Activo (Pagado/Confirmado)</option>
                            <option value="Inactivo" <?php echo e(old('Estado', $servicio[0]->Estado ?? '') == 'Inactivo' ? 'selected' : ''); ?>>Inactivo</option>
                            <option value="Pendiente" <?php echo e(old('Estado', $servicio[0]->Estado ?? '') == 'Pendiente' ? 'selected' : ''); ?>>Pendiente (Por Pagar)</option>
                        </select>
                        <?php $__errorArgs = ['Estado'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="text-red-500 text-xs mt-1"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div>
                        <label for="GranTotal" class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="material-icons text-gray-500 mr-1 text-sm align-middle">calculate</i>Total Acumulado de Servicios (Q)
                        </label>
                        
                        <input type="text" class="form-input w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 bg-gray-100 font-extrabold text-xl text-green-700 text-right" id="GranTotal" value="Q0.00" readonly>
                        <input type="hidden" name="TotalAcumuladoFinal" id="TotalAcumuladoFinal">
                    </div>
                </div>

                <div class="flex flex-row justify-end gap-4 mt-8 pt-6 border-t border-gray-200">
                    <button type="submit" class="material-btn material-btn-primary flex-none px-6">
                        <i class="material-icons text-sm mr-2">save</i>
                        Actualizar Servicios
                    </button>
                    <a href="<?php echo e(route('servicios.index')); ?>" class="material-btn material-btn-secondary flex-none px-6">
                        <i class="material-icons text-sm mr-2">cancel</i>
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<template id="servicio-template">
    <div class="servicio-item flex items-end gap-4 mb-4 p-4 border border-gray-200 rounded-lg bg-white shadow-sm flex-wrap lg:flex-nowrap">
        
        <div class="flex-1 min-w-[250px] w-full lg:w-auto">
            <label class="block text-xs font-medium text-gray-500 mb-1">Tipo Servicio (Costo Unitario)</label>
            <select
                class="form-select w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 servicio-select"
                name="servicios[0][idTipoServicio]" required>
                <option value="">Seleccione un tipo de servicio</option>
                <?php $__currentLoopData = $tipoServicios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tipoServicio): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($tipoServicio->idTipoServicio); ?>" data-costo="<?php echo e($tipoServicio->Costo); ?>">
                        <?php echo e($tipoServicio->Nombre); ?> (Q<?php echo e(number_format($tipoServicio->Costo, 2)); ?>)
                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <div class="w-24 flex-shrink-0">
            <label class="block text-xs font-medium text-gray-500 mb-1">Cantidad</label>
            <input type="number" step="1"
                class="form-input w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 cantidad-input text-center"
                name="servicios[0][Cantidad]" value="1" min="1" required>
        </div>

        <div class="w-32 flex-shrink-0">
            <label class="block text-xs font-medium text-gray-500 mb-1">Costo Total (Q)</label>
            <input type="text"
                class="form-input w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-50 font-semibold text-right text-sm"
                readonly value="0.00">
            <input type="hidden" class="costo-total-hidden" name="servicios[0][CostoTotal]">
            <input type="hidden" name="servicios[0][idServicioItem]" value="nuevo">
        </div>

        <div class="flex-shrink-0 self-center">
            <button type="button" class="material-btn material-btn-danger flex items-center justify-center p-2 rounded-md remove-servicio h-10 w-10" title="Eliminar Servicio">
                <i class="material-icons text-lg">delete</i>
            </button>
        </div>
    </div>
</template>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const container = document.getElementById('servicios-container');
        const addButton = document.getElementById('agregar-servicio');
        const template = document.getElementById('servicio-template');
        const granTotalInput = document.getElementById('GranTotal');
        const granTotalHidden = document.getElementById('TotalAcumuladoFinal');
        let servicioIndex = 0;
        
        // Datos de los servicios asociados (simulación, esto debe venir del controlador)
        const serviciosActuales = <?php echo json_encode($serviciosAsociados ?? [], 15, 512) ?>;

        // --- Funciones de Cálculo y Gestión ---

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
            granTotalInput.value = 'Q' + granTotal.toFixed(2);
            granTotalHidden.value = granTotal.toFixed(2);
        }

        function addServicioRow(data = null) {
            const clone = template.content.cloneNode(true);
            const newRow = clone.querySelector('.servicio-item');
            
            // Renombrar los campos con el índice correcto
            newRow.querySelectorAll('[name*="servicios[0]"]').forEach(el => {
                el.name = el.name.replace('[0]', `[${servicioIndex}]`);
            });

            const select = newRow.querySelector('.servicio-select');
            const cantidadInput = newRow.querySelector('.cantidad-input');
            const costoTotalHidden = newRow.querySelector('.costo-total-hidden');
            const idItemHidden = newRow.querySelector('[name*="idServicioItem"]');
            const removeButton = newRow.querySelector('.remove-servicio');

            // Cargar datos si existen (modo Edición)
            if (data) {
                select.value = data.idTipoServicio;
                cantidadInput.value = data.Cantidad;
                costoTotalHidden.value = data.CostoTotal.toFixed(2);
                idItemHidden.value = data.idServicio; // ID del ítem de servicio existente
            } else {
                // Nuevo ítem, el idServicioItem ya es 'nuevo' por defecto en el template
                cantidadInput.value = 1; 
            }
            
            // Asignar listeners
            select.addEventListener('change', () => calcularFila(newRow));
            cantidadInput.addEventListener('input', () => calcularFila(newRow));
            removeButton.addEventListener('click', () => {
                newRow.remove();
                actualizarGranTotal();
            });

            container.appendChild(newRow);
            calcularFila(newRow); // Calcular la fila inmediatamente al agregar
            servicioIndex++;
        }

        // --- Lógica de Inicialización ---
        
        // 1. Cargar servicios existentes si la variable está definida y no está vacía
        if (serviciosActuales && serviciosActuales.length > 0) {
            serviciosActuales.forEach(servicio => {
                addServicioRow(servicio);
            });
        } else {
            // 2. Si no hay servicios existentes, añadir una fila vacía para empezar
            addServicioRow();
        }
        
        // 3. Inicializar listeners para nuevos servicios
        addButton.addEventListener('click', addServicioRow);
        
        // 4. Calcular el total acumulado de todos los servicios cargados
        actualizarGranTotal();
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\repositorios\sistema-aeropuerto - copia (4)\resources\views/servicios/edit.blade.php ENDPATH**/ ?>