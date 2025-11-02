<?php $__env->startSection('page-title', 'Reporte de Disponibilidad de Boletos'); ?>

<?php $__env->startSection('content'); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Disponibilidad de Boletos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    
    <style>
        /* Variables de color (Usaremos Indigo para Reportes) */
        :root {
            --color-primary: #303F9F; /* Indigo Oscuro Material Design */
            --color-primary-light: #5C6BC0;
            --color-success: #48BB78; /* Disponibilidad OK */
            --color-warning: #ECC94B; /* Poca Disponibilidad */
            --color-danger: #F56565; /* No Disponible / Crítico */
            --color-text-muted: #6c757d;
            --color-background-light: #F8F9FA;
        }

        .material-card {
            /* Estilo principal de la tarjeta con sombra */
            box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.14), 0 7px 10px -5px rgba(33, 33, 33, 0.4);
            border-radius: 6px;
            margin-bottom: 30px;
            background-color: white;
            padding: 0; 
        }

        .material-btn {
            /* Estilo base de los botones */
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
            cursor: pointer; /* Añadir cursor para mejor UX */
        }

        .material-btn:hover {
            opacity: 0.9;
            color: white;
        }

        .report-header {
            /* Encabezado con degradado Indigo */
            background: linear-gradient(135deg, var(--color-primary), var(--color-primary-light));
            color: white;
            border: none;
            padding: 24px;
            border-top-left-radius: 6px;
            border-top-right-radius: 6px;
            margin-bottom: 20px;
        }
        
        /* Estilos específicos de la tabla de Reportes */
        .report-table thead th {
            background-color: var(--color-background-light);
            font-weight: 600;
            color: #333;
            border-bottom: 2px solid var(--color-primary-light);
            text-transform: uppercase;
            font-size: 0.8rem;
        }

        .report-table tbody td {
            font-size: 0.9rem;
            padding: 12px 24px;
            vertical-align: middle;
        }
        
        /* Asegurar que los inputs se vean bien en el formulario de filtro */
        .form-control, .form-select {
            height: calc(1.5em + 0.75rem + 2px); /* Altura estándar de Bootstrap */
        }
    </style>
