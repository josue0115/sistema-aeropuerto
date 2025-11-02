<?php $__env->startSection('page-title', 'Crear Boleto - Sistema Aeropuerto'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mx-auto px-4 py-8" style="max-height: 600px; overflow-y: scroll;">
    <!-- Header Section -->
    <div class="mb-3">
        <div class="flex items-center justify-between mb-2">
            <div>
                <h1 class="text-3xl font-bold text-gray-800 mb-2">
                    <i class="material-icons text-blue-600 mr-2">confirmation_number</i>
                    Crear Boleto
                </h1>
                <p class="text-gray-600 text-lg">Complete la información del boleto</p>
            </div>
            <div class="flex space-x-3">
                 <?php if(isset($vueloSeleccionado)): ?>
                <a href="<?php echo e(route('pasajeros.create')); ?>" class="material-btn material-btn-secondary">
                    <i class="material-icons text-sm mr-2">arrow_back</i>
                    Volver a Pasajeros
                </a>
                <?php endif; ?>
                 <?php if(in_array(auth()->user()->role, ['operador'])): ?>
                <a href="<?php echo e(route('boletos.index')); ?>" class="material-btn material-btn-secondary">
                    <i class="material-icons text-sm mr-2">list</i>
                    Ver Boletos
                </a>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Info Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-2">
        <?php if(isset($vueloSeleccionado)): ?>
        <div class="material-card">
            <div class="p-4">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                        <i class="material-icons text-green-600">flight</i>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-800">Vuelo Seleccionado</h3>
                        <p class="text-gray-600">
                            #<?php echo e($vueloSeleccionado->IdVuelo); ?> -
                            <?php echo e($vueloSeleccionado->aeropuertoOrigen->NombreAeropuerto ?? 'N/A'); ?> →
                            <?php echo e($vueloSeleccionado->aeropuertoDestino->NombreAeropuerto ?? 'N/A'); ?>

                        </p>
                        <p class="text-sm text-gray-500"><?php echo e(\Carbon\Carbon::parse($vueloSeleccionado->FechaSalida)->format('d/m/Y H:i')); ?></p>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <div class="material-card">
            <div class="p-4">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                        <i class="material-icons text-blue-600">person</i>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-800">Información del Boleto</h3>
                        <p class="text-gray-600">Complete todos los campos requeridos</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Form Card -->
    <div class="material-card">
        <div class="p-6">
                    <form action="<?php echo e(route('boletos.store')); ?>" method="POST">
                        <?php echo csrf_field(); ?>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div style="display: none;">
                                <label for="idBoleto" class="block text-sm font-medium text-gray-700 mb-1">
                                    <i class="material-icons text-gray-500 mr-1 text-sm">tag</i>ID Boleto
                                </label>
                                <input type="number" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 <?php $__errorArgs = ['idBoleto'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="idBoleto" name="idBoleto" value="<?php echo e(old('idBoleto')); ?>">
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
                                <label for="idVuelo" class="block text-sm font-medium text-gray-700 mb-1">
                                    <i class="material-icons text-gray-500 mr-1 text-sm">flight</i>Código Vuelo
                                </label>
                                <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 <?php $__errorArgs = ['idVuelo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="idVuelo" name="idVuelo" required>
                                    <option value="">Seleccione un vuelo</option>
                                    <?php $__currentLoopData = $vuelos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vuelo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($vuelo->IdVuelo); ?>" data-precio="<?php echo e($vuelo->Precio); ?>"
                                                <?php echo e((isset($vueloSeleccionado) && $vueloSeleccionado->IdVuelo == $vuelo->IdVuelo) || old('IdVuelo') == $vuelo->IdVuelo ? 'selected' : ''); ?>>
                                            <?php echo e($vuelo->IdVuelo); ?> - <?php echo e($vuelo->aeropuertoOrigen->NombreAeropuerto ?? 'N/A'); ?> a <?php echo e($vuelo->aeropuertoDestino->NombreAeropuerto ?? 'N/A'); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php $__errorArgs = ['IdVuelo'];
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
                                <label for="idPasajero" class="block text-sm font-medium text-gray-700 mb-1">
                                    <i class="material-icons text-gray-500 mr-1 text-sm">person</i>Pasajero
                                </label>
                                <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 <?php $__errorArgs = ['idPasajero'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="idPasajero" name="idPasajero" required>
                                    <option value="">Seleccione un pasajero</option>
                                    <?php
                                        $pasajerosCreados = session('pasajeros_creados', []);
                                        $primerPasajeroId = !empty($pasajerosCreados) ? $pasajerosCreados[0] : null;
                                    ?>
                                    <?php if($pasajeros instanceof \Illuminate\Database\Eloquent\Collection): ?>
                                        <?php $__currentLoopData = $pasajeros; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pasajero): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($pasajero->idPasajero); ?>"
                                                    <?php echo e((old('idPasajero') == $pasajero->idPasajero || (!$loop->first && $primerPasajeroId == $pasajero->idPasajero)) ? 'selected' : ''); ?>>
                                                <?php echo e($pasajero->idPasajero); ?> - <?php echo e($pasajero->Nombre); ?> <?php echo e($pasajero->Apellido); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php else: ?>
                                        <?php $__currentLoopData = $pasajeros; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $pasajero): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($pasajero->idPasajero); ?>"
                                                    <?php echo e((old('idPasajero') == $pasajero->idPasajero || ($index == 0 && $primerPasajeroId == $pasajero->idPasajero)) ? 'selected' : ''); ?>>
                                                <?php echo e($pasajero->idPasajero); ?> - <?php echo e($pasajero->Nombre); ?> <?php echo e($pasajero->Apellido); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </select>
                                <?php $__errorArgs = ['idPasajero'];
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
                                <label for="FechaCompra" class="block text-sm font-medium text-gray-700 mb-1">
                                    <i class="material-icons text-gray-500 mr-1 text-sm">event</i>Fecha Compra
                                </label>
                                <input type="datetime-local" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 <?php $__errorArgs = ['FechaCompra'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="FechaCompra" name="FechaCompra" value="<?php echo e(old('FechaCompra', date('Y-m-d\TH:i'))); ?>" min="<?php echo e(date('Y-m-d\TH:i')); ?>">
                                <?php $__errorArgs = ['FechaCompra'];
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
                                <label for="Precio" class="block text-sm font-medium text-gray-700 mb-1">
                                    <i class="material-icons text-gray-500 mr-1 text-sm">attach_money</i>Precio
                                </label>
                                <input type="number" step="0.01" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 <?php $__errorArgs = ['Precio'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="Precio" name="Precio" value="<?php echo e(isset($vueloSeleccionado) ? $vueloSeleccionado->Precio : old('Precio')); ?>" min="0" readonly>
                                <?php $__errorArgs = ['Precio'];
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
                                <label for="Cantidad" class="block text-sm font-medium text-gray-700 mb-1">
                                    <i class="material-icons text-gray-500 mr-1 text-sm">format_list_numbered</i>Cantidad
                                </label>
                                <input type="number" step="0.01" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 <?php $__errorArgs = ['Cantidad'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="Cantidad" name="Cantidad" value="<?php echo e(old('Cantidad', $cantidadDefault ?? 1)); ?>" min="0">
                                <?php $__errorArgs = ['Cantidad'];
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
                                <label for="Descuento" class="block text-sm font-medium text-gray-700 mb-1">
                                    <i class="material-icons text-gray-500 mr-1 text-sm">local_offer</i>Descuento
                                </label>
                                <input type="number" step="0.01" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 <?php $__errorArgs = ['Descuento'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="Descuento" name="Descuento" value="<?php echo e(old('Descuento')); ?>" readonly>
                                <?php $__errorArgs = ['Descuento'];
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
                                <label for="Impuesto" class="block text-sm font-medium text-gray-700 mb-1">
                                    <i class="material-icons text-gray-500 mr-1 text-sm">account_balance</i>Impuesto
                                </label>
                                <input type="number" step="0.01" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 <?php $__errorArgs = ['Impuesto'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="Impuesto" name="Impuesto" value="<?php echo e(old('Impuesto')); ?>" readonly>
                                <?php $__errorArgs = ['Impuesto'];
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

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                            <div>
                                <label for="Total" class="block text-sm font-medium text-gray-700 mb-1">
                                    <i class="material-icons text-gray-500 mr-1 text-sm">calculate</i>Total (Calculado automáticamente)
                                </label>
                                <input type="number" step="0.01" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 bg-gray-50" id="Total" name="Total" readonly>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex flex-row justify-center gap-4 mt-8 pt-6 border-t border-gray-200">
                            <?php if(!isset($vueloSeleccionado)): ?>
                                <button type="submit" class="material-btn material-btn-primary flex-1 justify-center" name="action" value="create">
                                    <i class="material-icons text-sm mr-2">save</i>
                                    Crear Boleto
                                </button>
                            <?php endif; ?>
                            <?php if(isset($vueloSeleccionado)): ?>
                               <button 
                                    type="button" 
                                    id="btn-siguiente-equipaje"
                                    name="action"
                                    value="next"
                                    style="display: flex; align-items: center; justify-content: center; flex: 1; 
                                        padding: 0.5rem 1rem; font-weight: 600; color: white; border-radius: 0.375rem; 
                                        box-shadow: 0 2px 6px rgba(0,0,0,0.2); background: linear-gradient(to right, #22c55e, #059669); 
                                        transition: all 0.2s ease;"
                                    onmouseover="this.style.background='linear-gradient(to right, #16a34a, #047857)';"
                                    onmouseout="this.style.background='linear-gradient(to right, #22c55e, #059669)';"
                                >
                                    <i class="material-icons" style="font-size: 14px; margin-right: 0.5rem;">arrow_forward</i>
                                    Siguiente: Equipajes
                                </button>


                            <?php endif; ?>
                            

                            <a href="<?php echo e(route('boletos.index')); ?>" class="material-btn material-btn-secondary flex-1 justify-center">
                                <i class="material-icons text-sm mr-2">cancel</i>
                                Cancelar
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const vueloSelect = document.getElementById('idVuelo');
        const precioInput = document.getElementById('Precio');
        const cantidadInput = document.getElementById('Cantidad');
        const descuentoInput = document.getElementById('Descuento');
        const impuestoInput = document.getElementById('Impuesto');
        const totalInput = document.getElementById('Total');
        const btnSiguienteEquipaje = document.getElementById('btn-siguiente-equipaje');
        const form = document.querySelector('form');
        const pasajeroSelect = document.getElementById('idPasajero');
        const fechaCompraInput = document.getElementById('FechaCompra');

        function calcularDescuento(cantidad) {
            if (cantidad >= 5 && cantidad < 10) return 0.05;
            if (cantidad >= 10 && cantidad < 15) return 0.10;
            if (cantidad >= 15) return 0.15;
            return 0;
        }

        function calcularImpuesto(subtotal) {
            return subtotal * 0.12;
        }

        function calcularTotal() {
            const precio = parseFloat(precioInput.value) || 0;
            const cantidad = parseFloat(cantidadInput.value) || 1;

            const subtotal = precio * cantidad;
            const descuento = 0;
            const impuesto = subtotal * 0.12;
            const total = subtotal + impuesto;

            descuentoInput.value = descuento.toFixed(2);
            impuestoInput.value = impuesto.toFixed(2);
            totalInput.value = total.toFixed(2);
        }

        // Evento para seleccionar vuelo y asignar precio
        vueloSelect.addEventListener('change', function() {
            const selectedOption = vueloSelect.options[vueloSelect.selectedIndex];
            const precio = selectedOption.getAttribute('data-precio') || 0;
            precioInput.value = precio;
            if (precio > 0) {
                calcularTotal();
            }
        });

        // Eventos para calcular automáticamente en tiempo real
        const events = ['input', 'change', 'keyup', 'blur'];
        events.forEach(event => {
            cantidadInput.addEventListener(event, function() {
                if (precioInput.value && precioInput.value > 0) {
                    calcularTotal();
                }
            });
        });

        // Calcular inicialmente si hay precio
        if (precioInput.value && precioInput.value > 0) {
            calcularTotal();
        }

        // Auto-seleccionar vuelo si hay uno preseleccionado y asignar precio
        if (vueloSelect.value) {
            vueloSelect.dispatchEvent(new Event('change'));
        }

        // Si hay un vuelo preseleccionado desde la sesión, forzar la selección y cálculo
        <?php if(isset($vueloSeleccionado)): ?>
        setTimeout(() => {
            vueloSelect.value = '<?php echo e($vueloSeleccionado->IdVuelo); ?>';
            // Asignar precio directamente desde el vuelo seleccionado
            precioInput.value = '<?php echo e($vueloSeleccionado->Precio); ?>';
            vueloSelect.dispatchEvent(new Event('change'));
            // Forzar cálculo después de seleccionar el vuelo
            setTimeout(() => {
                calcularTotal();
            }, 200);
        }, 100);
        <?php endif; ?>

        // Evento para el botón "Finalizar Reserva"
        btnSiguienteEquipaje.addEventListener('click', function() {
            // Verificar campos requeridos
            if (!vueloSelect.value) {
                alert('Por favor seleccione un vuelo.');
                vueloSelect.focus();
                return;
            }

            if (!pasajeroSelect.value) {
                alert('Por favor seleccione un pasajero.');
                pasajeroSelect.focus();
                return;
            }

            if (!precioInput.value || precioInput.value <= 0) {
                alert('El precio del vuelo no es válido. Por favor seleccione un vuelo.');
                vueloSelect.focus();
                return;
            }

            if (!cantidadInput.value || cantidadInput.value <= 0) {
                alert('Por favor ingrese una cantidad válida.');
                cantidadInput.focus();
                return;
            }

            if (!totalInput.value || totalInput.value <= 0) {
                alert('El total no se ha calculado correctamente.');
                return;
            }

            // Deshabilitar botón para evitar múltiples envíos
            btnSiguienteEquipaje.disabled = true;
            btnSiguienteEquipaje.innerHTML = '<i class="material-icons text-sm mr-2">hourglass_empty</i>Procesando...';

            // Crear FormData con los datos del formulario
            const formData = new FormData();

            formData.append('idVuelo', vueloSelect.value);
            formData.append('idPasajero', pasajeroSelect.value);
            formData.append('Precio', precioInput.value);
            formData.append('Cantidad', cantidadInput.value);
            formData.append('Descuento', descuentoInput.value || '0');
            formData.append('Impuesto', impuestoInput.value || '0');
            formData.append('Total', totalInput.value);
            formData.append('FechaCompra', fechaCompraInput.value);
            formData.append('action', 'next');

            // Agregar el token CSRF
            formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));

            // Mostrar preloader de pantalla completa
            showFullscreenLoader();

            // Mostrar el preloader por al menos 2 segundos antes de enviar la petición AJAX
            setTimeout(() => {
                // Enviar petición AJAX
                fetch('<?php echo e(route("boletos.store")); ?>', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        return response.json().then(err => {
                            // Mostrar errores específicos de validación
                            if (err.errors) {
                                let errorMessages = 'Errores de validación:\n';
                                for (let field in err.errors) {
                                    errorMessages += `- ${err.errors[field].join(', ')}\n`;
                                }
                                throw new Error(errorMessages);
                            }
                            throw new Error(err.message || 'Error en la solicitud');
                        });
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.boleto_id) {
                        // Abrir PDF en nueva pestaña
                        window.open('<?php echo e(url("/boletos")); ?>/' + data.boleto_id + '/pdf', '_blank');

                        // Redirigir a equipajes create después de un breve delay
                        setTimeout(() => {
                            window.location.href = '<?php echo e(route("equipajes.create")); ?>';
                        }, 1000);
                    } else {
                        hideFullscreenLoader();
                        alert('Error al crear el boleto');
                        btnSiguiente.disabled = false;
                        btnSiguiente.innerHTML = '<i class="material-icons text-sm mr-2">arrow_forward</i>Siguiente: Equipajes';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    hideFullscreenLoader();
                    alert('Error al procesar la solicitud: ' + error.message);
                    btnFinalizarReserva.disabled = false;
                });
            }, 2000);
        });
    });

    // Función para mostrar preloader de pantalla completa
    function showFullscreenLoader() {
        let loader = document.getElementById('fullscreen-loader');
        if (!loader) {
            loader = document.createElement('div');
            loader.id = 'fullscreen-loader';
            loader.innerHTML = `
                <div style="
                    position: fixed;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    background-color: rgba(255, 255, 255, 0.95);
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    z-index: 9999;
                    flex-direction: column;
                    border: 2px solid #007bff;
                    border-radius: 10px;
                    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
                ">
                    <img src="<?php echo e(asset('images/plane-loader.gif')); ?>" alt="Cargando..." style="width: 250px; height: 250px; margin-bottom: 20px;">
                    <h4 style="color: #007bff; font-weight: bold;">Procesando...</h4>
                </div>
            `;
            document.body.appendChild(loader);
        }
        loader.style.display = 'flex';
    }

    // Función para ocultar preloader de pantalla completa
    function hideFullscreenLoader() {
        const loader = document.getElementById('fullscreen-loader');
        if (loader) {
            loader.style.display = 'none';
        }
    }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\repositorios\sistema-aeropuerto - copia (4)\resources\views/boletos/create.blade.php ENDPATH**/ ?>