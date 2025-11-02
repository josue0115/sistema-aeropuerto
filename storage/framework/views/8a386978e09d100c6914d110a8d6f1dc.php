<?php $__env->startSection('page-title', 'Ver Avión - ' . $avion->Placa); ?>

<?php $__env->startSection('content'); ?>
<div class="container mx-auto px-4 py-8 flex justify-center items-start min-h-[70vh]">

    <div class="material-card shadow-xl rounded-lg max-w-2xl w-full border-t-4 border-purple-600 mt-8">
        <div class="p-6">
            
            <div class="flex items-center justify-between mb-6 pb-4 border-b border-gray-200">
                <h2 class="text-3xl font-bold text-gray-800 flex items-center">
                    <i class="material-icons text-purple-600 mr-2 text-3xl">airplanemode_active</i>
                    Avión **#<?php echo e($avion->IdAvion); ?>**
                </h2>
                <a href="<?php echo e(route('avion.listar')); ?>" class="text-gray-400 hover:text-gray-600 transition">
                    <i class="material-icons text-xl">close</i>
                </a>
            </div>

            <div class="space-y-6">
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-purple-50 p-6 rounded-lg border border-purple-200">
                    
                    <div class="detail-group border-b-0 pb-0">
                        <label class="detail-label text-base"><i class="material-icons text-base mr-1 align-middle">credit_card</i> **PLACA DE REGISTRO**</label>
                        
                        <p class="detail-value **text-4xl** font-extrabold text-purple-800">
                            <?php echo e($avion->Placa); ?>

                        </p>
                    </div>

                    <div class="detail-group border-b-0 pb-0">
                        <label class="detail-label text-base"><i class="material-icons text-base mr-1 align-middle">flight</i> Aerolínea</label>
                        
                        <p class="detail-value **text-2xl** font-bold text-gray-800">
                            <?php echo e($avion->aerolinea->NombreAerolinea ?? 'N/A'); ?> 
                            <span class="text-base font-normal text-gray-500 block">(<?php echo e($avion->IdAerolinea); ?>)</span>
                        </p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                    <div class="detail-group">
                        <label class="detail-label text-base"><i class="material-icons text-base mr-1 align-middle">category</i> Tipo</label>
                        
                        <p class="detail-value **text-xl** font-semibold"><?php echo e($avion->Tipo); ?></p>
                    </div>

                    <div class="detail-group">
                        <label class="detail-label text-base"><i class="material-icons text-base mr-1 align-middle">build</i> Modelo</label>
                        
                        <p class="detail-value **text-xl** font-semibold"><?php echo e($avion->Modelo); ?></p>
                    </div>
                    
                    <div class="detail-group">
                        <label class="detail-label text-base"><i class="material-icons text-base mr-1 align-middle">people</i> Capacidad (Asientos)</label>
                        
                        <p class="detail-value **text-3xl** font-extrabold text-green-700"><?php echo e($avion->Capacidad); ?></p>
                    </div>

                </div>

                <div class="detail-group border-b-0 pb-0 pt-4 border-t border-gray-100">
                    <label class="detail-label text-base"><i class="material-icons text-base mr-1 align-middle">toggle_on</i> Estado Actual</label>
                    <?php
                        $statusClass = [
                            'Activo' => 'bg-green-100 text-green-800',
                            'Inactivo' => 'bg-red-100 text-red-800',
                            'default' => 'bg-gray-100 text-gray-800'
                        ];
                    ?>
                    
                    <span class="px-4 py-1 rounded-full **text-2xl** font-bold <?php echo e($statusClass[$avion->Estado] ?? $statusClass['default']); ?>">
                        <?php echo e($avion->Estado); ?>

                    </span>
                </div>
            </div>

            <div class="mt-8 pt-4 border-t border-gray-200 flex justify-end">
                <a href="<?php echo e(route('avion.listar')); ?>" class="material-btn material-btn-secondary">
                    <i class="material-icons text-sm mr-2">arrow_back</i>
                    Cerrar y Volver
                </a>
            </div>
        </div>
    </div>
</div>

<style>
    /* Estilos de utilidad para agrupar la información */
    .detail-group {
        /* Se mantiene el padding vertical para acomodar el texto más grande */
        @apply mb-4 pb-2 border-b border-gray-100;
    }
    .detail-label {
        /* Se hizo el label más grande (text-base) */
        @apply block font-medium text-gray-500 mb-0.5 flex items-center;
    }
    .detail-value {
        @apply text-gray-900;
    }
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\repositorios\sistema-aeropuerto - copia (4)\resources\views/Avion/Show.blade.php ENDPATH**/ ?>