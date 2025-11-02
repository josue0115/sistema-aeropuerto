<?php $__env->startSection('page-title', 'Detalles de Factura - ' . $factura[0]->idFactura); ?>

<?php $__env->startSection('content'); ?>
<div class="container mx-auto px-4 py-8 flex justify-center items-start min-h-[70vh]">

    <div class="material-card shadow-xl rounded-lg max-w-4xl w-full border-t-4 border-teal-600 mt-8">
        <div class="p-6">
            
            <div class="flex items-center justify-between mb-6 pb-4 border-b border-gray-200">
                <h2 class="text-3xl font-bold text-gray-800 flex items-center">
                    <i class="material-icons text-teal-600 mr-2 text-3xl">receipt_long</i>
                    Detalles de la Factura
                </h2>
               
            </div>

            <div class="space-y-6">
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-teal-50 p-4 rounded-lg border border-teal-200">
                    
                    <div class="detail-group border-b-0 pb-0">
                        <label class="detail-label text-base"><i class="material-icons text-base mr-1 align-middle">tag</i> ID de Factura</label>
                        <p class="detail-value **text-2xl** font-extrabold text-teal-800">
                            <?php echo e($factura[0]->idFactura); ?>

                        </p>
                    </div>

                    <div class="detail-group border-b-0 pb-0">
                        <label class="detail-label text-base"><i class="material-icons text-base mr-1 align-middle">calendar_today</i> Fecha de Emisión</label>
                        <p class="detail-value **text-xl** font-bold text-gray-800">
                            <?php echo e(\Carbon\Carbon::parse($factura[0]->FechaEmision)->format('d/m/Y H:i')); ?>

                        </p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div class="detail-group">
                        <label class="detail-label text-base"><i class="material-icons text-base mr-1 align-middle">confirmation_number</i> ID de Boleto</label>
                        <p class="detail-value **text-xl** font-semibold text-gray-900">
                            <?php echo e($factura[0]->idBoleto); ?>

                        </p>
                    </div>

                    <div class="detail-group">
                        <label class="detail-label text-base"><i class="material-icons text-base mr-1 align-middle">money</i> Monto Base</label>
                        <p class="detail-value **text-xl** font-semibold text-gray-900">
                            <?php echo e(number_format($factura[0]->monto, 2)); ?>

                        </p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-4 border-t border-gray-100">
                    <div class="detail-group">
                        <label class="detail-label text-base"><i class="material-icons text-base mr-1 align-middle">percent</i> Impuesto Aplicado</label>
                        <p class="detail-value **text-xl** font-semibold text-gray-900">
                            <?php echo e(number_format($factura[0]->impuesto, 2)); ?>

                        </p>
                    </div>

                    <div class="detail-group">
                        <label class="detail-label text-base text-teal-600 font-bold"><i class="material-icons text-base mr-1 align-middle">payments</i> Monto Total</label>
                        <p class="detail-value **text-3xl** font-extrabold text-teal-700">
                            <?php echo e(number_format($factura[0]->MontoTotal, 2)); ?>

                        </p>
                    </div>
                </div>
                
                <div class="detail-group border-b-0 pb-0 pt-4 border-t border-gray-100">
                    <label class="detail-label text-base"><i class="material-icons text-base mr-1 align-middle">toggle_on</i> Estado</label>
                    <?php
                        $statusText = $factura[0]->Estado ?: 'N/A';
                        $statusClass = [
                            'Pagada' => 'bg-green-100 text-green-800',
                            'Pendiente' => 'bg-yellow-100 text-yellow-800',
                            'Anulada' => 'bg-red-100 text-red-800',
                            'default' => 'bg-gray-100 text-gray-800'
                        ];
                    ?>
                    <span class="px-4 py-1 rounded-full **text-xl** font-bold <?php echo e($statusClass[$statusText] ?? $statusClass['default']); ?>">
                        <?php echo e($statusText); ?>

                    </span>
                </div>
            </div>

            <div class="mt-8 pt-4 border-t border-gray-200 flex justify-end space-x-3">
                
                 <a href="<?php echo e(route('facturas.index')); ?>" class="material-btn material-btn-secondary">
                    <i class="material-icons text-sm mr-2">arrow_back</i>
                    Volver al Listado
                </a>

                <form action="<?php echo e(route('facturas.destroy', $factura[0]->idFactura)); ?>" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar esta factura?');" class="inline-block">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit" style="background-color: #dc2626;" class="material-btn text-white hover:bg-red-700">
                        <i class="material-icons text-sm mr-2">delete</i>
                        Eliminar
                    </button>
                </form>
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
        @apply block font-medium text-gray-500 mb-0.5 flex items-center;
    }
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\repositorios\sistema-aeropuerto - copia (4)\resources\views/facturas/show.blade.php ENDPATH**/ ?>