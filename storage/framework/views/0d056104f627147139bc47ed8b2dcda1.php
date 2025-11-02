<?php $__env->startSection('page-title', 'Ver Aerolínea - ' . $aerolinea->NombreAerolinea); ?>

<?php $__env->startSection('content'); ?>
<div class="container mx-auto px-4 py-8 flex justify-center items-start min-h-[70vh]">

    <div class="material-card shadow-xl rounded-lg max-w-xl w-full border-t-4 border-cyan-600 mt-8">
        <div class="p-6">
            
            <div class="flex items-center justify-between mb-6 pb-4 border-b border-gray-200">
                <h2 class="text-3xl font-bold text-gray-800 flex items-center">
                    <i class="material-icons text-cyan-600 mr-2 text-3xl">flight_takeoff</i>
                    Detalles de Aerolínea
                </h2>
                <a href="<?php echo e(route('aerolinea.Listar')); ?>" class="text-gray-400 hover:text-gray-600 transition">
                    <i class="material-icons text-xl">close</i>
                </a>
            </div>

            <div class="space-y-6">
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-cyan-50 p-4 rounded-lg border border-cyan-200">
                    
                    <div class="detail-group border-b-0 pb-0">
                        <label class="detail-label text-base"><i class="material-icons text-base mr-1 align-middle">tag</i> ID Aerolínea</label>
                        
                        <p class="detail-value **text-2xl** font-extrabold text-cyan-800">
                            <?php echo e($aerolinea->IdAerolinea); ?>

                        </p>
                    </div>

                    <div class="detail-group border-b-0 pb-0">
                        <label class="detail-label text-base"><i class="material-icons text-base mr-1 align-middle">business</i> Nombre Comercial</label>
                        
                        <p class="detail-value **text-xl** font-bold text-gray-800">
                            <?php echo e($aerolinea->NombreAerolinea); ?>

                        </p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div class="detail-group">
                        <label class="detail-label text-base"><i class="material-icons text-base mr-1 align-middle">flag</i> País Base</label>
                        
                        <p class="detail-value **text-xl** font-semibold"><?php echo e($aerolinea->Pais); ?></p>
                    </div>

                    <div class="detail-group">
                        <label class="detail-label text-base"><i class="material-icons text-base mr-1 align-middle">location_city</i> Ciudad Base</label>
                        
                        <p class="detail-value **text-xl** font-semibold"><?php echo e($aerolinea->Ciudad); ?></p>
                    </div>
                </div>

                <div class="detail-group border-b-0 pb-0 pt-4 border-t border-gray-100">
                    <label class="detail-label text-base"><i class="material-icons text-base mr-1 align-middle">toggle_on</i> Estado Operacional</label>
                    <?php
                        $statusClass = [
                            'Activo' => 'bg-green-100 text-green-800',
                            'Inactivo' => 'bg-red-100 text-red-800',
                            'default' => 'bg-gray-100 text-gray-800'
                        ];
                    ?>
                    
                    <span class="px-4 py-1 rounded-full **text-2xl** font-bold <?php echo e($statusClass[$aerolinea->Estado] ?? $statusClass['default']); ?>">
                        <?php echo e($aerolinea->Estado); ?>

                    </span>
                </div>
            </div>

            <div class="mt-8 pt-4 border-t border-gray-200 flex justify-end">
                <a href="<?php echo e(route('aerolinea.Listar')); ?>" class="material-btn material-btn-secondary">
                    <i class="material-icons text-sm mr-2">arrow_back</i>
                    Cerrar
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
        /* Se hizo el label más grande (text-base) */
        @apply block font-medium text-gray-500 mb-0.5 flex items-center;
    }
    .detail-value {
        @apply text-gray-900;
    }
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\repositorios\sistema-aeropuerto - copia (4)\resources\views/aerolinea/Show.blade.php ENDPATH**/ ?>