<?php $__env->startSection('page-title', 'Detalles del Pasajero - Sistema Aeropuerto'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mx-auto px-4 py-8">
    <div class="mb-6">
        <div class="flex items-center justify-between mb-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-800 mb-1 flex items-center">
                    <i class="material-icons text-blue-600 mr-2 text-3xl">info</i>
                    Detalles del Pasajero
                </h1>
                <p class="text-gray-600 text-lg">Información completa del pasajero #<?php echo e($pasajero[0]->idPasajero); ?></p>
            </div>
            <div class="flex space-x-3">
                <a href="<?php echo e(route('pasajeros.index')); ?>" class="material-btn material-btn-secondary flex items-center">
                    <i class="material-icons text-sm mr-2">list</i>
                    Ver Pasajeros
                </a>
            </div>
        </div>
    </div>

    <div class="material-card shadow-xl rounded-lg">
        <div class="p-6">
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-y-4 gap-x-8 text-lg">
                
                <div>
                    <p class="mb-3">
                        <i class="material-icons text-gray-500 mr-2 text-base align-middle">vpn_key</i>
                        <strong class="font-semibold text-gray-700">ID Pasajero:</strong> 
                        <span class="text-gray-900 font-mono bg-gray-100 px-2 py-0.5 rounded"><?php echo e($pasajero[0]->idPasajero); ?></span>
                    </p>
                    <p class="mb-3">
                        <i class="material-icons text-gray-500 mr-2 text-base align-middle">person</i>
                        <strong class="font-semibold text-gray-700">Nombre:</strong> 
                        <span class="text-gray-900"><?php echo e($pasajero[0]->Nombre); ?></span>
                    </p>
                    <p class="mb-3">
                        <i class="material-icons text-gray-500 mr-2 text-base align-middle">person_outline</i>
                        <strong class="font-semibold text-gray-700">Apellido:</strong> 
                        <span class="text-gray-900"><?php echo e($pasajero[0]->Apellido); ?></span>
                    </p>
                </div>

                <div>
                    <p class="mb-3">
                        <i class="material-icons text-gray-500 mr-2 text-base align-middle">public</i>
                        <strong class="font-semibold text-gray-700">País:</strong> 
                        <span class="text-gray-900"><?php echo e($pasajero[0]->Pais); ?></span>
                    </p>
                    <p class="mb-3">
                        <i class="material-icons text-gray-500 mr-2 text-base align-middle">badge</i>
                        <strong class="font-semibold text-gray-700">Tipo Pasajero:</strong> 
                        <span class="text-gray-900"><?php echo e($pasajero[0]->TipoPasajero); ?></span>
                    </p>
                    <p class="mb-3">
                        <i class="material-icons text-gray-500 mr-2 text-base align-middle">toggle_on</i>
                        <strong class="font-semibold text-gray-700">Estado:</strong> 
                        <?php
                            $estado = $pasajero[0]->Estado;
                            $color = match($estado) {
                                'Activo' => 'bg-green-100 text-green-800',
                                'Inactivo' => 'bg-red-100 text-red-800',
                                'Suspendido' => 'bg-yellow-100 text-yellow-800',
                                'Bloqueado' => 'bg-gray-100 text-gray-800',
                                default => 'bg-blue-100 text-blue-800',
                            };
                        ?>
                        <span class="inline-block px-3 py-1 text-sm font-semibold rounded-full <?php echo e($color); ?>">
                            <?php echo e($estado); ?>

                        </span>
                    </p>
                </div>
            </div>

            <div class="flex justify-start gap-4 mt-8 pt-6 border-t border-gray-200">
                <a href="<?php echo e(route('pasajeros.index')); ?>" class="material-btn material-btn-secondary flex items-center">
                    <i class="material-icons text-sm mr-2">arrow_back</i>
                    Volver al Listado
                </a>
                
            </div>
            
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\repositorios\sistema-aeropuerto - copia (4)\resources\views/pasajeros/show.blade.php ENDPATH**/ ?>