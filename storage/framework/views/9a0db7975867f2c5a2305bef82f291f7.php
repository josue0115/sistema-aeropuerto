<?php $__env->startSection('page-title', 'Historial de Vuelos'); ?>

<?php $__env->startSection('content'); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de Vuelos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    
    <style>
        /* Variables de color (Usaremos Gris Azulado para Historial) */
        :root {
            --color-primary: #607D8B; /* Gris Azulado Oscuro Material Design */
            --color-primary-light: #90A4AE;
            --color-success: #38a169; /* Verde */
            --color-warning: #d69e2e; /* Naranja (Editar) */
            --color-info: #4299e1;    /* Azul (Ver) */
            --color-danger: #E53E3E; /* Rojo (Eliminar) */
            --color-text-muted: #6c757d;
        }

        .material-card {
            box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.14), 0 7px 10px -5px rgba(33, 33, 33, 0.4);
            border-radius: 6px;
            margin-bottom: 30px;
            background-color: white;
            padding: 0; 
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
            transition: all 0.15s ease-in-out;
            text-decoration: none;
            color: white;
        }

        .material-btn-primary {
            background: linear-gradient(135deg, var(--color-primary), var(--color-primary-light));
            border-color: var(--color-primary);
        }

        .material-btn-primary:hover {
            opacity: 0.9;
            color: white;
        }

        #tablaHistorial thead th {
            background-color: #f0f0f0;
            font-weight: 600;
            color: #333;
        }
    </style>
</head>
<body>
<div class="container-fluid pt-4">
    <div class="row">
        <div class="col-12">
            <div class="material-card">
                
                <div class="card-header d-flex justify-content-between align-items-center" style="background: linear-gradient(135deg, var(--color-primary), var(--color-primary-light)); color: white; border: none; padding: 24px;">
                    <h3 class="card-title mb-0" style="font-weight: 600; font-size: 1.5rem;">
                        <i class="material-icons" style="vertical-align: middle; margin-right: 12px;">history_toggle_off</i>
                        Historial de Vuelos
                    </h3>
                    <div class="card-tools">
                        
                        <a href="<?php echo e(route('historial_vuelos.create')); ?>" class="material-btn material-btn-primary">
                            <i class="material-icons" style="font-size: 1rem; margin-right: 8px;">add</i>
                            Nuevo Registro
                        </a>
                    </div>
                </div>
                
                <div class="card-body" style="padding: 0;">
                    <?php if(session('success')): ?>
                        <div class="alert alert-success d-flex align-items-center" style="margin: 20px; margin-bottom: 0;">
                            <i class="material-icons me-2" style="vertical-align: middle;">check_circle</i>
                            <?php echo e(session('success')); ?>

                        </div>
                    <?php endif; ?>

                    <table id="tablaHistorial" class="table table-striped w-100">
                        <thead>
                            <tr>
                                <th>ID Registro</th>
                                <th>IDs (Historial/Vuelo)</th>
                                <th>ID Pasajero</th>
                                <th>Fecha</th>
                                <th>Detalle</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $historiales ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $historial): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td style="font-weight: 600; color: var(--color-primary);"><?php echo e($historial->id_historial_vuelo); ?></td>
                                    <td>
                                        
                                        <strong style="color: var(--color-primary-light);">Historial: <?php echo e($historial->idhistorial); ?></strong>
                                        <br>
                                        <span style="font-size: 0.9em; color: var(--color-text-muted);">Vuelo: <?php echo e($historial->idvuelo); ?></span>
                                    </td>
                                    <td><?php echo e($historial->idPasajero); ?></td>
                                    <td>
                                        
                                        <span style="font-weight: 500;">
                                            <?php echo e($historial->Fecha ? \Carbon\Carbon::parse($historial->Fecha)->format('d/m/Y H:i') : 'N/A'); ?>

                                        </span>
                                    </td>
                                    <td style="max-width: 300px; white-space: normal;">
                                        
                                        <?php echo e(Str::limit($historial->Detalle, 70, '...')); ?>

                                    </td>
                                    <td style="white-space: nowrap;">
                                        <div class="btn-group" role="group">
                                            
                                            <a href="<?php echo e(route('historial_vuelos.show', $historial->id_historial_vuelo)); ?>" class="material-btn" style="background: linear-gradient(135deg, var(--color-info), #63b3ed); color: white; padding: 6px 12px; font-size: 0.8rem; margin-right: 4px;">
                                                <i class="material-icons" style="font-size: 1rem;">visibility</i>
                                            </a>
                                            
                                            
                                            <a href="<?php echo e(route('historial_vuelos.edit', $historial->id_historial_vuelo)); ?>" class="material-btn" style="background: linear-gradient(135deg, var(--color-warning), #ed8936); color: white; padding: 6px 12px; font-size: 0.8rem; margin-right: 4px;">
                                                <i class="material-icons" style="font-size: 1rem;">edit</i>
                                            </a>
                                            
                                            <form action="<?php echo e(route('historial_vuelos.destroy', $historial->id_historial_vuelo)); ?>" method="POST" style="display: inline;">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit" class="material-btn" style="background: linear-gradient(135deg, var(--color-danger), #f56565); color: white; padding: 6px 12px; font-size: 0.8rem; border: none;" onclick="return confirm('¿Estás seguro de eliminar este registro?')">
                                                    <i class="material-icons" style="font-size: 1rem;">delete</i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="6" class="text-center" style="padding: 40px; color: var(--color-text-muted); font-style: italic;">
                                        <i class="material-icons" style="font-size: 3rem; opacity: 0.5; display: block; margin-bottom: 16px;">history_toggle_off</i>
                                        No hay registros de historial de vuelos.
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>
$(document).ready(function() {
    // Inicializar DataTables con opciones en español y responsive
    $('#tablaHistorial').DataTable({
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
        },
        responsive: true,
        pageLength: 10,
        lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "Todos"]],
        columnDefs: [
            { orderable: false, targets: -1 } // Deshabilita la ordenación en la columna de Acciones
        ],
        scrollX: true 
    });
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\repositorios\sistema-aeropuerto - copia (4)\resources\views/historial_vuelos/index.blade.php ENDPATH**/ ?>