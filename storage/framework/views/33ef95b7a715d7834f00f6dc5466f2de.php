<?php $__env->startSection('page-title', 'Detalles del Mantenimiento'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mx-auto px-4 py-6"> 
    <div class="mb-5"> 
        <div class="flex items-center justify-between mb-3"> 
            <div>
                <h1 class="text-2xl font-bold text-gray-800 mb-1 flex items-center"> 
                    <i class="material-icons text-blue-600 mr-2 text-2xl">build</i> 
                    Detalles del Mantenimiento ID: **#<?php echo e($mantenimiento->Id_mantenimiento); ?>**
                </h1>
                <p class="text-gray-600 text-base"> 
                    Información completa sobre el servicio y costos asociados.
                </p>
            </div>
            <div class="flex space-x-2"> 
                <a href="<?php echo e(route('mantenimiento.listar')); ?>" class="material-btn material-btn-secondary flex items-center px-4 py-2 text-sm"> 
                    <i class="material-icons text-xs mr-2">arrow_back</i> 
                    Volver a la Lista
                </a>
            </div>
        </div>
    </div>
    
    <div class="material-card shadow-xl rounded-lg max-w-5xl mx-auto">
        <div class="p-5"> 
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-6 border-b pb-5"> 
                
                <div class="col-span-1 border-r pr-5"> 
                    <p class="text-xs font-semibold text-gray-500 mb-1">Tipo de Servicio</p> 
                    <p class="text-xl font-bold text-indigo-700"><?php echo e($mantenimiento->Tipo); ?></p> 
                    <p class="mt-3 text-xs font-semibold text-gray-500 mb-1">Estado</p> 
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                        <?php if($mantenimiento->Estado == 'Completado'): ?> 
                            bg-green-100 text-green-800
                        <?php elseif($mantenimiento->Estado == 'En Progreso'): ?> 
                            bg-yellow-100 text-yellow-800
                        <?php else: ?> 
                            bg-gray-100 text-gray-800 
                        <?php endif; ?>">
                        <i class="material-icons text-xs mr-1">
                            <?php if($mantenimiento->Estado == 'Completado'): ?> check_circle 
                            <?php elseif($mantenimiento->Estado == 'En Progreso'): ?> loop
                            <?php else: ?> schedule 
                            <?php endif; ?>
                        </i>
                        <?php echo e($mantenimiento->Estado); ?>

                    </span>
                </div>

                <div class="col-span-1 border-r pr-5"> 
                    <p class="text-xs font-semibold text-gray-500 mb-1">Fecha de Ingreso</p> 
                    <p class="text-base font-bold text-gray-900 flex items-center"> 
                        <i class="material-icons text-xs mr-1">event_available</i> 
                        <?php echo e(\Carbon\Carbon::parse($mantenimiento->FechaIngreso)->locale('es')->isoFormat('D MMMM YYYY')); ?>

                    </p>
                    <p class="mt-3 text-xs font-semibold text-gray-500 mb-1">Fecha de Salida</p> 
                    <p class="text-base font-bold text-gray-900 flex items-center"> 
                        <i class="material-icons text-xs mr-1">event_busy</i> 
                        <?php echo e(\Carbon\Carbon::parse($mantenimiento->FechaSalida)->locale('es')->isoFormat('D MMMM YYYY')); ?>

                    </p>
                </div>
                
                <div class="col-span-1">
                    <p class="text-xs font-semibold text-gray-500 mb-1">Costo Total</p> 
                    <p class="text-xl font-bold text-green-700"> 
                        Q <?php echo e(number_format($mantenimiento->Costo + $mantenimiento->CostoExtra, 2)); ?>

                    </p>
                    <p class="text-xs text-gray-500 mt-2">Base: Q <?php echo e(number_format($mantenimiento->Costo, 2)); ?></p> 
                    <p class="text-xs text-gray-500">Extra: Q <?php echo e(number_format($mantenimiento->CostoExtra, 2)); ?></p> 
                </div>
            </div>
            
            <h5 class="text-base font-semibold text-gray-700 border-b pb-2 mb-4 flex items-center"> 
                <i class="material-icons text-xs mr-2 text-gray-500">people</i> 
                Actores Involucrados
            </h5>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6"> 
                
                <div class="bg-gray-50 p-3 rounded-lg border border-gray-200"> 
                    <p class="text-xs font-semibold text-gray-500 mb-1 flex items-center"><i class="material-icons text-xs mr-1 text-blue-500">flight</i> Avión</p> 
                    <p class="text-lg font-bold text-gray-900"><?php echo e($mantenimiento->avion->Placa ?? 'N/A'); ?></p> 
                    <p class="text-gray-800 text-xs mt-1">ID: <?php echo e($mantenimiento->avion->IdAvion ?? 'N/A'); ?></p> 
                </div>

                <div class="bg-gray-50 p-3 rounded-lg border border-gray-200"> 
                    <p class="text-xs font-semibold text-gray-500 mb-1 flex items-center"><i class="material-icons text-xs mr-1 text-orange-500">person</i> Personal Asignado</p> 
                    <p class="text-lg font-bold text-gray-900"><?php echo e($mantenimiento->personal->Nombre ?? 'N/A'); ?> <?php echo e($mantenimiento->personal->Apellido ?? 'N/A'); ?></p> 
                    <p class="text-gray-800 text-xs mt-1">ID: <?php echo e($mantenimiento->personal->IdPersonal ?? 'N/A'); ?></p> 
                </div>
            </div>
            
            <h5 class="text-base font-semibold text-gray-700 border-b pb-2 mb-3 flex items-center"> 
                <i class="material-icons text-xs mr-2 text-gray-500">description</i> 
                Descripción del Servicio
            </h5>
            <div class="mb-5 bg-white p-3 border rounded-lg shadow-inner"> 
                <p class="text-sm text-gray-800 whitespace-pre-line"><?php echo e($mantenimiento->Descripcion); ?></p> 
            </div>


            <div class="flex justify-start mt-6 pt-5 border-t border-gray-200"> 
                <a href="<?php echo e(route('mantenimiento.listar')); ?>" class="material-btn material-btn-secondary flex items-center px-5 py-2 text-sm"> 
                    <i class="material-icons text-xs mr-2">close</i> 
                    Cerrar Detalles
                </a>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\repositorios\sistema-aeropuerto - copia (4)\resources\views/Mantenimiento/Ver.blade.php ENDPATH**/ ?>