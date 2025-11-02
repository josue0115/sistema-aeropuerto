<?php $__env->startSection('page-title', 'Editar Equipaje - Sistema Aeropuerto'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mx-auto px-4 py-8">
    <div class="mb-6">
        <div class="flex items-center justify-between mb-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-800 mb-1 flex items-center">
                    <i class="material-icons text-yellow-600 mr-2 text-3xl">luggage</i>
                    Editar Equipaje
                </h1>
                <p class="text-gray-600 text-lg">Modifique los detalles del equipaje #<?php echo e($equipaje->idEquipaje); ?></p>
            </div>
            <div class="flex space-x-3">
                <a href="<?php echo e(route('equipajes.index')); ?>" class="material-btn material-btn-secondary flex items-center">
                    <i class="material-icons text-sm mr-2">list</i>
                    Volver a Equipajes
                </a>
            </div>
        </div>
    </div>
    
    <div class="material-card shadow-xl rounded-lg">
        <div class="p-6">
            <form action="<?php echo e(route('equipajes.update', $equipaje->idEquipaje)); ?>" method="POST" id="equipaje-form">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                <input type="hidden" id="idEquipaje" name="idEquipaje" value="<?php echo e($equipaje->idEquipaje); ?>">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    <div>
                        <label for="idBoleto" class="block text-sm font-medium text-gray-700 mb-1 flex items-center">
                            <i class="material-icons text-gray-500 mr-1 text-sm">confirmation_number</i>Código Boleto
                        </label>
                        <select class="form-select <?php $__errorArgs = ['idBoleto'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                                id="idBoleto" 
                                name="idBoleto" 
                                required>
                            <option value="">Seleccione un boleto</option>
                            <?php $__currentLoopData = $boletos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $boleto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($boleto->idBoleto); ?>" <?php echo e(old('idBoleto', $equipaje->idBoleto) == $boleto->idBoleto ? 'selected' : ''); ?>>
                                    <?php echo e($boleto->idBoleto); ?> - <?php echo e($boleto->idPasajero ?? 'N/A'); ?> <?php echo e($boleto->pasajero_apellido ?? ''); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php $__errorArgs = ['idBoleto'];
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
                        <label for="Costo" class="block text-sm font-medium text-gray-700 mb-1 flex items-center">
                            <i class="material-icons text-gray-500 mr-1 text-sm">attach_money</i>Costo Base ($)
                        </label>
                        <input type="number" 
                               step="0.01" 
                               min="0" 
                               class="form-input <?php $__errorArgs = ['Costo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                               id="Costo" 
                               name="Costo" 
                               value="<?php echo e(old('Costo', $equipaje->Costo)); ?>" 
                               required
                               placeholder="Ej: 50.00">
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
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                    <div>
                        <label for="Dimensiones" class="block text-sm font-medium text-gray-700 mb-1 flex items-center">
                            <i class="material-icons text-gray-500 mr-1 text-sm">straighten</i>Dimensiones (ej: 50x30x20)
                        </label>
                        <input type="text" 
                               class="form-input <?php $__errorArgs = ['Dimensiones'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                               id="Dimensiones" 
                               name="Dimensiones" 
                               value="<?php echo e(old('Dimensiones', $equipaje->Dimensiones)); ?>" 
                               placeholder="50x30x20" 
                               pattern="[0-9x\s]+" 
                               title="Solo números, 'x' y espacios permitidos" 
                               required>
                        <?php $__errorArgs = ['Dimensiones'];
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
                        <label for="Peso" class="block text-sm font-medium text-gray-700 mb-1 flex items-center">
                            <i class="material-icons text-gray-500 mr-1 text-sm">fitness_center</i>Peso (kg)
                        </label>
                        <input type="number" 
                               step="0.01" 
                               min="0" 
                               class="form-input <?php $__errorArgs = ['Peso'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                               id="Peso" 
                               name="Peso" 
                               value="<?php echo e(old('Peso', $equipaje->Peso ?? '')); ?>" 
                               required
                               placeholder="Ej: 25.5">
                        <?php $__errorArgs = ['Peso'];
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
                        <label for="CostoExtra" class="block text-sm font-medium text-gray-700 mb-1 flex items-center">
                            <i class="material-icons text-gray-500 mr-1 text-sm">toll</i>Costo Extra ($)
                        </label>
                        <input type="number" 
                               step="0.01" 
                               class="form-input w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 cursor-not-allowed" 
                               id="CostoExtra" 
                               name="CostoExtra" 
                               value="<?php echo e(old('CostoExtra', $equipaje->CostoExtra ?? 0)); ?>" 
                               readonly
                               placeholder="0.00">
                        <p class="text-xs text-gray-500 mt-1">Calculado automáticamente (basado en peso).</p>
                    </div>

                    <div>
                        <label for="Monto" class="block text-sm font-medium text-gray-700 mb-1 flex items-center">
                            <i class="material-icons text-gray-500 mr-1 text-sm">payments</i>Monto Total ($)
                        </label>
                        <input type="number" 
                               step="0.01" 
                               class="form-input w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 cursor-not-allowed" 
                               id="Monto" 
                               name="Monto" 
                               value="<?php echo e(old('Monto', $equipaje->Monto)); ?>" 
                               readonly
                               placeholder="0.00">
                        <p class="text-xs text-gray-500 mt-1">Costo Base + Costo Extra.</p>
                    </div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                    <div>
                        <label for="Estado" class="block text-sm font-medium text-gray-700 mb-1 flex items-center">
                            <i class="material-icons text-gray-500 mr-1 text-sm">check_circle</i>Estado
                        </label>
                        <select class="form-select <?php $__errorArgs = ['Estado'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                                id="Estado" 
                                name="Estado" 
                                required>
                            <option value="">Seleccione un estado</option>
                            <option value="Registrado" <?php echo e(old('Estado', $equipaje->Estado) == 'Registrado' ? 'selected' : ''); ?>>Registrado</option>
                            <option value="EnTransito" <?php echo e(old('Estado', $equipaje->Estado) == 'EnTransito' ? 'selected' : ''); ?>>En Tránsito</option>
                            <option value="Entregado" <?php echo e(old('Estado', $equipaje->Estado) == 'Entregado' ? 'selected' : ''); ?>>Entregado</option>
                            <option value="Perdido" <?php echo e(old('Estado', $equipaje->Estado) == 'Perdido' ? 'selected' : ''); ?>>Perdido</option>
                            <option value="Dañado" <?php echo e(old('Estado', $equipaje->Estado) == 'Dañado' ? 'selected' : ''); ?>>Dañado</option>
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

                <div class="flex flex-row justify-start gap-4 mt-8 pt-6 border-t border-gray-200">
                    <button type="submit" class="material-btn material-btn-primary flex items-center px-6">
                        <i class="material-icons text-sm mr-2">save</i>
                        Actualizar Equipaje
                    </button>
                    <a href="<?php echo e(route('equipajes.index')); ?>" class="material-btn material-btn-secondary flex items-center px-6">
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
    const costoInput = document.getElementById('Costo');
    const pesoInput = document.getElementById('Peso');
    const costoExtraInput = document.getElementById('CostoExtra');
    const montoInput = document.getElementById('Monto');
    const dimensionesInput = document.getElementById('Dimensiones');

    // Constante para el cálculo de peso extra
    const COSTO_POR_KG = 30 / 23; // $30 por cada 23kg

    function calcularMontos() {
        const costo = parseFloat(costoInput.value) || 0;
        const peso = parseFloat(pesoInput.value) || 0;

        // Calcular costo extra: $30 por cada 23kg
        // El cálculo original (peso / 23) * 30 parece ser por peso total, no por exceso.
        // Lo mantengo por fidelidad al código, asumiendo que es el costo total del equipaje.
        // Si fuera por exceso, la lógica debería ser: Math.max(0, peso - limite_base) * costo_por_kg.
        const costoExtra = peso * COSTO_POR_KG; // Calculo simple

        costoExtraInput.value = costoExtra.toFixed(2);

        // Calcular monto total: costo + costo extra
        const montoTotal = costo + costoExtra;
        montoInput.value = montoTotal.toFixed(2);
    }

    // Validación en tiempo real para dimensiones (mejorada para solo permitir el patrón)
    dimensionesInput.addEventListener('input', function() {
        const value = this.value;
        // Solo permitir números, 'x', y espacios.
        if (!/^[0-9x\s]*$/.test(value)) {
            // Reemplazar caracteres no permitidos
            this.value = value.replace(/[^0-9x\s]/g, '');
        }
    });

    // Event listeners para el cálculo automático y validación
    const fieldsToWatch = [costoInput, pesoInput];
    fieldsToWatch.forEach(field => {
        field.addEventListener('input', function() {
            // Asegurar que el valor no sea negativo
            if (this.value < 0) {
                this.value = 0;
            }
            calcularMontos();
        });
    });
    
    // Calcular inicialmente
    calcularMontos();
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\repositorios\sistema-aeropuerto - copia (4)\resources\views/equipajes/edit.blade.php ENDPATH**/ ?>