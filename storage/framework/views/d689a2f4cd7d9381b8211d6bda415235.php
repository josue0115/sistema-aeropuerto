<?php $__env->startSection('page-title', 'Eliminar Aeropuerto'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mx-auto px-4 py-8 flex justify-center items-start min-h-[70vh]">

    <div class="material-card shadow-xl rounded-lg max-w-xl w-full border-t-4 border-red-600 mt-8">
        
        <div class="p-6 bg-red-100 border-b border-red-300">
            <h1 class="text-2xl font-bold text-red-800 flex items-center">
                <i class="material-icons text-red-600 mr-2 text-3xl">delete_forever</i>
                Confirmar Eliminación de Aeropuerto
            </h1>
            <p class="mt-2 text-red-700 font-semibold">
                ¿Estás seguro de que deseas eliminar este aeropuerto? **Esta acción no se puede deshacer.**
            </p>
        </div>

        <div class="p-6 space-y-4">
            
            <p class="text-gray-700 text-lg mb-4">
                Por favor, revisa los detalles antes de proceder a la eliminación permanente.
            </p>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 bg-gray-50 p-4 rounded-md border border-gray-200">
                
                <div class="detail-group">
                    <label class="detail-label text-sm"><i class="material-icons text-xs mr-1 align-middle">tag</i> ID del Aeropuerto</label>
                    <p class="detail-value text-lg font-semibold text-gray-800"><?php echo e($aeropuerto->IdAeropuerto); ?></p>
                </div>

                <div class="detail-group">
                    <label class="detail-label text-sm"><i class="material-icons text-xs mr-1 align-middle">business</i> Nombre</label>
                    <p class="detail-value text-lg font-semibold text-gray-800"><?php echo e($aeropuerto->NombreAeropuerto); ?></p>
                </div>

                <div class="detail-group">
                    <label class="detail-label text-sm"><i class="material-icons text-xs mr-1 align-middle">flag</i> País</label>
                    <p class="detail-value text-lg font-semibold text-gray-800"><?php echo e($aeropuerto->Pais); ?></p>
                </div>

                <div class="detail-group">
                    <label class="detail-label text-sm"><i class="material-icons text-xs mr-1 align-middle">location_city</i> Ciudad</label>
                    <p class="detail-value text-lg font-semibold text-gray-800"><?php echo e($aeropuerto->Ciudad); ?></p>
                </div>
            </div>

            <form action="<?php echo e(route('aeropuerto.destroy', $aeropuerto->IdAeropuerto)); ?>" method="POST" class="pt-6 border-t border-gray-200">
                <?php echo csrf_field(); ?>
                <?php echo method_field('DELETE'); ?>

                <div class="flex justify-end space-x-4">
                    <a href="<?php echo e(route('aeropuerto.listar')); ?>" class="material-btn material-btn-secondary">
                        <i class="material-icons text-sm mr-2">cancel</i>
                        Cancelar
                    </a>
                    <button type="submit" style="background-color: #dc2626;" class="material-btn text-white hover:bg-red-700 focus:ring-red-500">
                        <i class="material-icons text-sm mr-2">delete</i>
                        Sí, Eliminar Permanentemente
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    /* Estilos de utilidad para detalles (manteniendo la consistencia) */
    .detail-group {
        @apply mb-0; /* No se necesita margen inferior dentro del grid */
    }
    .detail-label {
        @apply block font-medium text-gray-500 mb-0.5 flex items-center;
    }
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\repositorios\sistema-aeropuerto - copia (4)\resources\views/Aeropuerto/Delete.blade.php ENDPATH**/ ?>