</head>
<body>
<div class="container-fluid pt-4">
    <div class="row">
        <div class="col-12">
            <div class="material-card">
                
                <div class="report-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title mb-0" style="font-weight: 600; font-size: 1.5rem;">
                        <i class="material-icons" style="vertical-align: middle; margin-right: 12px;">analytics</i>
                        Reporte de Disponibilidad de Boletos
                    </h3>
                    
                    <!-- <a href="<?php echo e(route('reportes.index')); ?>" class="material-btn" style="background: rgba(255, 255, 255, 0.2); border: 1px solid white;">
                        <i class="material-icons" style="font-size: 1rem; margin-right: 8px;">arrow_back</i>
                        Volver a Reportes
                    </a> -->
                </div>
                
                <div class="card-body" style="padding: 24px;">
                    <p class="text-secondary mb-4">Análisis de boletos disponibles por vuelo en la fecha seleccionada.</p>

                    <form method="POST" action="<?php echo e(route('reportes.disponibilidad-boletos.generar')); ?>" class="p-4 rounded-lg mb-5" style="background-color: var(--color-background-light); border: 1px solid #dee2e6;">
                        <?php echo csrf_field(); ?>
                        <div class="row g-3 align-items-end">
                            <div class="col-md-4">
                                <label for="fecha" class="form-label text-sm font-weight-bold text-secondary mb-1">Fecha</label>
                                <input type="date" id="fecha" name="fecha" value="<?php echo e(old('fecha', $fecha ?? date('Y-m-d'))); ?>"
                                    class="form-control" required style="border: 1px solid #ced4da;">
                            </div>
                            <div class="col-md-5">
                                <label for="id_vuelo" class="form-label text-sm font-weight-bold text-secondary mb-1">Vuelo (Opcional)</label>
                                <select id="id_vuelo" name="id_vuelo" class="form-select" style="border: 1px solid #ced4da;">
                                    <option value="">Todos los vuelos</option>
                                    <?php if(isset($vuelos)): ?>
                                        <?php $__currentLoopData = $vuelos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vuelo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($vuelo->IdVuelo); ?>" <?php echo e((isset($idVuelo) && $idVuelo == $vuelo->IdVuelo) ? 'selected' : ''); ?>>
                                                Vuelo <?php echo e($vuelo->IdVuelo); ?> - <?php echo e($vuelo->aeropuertoOrigen->NombreAeropuerto ?? 'N/A'); ?> → <?php echo e($vuelo->aeropuertoDestino->NombreAeropuerto ?? 'N/A'); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                            <div class="col-md-3 d-flex space-x-2">
                                
                                <button type="submit" class="material-btn flex-grow-1 me-2" style="background: linear-gradient(135deg, #00C853, #00E676);">
                                    <i class="material-icons" style="font-size: 1rem; margin-right: 8px;">search</i>
                                    Buscar
                                </button>
                                
                                <button type="button" onclick="exportDisponibilidad()" class="material-btn flex-grow-1" style="background: linear-gradient(135deg, #FF9800, #FFB74D);">
                                    <i class="material-icons" style="font-size: 1rem; margin-right: 8px;">download</i>
                                    Excel
                                </button>
                            </div>
                        </div>
                    </form>

                    <?php if(isset($reporte)): ?>
                        
                        <div class="table-responsive">
                            <table class="report-table table table-striped table-hover w-100">
                                <thead>
                                    <tr>
                                        <th>ID Vuelo</th>
                                        <th>Ruta</th>
                                        <th>Fechas (Salida/Llegada)</th>
                                        <th class="text-center">Capacidad Total</th>
                                        <th class="text-center">Boletos Vendidos</th>
                                        <th class="text-center">Disponibles</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__empty_1 = true; $__currentLoopData = $reporte; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <tr>
                                            <td class="font-weight-bold" style="color: var(--color-primary);"><?php echo e($item->IdVuelo); ?></td>
                                            <td>
                                                <i class="material-icons" style="font-size: 1rem; vertical-align: middle; color: var(--color-primary-light);">flight_takeoff</i>
                                                **<?php echo e($item->origen); ?>** <i class="material-icons" style="font-size: 1rem; vertical-align: middle; color: var(--color-text-muted);">arrow_forward</i>
                                                **<?php echo e($item->destino); ?>**
                                            </td>
                                            <td>
                                                Salida: <?php echo e(\Carbon\Carbon::parse($item->FechaSalida)->format('d/m/Y H:i')); ?>

                                                <br>
                                                Llegada: <?php echo e(\Carbon\Carbon::parse($item->FechaLlegada)->format('d/m/Y H:i')); ?>

                                            </td>
                                            <td class="text-center"><?php echo e($item->Capacidad); ?></td>
                                            <td class="text-center"><?php echo e($item->boletos_vendidos); ?></td>
                                            
                                            <td class="text-center font-weight-bold" style="font-size: 1.1rem; color: <?php echo e($item->boletos_disponibles > 50 ? 'var(--color-success)' : ($item->boletos_disponibles > 0 ? 'var(--color-warning)' : 'var(--color-danger)')); ?>">
                                                <?php echo e($item->boletos_disponibles); ?>

                                                <?php if($item->boletos_disponibles <= 0): ?>
                                                    <i class="material-icons" style="font-size: 1rem; vertical-align: middle; margin-left: 4px;">warning</i>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <tr>
                                            <td colspan="6" class="text-center" style="padding: 40px; color: var(--color-text-muted); font-style: italic;">
                                                <i class="material-icons" style="font-size: 3rem; opacity: 0.5; display: block; margin-bottom: 16px;">info_outline</i>
                                                No se encontraron resultados para los criterios seleccionados.
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>

                        
                        <?php if($reporte->count() > 0): ?>
                            <div class="mt-4 text-sm bg-light p-4 rounded-lg" style="border: 1px dashed #ced4da;">
                                <div class="row">
                                    <div class="col-md-6">
                                        <strong style="color: var(--color-primary);">Total de Vuelos Analizados:</strong> 
                                        <span class="badge bg-secondary"><?php echo e($reporte->count()); ?></span>
                                    </div>
                                    <div class="col-md-6 text-md-end">
                                        <strong style="color: var(--color-primary);">Reporte generado para la Fecha:</strong> 
                                        <span class="badge bg-secondary"><?php echo e(\Carbon\Carbon::parse($fecha)->format('d/m/Y')); ?></span>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
function exportDisponibilidad() {
    const fecha = document.getElementById('fecha').value;
    const idVuelo = document.getElementById('id_vuelo').value;
    const url = `<?php echo e(route('reportes.disponibilidad-boletos.exportar')); ?>?fecha=${fecha}&id_vuelo=${idVuelo}`;
    window.location.href = url;
}
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\repositorios\sistema-aeropuerto - copia (4)\resources\views/reportes/disponibilidad-boletos.blade.php ENDPATH**/ ?>