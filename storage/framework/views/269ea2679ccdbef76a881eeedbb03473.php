<?php $__env->startSection('page-title', 'Crear Asiento - Sistema Aeropuerto'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mx-auto px-4 py-8">
    <!-- Header Section -->
    <div class="mb-3">
        <div class="flex items-center justify-between mb-2">
            <div>
                <h1 class="text-3xl font-bold text-gray-800 mb-2">
                    <i class="material-icons text-blue-600 mr-2">airline_seat_recline_normal</i>
                    Crear Asiento
                </h1>
                <p class="text-gray-600 text-lg">Seleccione el vuelo y asiento deseado</p>
            </div>
            <div class="flex space-x-3">
                <a href="<?php echo e(route('boletos.create')); ?>" class="material-btn material-btn-secondary">
                    <i class="material-icons text-sm mr-2">arrow_back</i>
                    Volver a Boletos
                </a>
                <?php if(in_array(auth()->user()->role, ['operador'])): ?>
                    <a href="<?php echo e(route('asientos.index')); ?>" class="material-btn material-btn-secondary">
                        <i class="material-icons text-sm mr-2">list</i>
                        Ver Asientos
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
                        <i class="material-icons text-blue-600">airline_seat_recline_normal</i>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-800">Información del Asiento</h3>
                        <p class="text-gray-600">Complete todos los campos requeridos</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Form Card -->
    <div class="material-card">
        <div class="p-6">
            <form action="<?php echo e(route('asientos.store')); ?>" method="POST" x-data="seatSelection" x-init="init()">
                <?php echo csrf_field(); ?>

                <!-- Selección de Vuelo y Asiento -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="IdVuelo" class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="material-icons text-gray-500 mr-1 text-sm">flight</i>Número de Vuelo
                        </label>
                        <select name="IdVuelo" id="IdVuelo" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 <?php $__errorArgs = ['IdVuelo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                            <option value="">Seleccione un vuelo</option>
                            <?php $__currentLoopData = $vuelos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vuelo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($vuelo->IdVuelo); ?>"
                                    <?php echo e(old('IdVuelo') == $vuelo->IdVuelo ? 'selected' : (isset($vueloSeleccionado) && $vueloSeleccionado == $vuelo->IdVuelo ? 'selected' : '')); ?>>
                                    Vuelo <?php echo e($vuelo->IdVuelo); ?> - <?php echo e($vuelo->aeropuerto_origen_nombre ?? 'N/A'); ?> → <?php echo e($vuelo->aeropuerto_destino_nombre ?? 'N/A'); ?>

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

                    <div>
                        <label for="NumeroAsiento" class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="material-icons text-gray-500 mr-1 text-sm">event_seat</i>Número de Asiento
                        </label>
                        <div class="flex gap-2">
                            <input type="text" name="NumeroAsiento" id="NumeroAsiento" class="flex-1 px-3 py-2 border border-gray-300 rounded-md bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 <?php $__errorArgs = ['NumeroAsiento'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('NumeroAsiento')); ?>" readonly required>
                            <button type="button" @click="if (!document.getElementById('IdVuelo').value) { showError('Selecciona un vuelo primero') } else { loadSeats(); seatModal = true }" class="material-btn material-btn-primary whitespace-nowrap">
                                <i class="material-icons text-sm mr-1">search</i>
                                Seleccionar
                            </button>
                        </div>
                        <?php $__errorArgs = ['NumeroAsiento'];
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

                <!-- Clase y Estado -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="Clase" class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="material-icons text-gray-500 mr-1 text-sm">stars</i>Clase
                        </label>
                        <input type="text" name="Clase" id="Clase" class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500" value="<?php echo e(old('Clase')); ?>" readonly>
                        <small class="text-gray-500 text-sm">Se asigna automáticamente según el asiento</small>
                    </div>

                    <div>
                        <label for="Estado" class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="material-icons text-gray-500 mr-1 text-sm">info</i>Estado
                        </label>
                        <select name="Estado" id="Estado" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 <?php $__errorArgs = ['Estado'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                            <option value="">Seleccione un estado</option>
                            <option value="Disponible" <?php echo e(old('Estado', 'Ocupado') == 'Disponible' ? 'selected' : ''); ?>>Disponible</option>
                            <option value="Reservado" <?php echo e(old('Estado', 'Ocupado') == 'Reservado' ? 'selected' : ''); ?>>Reservado</option>
                            <option value="Ocupado" <?php echo e(old('Estado', 'Ocupado') == 'Ocupado' ? 'selected' : ''); ?>>Ocupado</option>
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
                    <?php if(!isset($vueloSeleccionado)): ?>               
                        <button type="submit" name="action" value="create" class="material-btn material-btn-primary flex-1 justify-center">
                            <i class="material-icons text-sm mr-2">save</i>
                            Crear Asiento
                        </button>
                    <?php endif; ?>
                    <?php if(isset($vueloSeleccionado)): ?>   
                    
                        <button type="submit" name="action" value="finalize" style="display: flex; align-items: center; justify-content: center; flex: 1; 
                                        padding: 0.5rem 1rem; font-weight: 600; color: white; border-radius: 0.375rem; 
                                        box-shadow: 0 2px 6px rgba(0,0,0,0.2); background: linear-gradient(to right, #22c55e, #059669); 
                                        transition: all 0.2s ease;"
                                    onmouseover="this.style.background='linear-gradient(to right, #16a34a, #047857)';"
                                    onmouseout="this.style.background='linear-gradient(to right, #22c55e, #059669)';">Finalizar Reserva</button>
                    <?php endif; ?>
                    <a href="<?php echo e(route('asientos.index')); ?>" class="material-btn material-btn-secondary flex-1 justify-center">
                        <i class="material-icons text-sm mr-2">cancel</i>
                        Cancelar
                    </a>
                </div>

                <!-- Modal Selección Asiento -->
                <div x-show="seatModal" x-cloak class="fixed inset-0 flex justify-center items-center bg-black/50 z-50 overflow-auto">
                    <div class="bg-white rounded-lg shadow-lg w-full max-w-3xl p-6" style="width: 850px; max-height: 90vh; display: flex; flex-direction: column;">
                        
                        <!-- Header -->
                        <div class="flex items-center justify-between mb-4 border-b pb-2 flex-shrink-0">
                            <h5 class="text-lg font-semibold text-gray-700">
                                <i class="material-icons text-blue-600 mr-2">airline_seat_recline_normal</i>
                                Seleccionar Asiento
                            </h5>
                            <button @click="seatModal=false" class="material-btn material-btn-secondary text-sm">
                                <i class="material-icons text-sm mr-1">close</i>
                                Cerrar
                            </button>
                        </div>
                        
                        <!-- Body con scroll -->
                        <div id="airplane-container" class="p-4 border border-gray-200 rounded bg-gray-50 text-center overflow-y-auto flex-1">
                            <p class="text-gray-500">Cargando asientos...</p>
                        </div>
                        
                        <!-- Footer -->
                        <div class="flex justify-end mt-6 flex-shrink-0 gap-2">
                            <button type="button" @click="seatModal=false" class="material-btn material-btn-secondary">
                                <i class="material-icons text-sm mr-1">cancel</i>
                                Cancelar
                            </button>
                            <button type="button" @click="confirmSeat()" class="material-btn material-btn-primary">
                                <i class="material-icons text-sm mr-1">check_circle</i>
                                Confirmar Selección
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Modal de Error -->
                <div x-show="errorModal" x-cloak class="fixed inset-0 flex items-center justify-center bg-black/50 z-50">
                    <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
                        <div class="flex items-center mb-4">
                            <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center mr-3">
                                <i class="material-icons text-red-600">error</i>
                            </div>
                            <h5 class="text-lg font-semibold text-gray-800">Error</h5>
                        </div>
                        <p class="text-gray-600 mb-4" x-text="errorMessage"></p>
                        <div class="flex justify-end">
                            <button @click="errorModal=false" class="material-btn material-btn-primary">
                                <i class="material-icons text-sm mr-1">check</i>
                                Aceptar
                            </button>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script src="//unpkg.com/alpinejs@3.x.x" defer></script>
<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('seatSelection', () => ({
        seatModal: false,
        errorModal: false,
        errorMessage: '',
        selectedSeat: null,

        init() {
            console.log("✅ Alpine seatSelection iniciado correctamente");
        },

        showError(msg) {
            this.errorMessage = msg;
            this.errorModal = true;
        },

        async loadSeats() {
            const vueloId = document.getElementById('IdVuelo').value;
            const container = document.getElementById('airplane-container');
            container.innerHTML = '<p class="text-gray-500">Cargando asientos...</p>';

            try {
                console.log('🔍 Cargando asientos para vuelo:', vueloId);
                const response = await fetch(`/asientos/available-seats?idVuelo=${vueloId}`);
                if (!response.ok) throw new Error(`Error HTTP: ${response.status}`);
                const data = await response.json();
                const available = data.available || [];
                const occupied = data.occupied || [];
                this.renderSeats(available, occupied);
            } catch (error) {
                console.error("❌ Error cargando asientos:", error);
                container.innerHTML = `<p class="text-red-500 mb-2">Error al cargar los asientos.</p>
                                       <p class="text-sm text-gray-500">Detalles: ${error.message}</p>`;
            }
        },

        renderSeats(available, occupied) {
            const container = document.getElementById('airplane-container');
            const firstClass = ['1A', '1B', '1C', '1D'];
            const businessClass = ['2A','2B','2C','2D','3A','3B','3C','3D'];
            const economyClass = ['4A','4B','4C','4D','4E','4F','5A','5B','5C','5D','5E','5F','6A','6B','6C','6D','6E','6F'];

            container.innerHTML = `
                <div class="airplane-wrapper" style="max-width: 500px; margin: 0 auto;">
                    <div style="background-color: #007bff; border-radius: 50px 50px 0 0; height: 64px; display: flex; align-items: center; justify-content: center; margin-bottom: 16px; color: white; font-weight: bold; font-size: 18px;">✈️ CABINA</div>
                    <div style="margin-bottom: 16px; padding: 16px; border-radius: 8px; border: 2px solid #ffc107; background-color: #fff3cd;">
                        <h6 style="text-align: center; font-weight: bold; color: #664d03; margin-bottom: 12px; font-size: 16px;">✨ PRIMERA CLASE</h6>
                        <div style="display: flex; justify-content: center; gap: 16px;">
                            <div style="display: flex; gap: 8px;">${this.renderSeatRow(firstClass.slice(0,2), available, occupied, '#ffc107')}</div>
                            <div style="width: 48px; display: flex; align-items: center; justify-content: center;"><div style="height: 100%; width: 2px; background-color: #6c757d;"></div></div>
                            <div style="display: flex; gap: 8px;">${this.renderSeatRow(firstClass.slice(2,4), available, occupied, '#ffc107')}</div>
                        </div>
                    </div>
                    <div style="margin-bottom: 16px; padding: 16px; border-radius: 8px; border: 2px solid #055160; background-color: #cff4fc;">
                        <h6 style="text-align: center; font-weight: bold; color: #055160; margin-bottom: 12px; font-size: 16px;">💼 CLASE EJECUTIVA</h6>
                        ${this.renderClassSection(businessClass, available, occupied, 4, '#055160')}
                    </div>
                    <div style="margin-bottom: 16px; padding: 16px; border-radius: 8px; border: 2px solid #198754; background-color: #d1edff;">
                        <h6 style="text-align: center; font-weight: bold; color: #0f5132; margin-bottom: 12px; font-size: 16px;">🪑 CLASE ECONÓMICA</h6>
                        ${this.renderClassSection(economyClass, available, occupied, 6, '#198754')}
                    </div>
                    <div style="background-color: #6c757d; border-radius: 0 0 8px 8px; height: 48px; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; font-size: 12px;">SALIDA DE EMERGENCIA</div>
                    <div style="margin-top: 16px; display: flex; flex-wrap: wrap; align-items: center; justify-content: center; gap: 12px; font-size: 14px;">
                        <div style="display: flex; align-items: center; gap: 8px;">
                            <div style="width: 32px; height: 32px; background-color: #007bff; border: 4px solid #007bff; border-radius: 4px; display: flex; align-items: center; justify-content: center; color: white; font-size: 12px; font-weight: bold;">S</div>
                            <span style="color: #6c757d;">Seleccionado</span>
                        </div>
                        <div style="display: flex; align-items: center; gap: 8px;">
                            <div style="width: 32px; height: 32px; background-color: #6c757d; border-radius: 4px; display: flex; align-items: center; justify-content: center; color: white; font-size: 12px; font-weight: bold;">O</div>
                            <span style="color: #6c757d;">Ocupado</span>
                        </div>
                    </div>
                </div>
            `;

            this.attachSeatListeners(container);
        },

        renderClassSection(seats, available, occupied, seatsPerRow, color) {
            let html = '';
            for (let i = 0; i < seats.length; i += seatsPerRow) {
                const rowSeats = seats.slice(i, i + seatsPerRow);
                const leftSeats = rowSeats.slice(0, seatsPerRow/2);
                const rightSeats = rowSeats.slice(seatsPerRow/2);
                html += `
                    <div style="display: flex; justify-content: center; gap: 16px; margin-bottom: 8px;">
                        <div style="display: flex; gap: 8px;">${this.renderSeatRow(leftSeats, available, occupied, color)}</div>
                        <div style="width: 48px; display: flex; align-items: center; justify-content: center;"><div style="height: 100%; width: 2px; background-color: #6c757d;"></div></div>
                        <div style="display: flex; gap: 8px;">${this.renderSeatRow(rightSeats, available, occupied, color)}</div>
                    </div>
                `;
            }
            return html;
        },

        renderSeatRow(seats, available, occupied, color) {
            return seats.map(seat => {
                const isOccupied = occupied.includes(seat);
                let style = 'border-radius: 4px; display: flex; align-items: center; justify-content: center; color: white; font-size: 12px; font-weight: bold; width: 40px; height: 40px;';
                if (isOccupied) {
                    style += ' background-color: #6c757d; cursor: not-allowed; opacity: 0.75;';
                } else {
                    style += ` background-color: ${color}; cursor: pointer; transition: opacity 0.2s;`;
                }
                return `<div data-seat="${seat}" data-color="${color}" class="seat" style="${style}">${seat}</div>`;
            }).join('');
        },

        attachSeatListeners(container) {
            const seats = container.querySelectorAll('.seat');
            seats.forEach(seat => {
                if (seat.style.cursor === 'not-allowed') return;
                seat.addEventListener('click', () => {
                    container.querySelectorAll('.seat').forEach(s => {
                        s.style.border = '';
                        if (s.style.cursor !== 'not-allowed') {
                            const originalColor = s.dataset.color;
                            s.style.backgroundColor = originalColor;
                        }
                    });
                    const originalColor = seat.dataset.color;
                    seat.style.backgroundColor = '#007bff';
                    seat.style.border = '4px solid #007bff';
                    this.selectedSeat = seat.dataset.seat;
                });
            });
        },

        confirmSeat() {
            if (!this.selectedSeat) {
                this.showError('Por favor selecciona un asiento.');
                return;
            }
            document.getElementById('NumeroAsiento').value = this.selectedSeat;
            document.getElementById('Clase').value = this.getSeatClass(this.selectedSeat);
            this.seatModal = false;
        },

        getSeatClass(seat) {
            const row = seat.charAt(0);
            if (row === '1') return 'Primera Clase';
            if (['2','3'].includes(row)) return 'Clase Ejecutiva';
            return 'Clase Económica';
        }

    }))
})
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\repositorios\sistema-aeropuerto - copia (4)\resources\views/asientos/create.blade.php ENDPATH**/ ?>