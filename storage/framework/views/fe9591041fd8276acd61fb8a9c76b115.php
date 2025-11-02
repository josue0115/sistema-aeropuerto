<?php $__env->startSection('page-title', 'Lista de Servicios'); ?>

<?php $__env->startSection('content'); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Servicios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    
    <style>
        /* Variables de color de ejemplo (ajusta a tu tema real si tienes) */
        :root {
            --color-primary: #1976D2; /* Azul */
            --color-primary-light: #42A5F5;
            --color-secondary: #FFC107; /* Amarillo */
            --color-accent: #FF9800; /* Naranja */
            --color-success: #38a169; /* Verde */
            --color-danger: #E53E3E; /* Rojo */
            --color-text-muted: #6c757d;
        }

        .material-card {
            box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.14), 0 7px 10px -5px rgba(33, 33, 33, 0.4);
            border-radius: 6px;
            margin-bottom: 30px;
            background-color: white;
        }

        .material-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 8px 16px;
            font-size: 0.9rem;
            font-weight: 500;
            text-align: center;
            white-space: nowrap;
            vertical-align: middle;
            user-select: none;
            border: 1px solid transparent;
            border-radius: 4px;
            transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
            text-decoration: none;
        }

        .material-btn-primary {
            color: white;
            background: linear-gradient(135deg, var(--color-primary), var(--color-primary-light));
            border-color: var(--color-primary);
        }

        .material-btn-primary:hover {
            color: white;
            background: var(--color-primary);
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="material-card">
                <div class="card-header d-flex justify-content-between align-items-center" style="background: linear-gradient(135deg, var(--color-primary), var(--color-primary-light)); color: white; border: none; padding: 24px;">
                    <h3 class="card-title mb-0" style="font-weight: 600; font-size: 1.5rem;">
                        <i class="material-icons" style="vertical-align: middle; margin-right: 12px;">room_service</i>
                        Gestión de Servicios
                    </h3>
                    <div class="card-tools">
                        <a href="<?php echo e(route('servicios.create')); ?>" class="material-btn material-btn-primary">
                            <i class="material-icons" style="font-size: 1rem; margin-right: 8px;">add</i>
                            Nuevo Servicio
                        </a>
                    </div>
                </div>
                <div class="card-body" style="padding: 0;">
                    <?php if(session('success')): ?>
                        <div class="alert alert-success d-flex align-items-center" style="margin: 20px; margin-bottom: 0;">
                            <i class="material-icons" style="vertical-align: middle; margin-right: 8px;">check_circle</i>
                            <?php echo e(session('success')); ?>

                        </div>
                    <?php endif; ?>

                    <table id="tablaServicios" class="table table-striped w-100">
                        <thead>
                            <tr>
                                <th>ID Servicio</th>
                                <th>ID Boleto</th>
                                <th>Fecha</th>
                                <th>Tipo Servicio</th>
                                <th>Costo (Unitario)</th>
                                <th>Cantidad</th>
                                <th>Costo Total</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $servicios ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $servicio): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td><?php echo e($servicio->idServicio); ?></td>
                                    <td style="font-weight: 500;"><?php echo e($servicio->idBoleto); ?></td>
                                    <td><?php echo e($servicio->Fecha ? \Carbon\Carbon::parse($servicio->Fecha)->format('d/m/Y') : 'N/A'); ?></td>
                                    <td>
                                        <span class="badge" style="background: linear-gradient(135deg, #00BCD4, #4DD0E1); color: white; padding: 6px 12px; border-radius: 20px; font-weight: 500;">
                                            <?php echo e($servicio->tipo_servicio_nombre ?? $servicio->TipoServicio ?? 'N/A'); ?>

                                        </span>
                                    </td>
                                    <td style="font-weight: 500; color: var(--color-success);">
                                        Q<?php echo e(number_format($servicio->Costo ?? 0, 2)); ?>

                                    </td>
                                    <td style="text-align: center;"><?php echo e($servicio->Cantidad); ?></td>
                                    <td style="font-weight: 600; color: var(--color-primary); font-size: 1.1rem; white-space: nowrap;">
                                        Q<?php echo e(number_format($servicio->CostoTotal ?? 0, 2)); ?>

                                    </td>
                                    <td>
                                        <span class="badge" style="background: <?php echo e($servicio->Estado == 'Activo' ? 'linear-gradient(135deg, #38a169, #48bb78)' : 'linear-gradient(135deg, #e53e3e, #f56565)'); ?>; color: white; padding: 6px 12px; border-radius: 20px; font-weight: 500;">
                                            <?php echo e($servicio->Estado ?? 'N/A'); ?>

                                        </span>
                                    </td>
                                    <td style="white-space: nowrap;">
                                        <div class="btn-group" role="group">
                                            
                                            <a href="<?php echo e(route('servicios.show', $servicio->idServicio)); ?>" class="material-btn material-btn-primary" style="padding: 6px 12px; font-size: 0.8rem; margin-right: 4px;">
                                                <i class="material-icons" style="font-size: 1rem;">visibility</i>
                                            </a>
                                            
                                            <a href="<?php echo e(route('servicios.edit', $servicio->idServicio)); ?>" class="material-btn" style="background: linear-gradient(135deg, #d69e2e, #ed8936); color: white; padding: 6px 12px; font-size: 0.8rem; margin-right: 4px;">
                                                <i class="material-icons" style="font-size: 1rem;">edit</i>
                                            </a>
                                            
                                            <form action="<?php echo e(route('servicios.destroy', $servicio->idServicio)); ?>" method="POST" style="display: inline;">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit" class="material-btn" style="background: linear-gradient(135deg, #e53e3e, #f56565); color: white; padding: 6px 12px; font-size: 0.8rem; border: none;" onclick="return confirm('¿Estás seguro de eliminar este servicio?')">
                                                    <i class="material-icons" style="font-size: 1rem;">delete</i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="9" class="text-center" style="padding: 40px; color: var(--color-text-muted); font-style: italic;">
                                        <i class="material-icons" style="font-size: 3rem; opacity: 0.5; display: block; margin-bottom: 16px;">room_service</i>
                                        No hay servicios registrados.
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
$(document).ready(function() {
    $('#tablaServicios').DataTable({
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
        },
        responsive: true,
        pageLength: 10,
        lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "Todos"]],
        columnDefs: [
            { orderable: false, targets: -1 }
        ]
    });
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\repositorios\sistema-aeropuerto - copia (4)\resources\views/servicios/index.blade.php ENDPATH**/ ?>