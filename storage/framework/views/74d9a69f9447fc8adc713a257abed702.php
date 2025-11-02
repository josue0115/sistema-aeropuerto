<?php $__env->startSection('page-title', 'Eliminar Vuelo - Sistema Aeropuerto'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mx-auto px-4 py-8 flex justify-center items-center min-h-[70vh]">

    <div class="material-card shadow-xl rounded-lg max-w-lg w-full border-t-4 border-red-600">
        
        <div class="p-6">
            
            <div class="flex items-center justify-between mb-4 pb-4 border-b border-gray-200">
                <h2 class="text-2xl font-bold text-gray-800 flex items-center">
                    <i class="material-icons text-red-600 mr-2 text-3xl">delete_forever</i>
                    Confirmar Eliminación
                </h2>
                
                <a href="<?php echo e(route('vuelo.listar')); ?>" class="text-gray-400 hover:text-gray-600 transition">
                    <i class="material-icons">close</i>
                </a>
            </div>

            <div class="modal-body mb-6">
                <p class="text-lg text-gray-700 mb-4 font-semibold">
                    ¿Estás seguro de que deseas eliminar permanentemente el siguiente vuelo?
                </p>
                <p class="text-sm text-red-700 bg-red-50 p-3 rounded-lg border border-red-200 mb-4">
                    **¡Esta acción no se puede deshacer!**
                </p>

                <div class="space-y-3 p-4 bg-gray-50 rounded-md border border-gray-100">
                    
                    <div class="detail-group">
                        <label class="detail-label"><i class="material-icons text-sm mr-1 align-middle">vpn_key</i>ID del Vuelo</label>
                        <p class="detail-value text-base font-bold text-red-800"><?php echo e($vuelo->IdVuelo); ?></p>
                    </div>

                    <div class="detail-group">
                        <label class="detail-label"><i class="material-icons text-sm mr-1 align-middle">airplanemode_active</i>Avión</label>
                        <p class="detail-value text-sm"><?php echo e($vuelo->avion->IdAvion ?? 'N/A'); ?> - <?php echo e($vuelo->avion->Placa ?? 'N/A'); ?></p>
                    </div>

                    <div class="detail-group">
                        <label class="detail-label"><i class="material-icons text-sm mr-1 align-middle">location_on</i>Ruta (Origen - Destino)</label>
                        <p class="detail-value text-sm">
                            <?php echo e($vuelo->aeropuertoOrigen->NombreAeropuerto ?? 'N/A'); ?> **➜** <?php echo e($vuelo->aeropuertoDestino->NombreAeropuerto ?? 'N/A'); ?>

                        </p>
                    </div>
                    
                    <div class="detail-group border-b-0 pb-0">
                        <label class="detail-label"><i class="material-icons text-sm mr-1 align-middle">paid</i>Precio del Boleto</label>
                        <p class="detail-value text-lg font-bold text-green-600">Q<?php echo e(number_format($vuelo->Precio ?? 0, 2)); ?></p>
                    </div>
                </div>
            </div>
            
            <div class="mt-6 pt-4 border-t border-gray-200 flex justify-end gap-4">
                
                <a href="<?php echo e(route('vuelo.listar')); ?>" class="material-btn material-btn-secondary flex-none px-6">
                    <i class="material-icons text-sm mr-2">cancel</i>
                    Cancelar
                </a>
                
                
                <form action="<?php echo e(route('vuelo.destroy', $vuelo->IdVuelo)); ?>" method="POST" class="inline-block">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit" style="background: linear-gradient(135deg, var(--color-danger), #f56565); color: white;" class="material-btn flex-none px-6">
                        <i class="material-icons text-sm mr-2">delete</i>
                        Sí, Eliminar Vuelo
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    /* Estilos de utilidad para agrupar la información */
    .detail-group {
        @apply mb-2 pb-1 border-b border-gray-100 last:border-b-0 last:pb-0;
    }
    .detail-label {
        @apply block text-xs font-medium text-gray-500 mb-0.5 flex items-center;
    }
    .detail-value {
        @apply text-gray-900;
    }
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\repositorios\sistema-aeropuerto - copia (4)\resources\views/Vuelo/Delete.blade.php ENDPATH**/ ?>