<?php $__env->startSection('page-title', 'Ver Escala - ' . $escala->IdEscala); ?>

<?php $__env->startSection('content'); ?>
<div class="container mx-auto px-4 py-8">
    
    <div class="mb-6 flex items-center justify-between">
        <h1 class="text-3xl font-bold text-gray-800 flex items-center">
            <i class="material-icons text-purple-600 mr-2 text-3xl">schedule</i>
            Detalles de Escala
        </h1>
        <a href="<?php echo e(route('escala.index')); ?>" class="material-btn material-btn-secondary flex items-center">
            <i class="material-icons text-sm mr-2">arrow_back</i>
            Volver a Escalas
        </a>
    </div>

    <div class="material-card shadow-xl rounded-lg max-w-3xl mx-auto border-t-4 border-purple-500">
        <div class="p-6">
            
            <h2 class="text-2xl font-semibold text-gray-700 mb-6 border-b pb-3 flex items-center">
                Información de Parada Técnica - Escala **#<?php echo e($escala->IdEscala); ?>**
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-6">

                <div class="detail-group">
                    <label class="detail-label"><i class="material-icons text-sm mr-1 align-middle">flight_takeoff</i>Vuelo Asociado</label>
                    <p class="detail-value font-semibold text-blue-700 text-lg">
                        #<?php echo e($escala->vuelo->IdVuelo ?? 'N/A'); ?>

                    </p>
                    <p class="text-sm text-gray-600">
                        Ruta: <?php echo e($escala->vuelo->aeropuertoOrigen->NombreAeropuerto ?? 'N/A'); ?> **→** <?php echo e($escala->vuelo->aeropuertoDestino->NombreAeropuerto ?? 'N/A'); ?>

                    </p>
                </div>

                <div class="detail-group">
                    <label class="detail-label"><i class="material-icons text-sm mr-1 align-middle">location_city</i>Aeropuerto de Parada</label>
                    <p class="detail-value text-lg">
                        **<?php echo e($escala->aeropuerto->NombreAeropuerto ?? 'N/A'); ?>**
                    </p>
                    <p class="text-sm text-gray-600">
                        Código: <?php echo e($escala->aeropuerto->IdAeropuerto ?? 'N/A'); ?>

                    </p>
                </div>

                <div class="detail-group">
                    <label class="detail-label"><i class="material-icons text-sm mr-1 align-middle">access_time</i>Hora de Llegada</label>
                    <p class="detail-value text-xl font-bold text-green-700">
                        <?php echo e(\Carbon\Carbon::parse($escala->HoraLlegada)->format('H:i')); ?> hrs
                    </p>
                </div>
                
                <div class="detail-group">
                    <label class="detail-label"><i class="material-icons text-sm mr-1 align-middle">departure_board</i>Hora de Salida</label>
                    <p class="detail-value text-xl font-bold text-red-700">
                        <?php echo e(\Carbon\Carbon::parse($escala->HoraSalida)->format('H:i')); ?> hrs
                    </p>
                </div>

                <div class="detail-group">
                    <label class="detail-label"><i class="material-icons text-sm mr-1 align-middle">timelapse</i>Tiempo de Espera</label>
                    <p class="detail-value text-2xl font-extrabold text-purple-600">
                        <?php echo e($escala->TiempoEspera); ?> min
                    </p>
                </div>

                <div class="detail-group">
                    <label class="detail-label"><i class="material-icons text-sm mr-1 align-middle">flag</i>Estado</label>
                    <?php
                        $statusClass = [
                            'Activo' => 'bg-green-100 text-green-800',
                            'Inactivo' => 'bg-red-100 text-red-800',
                            'Programada' => 'bg-blue-100 text-blue-800',
                            'Finalizada' => 'bg-gray-100 text-gray-800',
                            'default' => 'bg-gray-100 text-gray-800'
                        ];
                    ?>
                    <span class="px-3 py-1 rounded-full text-sm font-semibold <?php echo e($statusClass[$escala->Estado] ?? $statusClass['default']); ?>">
                        <?php echo e($escala->Estado); ?>

                    </span>
                </div>
                
            </div>

            <div class="mt-8 pt-4 border-t border-gray-200 flex justify-end">
                 <a href="<?php echo e(route('escala.index')); ?>" class="material-btn material-btn-secondary">
                    <i class="material-icons text-sm mr-2">arrow_back</i>
                    Volver
                </a>
            </div>
        </div>
    </div>
</div>

<style>
    /* Estilos de utilidad para agrupar la información */
    .detail-group {
        @apply mb-4;
    }
    .detail-label {
        @apply block text-sm font-medium text-gray-500 mb-0.5 flex items-center;
    }
    .detail-value {
        @apply text-gray-900;
    }
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\repositorios\sistema-aeropuerto - copia (4)\resources\views/Escala/Show.blade.php ENDPATH**/ ?>