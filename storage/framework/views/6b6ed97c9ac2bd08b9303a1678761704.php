<?php $__env->startSection('page-title', 'Crear Mantenimiento'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mx-auto px-4 py-8">
    <div class="mb-6">
        <div class="flex items-center justify-between mb-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-800 mb-1 flex items-center">
                    <i class="material-icons text-indigo-600 mr-2 text-3xl">build</i>
                    Crear Nuevo Registro de Mantenimiento
                </h1>
                <p class="text-gray-600 text-lg">Asigne el personal, el avión y los detalles del servicio requerido.</p>
            </div>
            <a href="<?php echo e(route('mantenimiento.listar')); ?>" class="material-btn material-btn-secondary flex items-center">
                <i class="material-icons text-sm mr-2">list</i>
                Ver Lista de Mantenimientos
            </a>
        </div>
    </div>
    
    <div class="material-card shadow-xl rounded-lg max-w-4xl mx-auto">
        <div class="p-6">
            <form method="POST" action="<?php echo e(route('mantenimiento.store')); ?>">
                <?php echo csrf_field(); ?>
                
                <h5 class="text-xl font-semibold text-gray-700 border-b pb-3 mb-6">Información del Servicio y Fechas</h5>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <div class="mb-5">
                            <label for="IdAvion" class="block text-sm font-medium text-gray-700 mb-1">Avión *</label>
                            <select name="IdAvion" id="IdAvion" class="form-select w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                                <option value="">Seleccione</option>
                                <?php $__currentLoopData = $aviones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $avion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($avion->IdAvion); ?>" <?php echo e(old('IdAvion') == $avion->IdAvion ? 'selected' : ''); ?>><?php echo e($avion->IdAvion); ?> - <?php echo e($avion->Placa); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php $__errorArgs = ['IdAvion'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        
                        <div class="mb-5">
                            <label for="IdPersonal" class="block text-sm font-medium text-gray-700 mb-1">Personal (Mecánico/Técnico) *</label>
                            <select name="IdPersonal" id="IdPersonal" class="form-select w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                                <option value="">Seleccione</option>
                                <?php $__currentLoopData = $personales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $personal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($personal->IdPersonal); ?>" <?php echo e(old('IdPersonal') == $personal->IdPersonal ? 'selected' : ''); ?>><?php echo e($personal->IdPersonal); ?> - <?php echo e($personal->Nombre); ?> <?php echo e($personal->Apellido); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php $__errorArgs = ['IdPersonal'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        
                        <div class="mb-5" id="fechaIngresoGroup">
                            <label for="FechaIngreso" class="block text-sm font-medium text-gray-700 mb-1">Fecha Ingreso *</label>
                            <input type="date" name="FechaIngreso" id="FechaIngreso" class="form-input w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" min="<?php echo e(date('Y-m-d')); ?>" value="<?php echo e(old('FechaIngreso', date('Y-m-d'))); ?>" required>
                            <p class="text-xs text-gray-500 mt-1" id="feedbackIngreso"></p>
                            <?php $__errorArgs = ['FechaIngreso'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        
                        <div class="mb-5" id="fechaSalidaGroup">
                            <label for="FechaSalida" class="block text-sm font-medium text-gray-700 mb-1">Fecha Salida *</label>
                            <input type="date" name="FechaSalida" id="FechaSalida" class="form-input w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" value="<?php echo e(old('FechaSalida')); ?>" required>
                            <p class="text-red-500 text-xs mt-1 hidden" id="feedbackSalida">La fecha de salida debe ser posterior a la fecha de ingreso.</p>
                            <?php $__errorArgs = ['FechaSalida'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                    
                    <div>
                        <div class="mb-5">
                            <label for="Tipo" class="block text-sm font-medium text-gray-700 mb-1">Tipo de Mantenimiento *</label>
                            <select name="Tipo" id="Tipo" class="form-select w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                                <option value="">Seleccione</option>
                                <option value="Preventivo" <?php echo e(old('Tipo') == 'Preventivo' ? 'selected' : ''); ?>>Preventivo</option>
                                <option value="Correctivo" <?php echo e(old('Tipo') == 'Correctivo' ? 'selected' : ''); ?>>Correctivo</option>
                                <option value="Emergencia" <?php echo e(old('Tipo') == 'Emergencia' ? 'selected' : ''); ?>>Emergencia</option>
                                <option value="Inspección" <?php echo e(old('Tipo') == 'Inspección' ? 'selected' : ''); ?>>Inspección</option>
                            </select>
                            <?php $__errorArgs = ['Tipo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        
                        <div class="mb-5">
                            <label for="Estado" class="block text-sm font-medium text-gray-700 mb-1">Estado *</label>
                            <select name="Estado" id="Estado" class="form-select w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                                <option value="">Seleccione</option>
                                <option value="Pendiente" <?php echo e(old('Estado') == 'Pendiente' ? 'selected' : ''); ?>>Pendiente</option>
                                <option value="En Progreso" <?php echo e(old('Estado') == 'En Progreso' ? 'selected' : ''); ?>>En Progreso</option>
                                <option value="Completado" <?php echo e(old('Estado') == 'Completado' ? 'selected' : ''); ?>>Completado</option>
                                <option value="Cancelado" <?php echo e(old('Estado') == 'Cancelado' ? 'selected' : ''); ?>>Cancelado</option>
                            </select>
                            <?php $__errorArgs = ['Estado'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="mb-5">
                            <label for="Costo" class="block text-sm font-medium text-gray-700 mb-1">Costo Base (Q)</label>
                            <input type="number" name="Costo" id="Costo" step="0.01" class="form-input w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 cursor-not-allowed" value="<?php echo e(old('Costo', '0.00')); ?>" readonly>
                            <p class="text-xs text-gray-500 mt-1">Costo base según el tipo de mantenimiento.</p>
                            <?php $__errorArgs = ['Costo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        
                        <div class="mb-5">
                            <label for="CostoExtra" class="block text-sm font-medium text-gray-700 mb-1">Costo Extra (Q)</label>
                            <input type="number" name="CostoExtra" id="CostoExtra" class="form-input w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" min="0" step="0.01" value="<?php echo e(old('CostoExtra', '0.00')); ?>">
                            <?php $__errorArgs = ['CostoExtra'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                </div>
                
                <div class="mb-6">
                    <label for="Descripcion" class="block text-sm font-medium text-gray-700 mb-1">Descripción del Trabajo *</label>
                    <textarea name="Descripcion" id="Descripcion" class="form-textarea w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" rows="4" required><?php echo e(old('Descripcion')); ?></textarea>
                    <?php $__errorArgs = ['Descripcion'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                
                <div class="flex justify-start mt-8 pt-6 border-t border-gray-200">
                    <button type="submit" class="material-btn material-btn-primary flex items-center px-6">
                        <i class="material-icons text-sm mr-2">add</i>
                        Crear Registro
                    </button>
                    <a href="<?php echo e(route('mantenimiento.listar')); ?>" class="material-btn material-btn-secondary ml-3 flex items-center px-6">
                        <i class="material-icons text-sm mr-2">cancel</i>
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const tipoSelect = document.getElementById('Tipo');
    const costoInput = document.getElementById('Costo');
    const fechaIngresoInput = document.getElementById('FechaIngreso');
    const fechaSalidaInput = document.getElementById('FechaSalida');
    const feedbackSalida = document.getElementById('feedbackSalida');
    const form = document.querySelector('form');

    // --- Lógica de Costo ---
    function actualizarCosto() {
        const tipo = tipoSelect.value;
        let costo = 0;
        
        switch(tipo) {
            case 'Preventivo': costo = 500.00; break;
            case 'Correctivo': costo = 800.00; break;
            case 'Emergencia': costo = 1200.00; break;
            case 'Inspección': costo = 300.00; break;
            default: costo = 0.00;
        }
        
        costoInput.value = costo.toFixed(2); 
    }

    tipoSelect.addEventListener('change', actualizarCosto);
    // Llama al iniciar para establecer el valor inicial
    actualizarCosto();

    // --- Lógica de Validación de Fechas ---
    function validateDates(e) {
        const fechaIngreso = fechaIngresoInput.value;
        const fechaSalida = fechaSalidaInput.value;
        let isValid = true;
        
        // Limpia cualquier estado de validación previo de Tailwind/Custom
        fechaSalidaInput.classList.remove('border-red-500', 'border-green-500');
        feedbackSalida.classList.add('hidden');
        
        if (fechaIngreso && fechaSalida) {
            if (new Date(fechaSalida) <= new Date(fechaIngreso)) {
                // Muestra error
                fechaSalidaInput.classList.add('border-red-500');
                fechaSalidaInput.classList.remove('focus:ring-indigo-500');
                fechaSalidaInput.classList.add('focus:ring-red-500');
                feedbackSalida.classList.remove('hidden');
                isValid = false;
            } else {
                // Muestra éxito (opcional, pero buena práctica)
                fechaSalidaInput.classList.add('border-green-500');
                fechaSalidaInput.classList.remove('focus:ring-red-500');
                fechaSalidaInput.classList.add('focus:ring-indigo-500');
            }
        }
        
        return isValid;
    }

    // Adjunta la validación a ambos campos de fecha
    fechaIngresoInput.addEventListener('change', validateDates);
    fechaSalidaInput.addEventListener('change', validateDates);
    
    // Previene el envío del formulario si la validación falla
    form.addEventListener('submit', function(e) {
        if (!validateDates()) {
            e.preventDefault();
            // Scroll al campo con error
            document.getElementById('fechaSalidaGroup').scrollIntoView({
                behavior: 'smooth',
                block: 'center'
            });
            return false;
        }
    });
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\repositorios\sistema-aeropuerto - copia (4)\resources\views/Mantenimiento/Crear.blade.php ENDPATH**/ ?>