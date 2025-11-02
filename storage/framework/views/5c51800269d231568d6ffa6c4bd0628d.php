<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Mantenimiento</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h1 class="mb-4">Editar Mantenimiento</h1>

    <!-- Modal Editar -->
    <div class="modal fade show" id="modalEditar" tabindex="-1" aria-labelledby="modalEditarLabel" aria-hidden="false" style="display: block;">
      <div class="modal-dialog">
        <div class="modal-content">
          <form method="POST" action="<?php echo e(route('mantenimiento.update', $mantenimiento->Id_mantenimiento)); ?>">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            <div class="modal-header">
              <h5 class="modal-title" id="modalEditarLabel">Editar Mantenimiento</h5>
              <a href="<?php echo e(route('mantenimiento.listar')); ?>" class="btn-close"></a>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label>Avión</label>
                    <select name="IdAvion" class="form-select" required>
                        <option value="">Seleccione</option>
                        <?php $__currentLoopData = $aviones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $avion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($avion->IdAvion); ?>" <?php echo e($mantenimiento->IdAvion == $avion->IdAvion ? 'selected' : ''); ?>><?php echo e($avion->IdAvion); ?> - <?php echo e($avion->Placa); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label>Personal</label>
                    <select name="IdPersonal" class="form-select" required>
                        <option value="">Seleccione</option>
                        <?php $__currentLoopData = $personales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $personal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($personal->IdPersonal); ?>" <?php echo e($mantenimiento->IdPersonal == $personal->IdPersonal ? 'selected' : ''); ?>><?php echo e($personal->IdPersonal); ?> - <?php echo e($personal->Nombre); ?> <?php echo e($personal->Apellido); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label>Fecha Ingreso</label>
                    <input type="date" name="FechaIngreso" class="form-control" value="<?php echo e($mantenimiento->FechaIngreso); ?>" min="<?php echo e(date('Y-m-d')); ?>" required>
                </div>
                <div class="mb-3">
                    <label>Fecha Salida</label>
                    <input type="date" name="FechaSalida" class="form-control" value="<?php echo e($mantenimiento->FechaSalida); ?>" required>
                </div>
                <div class="mb-3">
                    <label>Tipo</label>
                    <select name="Tipo" class="form-select" required>
                        <option value="">Seleccione</option>
                        <option value="Preventivo" <?php echo e($mantenimiento->Tipo == 'Preventivo' ? 'selected' : ''); ?>>Preventivo</option>
                        <option value="Correctivo" <?php echo e($mantenimiento->Tipo == 'Correctivo' ? 'selected' : ''); ?>>Correctivo</option>
                        <option value="Emergencia" <?php echo e($mantenimiento->Tipo == 'Emergencia' ? 'selected' : ''); ?>>Emergencia</option>
                        <option value="Inspección" <?php echo e($mantenimiento->Tipo == 'Inspección' ? 'selected' : ''); ?>>Inspección</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label>Estado</label>
                    <select name="Estado" class="form-select" required>
                        <option value="">Seleccione</option>
                        <option value="Pendiente" <?php echo e($mantenimiento->Estado == 'Pendiente' ? 'selected' : ''); ?>>Pendiente</option>
                        <option value="En Progreso" <?php echo e($mantenimiento->Estado == 'En Progreso' ? 'selected' : ''); ?>>En Progreso</option>
                        <option value="Completado" <?php echo e($mantenimiento->Estado == 'Completado' ? 'selected' : ''); ?>>Completado</option>
                        <option value="Cancelado" <?php echo e($mantenimiento->Estado == 'Cancelado' ? 'selected' : ''); ?>>Cancelado</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label>Descripción</label>
                    <textarea name="Descripcion" class="form-control" required><?php echo e($mantenimiento->Descripcion); ?></textarea>
                </div>
                <div class="mb-3">
                    <label>Costo</label>
                    <input type="number" name="Costo" class="form-control" readonly>
                </div>
                <div class="mb-3">
                    <label>Costo Extra</label>
                    <input type="number" name="CostoExtra" class="form-control" value="<?php echo e($mantenimiento->CostoExtra); ?>" min="0" step="0.01">
                </div>
            </div>
            <div class="modal-footer">
              <a href="<?php echo e(route('mantenimiento.listar')); ?>" class="btn btn-secondary">Cancelar</a>
              <button type="submit" class="btn btn-primary">Actualizar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
$(document).ready(function() {
    // Auto-fill costo based on tipo
    $('select[name="Tipo"]').change(function() {
        var tipo = $(this).val();
        var costo = 0;
        switch(tipo) {
            case 'Preventivo': costo = 500.00; break;
            case 'Correctivo': costo = 800.00; break;
            case 'Emergencia': costo = 1200.00; break;
            case 'Inspección': costo = 300.00; break;
        }
        $('input[name="Costo"]').val(costo.toFixed(2));
    });

    // Set initial costo
    $('select[name="Tipo"]').trigger('change');

    // Validate FechaSalida > FechaIngreso
    $('input[name="FechaSalida"]').change(function() {
        var fechaIngreso = $('input[name="FechaIngreso"]').val();
        var fechaSalida = $(this).val();
        if (fechaIngreso && fechaSalida && fechaSalida <= fechaIngreso) {
            alert('La fecha de salida debe ser posterior a la fecha de ingreso.');
            $(this).val('');
        }
    });
});
</script>
</body>
</html>
<?php /**PATH C:\repositorios\sistema-aeropuerto - copia (4)\resources\views/Mantenimiento/Editar.blade.php ENDPATH**/ ?>