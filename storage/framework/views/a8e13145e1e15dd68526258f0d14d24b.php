<?php $__env->startSection('page-title', 'Ver Horario - ' . $horario->IdHorario); ?>

<?php $__env->startSection('content'); ?>
<div class="container mx-auto px-4 py-8 flex justify-center items-start min-h-[70vh]">

    <div class="material-card shadow-xl rounded-lg max-w-xl w-full border-t-4 border-indigo-500 mt-8">
        <div class="p-6">
            
            <div class="flex items-center justify-between mb-4 pb-4 border-b border-gray-200">
                <h2 class="text-2xl font-bold text-gray-800 flex items-center">
                    <i class="material-icons text-indigo-600 mr-2 text-3xl">schedule</i>
                    Horario **#<?php echo e($horario->IdHorario); ?>**
                </h2>
                <a href="<?php echo e(route('horario.index')); ?>" class="text-gray-400 hover:text-gray-600 transition">
                    <i class="material-icons">close</i>
                </a>
            </div>

            <div class="modal-body space-y-5">
                
                <div class="detail-group">
                    <label class="detail-label"><i class="material-icons text-sm mr-1 align-middle">flight_takeoff</i>Vuelo Asociado</label>
                    <p class="detail-value text-lg font-bold text-indigo-700">
                        #<?php echo e($horario->vuelo->IdVuelo ?? 'N/A'); ?>

                    </p>
                    <p class="text-base text-gray-600">
                        Ruta: <?php echo e($horario->vuelo->aeropuertoOrigen->NombreAeropuerto ?? 'N/A'); ?> **→** <?php echo e($horario->vuelo->aeropuertoDestino->NombreAeropuerto ?? 'N/A'); ?>

                    </p>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="detail-group">
                        <label class="detail-label"><i class="material-icons text-sm mr-1 align-middle">access_time</i>Hora de Salida</label>
                        <p class="detail-value text-2xl font-extrabold text-red-700">
                            <?php echo e($horario->HoraSalida); ?>

                        </p>
                    </div>
                    <div class="detail-group">
                        <label class="detail-label"><i class="material-icons text-sm mr-1 align-middle">schedule</i>Hora de Llegada</label>
                        <p class="detail-value text-2xl font-extrabold text-green-700">
                            <?php echo e($horario->HoraLlegada); ?>

                        </p>
                    </div>
                </div>

                <div class="detail-group">
                    <label class="detail-label"><i class="material-icons text-sm mr-1 align-middle">timelapse</i>Tiempo de Espera</label>
                    <p class="detail-value text-xl font-extrabold text-gray-800">
                        <?php echo e($horario->TiempoEspera); ?> minutos
                    </p>
                </div>

                <div class="detail-group border-b-0 pb-0">
                    <label class="detail-label"><i class="material-icons text-sm mr-1 align-middle">flag</i>Estado</label>
                    <?php
                        $statusClass = [
                            'Activo' => 'bg-green-100 text-green-800',
                            'Inactivo' => 'bg-red-100 text-red-800',
                            'Cancelado' => 'bg-red-500 text-white',
                            'default' => 'bg-gray-100 text-gray-800'
                        ];
                    ?>
                    <span class="px-3 py-1 rounded-full text-sm font-semibold <?php echo e($statusClass[$horario->Estado] ?? $statusClass['default']); ?>">
                        <?php echo e($horario->Estado); ?>

                    </span>
                </div>
            </div>

            <div class="mt-8 pt-4 border-t border-gray-200 flex justify-end">
                <a href="<?php echo e(route('horario.index')); ?>" class="material-btn material-btn-secondary">
                    <i class="material-icons text-sm mr-2">arrow_back</i>
                    Volver a la Lista
                </a>
            </div>
        </div>
    </div>
</div>

<style>
    /* Estilos de utilidad para agrupar la información */
    .detail-group {
        @apply mb-4 pb-2 border-b border-gray-100;
    }
    .detail-label {
        @apply block text-sm font-medium text-gray-500 mb-0.5 flex items-center;
    }
    .detail-value {
        @apply text-gray-900;
    }
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\repositorios\sistema-aeropuerto - copia (4)\resources\views/Horario/Show.blade.php ENDPATH**/ ?>