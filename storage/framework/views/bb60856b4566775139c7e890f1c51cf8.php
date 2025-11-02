<?php $__env->startSection('page-title', 'Eliminar Horario - Sistema Aeropuerto'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mx-auto px-4 py-8 flex justify-center items-center min-h-[70vh]">

    <div class="material-card shadow-xl rounded-lg max-w-lg w-full border-t-4 border-red-600">
        
        <div class="p-6">
            
            <div class="flex items-center justify-between mb-4 pb-4 border-b border-gray-200">
                <h2 class="text-2xl font-bold text-gray-800 flex items-center">
                    <i class="material-icons text-red-600 mr-2 text-3xl">delete_forever</i>
                    Confirmar Eliminación de Horario
                </h2>
                
                <a href="<?php echo e(route('horario.index')); ?>" class="text-gray-400 hover:text-gray-600 transition">
                    <i class="material-icons">close</i>
                </a>
            </div>

            <form method="POST" action="<?php echo e(route('horario.destroy', $horario)); ?>">
                <?php echo csrf_field(); ?>
                <?php echo method_field('DELETE'); ?>

                <div class="modal-body mb-6">
                    <p class="text-lg text-gray-700 mb-4 font-semibold">
                        ¿Está seguro de que desea eliminar el horario **#<?php echo e($horario->IdHorario); ?>**?
                    </p>
                    <p class="text-sm text-red-700 bg-red-50 p-3 rounded-lg border border-red-200 mb-4 font-bold">
                        Esta acción es **irreversible**. El registro se perderá permanentemente.
                    </p>

                    <div class="space-y-4 p-4 bg-gray-50 rounded-md border border-gray-100">
                        
                        <div class="detail-group">
                            <label class="detail-label"><i class="material-icons text-sm mr-1 align-middle">flight_takeoff</i>Vuelo</label>
                            
                            <p class="detail-value **text-base md:text-lg** font-bold text-indigo-700">
                                #<?php echo e($horario->vuelo->IdVuelo ?? 'N/A'); ?>

                                <span class="block text-gray-600 font-semibold text-sm mt-1">
                                    <?php echo e($horario->vuelo->aeropuertoOrigen->NombreAeropuerto ?? 'N/A'); ?> **→** <?php echo e($horario->vuelo->aeropuertoDestino->NombreAeropuerto ?? 'N/A'); ?>

                                </span>
                            </p>
                        </div>

                        <div class="detail-group">
                            <label class="detail-label"><i class="material-icons text-sm mr-1 align-middle">access_time</i>Salida y Llegada</label>
                            
                            <p class="detail-value **text-xl** font-extrabold text-gray-900">
                                **<?php echo e($horario->HoraSalida); ?>** → **<?php echo e($horario->HoraLlegada); ?>**
                            </p>
                        </div>
                        
                        <div class="detail-group">
                            <label class="detail-label"><i class="material-icons text-sm mr-1 align-middle">timelapse</i>Tiempo de Espera</label>
                            <p class="detail-value **text-xl** font-extrabold text-gray-700"><?php echo e($horario->TiempoEspera); ?> min</p>
                        </div>

                        <div class="detail-group border-b-0 pb-0">
                            <label class="detail-label"><i class="material-icons text-sm mr-1 align-middle">flag</i>Estado</label>
                            <p class="detail-value **text-base**"><?php echo e($horario->Estado); ?></p>
                        </div>
                    </div>
                </div>
                
                <div class="mt-6 pt-4 border-t border-gray-200 flex justify-end gap-4">
                    
                    <a href="<?php echo e(route('horario.index')); ?>" class="material-btn material-btn-secondary flex-none px-6">
                        <i class="material-icons text-sm mr-2">cancel</i>
                        Cancelar
                    </a>
                    
                    <button type="submit" style="background: linear-gradient(135deg, var(--color-danger), #f56565); color: white;" class="material-btn flex-none px-6">
                        <i class="material-icons text-sm mr-2">delete</i>
                        Sí, Eliminar Horario
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    /* Estilos de utilidad para agrupar la información */
    .detail-group {
        @apply mb-3 pb-2 border-b border-gray-100;
    }
    .detail-label {
        @apply block text-sm font-medium text-gray-500 mb-0.5 flex items-center;
    }
    .detail-value {
        @apply text-gray-900;
    }
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\repositorios\sistema-aeropuerto - copia (4)\resources\views/Horario/Delete.blade.php ENDPATH**/ ?>