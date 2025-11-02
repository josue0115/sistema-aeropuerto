<?php $__env->startSection('page-title', 'Lista de Horarios'); ?>

<?php $__env->startSection('content'); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Horarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <style>
        /* Variables de color */
        :root {
            --color-primary: #1976D2; /* Azul */
            --color-primary-light: #42A5F5;
            --color-accent: #FF9800; /* Naranja para tiempo de espera */
            --color-success: #38a169; /* Verde */
            --color-danger: #E53E3E; /* Rojo */
            --color-text-muted: #6c757d;
        }

        .material-card {
            box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.14), 0 7px 10px -5px rgba(33, 33, 33, 0.4);
            border-radius: 6px;
            margin-bottom: 30px;
            background-color: white;
            padding: 0; /* Quitamos padding del cuerpo de la card para la tabla */
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

        /* Estilos específicos para la tabla y sus filas */
        #tablaHorarios thead th {
            background-color: #f0f0f0;
            font-weight: 600;
            color: #333;
        }
        
        #tablaHorarios tbody tr:hover {
            background-color: #f9f9f9;
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
                        <i class="material-icons" style="vertical-align: middle; margin-right: 12px;">schedule</i>
                        Gestión de Horarios
                    </h3>
                    <div class="card-tools">
                        <?php if(auth()->user()->role === 'operador'): ?>
                        <a href="<?php echo e(route('horario.create')); ?>" class="material-btn material-btn-primary">
                            <i class="material-icons" style="font-size: 1rem; margin-right: 8px;">add</i>
                            Nuevo Horario
                        </a>
                        <?php endif; ?>
                    </div>
                </div>
                
                
                <div class="card-body" style="padding: 0;">
                    <table id="tablaHorarios" class="table table-striped w-100">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Vuelo (Origen → Destino)</th>
                                <th>Hora Salida</th>
                                <th>Hora Llegada</th>
                                <th>Tiempo Espera</th>
                                <th>Estado</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $horarios ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $horario): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e($horario->IdHorario); ?></td>
                                <td>
                                    <span style="font-weight: 500;">Vuelo #<?php echo e($horario->vuelo->IdVuelo ?? 'N/A'); ?></span>
                                    <br>
                                    <span style="font-size: 0.9em; color: var(--color-text-muted);">
                                        <?php echo e($horario->vuelo->aeropuertoOrigen->NombreAeropuerto ?? 'N/A'); ?>

                                        <i class="material-icons" style="font-size: 0.8rem; vertical-align: middle;">arrow_forward</i>
                                        <?php echo e($horario->vuelo->aeropuertoDestino->NombreAeropuerto ?? 'N/A'); ?>

                                    </span>
                                </td>
                                <td><?php echo e($horario->HoraSalida); ?></td>
                                <td><?php echo e($horario->HoraLlegada); ?></td>
                                <td style="font-weight: 600; color: var(--color-accent); font-size: 1.1rem; text-align: center;">
                                    <?php echo e($horario->TiempoEspera); ?> min
                                </td>
                                <td>
                                    <?php
                                        $estadoClasses = match($horario->Estado) {
                                            'Activo' => 'linear-gradient(135deg, #38a169, #48bb78)', // Verde
                                            'Inactivo' => 'linear-gradient(135deg, #718096, #a0aec0)', // Gris
                                            'Cancelado' => 'linear-gradient(135deg, #e53e3e, #f56565)', // Rojo
                                            default => 'linear-gradient(135deg, #d69e2e, #ed8936)' // Naranja
                                        };
                                    ?>
                                    <span class="badge" style="background: <?php echo e($estadoClasses); ?>; color: white; padding: 6px 12px; border-radius: 20px; font-weight: 500;">
                                        <?php echo e($horario->Estado); ?>

                                    </span>
                                </td>
                                <td class="text-center" style="white-space: nowrap;">
                                    <div class="btn-group" role="group" aria-label="Acciones">
                                        
                                        <a href="<?php echo e(route('horario.show', $horario)); ?>" class="material-btn material-btn-primary" style="padding: 6px 12px; font-size: 0.8rem; margin-right: 4px;">
                                            <i class="bi bi-eye" style="font-size: 1rem;"></i> 
                                        </a>
                                        
                                        <?php if(auth()->user()->role === 'operador'): ?>
                                        
                                        <a href="<?php echo e(route('horario.edit', $horario)); ?>" class="material-btn" style="background: linear-gradient(135deg, #d69e2e, #ed8936); color: white; padding: 6px 12px; font-size: 0.8rem; margin-right: 4px;">
                                            <i class="bi bi-pencil-square" style="font-size: 1rem;"></i>
                                        </a>
                                        
                                        <a href="<?php echo e(route('horario.delete', $horario)); ?>" class="material-btn" style="background: linear-gradient(135deg, #e53e3e, #f56565); color: white; padding: 6px 12px; font-size: 0.8rem; border: none;" onclick="return confirm('¿Está seguro de eliminar este horario?')">
                                            <i class="bi bi-trash" style="font-size: 1rem;"></i>
                                        </a>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="7" class="text-center" style="padding: 40px; color: var(--color-text-muted); font-style: italic;">
                                    <i class="material-icons" style="font-size: 3rem; opacity: 0.5; display: block; margin-bottom: 16px;">schedule</i>
                                    No hay horarios registrados en este momento.
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
    // Asegurarse de que el ID de la tabla coincida con el script. Lo cambié a tablaHorarios en el HTML.
    $('#tablaHorarios').DataTable({
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
        },
        responsive: true,
        pageLength: 10,
        lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "Todos"]],
        columnDefs: [
            { orderable: false, targets: -1 } // Deshabilita la ordenación en la columna de Acciones
        ],
        scrollX: true // Útil para tablas con muchas columnas
    });
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\repositorios\sistema-aeropuerto - copia (4)\resources\views/Horario/Listar.blade.php ENDPATH**/ ?>