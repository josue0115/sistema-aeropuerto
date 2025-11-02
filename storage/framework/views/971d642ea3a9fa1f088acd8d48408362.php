<?php $__env->startSection('page-title', 'Crear Nueva Factura - Sistema Aeropuerto'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mx-auto px-4 py-8">
    <div class="mb-6">
        <div class="flex items-center justify-between mb-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-800 mb-1 flex items-center">
                    <i class="material-icons text-green-600 mr-2 text-3xl">receipt_long</i>
                    Crear Nueva Factura
                </h1>
                <p class="text-gray-600 text-lg">Ingrese los detalles para generar una nueva factura.</p>
            </div>
            
        </div>
    </div>
    
    <div class="material-card shadow-xl rounded-lg">
        <div class="p-6">
            <form action="<?php echo e(route('facturas.store')); ?>" method="POST">
                <?php echo csrf_field(); ?>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    <!-- <div>
                        <label for="idFactura" class="block text-sm font-medium text-gray-700 mb-1 flex items-center">
                            <i class="material-icons text-gray-500 mr-1 text-sm">vpn_key</i>ID Factura (Requerido)
                        </label>
                        <input type="number" 
                               class="form-input <?php $__errorArgs = ['idFactura'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                               id="idFactura" 
                               name="idFactura" 
                               value="<?php echo e(old('idFactura')); ?>" 
                               required>
                        <?php $__errorArgs = ['idFactura'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div> -->

                    <div>
                        <label for="idBoleto" class="block text-sm font-medium text-gray-700 mb-1 flex items-center">
                            <i class="material-icons text-gray-500 mr-1 text-sm">confirmation_number</i>ID Boleto
                        </label>
                        <input type="number" 
                               class="form-input <?php $__errorArgs = ['idBoleto'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                               id="idBoleto" 
                               name="idBoleto" 
                               value="<?php echo e(old('idBoleto')); ?>">
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
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                    <div>
                        <label for="FechaEmision" class="block text-sm font-medium text-gray-700 mb-1 flex items-center">
                            <i class="material-icons text-gray-500 mr-1 text-sm">event</i>Fecha Emisión
                        </label>
                        <input type="datetime-local" 
                               class="form-input <?php $__errorArgs = ['FechaEmision'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                               id="FechaEmision" 
                               name="FechaEmision" 
                               value="<?php echo e(old('FechaEmision')); ?>">
                        <?php $__errorArgs = ['FechaEmision'];
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
                        <label for="monto" class="block text-sm font-medium text-gray-700 mb-1 flex items-center">
                            <i class="material-icons text-gray-500 mr-1 text-sm">attach_money</i>Monto Base ($)
                        </label>
                        <input type="number" 
                               step="0.01" 
                               class="form-input <?php $__errorArgs = ['monto'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                               id="monto" 
                               name="monto" 
                               value="<?php echo e(old('monto')); ?>"
                               placeholder="0.00">
                        <?php $__errorArgs = ['monto'];
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
                        <label for="impuesto" class="block text-sm font-medium text-gray-700 mb-1 flex items-center">
                            <i class="material-icons text-gray-500 mr-1 text-sm">account_balance</i>Impuesto ($)
                        </label>
                        <input type="number" 
                               step="0.01" 
                               class="form-input <?php $__errorArgs = ['impuesto'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                               id="impuesto" 
                               name="impuesto" 
                               value="<?php echo e(old('impuesto')); ?>"
                               placeholder="0.00">
                        <?php $__errorArgs = ['impuesto'];
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
                        <label for="MontoTotal" class="block text-sm font-medium text-gray-700 mb-1 flex items-center">
                            <i class="material-icons text-gray-500 mr-1 text-sm">payments</i>Monto Total ($)
                        </label>
                        <input type="number" 
                               step="0.01" 
                               class="form-input w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 cursor-not-allowed" 
                               id="MontoTotal" 
                               name="MontoTotal" 
                               value="<?php echo e(old('MontoTotal', '0.00')); ?>" 
                               readonly
                               placeholder="0.00">
                        <p class="text-xs text-gray-500 mt-1">Calculado automáticamente (Monto Base + Impuesto).</p>
                        <?php $__errorArgs = ['MontoTotal'];
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
                
                <div class="mt-6">
                    <label for="Estado" class="block text-sm font-medium text-gray-700 mb-1 flex items-center">
                        <i class="material-icons text-gray-500 mr-1 text-sm">check_circle</i>Estado de la Factura
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
                            name="Estado">
                        <option value="">Seleccione un estado</option>
                        <option value="Activo" <?php echo e(old('Estado') == 'Activo' ? 'selected' : ''); ?>>Activo</option>
                        <option value="Inactivo" <?php echo e(old('Estado') == 'Inactivo' ? 'selected' : ''); ?>>Inactivo</option>
                        <option value="Pendiente" <?php echo e(old('Estado') == 'Pendiente' ? 'selected' : ''); ?>>Pendiente</option>
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

                <div class="flex justify-start mt-8 pt-6 border-t border-gray-200">
                    <button type="submit" class="material-btn material-btn-primary flex items-center px-6">
                        <i class="material-icons text-sm mr-2">save</i>
                        Crear Factura
                    </button>
                    <a href="<?php echo e(route('facturas.index')); ?>" class="material-btn material-btn-secondary flex items-center">
                    <i class="material-icons text-sm mr-2">list</i>
                    Volver a Facturas
                </a>
                </div>
                <div class="flex space-x-3">
                
            </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const montoInput = document.getElementById('monto');
    const impuestoInput = document.getElementById('impuesto');
    const montoTotalInput = document.getElementById('MontoTotal');

    function calcularMontoTotal() {
        const monto = parseFloat(montoInput.value) || 0;
        const impuesto = parseFloat(impuestoInput.value) || 0;
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\repositorios\sistema-aeropuerto - copia (4)\resources\views/facturas/create.blade.php ENDPATH**/ ?>