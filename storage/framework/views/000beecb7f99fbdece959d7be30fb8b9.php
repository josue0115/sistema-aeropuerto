<?php $__env->startSection('page-title', 'Lista de Boletos'); ?>

<?php $__env->startSection('content'); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Boletos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    
    <style>
        /* Variables de color (Usaremos Cyan/Turquesa para Boletos) */
        :root {
            --color-primary: #00BCD4; /* Cyan Oscuro Material Design */
            --color-primary-light: #4DD0E1;
            --color-success: #38a169; /* Verde (Precio Total) */
            --color-warning: #d69e2e; /* Naranja (Descuento/Impuesto/Editar) */
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

        #tablaBoletos thead th {
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
                        <i class="material-icons" style="vertical-align: middle; margin-right: 12px;">confirmation_number</i>
                        Gestión de Boletos
                    </h3>
                    <div class="card-tools">
                        <?php if(auth()->user()->role === 'operador'): ?>
                        
                        <a href="<?php echo e(route('boletos.create')); ?>" class="material-btn material-btn-primary">
                            <i class="material-icons" style="font-size: 1rem; margin-right: 8px;">add</i>
                            Nuevo Boleto
                        </a>
                        <?php endif; ?>
                    </div>
                </div>
                
                <div class="card-body" style="padding: 0;">
                    <?php if(session('success')): ?>
                        <div class="alert alert-success d-flex align-items-center" style="margin: 20px; margin-bottom: 0;">
                            <i class="material-icons me-2" style="vertical-align: middle;">check_circle</i>
                            <?php echo e(session('success')); ?>

                        </div>
                    <?php endif; ?>

                    <table id="tablaBoletos" class="table table-striped w-100">
                        <thead>
                            <tr>
                                <th>ID Boleto</th>
                                <th>Vuelo / Pasajero</th>
                                <th>Fecha Compra</th>
                                <th>Precio Unit.</th>
                                <th>Cant.</th>
                                <th>Descuento</th>
                                <th>Impuesto</th>
                                <th>Total</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $boletos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $boleto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td style="font-weight: 600; color: var(--color-primary);"><?php echo e($boleto->idBoleto); ?></td>
                                <td>
                                    
                                    <strong style="color: var(--color-primary-light);">Vuelo: <?php echo e($boleto->idVuelo); ?></strong>
                                    <br>
                                    <span style="font-size: 0.9em; color: var(--color-text-muted);">Pasajero: <?php echo e($boleto->idPasajero); ?></span>
                                </td>
                                <td>
                                    
                                    <?php echo e($boleto->FechaCompra ? \Carbon\Carbon::parse($boleto->FechaCompra)->format('d/m/Y') : 'N/A'); ?>

                                </td>
                                <td style="font-weight: 500;">
                                    Q<?php echo e(number_format($boleto->Precio ?? 0, 2)); ?>

                                </td>
                                <td>
                                    <span class="badge" style="background-color: #f0f0f0; color: #333; font-weight: 600;">
                                        <?php echo e($boleto->Cantidad); ?>

                                    </span>
                                </td>
                                <td style="font-weight: 600; color: var(--color-warning);">
                                    Q<?php echo e(number_format($boleto->Descuento ?? 0, 2)); ?>

                                </td>
                                <td style="font-weight: 600; color: var(--color-warning);">
                                    Q<?php echo e(number_format($boleto->Impuesto ?? 0, 2)); ?>

                                </td>
                                <td style="font-weight: 700; color: var(--color-success); font-size: 1.15rem;">
                                    Q<?php echo e(number_format($boleto->Total ?? 0, 2)); ?>

                                </td>
                                <td style="white-space: nowrap;">
                                    <div class="btn-group" role="group">
                                        
                                        <a href="<?php echo e(route('boletos.show', $boleto->idBoleto)); ?>" class="material-btn material-btn-primary" style="padding: 6px 12px; font-size: 0.8rem; margin-right: 4px;">
                                            <i class="material-icons" style="font-size: 1rem;">visibility</i>
                                        </a>
                                        
                                        <?php if(auth()->user()->role === 'operador'): ?>
                                        
                                        <a href="<?php echo e(route('boletos.edit', $boleto->idBoleto)); ?>" class="material-btn" style="background: linear-gradient(135deg, var(--color-warning), #ed8936); color: white; padding: 6px 12px; font-size: 0.8rem; margin-right: 4px;">
                                            <i class="material-icons" style="font-size: 1rem;">edit</i>
                                        </a>
                                        
                                        <form action="<?php echo e(route('boletos.destroy', $boleto->idBoleto)); ?>" method="POST" style="display: inline;">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="material-btn" style="background: linear-gradient(135deg, var(--color-danger), #f56565); color: white; padding: 6px 12px; font-size: 0.8rem; border: none;" onclick="return confirm('¿Estás seguro de eliminar este boleto?')">
                                                <i class="material-icons" style="font-size: 1rem;">delete</i>
                                            </button>
                                        </form>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="9" class="text-center" style="padding: 40px; color: var(--color-text-muted); font-style: italic;">
                                    <i class="material-icons" style="font-size: 3rem; opacity: 0.5; display: block; margin-bottom: 16px;">confirmation_number</i>
                                    No hay boletos registrados.
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
    $('#tablaBoletos').DataTable({
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
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\repositorios\sistema-aeropuerto - copia (4)\resources\views/boletos/index.blade.php ENDPATH**/ ?>