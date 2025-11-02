<?php $__env->startSection('page-title', 'Editar Reserva - Sistema Aeropuerto'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mx-auto px-4 py-8">
    <div class="mb-6">
        <div class="flex items-center justify-between mb-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-800 mb-1 flex items-center">
                    <i class="material-icons text-yellow-600 mr-2 text-3xl">edit</i>
                    Editar Reserva
                </h1>
                <p class="text-gray-600 text-lg">Modifique los detalles de la reserva #<?php echo e($reserva->idReserva); ?></p>
            </div>
            <div class="flex space-x-3">
                <a href="<?php echo e(route('reservas.index')); ?>" class="material-btn material-btn-secondary flex items-center">
                    <i class="material-icons text-sm mr-2">list</i>
                    Volver a Reservas
                </a>
            </div>
        </div>
    </div>
    
    <div class="material-card shadow-xl rounded-lg">
        <div class="p-6">
            <form action="<?php echo e(route('reservas.update', $reserva->idReserva)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                <input type="hidden" id="idReserva" name="idReserva" value="<?php echo e($reserva->idReserva); ?>">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    <div>
                        <label for="idPasajero" class="block text-sm font-medium text-gray-700 mb-1 flex items-center">
                            <i class="material-icons text-gray-500 mr-1 text-sm">person_pin</i>Código Pasajero
                        </label>
                        <select class="form-select <?php $__errorArgs = ['idPasajero'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                                id="idPasajero" 
                                name="idPasajero" 
                                required>
                            <option value="">Seleccione un pasajero</option>
                            <?php $__currentLoopData = $pasajeros; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pasajero): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($pasajero->idPasajero); ?>" <?php echo e(old('idPasajero', $reserva->idPasajero) == $pasajero->idPasajero ? 'selected' : ''); ?>>
                                    <?php echo e($pasajero->idPasajero); ?> - <?php echo e($pasajero->Nombre); ?> <?php echo e($pasajero->Apellido); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
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

                    <div>
                        <label for="idVuelo" class="block text-sm font-medium text-gray-700 mb-1 flex items-center">
                            <i class="material-icons text-gray-500 mr-1 text-sm">flight</i>Código Vuelo
                        </label>
                        <select class="form-select <?php $__errorArgs = ['idVuelo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                                id="idVuelo" 
                                name="idVuelo" 
                                required>
                            <option value="">Seleccione un vuelo</option>
                            <?php $__currentLoopData = $vuelos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vuelo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($vuelo->IdVuelo); ?>" 
                                        data-precio="<?php echo e($vuelo->Precio); ?>" 
                                        data-fecha-salida="<?php echo e($vuelo->FechaSalida); ?>" 
                                        <?php echo e(old('idVuelo', $reserva->idVuelo) == $vuelo->IdVuelo ? 'selected' : ''); ?>>
                                    <?php echo e($vuelo->IdVuelo); ?> - <?php echo e($vuelo->aeropuertoOrigen->NombreAeropuerto ?? 'N/A'); ?> a <?php echo e($vuelo->aeropuertoDestino->NombreAeropuerto ?? 'N/A'); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
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
                </div>

                <div id="historial-reservas" class="mt-6" style="display: none;">
                    <div class="material-card border border-gray-200 bg-gray-50 p-4 rounded-lg shadow-sm">
                        <h6 class="text-lg font-semibold text-gray-700 mb-3 flex items-center">
                            <i class="material-icons text-blue-500 mr-2 text-xl">history</i>
                            Reservas Anteriores del Pasajero
                        </h6>
                        <div id="historial-content" class="text-sm text-gray-600">
                            </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                    <div>
                        <label for="FechaReserva" class="block text-sm font-medium text-gray-700 mb-1 flex items-center">
                            <i class="material-icons text-gray-500 mr-1 text-sm">event_note</i>Fecha Reserva
                        </label>
                        <input type="datetime-local" 
                               class="form-input <?php $__errorArgs = ['FechaReserva'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                               id="FechaReserva" 
                               name="FechaReserva" 
                               value="<?php echo e(old('FechaReserva', $reserva->FechaReserva ? \Carbon\Carbon::parse($reserva->FechaReserva)->format('Y-m-d\TH:i') : date('Y-m-d\TH:i'))); ?>" 
                               min="<?php echo e(date('Y-m-d\TH:i')); ?>" 
                               required>
                        <?php $__errorArgs = ['FechaReserva'];
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
                        <label for="FechaVuelo" class="block text-sm font-medium text-gray-700 mb-1 flex items-center">
                            <i class="material-icons text-gray-500 mr-1 text-sm">flight_takeoff</i>Fecha Vuelo
                        </label>
                        <input type="datetime-local" 
                               class="form-input <?php $__errorArgs = ['FechaVuelo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                               id="FechaVuelo" 
                               name="FechaVuelo" 
                               value="<?php echo e(old('FechaVuelo', $reserva->FechaVuelo ? \Carbon\Carbon::parse($reserva->FechaVuelo)->format('Y-m-d\TH:i') : '')); ?>" 
                               min="<?php echo e(date('Y-m-d\TH:i')); ?>" 
                               required>
                        <?php $__errorArgs = ['FechaVuelo'];
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
                        <label for="MontoAnticipado" class="block text-sm font-medium text-gray-700 mb-1 flex items-center">
                            <i class="material-icons text-gray-500 mr-1 text-sm">attach_money</i>Monto Anticipado (10% del vuelo)
                        </label>
                        <input type="number" 
                               step="0.01" 
                               class="form-input w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 cursor-not-allowed" 
                               id="MontoAnticipado" 
                               name="MontoAnticipado" 
                               value="<?php echo e(old('MontoAnticipado', $reserva->MontoAnticipado)); ?>" 
                               readonly>
                    </div>

                    <div>
                        <label for="Estado" class="block text-sm font-medium text-gray-700 mb-1 flex items-center">
                            <i class="material-icons text-gray-500 mr-1 text-sm">toggle_on</i>Estado
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
                            <option value="Activo" <?php echo e(old('Estado', $reserva->Estado) == 'Activo' ? 'selected' : ''); ?>>Activo</option>
                            <option value="Inactivo" <?php echo e(old('Estado', $reserva->Estado) == 'Inactivo' ? 'selected' : ''); ?>>Inactivo</option>
                            <option value="Pendiente" <?php echo e(old('Estado', $reserva->Estado) == 'Pendiente' ? 'selected' : ''); ?>>Pendiente</option>
                            <option value="Confirmado" <?php echo e(old('Estado', $reserva->Estado) == 'Confirmado' ? 'selected' : ''); ?>>Confirmado</option>
                            <option value="Cancelado" <?php echo e(old('Estado', $reserva->Estado) == 'Cancelado' ? 'selected' : ''); ?>>Cancelado</option>
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
                        Actualizar Reserva
                    </button>
                    <a href="<?php echo e(route('reservas.index')); ?>" class="material-btn material-btn-secondary flex items-center px-6">
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
    const pasajeroSelect = document.getElementById('idPasajero');
    const vueloSelect = document.getElementById('idVuelo');
    const fechaReservaInput = document.getElementById('FechaReserva');
    const fechaVueloInput = document.getElementById('FechaVuelo');
    const montoAnticipadoInput = document.getElementById('MontoAnticipado');
    const historialDiv = document.getElementById('historial-reservas');
    const historialContent = document.getElementById('historial-content');

    // Datos de reservas existentes pasados desde el controlador
    const reservasExistentes = <?php echo json_encode($reservasExistentes ?? [], 15, 512) ?>;

    function mostrarHistorialReservas(idPasajero) {
        const reservasPasajero = reservasExistentes.filter(r => r.idPasajero == idPasajero);

        if (reservasPasajero.length > 0) {
            let html = '<ul class="list-disc list-inside space-y-2">';
            reservasPasajero.forEach(reserva => {
                // Se actualizan las clases del botón para usar Tailwind/material-btn
                html += `<li class="text-gray-700">
                    <strong class="font-medium text-blue-600">Vuelo ${reserva.vuelo_id}</strong> - ${reserva.origen} a ${reserva.destino}
                    <button type="button" class="material-btn material-btn-xs material-btn-info ms-3" onclick="seleccionarVuelo(${reserva.vuelo_id})">
                        <i class="material-icons text-xs mr-1">check_circle</i>Seleccionar este vuelo
                    </button>
                </li>`;
            });
            html += '</ul>';
            historialContent.innerHTML = html;
            historialDiv.style.display = 'block';
        } else {
            historialContent.innerHTML = '<p>Este pasajero no tiene reservas anteriores registradas.</p>';
            historialDiv.style.display = 'block'; // Mostrar la sección aunque esté vacía o usar 'none' según preferencia
        }
    }

    function actualizarCamposDesdeVuelo() {
        const selectedOption = vueloSelect.options[vueloSelect.selectedIndex];
        if (selectedOption && selectedOption.value) {
            // Calcular monto anticipado
            const precio = parseFloat(selectedOption.getAttribute('data-precio')) || 0;
            const montoAnticipado = precio * 0.10; // 10% del precio del vuelo
            montoAnticipadoInput.value = montoAnticipado.toFixed(2);

            // Llenar fecha de vuelo desde la fecha de salida del vuelo
            const fechaSalida = selectedOption.getAttribute('data-fecha-salida');
            if (fechaSalida) {
                // Convertir la fecha de MySQL a formato datetime-local
                const fecha = new Date(fechaSalida);
                const formattedFecha = fecha.toISOString().slice(0, 16); // YYYY-MM-DDTHH:MM
                fechaVueloInput.value = formattedFecha;
            }
        } else {
            montoAnticipadoInput.value = '';
            fechaVueloInput.value = '';
        }
    }

    // Función global para seleccionar un vuelo desde el historial
    window.seleccionarVuelo = function(idVuelo) {
        vueloSelect.value = idVuelo;
        actualizarCamposDesdeVuelo();
        // Scroll suave al selector de vuelo
        vueloSelect.scrollIntoView({ behavior: 'smooth', block: 'center' });
        vueloSelect.focus();
    };

    // Evento para mostrar historial cuando se selecciona un pasajero
    pasajeroSelect.addEventListener('change', function() {
        const idPasajero = this.value;
        if (idPasajero) {
            mostrarHistorialReservas(idPasajero);
        } else {
            historialDiv.style.display = 'none';
        }
    });

    // Evento para actualizar campos cuando se selecciona un vuelo
    vueloSelect.addEventListener('change', actualizarCamposDesdeVuelo);

    // Inicializar campos al cargar la página
    actualizarCamposDesdeVuelo();
    const idPasajeroActual = pasajeroSelect.value;
    if (idPasajeroActual) {
        mostrarHistorialReservas(idPasajeroActual);
    }
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\repositorios\sistema-aeropuerto - copia (4)\resources\views/reservas/edit.blade.php ENDPATH**/ ?>