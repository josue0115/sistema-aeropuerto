<?php $__env->startSection('page-title', 'Crear Horario - Sistema Aeropuerto'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mx-auto px-4 py-8">
    
    <div class="mb-6 flex items-center justify-between">
        <h1 class="text-3xl font-bold text-gray-800 flex items-center">
            <i class="material-icons text-indigo-600 mr-2 text-3xl">schedule</i>
            Crear Nuevo Horario
        </h1>
        <a href="<?php echo e(route('horario.index')); ?>" class="material-btn material-btn-secondary flex items-center">
            <i class="material-icons text-sm mr-2">arrow_back</i>
            Volver a Horarios
        </a>
    </div>

    <div class="material-card shadow-xl rounded-lg max-w-2xl mx-auto border-t-4 border-indigo-500">
        <div class="p-6">
            
            <h2 class="text-xl font-semibold text-gray-700 mb-6 border-b pb-3">
                Asignar Tiempos a un Vuelo
            </h2>

            <form method="POST" action="<?php echo e(route('horario.store')); ?>">
                <?php echo csrf_field(); ?>

                <div class="mb-5">
                    <label for="IdVuelo" class="block text-sm font-medium text-gray-700 mb-1">
                        <i class="material-icons text-gray-500 mr-1 text-sm align-middle">flight_takeoff</i>Vuelo *
                    </label>
                    <select name="IdVuelo" id="IdVuelo" class="form-select w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 <?php $__errorArgs = ['IdVuelo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                        <option value="">Seleccione un vuelo</option>
                        <?php $__currentLoopData = $vuelos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vuelo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($vuelo->IdVuelo); ?>" <?php echo e(old('IdVuelo') == $vuelo->IdVuelo ? 'selected' : ''); ?>>
                                Vuelo #<?php echo e($vuelo->IdVuelo); ?> - 
                                <?php echo e($vuelo->aeropuertoOrigen->NombreAeropuerto ?? 'N/A'); ?> →
                                <?php echo e($vuelo->aeropuertoDestino->NombreAeropuerto ?? 'N/A'); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php $__errorArgs = ['IdVuelo'];
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

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    <div class="mb-5">
                        <label for="HoraSalida" class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="material-icons text-gray-500 mr-1 text-sm align-middle">access_time</i>Hora Salida *
                        </label>
                        <input type="time" name="HoraSalida" id="HoraSalida" 
                               class="form-input w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 <?php $__errorArgs = ['HoraSalida'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                               value="<?php echo e(old('HoraSalida')); ?>" required>
                        <?php $__errorArgs = ['HoraSalida'];
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

                    <div class="mb-5">
                        <label for="HoraLlegada" class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="material-icons text-gray-500 mr-1 text-sm align-middle">schedule</i>Hora Llegada *
                        </label>
                        <input type="time" name="HoraLlegada" id="HoraLlegada" 
                               class="form-input w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 <?php $__errorArgs = ['HoraLlegada'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                               value="<?php echo e(old('HoraLlegada')); ?>" required>
                        <?php $__errorArgs = ['HoraLlegada'];
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

                <div class="mb-5">
                    <label for="TiempoEspera" class="block text-sm font-medium text-gray-700 mb-1">
                        <i class="material-icons text-gray-500 mr-1 text-sm align-middle">timelapse</i>Tiempo de Espera (minutos) *
                    </label>
                    <input type="number" name="TiempoEspera" id="TiempoEspera" 
                           class="form-input w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 <?php $__errorArgs = ['TiempoEspera'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                           min="0" value="<?php echo e(old('TiempoEspera')); ?>" required>
                    <?php $__errorArgs = ['TiempoEspera'];
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

                <div class="mb-6">
                    <label for="Estado" class="block text-sm font-medium text-gray-700 mb-1">
                        <i class="material-icons text-gray-500 mr-1 text-sm align-middle">flag</i>Estado *
                    </label>
                    <select name="Estado" id="Estado" class="form-select w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 <?php $__errorArgs = ['Estado'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                        <option value="">Seleccione un estado</option>
                        <option value="Activo" <?php echo e(old('Estado') == 'Activo' ? 'selected' : ''); ?>>Activo</option>
                        <option value="Inactivo" <?php echo e(old('Estado') == 'Inactivo' ? 'selected' : ''); ?>>Inactivo</option>
                        <option value="Cancelado" <?php echo e(old('Estado') == 'Cancelado' ? 'selected' : ''); ?>>Cancelado</option>
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

                <div class="flex justify-end gap-4 pt-4 border-t border-gray-200">
                    <a href="<?php echo e(route('horario.index')); ?>" class="material-btn material-btn-secondary flex-none px-6">
                        <i class="material-icons text-sm mr-2">cancel</i> Cancelar
                    </a>
                    <button type="submit" class="material-btn material-btn-primary flex-none px-6">
                        <i class="material-icons text-sm mr-2">save</i> Guardar Horario
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const horaSalidaInput = document.querySelector('input[name="HoraSalida"]');
        const horaLlegadaInput = document.querySelector('input[name="HoraLlegada"]');

        if (horaSalidaInput && horaLlegadaInput) {
            function validarHoras(event) {
                const horaSalida = horaSalidaInput.value;
                const horaLlegada = horaLlegadaInput.value;

                if (horaSalida && horaLlegada) {
                    // Si la hora de llegada es igual o anterior a la hora de salida
                    if (horaLlegada <= horaSalida) {
                        alert('⚠️ La hora de llegada debe ser posterior a la hora de salida.');
                        // Limpiar el campo que acaba de causar la falla (puede ser llegada o salida)
                        event.target.value = '';
                    }
                }
            }

            horaSalidaInput.addEventListener('change', validarHoras);
            horaLlegadaInput.addEventListener('change', validarHoras);
        }
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\repositorios\sistema-aeropuerto - copia (4)\resources\views/Horario/Create.blade.php ENDPATH**/ ?>