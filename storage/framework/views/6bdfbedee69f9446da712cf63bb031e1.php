<?php $__env->startSection('content'); ?>
<?php if(session()->has('total_acumulado')): ?>
    <!-- <div class="absolute top-3 right-3 bg-blue-600 text-white px-4 py-2 rounded-lg shadow-lg z-10">
        <div class="text-sm font-medium">Total Reserva</div>
        <div class="text-lg font-bold">$<?php echo e(number_format(session('total_acumulado'), 2)); ?></div>
    </div> -->
<?php endif; ?>
<div class="container mx-auto px-4 py-8">
  <!-- Header Section -->
    <div class="mb-3">
        <div class="flex items-center justify-between mb-2">
            <div>
                <h1 class="text-3xl font-bold text-gray-800 mb-2">
                    <i class="material-icons text-blue-600 mr-2">airline_seat_recline_normal</i>
                    Crear Reserva
                </h1>
                <p class="text-gray-600 text-lg">Seleccione el vuelo y pasajero de no ser seleccionado automaticamente</p>
            </div>
            <div class="flex space-x-3">
                <a href="<?php echo e(route('boletos.create')); ?>" class="material-btn material-btn-secondary">
                    <i class="material-icons text-sm mr-2">arrow_back</i>
                    Volver a Asientos
                </a>
                <?php if(in_array(auth()->user()->role, ['operador'])): ?>
                    <a href="<?php echo e(route('reservas.index')); ?>" class="material-btn material-btn-secondary">
                        <i class="material-icons text-sm mr-2">list</i>
                        Ver Reservas
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
                            Vuelo #<?php echo e($vueloSeleccionado); ?> -
                            Pasajero #<?php echo e($pasajeroSeleccionado ?? 'N/A'); ?>

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
                       <i class="material-icons text-red-600">airline_seat_recline_normal</i>
    
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-800">Información de Reserva</h3>
                        <p class="text-gray-600">Complete todos los campos requeridos</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="material-card">
        <div class="bg-white shadow-md rounded-lg p-6 border border-gray-200">
            

            <div class="p-6">
                        <form action="<?php echo e(route('reservas.store')); ?>" method="POST" id="reserva-form">
                            <?php echo csrf_field(); ?>

                            <!-- ID Reserva oculto -->
                            <input type="hidden" id="idReserva" name="idReserva" value="">

                            
                            <div class="grid md:grid-cols-2 gap-6">
                                <div>
                                    <label for="idPasajero" class="block text-sm font-medium text-gray-700 mb-1">Código Pasajero</label>
                                    <select class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none <?php $__errorArgs = ['idPasajero'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="idPasajero" name="idPasajero" required>
                                        <option value="">Seleccione un pasajero</option>
                                        <?php $__currentLoopData = $pasajeros; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pasajero): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($pasajero->idPasajero); ?>" <?php echo e(old('idPasajero', $pasajeroSeleccionado ?? '') == $pasajero->idPasajero ? 'selected' : ''); ?>>
                                                <?php echo e($pasajero->idPasajero); ?> - <?php echo e($pasajero->Nombre); ?> <?php echo e($pasajero->Apellido); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                                    <?php if($pasajeroSeleccionado ?? false): ?>
                                        <small class="text-gray-500">Pasajero preseleccionado de la sesión</small>
                                    <?php endif; ?>
                                </div>

                                <div>
                                    <label for="idVuelo" class="block text-sm font-medium text-gray-700 mb-1">Código Vuelo</label>
                                    <select class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none <?php $__errorArgs = ['idVuelo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="idVuelo" name="idVuelo" required>
                                        <option value="">Seleccione un vuelo</option>
                                        <?php $__currentLoopData = $vuelos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vuelo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($vuelo->IdVuelo); ?>" data-precio="<?php echo e($vuelo->Precio); ?>" data-fecha-salida="<?php echo e($vuelo->FechaSalida); ?>" <?php echo e(old('idVuelo', $vueloSeleccionado ?? '') == $vuelo->IdVuelo ? 'selected' : ''); ?>>
                                                <?php echo e($vuelo->IdVuelo); ?> - <?php echo e($vuelo->aeropuerto_origen_nombre ?? 'N/A'); ?> a <?php echo e($vuelo->aeropuerto_destino_nombre ?? 'N/A'); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <?php $__errorArgs = ['idVuelo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="text-red-500 text-sm mt-1"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    <?php if($vueloSeleccionado ?? false): ?>
                                        <small class="text-gray-500">Vuelo preseleccionado de la sesión</small>
                                    <?php endif; ?>
                                </div>
                            </div>

                            
                            <div id="historial-reservas" class="mb-6" style="display: none;">
                                <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                                    <h6 class="text-lg font-semibold text-gray-800 mb-3">Reservas Anteriores del Pasajero</h6>
                                    <div id="historial-content">
                                        
                                    </div>
                                </div>
                            </div>

                            
                            <div class="grid md:grid-cols-2 gap-6">
                                <div>
                                    <label for="FechaReserva" class="block text-sm font-medium text-gray-700 mb-1">Fecha Reserva</label>
                                    <input type="datetime-local" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none <?php $__errorArgs = ['FechaReserva'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="FechaReserva" name="FechaReserva" value="<?php echo e(old('FechaReserva', date('Y-m-d\TH:i'))); ?>" min="<?php echo e(date('Y-m-d\TH:i')); ?>" required>
                                    <?php $__errorArgs = ['FechaReserva'];
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
                                    <label for="FechaVuelo" class="block text-sm font-medium text-gray-700 mb-1">Fecha Vuelo</label>
                                    <input type="datetime-local" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none <?php $__errorArgs = ['FechaVuelo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="FechaVuelo" name="FechaVuelo" value="<?php echo e(old('FechaVuelo')); ?>" min="<?php echo e(date('Y-m-d\TH:i')); ?>" required>
                                    <?php $__errorArgs = ['FechaVuelo'];
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

                            
                            <div class="grid md:grid-cols-2 gap-6 mt-6">
                                <div>
                                    <label for="MontoAnticipado" class="block text-sm font-medium text-gray-700 mb-1">Monto Anticipado</label>
                                    <input type="number" step="0.01" class="w-full border border-gray-300 rounded-md px-3 py-2 bg-gray-100" id="MontoAnticipado" name="MontoAnticipado" value="<?php echo e(old('MontoAnticipado')); ?>" readonly>
                                </div>

                                <div>
                                    <label for="Estado" class="block text-sm font-medium text-gray-700 mb-1">Estado</label>
                                    <select class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none <?php $__errorArgs = ['Estado'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="Estado" name="Estado" required>
                                        <option value="">Seleccione un estado</option>
                                        <option value="Activo" <?php echo e(old('Estado', 'Confirmada') == 'Activo' ? 'selected' : ''); ?>>Activo</option>
                                        <option value="Inactivo" <?php echo e(old('Estado', 'Confirmada') == 'Inactivo' ? 'selected' : ''); ?>>Inactivo</option>
                                        <option value="Pendiente" <?php echo e(old('Estado', 'Confirmada') == 'Pendiente' ? 'selected' : ''); ?>>Pendiente</option>
                                        <option value="Confirmada" <?php echo e(old('Estado', 'Confirmada') == 'Confirmada' ? 'selected' : ''); ?>>Confirmada</option>
                                        <option value="Cancelado" <?php echo e(old('Estado', 'Confirmada') == 'Cancelado' ? 'selected' : ''); ?>>Cancelado</option>
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

                            
                            <div class="flex flex-wrap gap-3 justify-end mt-8 pt-6 border-t border-gray-200">
                                 <?php if(!isset($vueloSeleccionado)): ?> 
                                    <button type="submit" name="action" value="create" class="material-btn material-btn-primary">
                                        <i class="fas fa-save me-2"></i>
                                        Crear Reserva
                                    </button>
                                <?php endif; ?>
                                <?php if(isset($vueloSeleccionado)): ?>   
                                    <button type="submit" name="action" value="pay" id="btn-crear-pagar" style="display: flex; align-items: center; justify-content: center; flex: 1; 
                                        padding: 0.5rem 1rem; font-weight: 600; color: white; border-radius: 0.375rem; 
                                        box-shadow: 0 2px 6px rgba(0,0,0,0.2); background: linear-gradient(to right, #22c55e, #059669); 
                                        transition: all 0.2s ease;"
                                    onmouseover="this.style.background='linear-gradient(to right, #16a34a, #047857)';"
                                    onmouseout="this.style.background='linear-gradient(to right, #22c55e, #059669)';">
                                        <i class="fas fa-credit-card me-2"></i>
                                        Crear y Pagar
                                    </button>
                                <?php endif; ?>
                                <a href="<?php echo e(route('reservas.index')); ?>" class="material-btn material-btn-secondary flex-1 justify-center">Cancelar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="//unpkg.com/alpinejs@3.x.x" defer></script>
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
    const btnCrearPagar = document.getElementById('btn-crear-pagar');
    const form = document.getElementById('reserva-form');

    // Datos de reservas existentes pasados desde el controlador
    const reservasExistentes = <?php echo json_encode($reservasExistentes ?? [], 15, 512) ?>;

    function mostrarHistorialReservas(idPasajero) {
        const reservasPasajero = reservasExistentes.filter(r => r.idPasajero == idPasajero);

        if (reservasPasajero.length > 0) {
            let html = '<p><strong>Este pasajero ha reservado los siguientes vuelos anteriormente:</strong></p><ul>';
            reservasPasajero.forEach(reserva => {
                html += `<li>
                    <strong>Vuelo ${reserva.vuelo_id}</strong> - ${reserva.origen} a ${reserva.destino}
                    <button type="button" class="btn btn-sm btn-outline-primary ms-2" onclick="seleccionarVuelo(${reserva.vuelo_id})">Seleccionar este vuelo</button>
                </li>`;
            });
            html += '</ul>';
            historialContent.innerHTML = html;
            historialDiv.style.display = 'block';
        } else {
            historialDiv.style.display = 'none';
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

    // Función para seleccionar un vuelo desde el historial
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

    // Inicializar fecha de reserva con la fecha actual
    if (!fechaReservaInput.value) {
        const now = new Date();
        const formattedNow = now.toISOString().slice(0, 16);
        fechaReservaInput.value = formattedNow;
    }

    // Calcular inicialmente
    actualizarCamposDesdeVuelo();

    // Evento para el botón "Crear y Pagar"
    btnCrearPagar.addEventListener('click', function(e) {
        e.preventDefault();

        // Validar campos requeridos
        if (!pasajeroSelect.value) {
            alert('Por favor seleccione un pasajero.');
            pasajeroSelect.focus();
            return;
        }

        if (!vueloSelect.value) {
            alert('Por favor seleccione un vuelo.');
            vueloSelect.focus();
            return;
        }

        if (!fechaReservaInput.value) {
            alert('Por favor ingrese la fecha de reserva.');
            fechaReservaInput.focus();
            return;
        }

        if (!fechaVueloInput.value) {
            alert('Por favor ingrese la fecha del vuelo.');
            fechaVueloInput.focus();
            return;
        }

        // Deshabilitar botón para evitar múltiples envíos
        btnCrearPagar.disabled = true;
        btnCrearPagar.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Procesando...';

        // Mostrar preloader de pantalla completa
        showFullscreenLoader();

        // Crear FormData con los datos del formulario
        const formData = new FormData(form);
        formData.append('action', 'pay');

        // Enviar petición AJAX
        fetch('<?php echo e(route("reservas.store")); ?>', {
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
            if (data.reserva_id) {
                // Abrir PDF en nueva pestaña
                window.open('<?php echo e(url("/reservas")); ?>/' + data.reserva_id + '/pdf', '_blank');

                // Mostrar el preloader por 3 segundos antes de redirigir
                setTimeout(() => {
                    window.location.href = '<?php echo e(route("pagos.create")); ?>';
                }, 3000);
            } else {
                hideFullscreenLoader();
                alert('Error al crear la reserva');
                btnCrearPagar.disabled = false;
                btnCrearPagar.innerHTML = '<i class="fas fa-credit-card me-2"></i>Crear y Pagar';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            hideFullscreenLoader();
            alert('Error al procesar la solicitud: ' + error.message);
            btnCrearPagar.disabled = false;
            btnCrearPagar.innerHTML = '<i class="fas fa-credit-card me-2"></i>Crear y Pagar';
        });
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
                <h4 style="color: #007bff; font-weight: bold;">Procesando Reserva...</h4>
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

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\repositorios\sistema-aeropuerto - copia (4)\resources\views/reservas/create.blade.php ENDPATH**/ ?>