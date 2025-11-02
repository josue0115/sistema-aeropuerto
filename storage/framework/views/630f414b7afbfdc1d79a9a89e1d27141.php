<?php $__env->startSection('content'); ?>
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-md p-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Reportes del Sistema</h1>

        <p class="text-gray-600 mb-6">Selecciona el tipo de reporte que deseas generar</p>

        <!-- Botones principales para seleccionar reporte -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <a href="<?php echo e(route('reportes.disponibilidad-boletos.ver')); ?>" target="_blank"
               class="bg-blue-600 text-white px-6 py-4 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors text-center block">
                <div class="text-2xl mb-2">
                    <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                    </svg>
                </div>
                <div class="font-semibold text-lg mb-1">Disponibilidad de Boletos</div>
                <div class="text-sm opacity-90">Por vuelo y fecha</div>
            </a>

            <a href="<?php echo e(route('reportes.boletos-facturados.ver')); ?>" target="_blank"
               class="bg-green-600 text-white px-6 py-4 rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 transition-colors text-center block">
                <div class="text-2xl mb-2">
                    <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <div class="font-semibold text-lg mb-1">Boletos Facturados</div>
                <div class="text-sm opacity-90">Por cliente y fecha</div>
            </a>
        </div>

        <div class="mt-8 text-center text-gray-500">
            <p>Ambos reportes incluyen funcionalidad de búsqueda y exportación a Excel</p>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\repositorios\sistema-aeropuerto - copia (4)\resources\views/reportes.blade.php ENDPATH**/ ?>