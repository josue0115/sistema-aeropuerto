<?php $__env->startSection('page-title', 'Editar Personal'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mx-auto px-4 py-8">
    <div class="mb-6">
        <div class="flex items-center justify-between mb-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-800 mb-1 flex items-center">
                    <i class="material-icons text-orange-600 mr-2 text-3xl">edit</i>
                    Editar Personal: <?php echo e($personal->Nombre); ?> <?php echo e($personal->Apellido); ?>

                </h1>
                <p class="text-gray-600 text-lg">Modifique la información del empleado ID **#<?php echo e($personal->IdPersonal); ?>**.</p>
            </div>
            <a href="<?php echo e(route('personal.listar')); ?>" class="material-btn material-btn-secondary flex items-center">
                <i class="material-icons text-sm mr-2">arrow_back</i>
                Volver a la Lista
            </a>
        </div>
    </div>
    
    <div class="material-card shadow-xl rounded-lg max-w-4xl mx-auto">
        <div class="p-6">
            <form method="POST" action="<?php echo e(route('personal.update', $personal->IdPersonal)); ?>">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                
                <h5 class="text-xl font-semibold text-gray-700 border-b pb-3 mb-6">Detalles del Empleado</h5>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="Nombre" class="block text-sm font-medium text-gray-700 mb-1">Nombre</label>
                        <input type="text" id="Nombre" class="form-input w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 cursor-not-allowed" value="<?php echo e($personal->Nombre); ?>" readonly>
                    </div>
                    <div>
                        <label for="Apellido" class="block text-sm font-medium text-gray-700 mb-1">Apellido</label>
                        <input type="text" id="Apellido" class="form-input w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 cursor-not-allowed" value="<?php echo e($personal->Apellido); ?>" readonly>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="col-span-1">
                        <label for="Cargo" class="block text-sm font-medium text-gray-700 mb-1">Cargo *</label>
                        <select id="Cargo" name="Cargo" class="form-select <?php $__errorArgs = ['Cargo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                            <option value="">Seleccione</option>
                            <option value="Piloto" <?php echo e(old('Cargo', $personal->Cargo) == 'Piloto' ? 'selected' : ''); ?>>Piloto</option>
                            <option value="Copiloto" <?php echo e(old('Cargo', $personal->Cargo) == 'Copiloto' ? 'selected' : ''); ?>>Copiloto</option>
                            <option value="Azafata" <?php echo e(old('Cargo', $personal->Cargo) == 'Azafata' ? 'selected' : ''); ?>>Azafata</option>
                            <option value="Mecánico" <?php echo e(old('Cargo', $personal->Cargo) == 'Mecánico' ? 'selected' : ''); ?>>Mecánico</option>
                            <option value="Administrador" <?php echo e(old('Cargo', $personal->Cargo) == 'Administrador' ? 'selected' : ''); ?>>Administrador</option>
                            <option value="Recepcionista" <?php echo e(old('Cargo', $personal->Cargo) == 'Recepcionista' ? 'selected' : ''); ?>>Recepcionista</option>
                            <option value="Seguridad" <?php echo e(old('Cargo', $personal->Cargo) == 'Seguridad' ? 'selected' : ''); ?>>Seguridad</option>
                            <option value="Limpieza" <?php echo e(old('Cargo', $personal->Cargo) == 'Limpieza' ? 'selected' : ''); ?>>Limpieza</option>
                        </select>
                        <?php $__errorArgs = ['Cargo'];
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

                    <div class="col-span-1">
                        <label for="Salario" class="block text-sm font-medium text-gray-700 mb-1">Salario (Q) *</label>
                        <input type="number" step="0.01" id="Salario" name="Salario" class="form-input w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 cursor-not-allowed" value="<?php echo e(old('Salario', $personal->Salario)); ?>" readonly>
                        <p class="text-xs text-gray-500 mt-1">Se auto-calcula según el cargo.</p>
                        <?php $__errorArgs = ['Salario'];
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
                    
                    <div class="col-span-1">
                        <label for="FechaIngreso" class="block text-sm font-medium text-gray-700 mb-1">Fecha Ingreso *</label>
                        <input type="date" id="FechaIngreso" name="FechaIngreso" class="form-input <?php $__errorArgs = ['FechaIngreso'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" min="<?php echo e(date('Y-m-d')); ?>" value="<?php echo e(old('FechaIngreso', $personal->FechaIngreso)); ?>" required>
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
                </div>

                <h5 class="text-xl font-semibold text-gray-700 border-b pb-3 mb-6 mt-8">Información de Contacto</h5>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="Telefono" class="block text-sm font-medium text-gray-700 mb-1">Teléfono *</label>
                        <input type="number" id="Telefono" name="Telefono" class="form-input <?php $__errorArgs = ['Telefono'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" value="<?php echo e(old('Telefono', $personal->Telefono)); ?>" required>
                        <?php $__errorArgs = ['Telefono'];
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

                    <div>
                        <label for="Correo" class="block text-sm font-medium text-gray-700 mb-1">Correo *</label>
                        <input type="email" id="Correo" name="Correo" class="form-input <?php $__errorArgs = ['Correo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" value="<?php echo e(old('Correo', $personal->Correo)); ?>" required>
                        <?php $__errorArgs = ['Correo'];
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

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                    <div>
                        <label for="Direccion" class="block text-sm font-medium text-gray-700 mb-1">Dirección *</label>
                        <input type="text" id="Direccion" name="Direccion" class="form-input <?php $__errorArgs = ['Direccion'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" value="<?php echo e(old('Direccion', $personal->Direccion)); ?>" required>
                        <?php $__errorArgs = ['Direccion'];
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

                    <div>
                        <label for="Estado" class="block text-sm font-medium text-gray-700 mb-1">Estado</label>
                        <select id="Estado" name="Estado" class="form-select <?php $__errorArgs = ['Estado'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            <option value="Activo" <?php echo e(old('Estado', $personal->Estado) == 'Activo' ? 'selected' : ''); ?>>Activo</option>
                            <option value="Inactivo" <?php echo e(old('Estado', $personal->Estado) == 'Inactivo' ? 'selected' : ''); ?>>Inactivo</option>
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
                </div>

                <div class="flex justify-start mt-8 pt-6 border-t border-gray-200">
                    <button type="submit" class="material-btn material-btn-primary flex items-center px-6" style="background: linear-gradient(90deg, #f59e0b, #d97706);">
                        <i class="material-icons text-sm mr-2">save</i>
                        Actualizar Personal
                    </button>
                    <a href="<?php echo e(route('personal.listar')); ?>" class="material-btn material-btn-secondary ml-3 flex items-center px-6">
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
    const cargoSelect = document.getElementById('Cargo');
    const salarioInput = document.getElementById('Salario');

    function actualizarSalario() {
        const cargo = cargoSelect.value;
        let salario = 0;
        
        // Lógica de cálculo de salario
        switch(cargo) {
            case 'Piloto': salario = 5000.00; break;
            case 'Copiloto': salario = 4000.00; break;
            case 'Azafata': salario = 2500.00; break;
            case 'Mecánico': salario = 3000.00; break;
            case 'Administrador': salario = 3500.00; break;
            case 'Recepcionista': salario = 2000.00; break;
            case 'Seguridad': salario = 2200.00; break;
            case 'Limpieza': salario = 1800.00; break;
            default: salario = 0.00;
        }
        
        salarioInput.value = salario.toFixed(2);
    }
    
    // 1. Inicializar el salario al cargar (usa el valor actual del empleado si no hay errores)
    // Usamos el salario actual si el cargo ya está seleccionado, o lo recalculamos
    if (!salarioInput.value) {
        actualizarSalario();
    }
    
    // 2. Event listener para actualizar el salario al cambiar el cargo
    cargoSelect.addEventListener('change', actualizarSalario);
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\repositorios\sistema-aeropuerto - copia (4)\resources\views/Personal/Edit.blade.php ENDPATH**/ ?>