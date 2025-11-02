<?php $__env->startSection('page-title', 'Crear Vuelo - Sistema Aeropuerto'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-4xl mx-auto">
    <div class="material-card">
        <div class="p-6 border-b border-gray-200">
            <h1 class="text-2xl font-semibold text-gray-800">
                <i class="material-icons text-blue-600 mr-2">flight_takeoff</i>
                Crear Nuevo Vuelo
            </h1>
            <p class="text-gray-600 mt-1">Complete la información para agregar un nuevo vuelo al sistema</p>
        </div>

        <div class="p-6">
            <form method="POST" action="<?php echo e(route('vuelos.store')); ?>" class="space-y-6">
                <?php echo csrf_field(); ?>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="idAvion" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="material-icons text-sm mr-1">flight</i>
                            Código Avión
                        </label>
                        <select name="idAvion" id="idAvion" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                            <option value="">Seleccionar Avión</option>
                            <?php $__currentLoopData = $aviones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $avion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($avion->idAvion); ?>" <?php echo e(old('idAvion') == $avion->idAvion ? 'selected' : ''); ?>>
                                    <?php echo e($avion->idAvion); ?> - <?php echo e($avion->Placa); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php $__errorArgs = ['idAvion'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div>
                        <label for="idAeropuertoOrigen" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="material-icons text-sm mr-1">flight_takeoff</i>
                            Aeropuerto Origen
                        </label>
                        <select name="idAeropuertoOrigen" id="idAeropuertoOrigen" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                            <option value="">Seleccionar Aeropuerto Origen</option>
                            <?php $__currentLoopData = $aeropuertos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $aeropuerto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($aeropuerto->IdAeropuerto); ?>" <?php echo e((isset($busquedaData) && $busquedaData['origen'] == $aeropuerto->IdAeropuerto) || old('idAeropuertoOrigen') == $aeropuerto->idAeropuerto ? 'selected' : ''); ?>>
                                    <?php echo e($aeropuerto->idAeropuerto); ?> - <?php echo e($aeropuerto->Nombre); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php $__errorArgs = ['idAeropuertoOrigen'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div>
                        <label for="idAeropuertoDestino" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="material-icons text-sm mr-1">flight_land</i>
                            Aeropuerto Destino
                        </label>
                        <select name="idAeropuertoDestino" id="idAeropuertoDestino" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                            <option value="">Seleccionar Aeropuerto Destino</option>
                            <?php $__currentLoopData = $aeropuertos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $aeropuerto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($aeropuerto->IdAeropuerto); ?>" <?php echo e((isset($busquedaData) && $busquedaData['destino'] == $aeropuerto->IdAeropuerto) || old('idAeropuertoDestino') == $aeropuerto->IdAeropuerto ? 'selected' : ''); ?>>
                                    <?php echo e($aeropuerto->idAeropuerto); ?> - <?php echo e($aeropuerto->Nombre); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php $__errorArgs = ['idAeropuertoDestino'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div>
                        <label for="FechaSalida" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="material-icons text-sm mr-1">schedule</i>
                            Fecha Salida
                        </label>
                        <input
                            type="datetime-local"
                            name="FechaSalida"
                            id="FechaSalida"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            value="<?php echo e(isset($busquedaData) ? date('Y-m-d\TH:i', strtotime($busquedaData['fecha_ida'])) : old('FechaSalida')); ?>"
                            required
                            min="<?php echo e(date('Y-m-d\TH:i')); ?>"
                        >
                        <?php $__errorArgs = ['FechaSalida'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div>
                        <label for="FechaLlegada" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="material-icons text-sm mr-1">schedule</i>
                            Fecha Llegada
                        </label>
                        <input
                            type="datetime-local"
                            name="FechaLlegada"
                            id="FechaLlegada"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            value="<?php echo e(isset($busquedaData) && isset($busquedaData['fecha_vuelta']) ? date('Y-m-d\TH:i', strtotime($busquedaData['fecha_vuelta'])) : old('FechaLlegada')); ?>"
                            <?php echo e(isset($busquedaData) && isset($busquedaData['fecha_vuelta']) ? 'required' : ''); ?>

                            min="<?php echo e(date('Y-m-d\TH:i')); ?>"
                        >
                        <?php $__errorArgs = ['FechaLlegada'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div>
                        <label for="Precio" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="material-icons text-sm mr-1">attach_money</i>
                            Precio
                        </label>
                        <input type="number" step="0.01" name="Precio" id="Precio" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" value="<?php echo e(isset($precioSugerido) ? $precioSugerido : old('Precio')); ?>" required readonly>
                        <?php if(isset($precioSugerido)): ?>
                            <small class="form-text text-muted">Precio sugerido basado en vuelos existentes para esta ruta</small>
                        <?php endif; ?>
                        <?php $__errorArgs = ['Precio'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div>
                        <label for="Estado" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="material-icons text-sm mr-1">toggle_on</i>
                            Estado
                        </label>
                        <select name="Estado" id="Estado" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                            <option value="Programado" <?php echo e(old('Estado', 'Programado') == 'Programado' ? 'selected' : ''); ?>>Programado</option>
                            <option value="EnVuelo" <?php echo e(old('Estado') == 'EnVuelo' ? 'selected' : ''); ?>>En Vuelo</option>
                            <option value="Llegado" <?php echo e(old('Estado') == 'Llegado' ? 'selected' : ''); ?>>Llegado</option>
                            <option value="Retrasado" <?php echo e(old('Estado') == 'Retrasado' ? 'selected' : ''); ?>>Retrasado</option>
                            <option value="Cancelado" <?php echo e(old('Estado') == 'Cancelado' ? 'selected' : ''); ?>>Cancelado</option>
                        </select>
                        <?php $__errorArgs = ['Estado'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>

                <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
                    <a href="<?php echo e(route('vuelos.index')); ?>" class="material-btn border border-gray-300 text-gray-700 hover:bg-gray-50">
                        <i class="material-icons text-sm mr-2">cancel</i>
                        Cancelar
                    </a>
                    <button type="submit" class="material-btn material-btn-primary">
                        <i class="material-icons text-sm mr-2">save</i>
                        Crear Vuelo
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
    // 1. Obtención ÚNICA de los elementos
    const origenSelect = document.getElementById('idAeropuertoOrigen');
    const destinoSelect = document.getElementById('idAeropuertoDestino');
    const fechaSalidaInput = document.getElementById('FechaSalida');
    const fechaLlegadaInput = document.getElementById('FechaLlegada');
    const precioInput = document.getElementById('Precio');

    // Función para calcular precio basado en origen y destino
    function calcularPrecio() {
        const origen = origenSelect.value;
        const destino = destinoSelect.value;
        if (origen && destino) {
            // Aquí puedes implementar la lógica para calcular el precio
            // Por ahora, asignamos un precio fijo basado en si es nacional o internacional
            const precio = (origen.substring(0, 2) === destino.substring(0, 2)) ? 500.00 : 1500.00;
            precioInput.value = precio.toFixed(2);
        } else {
            precioInput.value = '';
        }
    }

    // --- LÓGICA DE CÁLCULO DE FECHA DE LLEGADA ---
    function formatDateTimeLocal(date) {
        const yyyy = date.getFullYear();
        const mm = String(date.getMonth() + 1).padStart(2, '0');
        const dd = String(date.getDate()).padStart(2, '0');
        const hh = String(date.getHours()).padStart(2, '0');
        const min = String(date.getMinutes()).padStart(2, '0');
        return `${yyyy}-${mm}-${dd}T${hh}:${min}`;
    }

    function actualizarFechaLlegada() {
        const fechaSalidaValue = fechaSalidaInput.value;
        if (!fechaSalidaValue) {
            fechaLlegadaInput.value = '';
            return;
        }

        // Convertir el valor del input a objeto Date
        const fechaSalida = new Date(fechaSalidaValue);

        // Clonar la fecha y sumarle 1 día (24 horas * 60 minutos * 60 segundos * 1000 milisegundos)
        const fechaLlegada = new Date(fechaSalida.getTime() + (24 * 60 * 60 * 1000));

        // Asignar el nuevo valor formateado
        fechaLlegadaInput.value = formatDateTimeLocal(fechaLlegada);
    }

    // --- INICIALIZACIÓN Y EVENTOS ---

    // Escuchar cambios en origen y destino para calcular precio
    origenSelect.addEventListener('change', calcularPrecio);
    destinoSelect.addEventListener('change', calcularPrecio);

    // 2. Ejecutar al cargar la página si ya hay valor en FechaSalida (proveniente del formulario anterior)
    if (fechaSalidaInput.value && !fechaLlegadaInput.value) {
        // Ejecuta la actualización solo si FechaLlegada está vacía
        actualizarFechaLlegada();
    }

    // Escuchar el evento 'change' en la fecha de salida para actualizar la llegada
    fechaSalidaInput.addEventListener('change', actualizarFechaLlegada);

    // Validación para asegurar que origen y destino sean diferentes
    function validarAeropuertos() {
        if (origenSelect.value && destinoSelect.value && origenSelect.value === destinoSelect.value) {
            destinoSelect.setCustomValidity('El aeropuerto de destino debe ser diferente al de origen');
        } else {
            destinoSelect.setCustomValidity('');
        }
    }

    origenSelect.addEventListener('change', validarAeropuertos);
    destinoSelect.addEventListener('change', validarAeropuertos);

    // Validación de fechas
    function validarFechas() {
        // Note: Se usa fechaSalidaInput y fechaLlegadaInput definidos al inicio
        const fechaSalida = new Date(fechaSalidaInput.value);
        const fechaLlegada = new Date(fechaLlegadaInput.value);
        const ahora = new Date();

        // Lógica de validación
        if (fechaSalida < ahora) {
            fechaSalidaInput.setCustomValidity('La fecha de salida debe ser futura');
        } else {
            fechaSalidaInput.setCustomValidity('');
        }

        if (fechaLlegada && fechaLlegada <= fechaSalida) {
            fechaLlegadaInput.setCustomValidity('La fecha de llegada debe ser posterior a la de salida');
        } else {
            fechaLlegadaInput.setCustomValidity('');
        }
    }

    fechaSalidaInput.addEventListener('change', validarFechas);
    fechaLlegadaInput.addEventListener('change', validarFechas);
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\repositorios\sistema-aeropuerto - copia (4)\resources\views/Vuelo/Create.blade.php ENDPATH**/ ?>