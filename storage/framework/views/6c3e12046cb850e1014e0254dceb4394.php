<?php $__env->startSection('page-title', 'Lista de Aeropuertos'); ?>

<?php $__env->startSection('content'); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Aeropuertos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <style>
        /* Variables de color */
        :root {
            --color-primary: #00796B; /* Teal oscuro, un color de Material Design */
            --color-primary-light: #4DB6AC;
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

        #tablaAeropuertos thead th {
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
                        <i class="material-icons" style="vertical-align: middle; margin-right: 12px;">local_airport</i>
                        Gestión de Aeropuertos
                    </h3>
                    <div class="card-tools">
                        <?php if(auth()->user()->role !== 'admin'): ?>
                        <a href="<?php echo e(route('aeropuerto.create')); ?>" class="material-btn material-btn-primary">
                            <i class="material-icons" style="font-size: 1rem; margin-right: 8px;">add_location_alt</i>
                            Agregar Aeropuerto
                        </a>
                        <?php endif; ?>
                    </div>
                </div>
                
                
                <div class="card-body" style="padding: 0;">
                    <table id="tablaAeropuertos" class="table table-striped w-100">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>País</th>
                                <th>Ciudad</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $aeropuertos ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $aero): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <?php if(is_null($aero) || is_null($aero->IdAeropuerto) || empty($aero->IdAeropuerto)): ?>
                                <?php continue; ?>
                            <?php endif; ?>
                            <tr>
                                <td><?php echo e($aero->IdAeropuerto); ?></td>
                                <td style="font-weight: 600; color: var(--color-primary);"><?php echo e($aero->NombreAeropuerto); ?></td>
                                <td><?php echo e($aero->Pais); ?></td>
                                <td><?php echo e($aero->Ciudad); ?></td>
                                <td>
                                    <?php
                                        $estadoStyles = match($aero->Estado) {
                                            'Activo' => 'linear-gradient(135deg, #38a169, #48bb78)', // Verde
                                            'Inactivo' => 'linear-gradient(135deg, #e53e3e, #f56565)', // Rojo
                                            'Mantenimiento' => 'linear-gradient(135deg, #d69e2e, #ed8936)', // Naranja
                                            default => 'linear-gradient(135deg, #718096, #a0aec0)' // Gris
                                        };
                                    ?>
                                    <span class="badge" style="background: <?php echo e($estadoStyles); ?>; color: white; padding: 6px 12px; border-radius: 20px; font-weight: 500;">
                                        <?php echo e($aero->Estado); ?>

                                    </span>
                                </td>
                                <td style="white-space: nowrap;">
                                    <div class="btn-group" role="group">
                                        
                                        <a href="<?php echo e(route('aeropuerto.show', $aero)); ?>" class="material-btn material-btn-primary" style="padding: 6px 12px; font-size: 0.8rem; margin-right: 4px;">
                                            <i class="bi bi-eye" style="font-size: 1rem;"></i>
                                        </a>
                                        
                                        <?php if(auth()->user()->role === 'operador'): ?>
                                        
                                        <a href="<?php echo e(route('aeropuerto.edit', $aero)); ?>" class="material-btn" style="background: linear-gradient(135deg, #d69e2e, #ed8936); color: white; padding: 6px 12px; font-size: 0.8rem; margin-right: 4px;">
                                            <i class="bi bi-pencil-square" style="font-size: 1rem;"></i>
                                        </a>
                                        
                                        <a href="<?php echo e(route('aeropuerto.delete', $aero)); ?>" class="material-btn" style="background: linear-gradient(135deg, #e53e3e, #f56565); color: white; padding: 6px 12px; font-size: 0.8rem; border: none;" onclick="return confirm('¿Está seguro de eliminar este aeropuerto?')">
                                            <i class="bi bi-trash" style="font-size: 1rem;"></i>
                                        </a>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="6" class="text-center" style="padding: 40px; color: var(--color-text-muted); font-style: italic;">
                                    <i class="material-icons" style="font-size: 3rem; opacity: 0.5; display: block; margin-bottom: 16px;">flight_land</i>
                                    No hay aeropuertos registrados en el sistema.
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
    // Inicializar DataTables con opciones en español y responsive
    $('#tablaAeropuertos').DataTable({
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
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\repositorios\sistema-aeropuerto - copia (4)\resources\views/Aeropuerto/Listar.blade.php ENDPATH**/ ?>