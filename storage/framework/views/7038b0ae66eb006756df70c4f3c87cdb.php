<?php $__env->startSection('page-title', 'Crear Servicio - Sistema Aeropuerto'); ?>

<?php $__env->startSection('content'); ?>

<div class="container mx-auto px-4 py-8">
    
    <div class="mb-6"> 
        <div class="flex items-center justify-between mb-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-800 mb-2 flex items-center">
                    <i class="material-icons text-blue-600 mr-2 text-3xl">room_service</i>
                    Crear Servicio
                </h1>
                <p class="text-gray-600 text-lg">Complete la información del servicio(s) para el boleto.</p>
            </div>
            <div class="flex space-x-3">
                 <?php if(isset($boletoCreado)): ?>
                <a href="<?php echo e(route('boletos.create')); ?>" class="material-btn material-btn-secondary flex items-center">
                    <i class="material-icons text-sm mr-2">arrow_back</i>
                    Volver a Boletos
                </a>
                    <?php endif; ?>
                <?php if(in_array(auth()->user()->role, ['operador'])): ?>
                    <a href="<?php echo e(route('servicios.index')); ?>" class="material-btn material-btn-secondary flex items-center">
                        <i class="material-icons text-sm mr-2">list</i>
                        Ver Servicios
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6"> 
        <?php if(isset($boletoCreado)): ?>
        <div class="material-card border-l-4 border-green-500 shadow-md">
            <div class="p-4">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                        <i class="material-icons text-green-600 text-xl">confirmation_number</i>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-800">Boleto Seleccionado</h3>
                        <p class="text-gray-600 text-sm">
                            **#<?php echo e($boletoCreado->idBoleto); ?>** | Pasajero: **<?php echo e($boletoCreado->idPasajero); ?>** | Vuelo: **<?php echo e($boletoCreado->idVuelo); ?>**
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <div class="material-card border-l-4 border-blue-500 shadow-md">
            <div class="p-4">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                        <i class="material-icons text-blue-600 text-xl">room_service</i>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-800">Información del Servicio</h3>
                        <p class="text-gray-600 text-sm">Agregue uno o más servicios y verifique el total.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="material-card shadow-xl rounded-lg">
        <div class="p-6">
            <form action="<?php echo e(route('servicios.store')); ?>" method="POST" id="servicio-form">
                <?php echo csrf_field(); ?>

                <h5 class="text-xl font-semibold text-gray-700 border-b pb-3 mb-6">Detalles del Vínculo y Tiempo</h5>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="idBoleto" class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="material-icons text-gray-500 mr-1 text-sm align-middle">confirmation_number</i>
                            Código Boleto *
                        </label>
                        <select class="form-select w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 <?php $__errorArgs = ['idBoleto'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="idBoleto" name="idBoleto" required>
                            <option value="">Seleccione un boleto</option>
                            <?php if(isset($boletoCreado)): ?>
                                <option value="<?php echo e($boletoCreado->idBoleto); ?>" selected>
                                    <?php echo e($boletoCreado->idBoleto); ?> - <?php echo e($boletoCreado->idPasajero); ?>

                                </option>
                            <?php endif; ?>
                            <?php $__currentLoopData = $boletos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $boleto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                
                                <?php if(!isset($boletoCreado) || $boleto->idBoleto != $boletoCreado->idBoleto): ?>
                                    <option value="<?php echo e($boleto->idBoleto); ?>" <?php echo e(old('idBoleto') == $boleto->idBoleto ? 'selected' : ''); ?>>
                                        <?php echo e($boleto->idBoleto); ?> - Pasajero: <?php echo e($boleto->idPasajero); ?>

                                    </option>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php $__errorArgs = ['idBoleto'];
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
unset($__errorArgs, $__bag); ?>" id="Fecha" name="Fecha" value="<?php echo e(old('Fecha', date('Y-m-d\TH:i'))); ?>" min="<?php echo e(date('Y-m-d\TH:i')); ?>" required>
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

                <div id="servicios-container"></div>

                
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
                            <option value="Activo" <?php echo e(old('Estado', 'Activo') == 'Activo' || !old('Estado') ? 'selected' : ''); ?>>Activo (Pagado/Confirmado)</option>
                            <option value="Inactivo" <?php echo e(old('Estado') == 'Inactivo' ? 'selected' : ''); ?>>Inactivo</option>
                            <option value="Pendiente" <?php echo e(old('Estado') == 'Pendiente' ? 'selected' : ''); ?>>Pendiente (Por Pagar)</option>
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
                    
                    
                    <?php if(!isset($boletoCreado)): ?>
                        <button type="submit" class="material-btn material-btn-primary flex-none px-6">
                            <i class="material-icons text-sm mr-2">save</i>
                            Crear Servicios
                        </button>
                    <?php endif; ?>
                    
                    
                    <?php if(isset($boletoCreado)): ?>
                        <button type="submit" name="action" value="next" 
                            class="flex-1 justify-center material-btn material-btn-success shadow-lg hover:shadow-xl transition-shadow duration-200"
                            style="background: linear-gradient(to right, #22c55e, #059669); flex: 1; max-width: 300px;">
                            <i class="material-icons text-sm mr-2">arrow_forward</i>
                            Siguiente: Asiento
                        </button>
                    <?php endif; ?>
                    
                    
                    <a href="<?php echo e(route('servicios.index')); ?>" class="material-btn material-btn-secondary flex-1 justify-center max-w-[300px]">
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

        function calcularFila(row) {
            const select = row.querySelector('.servicio-select');
            const cantidadInput = row.querySelector('.cantidad-input');
            const costoTotalHidden = row.querySelector('.costo-total-hidden');
            const costoTotalVisible = costoTotalHidden.previousElementSibling;
            
            const selectedOption = select.options[select.selectedIndex];
            const costo = parseFloat(selectedOption.getAttribute('data-costo')) || 0;
            const cantidad = parseFloat(cantidadInput.value) || 0;
            
            const total = costo * cantidad;
            
            // Actualizar campos
            if (costoTotalVisible) costoTotalVisible.value = total.toFixed(2);
            costoTotalHidden.value = total.toFixed(2);
            
            actualizarGranTotal();
        }

        function actualizarGranTotal() {
            let granTotal = 0;
            document.querySelectorAll('.costo-total-hidden').forEach(input => {
                granTotal += parseFloat(input.value) || 0;
            });
            // Mostrar con formato de Quetzales (Q)
            granTotalInput.value = 'Q' + granTotal.toFixed(2);
            granTotalHidden.value = granTotal.toFixed(2);
        }

        function addServicioRow() {
            const clone = template.content.cloneNode(true);
            const newRow = clone.querySelector('.servicio-item');
            
            // Renombrar los campos con el índice correcto
            newRow.querySelectorAll('[name*="servicios[0]"]').forEach(el => {
                el.name = el.name.replace('[0]', `[${servicioIndex}]`);
            });

            const select = newRow.querySelector('.servicio-select');
            const cantidadInput = newRow.querySelector('.cantidad-input');
            const removeButton = newRow.querySelector('.remove-servicio');

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

        addButton.addEventListener('click', addServicioRow);
        
        // Agregar la primera fila al cargar la página si no hay ninguna
        if (container.children.length === 0) {
            addServicioRow();
        }

        actualizarGranTotal();
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\repositorios\sistema-aeropuerto - copia (4)\resources\views/servicios/create.blade.php ENDPATH**/ ?>