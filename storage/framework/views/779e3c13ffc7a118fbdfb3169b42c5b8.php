<?php $__env->startSection('page-title', 'Editar Boleto - Sistema Aeropuerto'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mx-auto px-4 py-8">
    <div class="mb-6">
        <div class="flex items-center justify-between mb-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-800 mb-1 flex items-center">
                    <i class="material-icons text-yellow-600 mr-2 text-3xl">confirmation_number</i>
                    Editar Boleto
                </h1>
                <p class="text-gray-600 text-lg">Modifique los detalles del boleto #<?php echo e($boleto->idBoleto); ?></p>
            </div>
            <div class="flex space-x-3">
                <a href="<?php echo e(route('boletos.index')); ?>" class="material-btn material-btn-secondary flex items-center">
                    <i class="material-icons text-sm mr-2">list</i>
                    Volver a Boletos
                </a>
            </div>
        </div>
    </div>
    
    <div class="material-card shadow-xl rounded-lg">
        <div class="p-6">
            <form action="<?php echo e(route('boletos.update', $boleto->idBoleto)); ?>" method="POST">

                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    <div>
                        <label for="idVuelo" class="block text-sm font-medium text-gray-700 mb-1 flex items-center">
                            <i class="material-icons text-gray-500 mr-1 text-sm">flight</i>ID Vuelo
                        </label>
                        <input type="number" 
                               class="form-input <?php $__errorArgs = ['idVuelo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                               id="idVuelo" 
                               name="idVuelo" 
                               value="<?php echo e(old('idVuelo', $boleto->idVuelo)); ?>"
                               placeholder="Ej: 101">
                        <?php $__errorArgs = ['idVuelo'];
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
                        <label for="idPasajero" class="block text-sm font-medium text-gray-700 mb-1 flex items-center">
                            <i class="material-icons text-gray-500 mr-1 text-sm">person_pin</i>ID Pasajero
                        </label>
                        <input type="number" 
                               class="form-input <?php $__errorArgs = ['idPasajero'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                               id="idPasajero" 
                               name="idPasajero" 
                               value="<?php echo e(old('idPasajero', $boleto->idPasajero)); ?>"
                               placeholder="Ej: 205">
                        <?php $__errorArgs = ['idPasajero'];
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
                        <label for="FechaCompra" class="block text-sm font-medium text-gray-700 mb-1 flex items-center">
                            <i class="material-icons text-gray-500 mr-1 text-sm">event_note</i>Fecha Compra
                        </label>
                        <input type="datetime-local" 
                               class="form-input <?php $__errorArgs = ['FechaCompra'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                               id="FechaCompra" 
                               name="FechaCompra" 
                               value="<?php echo e(old('FechaCompra', $boleto->FechaCompra ? \Carbon\Carbon::parse($boleto->FechaCompra)->format('Y-m-d\TH:i') : '')); ?>">
                        <?php $__errorArgs = ['FechaCompra'];
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
                        <label for="Precio" class="block text-sm font-medium text-gray-700 mb-1 flex items-center">
                            <i class="material-icons text-gray-500 mr-1 text-sm">monetization_on</i>Precio Unitario
                        </label>
                        <input type="number" 
                               step="0.01" 
                               class="form-input <?php $__errorArgs = ['Precio'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                               id="Precio" 
                               name="Precio" 
                               value="<?php echo e(old('Precio', $boleto->Precio)); ?>"
                               placeholder="0.00">
                        <?php $__errorArgs = ['Precio'];
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
                        <label for="Cantidad" class="block text-sm font-medium text-gray-700 mb-1 flex items-center">
                            <i class="material-icons text-gray-500 mr-1 text-sm">filter_1</i>Cantidad de Boletos
                        </label>
                        <input type="number" 
                               step="1" 
                               min="1"
                               class="form-input <?php $__errorArgs = ['Cantidad'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                               id="Cantidad" 
                               name="Cantidad" 
                               value="<?php echo e(old('Cantidad', $boleto->Cantidad)); ?>"
                               placeholder="1">
                        <?php $__errorArgs = ['Cantidad'];
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
                        <label for="Descuento" class="block text-sm font-medium text-gray-700 mb-1 flex items-center">
                            <i class="material-icons text-gray-500 mr-1 text-sm">redeem</i>Descuento
                        </label>
                        <input type="number" 
                               step="0.01" 
                               class="form-input <?php $__errorArgs = ['Descuento'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                               id="Descuento" 
                               name="Descuento" 
                               value="<?php echo e(old('Descuento', $boleto->Descuento)); ?>"
                               placeholder="0.00">
                        <?php $__errorArgs = ['Descuento'];
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
                        <label for="Impuesto" class="block text-sm font-medium text-gray-700 mb-1 flex items-center">
                            <i class="material-icons text-gray-500 mr-1 text-sm">paid</i>Impuesto
                        </label>
                        <input type="number" 
                               step="0.01" 
                               class="form-input <?php $__errorArgs = ['Impuesto'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                               id="Impuesto" 
                               name="Impuesto" 
                               value="<?php echo e(old('Impuesto', $boleto->Impuesto)); ?>"
                               placeholder="0.00">
                        <?php $__errorArgs = ['Impuesto'];
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
                        <label for="Total" class="block text-sm font-medium text-gray-700 mb-1 flex items-center">
                            <i class="material-icons text-gray-500 mr-1 text-sm">payments</i>Total (Calculado automáticamente)
                        </label>
                        <input type="number" 
                               step="0.01" 
                               class="form-input w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 cursor-not-allowed" 
                               id="Total" 
                               name="Total" 
                               value="<?php echo e(old('Total', $boleto->Total)); ?>" 
                               readonly
                               placeholder="0.00">
                    </div>
                </div>

                <div class="flex flex-row justify-start gap-4 mt-8 pt-6 border-t border-gray-200">
                    <button type="submit" class="material-btn material-btn-primary flex items-center px-6">
                        <i class="material-icons text-sm mr-2">save</i>
                        Actualizar Boleto
                    </button>
                    <a href="<?php echo e(route('boletos.index')); ?>" class="material-btn material-btn-secondary flex items-center px-6">
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
        const precioInput = document.getElementById('Precio');
        const cantidadInput = document.getElementById('Cantidad');
        const descuentoInput = document.getElementById('Descuento');
        const impuestoInput = document.getElementById('Impuesto');
        const totalInput = document.getElementById('Total');

        function calcularTotal() {
            // Aseguramos que los valores sean números, usando 0 si no son válidos
            const precio = parseFloat(precioInput.value) || 0;
            const cantidad = parseFloat(cantidadInput.value) || 0;
            const descuento = parseFloat(descuentoInput.value) || 0;
            const impuesto = parseFloat(impuestoInput.value) || 0;

            const subtotal = precio * cantidad;
            // Cálculo: (Precio * Cantidad) - Descuento + Impuesto
            const total = subtotal - descuento + impuesto;

            // Mostrar el total con dos decimales
            totalInput.value = total.toFixed(2);
        }

        // Eventos para calcular automáticamente en tiempo real
        const fieldsToWatch = [precioInput, cantidadInput, descuentoInput, impuestoInput];
        const events = ['input', 'change', 'keyup']; // Se eliminó 'blur' para no duplicar si ya hay 'change' en select

        fieldsToWatch.forEach(field => {
            events.forEach(event => {
                field.addEventListener(event, calcularTotal);
            });
        });

        // Calcular inicialmente al cargar la página (para el valor existente)
        calcularTotal();
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\repositorios\sistema-aeropuerto - copia (4)\resources\views/boletos/edit.blade.php ENDPATH**/ ?>