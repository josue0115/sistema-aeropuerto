<?php $__env->startSection('page-title', 'Crear Equipaje - Sistema Aeropuerto'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mx-auto px-4 py-8" style="max-height: 900px; overflow-y: scroll;">
    <!-- Header Section -->
    <div class="mb-3">
        <div class="flex items-center justify-between mb-2">
            <div>
                <h1 class="text-3xl font-bold text-gray-800 mb-2">
                    <i class="material-icons text-blue-600 mr-2">work</i>
                    Crear Equipaje
                </h1>
                <p class="text-gray-600 text-lg">Complete la información del equipaje</p>
            </div>
            <div class="flex space-x-3">
                <a href="<?php echo e(route('servicios.create')); ?>" class="material-btn material-btn-secondary">
                    <i class="material-icons text-sm mr-2">arrow_back</i>
                    Volver a Servicios
                </a>
                <?php if(in_array(auth()->user()->role, ['operador'])): ?>
                    <a href="<?php echo e(route('equipajes.index')); ?>" class="material-btn material-btn-secondary">
                        <i class="material-icons text-sm mr-2">list</i>
                        Ver Equipajes
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Info Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-2">
        <?php if(isset($boletoCreado)): ?>
        <div class="material-card">
            <div class="p-4">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                        <i class="material-icons text-green-600">confirmation_number</i>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-800">Boleto Seleccionado</h3>
                        <p class="text-gray-600">
                            #<?php echo e($boletoCreado->idBoleto); ?> -
                            Pasajero: <?php echo e($boletoCreado->idPasajero); ?> - Vuelo: <?php echo e($boletoCreado->idVuelo); ?>

                        </p>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <div class="material-card">
            <div class="p-4">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                        <i class="material-icons text-blue-600">work</i>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-800">Información del Equipaje</h3>
                        <p class="text-gray-600">Complete todos los campos requeridos</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Form Card -->
    <div class="material-card">
        <div class="p-6">
            <form action="<?php echo e(route('equipajes.store')); ?>" method="POST" id="equipaje-form">
                <?php echo csrf_field(); ?>

                <!-- ID Equipaje oculto -->
                <input type="hidden" id="idEquipaje" name="idEquipaje" value="">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="idBoleto" class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="material-icons text-gray-500 mr-1 text-sm">confirmation_number</i>Código Boleto
                        </label>
                        <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 <?php $__errorArgs = ['idBoleto'];
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
                                <option value="<?php echo e($boleto->idBoleto); ?>" <?php echo e(old('idBoleto') == $boleto->idBoleto ? 'selected' : ''); ?>>
                                    <?php echo e($boleto->idBoleto); ?> - <?php echo e($boleto->idPasajero ?? 'N/A'); ?> <?php echo e($boleto->pasajero_apellido ?? ''); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php $__errorArgs = ['idBoleto'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="text-red-500 text-sm mt-1"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div>
                        <label for="Costo" class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="material-icons text-gray-500 mr-1 text-sm">attach_money</i>Costo
                        </label>
                        <input type="number" value="0" step="0.01" min="0" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 <?php $__errorArgs = ['Costo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="Costo" name="Costo" value="<?php echo e(old('Costo')); ?>" required>
                        <?php $__errorArgs = ['Costo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="text-red-500 text-sm mt-1"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="Dimensiones" class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="material-icons text-gray-500 mr-1 text-sm">straighten</i>Dimensiones (ej: 50x30x20)
                        </label>
                        <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 <?php $__errorArgs = ['Dimensiones'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="Dimensiones" name="Dimensiones" value="<?php echo e(old('Dimensiones')); ?>" placeholder="50x30x20" pattern="[0-9x\s]+" title="Solo números y 'x' permitidos" >
                        <?php $__errorArgs = ['Dimensiones'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="text-red-500 text-sm mt-1"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div>
                        <label for="Peso" class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="material-icons text-gray-500 mr-1 text-sm">scale</i>Peso (kg)
                        </label>
                        <input type="number" step="0.01" min="0" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 <?php $__errorArgs = ['Peso'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="Peso" name="Peso" value="<?php echo e(old('Peso') ?? 0); ?>" required >
                        <?php $__errorArgs = ['Peso'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="text-red-500 text-sm mt-1"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="CostoExtra" class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="material-icons text-gray-500 mr-1 text-sm">add_circle</i>Costo Extra
                        </label>
                        <input type="number" step="0.01" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 bg-gray-50" id="CostoExtra" name="CostoExtra" value="<?php echo e(old('CostoExtra', 0)); ?>" readonly>
                        <small class="text-gray-500 text-sm">Calculado automáticamente: $30 por cada 23kg</small>
                    </div>

                    <div>
                        <label for="Monto" class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="material-icons text-gray-500 mr-1 text-sm">calculate</i>Monto Total
                        </label>
                        <input type="number" step="0.01" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 bg-gray-50" id="Monto" name="Monto" value="<?php echo e(old('Monto')); ?>" readonly>
                        <small class="text-gray-500 text-sm">Costo + Costo Extra</small>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <div>
                        <label for="Estado" class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="material-icons text-gray-500 mr-1 text-sm">info</i>Estado
                        </label>
                        <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 <?php $__errorArgs = ['Estado'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="Estado" name="Estado" required>
                            <option value="">Seleccione un estado</option>
                            <option value="Registrado" <?php echo e(old('Estado', 'Registrado') == 'Registrado' ? 'selected' : ''); ?>>Registrado</option>
                            <option value="EnTransito" <?php echo e(old('Estado') == 'EnTransito' ? 'selected' : ''); ?>>En Tránsito</option>
                            <option value="Entregado" <?php echo e(old('Estado') == 'Entregado' ? 'selected' : ''); ?>>Entregado</option>
                            <option value="Perdido" <?php echo e(old('Estado') == 'Perdido' ? 'selected' : ''); ?>>Perdido</option>
                            <option value="Dañado" <?php echo e(old('Estado') == 'Dañado' ? 'selected' : ''); ?>>Dañado</option>
                        </select>
                        <?php $__errorArgs = ['Estado'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="text-red-500 text-sm mt-1"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-row justify-center gap-4 mt-8 pt-6 border-t border-gray-200">
                    <?php if(!isset($boletoCreado)): ?>
                    <button type="submit" class="material-btn material-btn-primary flex-1 justify-center">
                        <i class="material-icons text-sm mr-2">save</i>
                        Crear Equipaje
                    </button>
                    <?php endif; ?>
                    <?php if(isset($boletoCreado)): ?>
                    <button type="submit" name="action" value="next" style="display: flex; align-items: center; justify-content: center; flex: 1; 
                                        padding: 0.5rem 1rem; font-weight: 600; color: white; border-radius: 0.375rem; 
                                        box-shadow: 0 2px 6px rgba(0,0,0,0.2); background: linear-gradient(to right, #22c55e, #059669); 
                                        transition: all 0.2s ease;"
                                    onmouseover="this.style.background='linear-gradient(to right, #16a34a, #047857)';"
                                    onmouseout="this.style.background='linear-gradient(to right, #22c55e, #059669)';">
                        <i class="material-icons text-sm mr-2">arrow_forward</i>
                        Siguiente: Servicios
                    </button>
                    <?php endif; ?>
                    <a href="<?php echo e(route('equipajes.index')); ?>" class="material-btn material-btn-secondary flex-1 justify-center">
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

    function calcularMontos() {
        const costo = parseFloat(costoInput.value) || 0;
        const peso = parseFloat(pesoInput.value) || 0;

        // Calcular costo extra: $30 por cada 23kg
        const costoExtra = (peso / 23) * 30;
        costoExtraInput.value = costoExtra.toFixed(2);

        // Calcular monto total: costo + costo extra
        const montoTotal = costo + costoExtra;
        montoInput.value = montoTotal.toFixed(2);
    }

    // Validación en tiempo real para dimensiones
    document.getElementById('Dimensiones').addEventListener('input', function() {
        const value = this.value;
        // Solo permitir números, 'x' y espacios
        if (!/^[0-9x\s]*$/.test(value)) {
            this.value = value.replace(/[^0-9x\s]/g, '');
        }
    });

    // Validación para costo (no negativo)
    costoInput.addEventListener('input', function() {
        if (this.value < 0) {
            this.value = 0;
        }
        calcularMontos();
    });

    // Validación para peso (no negativo)
    pesoInput.addEventListener('input', function() {
        if (this.value < 0) {
            this.value = 0;
        }
        calcularMontos();
    });

    // Calcular inicialmente
    calcularMontos();
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\repositorios\sistema-aeropuerto - copia (4)\resources\views/equipajes/create.blade.php ENDPATH**/ ?>