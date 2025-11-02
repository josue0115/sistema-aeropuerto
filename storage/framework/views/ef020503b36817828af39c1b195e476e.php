<?php $__env->startSection('page-title', 'Editar Avión - Sistema Aeropuerto'); ?>

<?php $__env->startSection('content'); ?>
    <div class="max-w-4xl mx-auto">
        <div class="material-card">
            <div class="p-6 border-b border-gray-200">
                <h1 class="text-2xl font-semibold text-gray-800">
                    <i class="material-icons text-purple-600 mr-2">edit</i>
                    Editar Avión
                </h1>
                <p class="text-gray-600 mt-1">Modifique la información del avión seleccionado</p>
            </div>

            <div class="p-6">
                <form method="POST" action="<?php echo e(route('avion.update', $avion->IdAvion)); ?>" class="space-y-6">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="IdAerolinea" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="material-icons text-sm mr-1">flight</i>
                                Aerolínea
                            </label>
                            <select name="IdAerolinea" id="IdAerolinea" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500" required>
                                <option value="">Seleccione una aerolínea</option>
                                <?php $__currentLoopData = $aerolineas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $aero): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($aero->IdAerolinea); ?>" <?php echo e($avion->IdAerolinea == $aero->IdAerolinea ? 'selected' : ''); ?>><?php echo e($aero->IdAerolinea); ?> - <?php echo e($aero->NombreAerolinea); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php $__errorArgs = ['IdAerolinea'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                    <div>
        <label for="Tipo" class="block text-sm font-medium text-gray-700 mb-2">
            <i class="material-icons text-sm mr-1">category</i>
            Tipo
        </label>

                        <select name="Tipo" id="Tipo"
        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500"
        required>

        <option value="" disabled <?php echo e(old('Tipo', $avion->Tipo) == '' ? 'selected' : ''); ?>>
            Selecciona el tipo de aeronave
        </option>

            <!-- Pasajeros -->
            <optgroup label="Aeronaves de Pasajeros">
            <option value="Comercial Internacional" <?php echo e(old('Tipo', $avion->Tipo) == 'Comercial Internacional' ? 'selected' : ''); ?>>Comercial Internacional</option>
            <option value="Comercial Doméstico" <?php echo e(old('Tipo', $avion->Tipo) == 'Comercial Doméstico' ? 'selected' : ''); ?>>Comercial Doméstico</option>
            <option value="Regional" <?php echo e(old('Tipo', $avion->Tipo) == 'Regional' ? 'selected' : ''); ?>>Regional</option>
            <option value="Ejecutivo / Privado" <?php echo e(old('Tipo', $avion->Tipo) == 'Ejecutivo / Privado' ? 'selected' : ''); ?>>Ejecutivo / Privado</option>
        </optgroup>

        <!-- Carga -->
        <optgroup label="Aeronaves de Carga">
            <option value="Carga Pura" <?php echo e(old('Tipo', $avion->Tipo) == 'Carga Pura' ? 'selected' : ''); ?>>Carga Pura</option>
            <option value="Mixto (Pasajeros + Carga)" <?php echo e(old('Tipo', $avion->Tipo) == 'Mixto (Pasajeros + Carga)' ? 'selected' : ''); ?>>Mixto (Pasajeros + Carga)</option>
        </optgroup>

        <!-- Otros Tipos -->
        <optgroup label="Otros Tipos de Aeronaves">
            <option value="Militar" <?php echo e(old('Tipo', $avion->Tipo) == 'Militar' ? 'selected' : ''); ?>>Militar</option>
            <option value="Entrenamiento" <?php echo e(old('Tipo', $avion->Tipo) == 'Entrenamiento' ? 'selected' : ''); ?>>Entrenamiento</option>
            <option value="Helicóptero" <?php echo e(old('Tipo', $avion->Tipo) == 'Helicóptero' ? 'selected' : ''); ?>>Helicóptero</option>
            <option value="Rescate / Ambulancia Aérea" <?php echo e(old('Tipo', $avion->Tipo) == 'Rescate / Ambulancia Aérea' ? 'selected' : ''); ?>>Rescate / Ambulancia Aérea</option>
            <option value="Servicios Aéreos Especiales" <?php echo e(old('Tipo', $avion->Tipo) == 'Servicios Aéreos Especiales' ? 'selected' : ''); ?>>Servicios Aéreos Especiales (fumigación, fotografía, etc.)</option>
            <option value="Dron / UAV" <?php echo e(old('Tipo', $avion->Tipo) == 'Dron / UAV' ? 'selected' : ''); ?>>Dron / UAV</option>
        </optgroup>
        </select>

        <?php $__errorArgs = ['Tipo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>


                    <div>
                        <label for="Modelo" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="material-icons text-sm mr-1">build</i>
                            Modelo
                        </label>
                        <select name="Modelo" id="Modelo" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500" required>
                            <option value="" disabled <?php echo e(old('Modelo', $avion->Modelo) == '' ? 'selected' : ''); ?>>Selecciona el modelo</option>

                            <optgroup label="Airbus">
                                <option value="A220" <?php echo e(old('Modelo', $avion->Modelo) == 'A220' ? 'selected' : ''); ?>>A220</option>
                                <option value="A320" <?php echo e(old('Modelo', $avion->Modelo) == 'A320' ? 'selected' : ''); ?>>A320</option>
                                <option value="A321" <?php echo e(old('Modelo', $avion->Modelo) == 'A321' ? 'selected' : ''); ?>>A321</option>
                                <option value="A330" <?php echo e(old('Modelo', $avion->Modelo) == 'A330' ? 'selected' : ''); ?>>A330</option>
                                <option value="A350" <?php echo e(old('Modelo', $avion->Modelo) == 'A350' ? 'selected' : ''); ?>>A350</option>
                                <option value="A380" <?php echo e(old('Modelo', $avion->Modelo) == 'A380' ? 'selected' : ''); ?>>A380</option>
                            </optgroup>

                            <optgroup label="Boeing">
                                <option value="B737" <?php echo e(old('Modelo', $avion->Modelo) == 'B737' ? 'selected' : ''); ?>>737</option>
                                <option value="B747" <?php echo e(old('Modelo', $avion->Modelo) == 'B747' ? 'selected' : ''); ?>>747</option>
                                <option value="B757" <?php echo e(old('Modelo', $avion->Modelo) == 'B757' ? 'selected' : ''); ?>>757</option>
                                <option value="B767" <?php echo e(old('Modelo', $avion->Modelo) == 'B767' ? 'selected' : ''); ?>>767</option>
                                <option value="B777" <?php echo e(old('Modelo', $avion->Modelo) == 'B777' ? 'selected' : ''); ?>>777</option>
                                <option value="B787" <?php echo e(old('Modelo', $avion->Modelo) == 'B787' ? 'selected' : ''); ?>>787 Dreamliner</option>
                            </optgroup>

                            <optgroup label="Embraer">
                                <option value="E170" <?php echo e(old('Modelo', $avion->Modelo) == 'E170' ? 'selected' : ''); ?>>E170</option>
                                <option value="E190" <?php echo e(old('Modelo', $avion->Modelo) == 'E190' ? 'selected' : ''); ?>>E190</option>
                                <option value="E195" <?php echo e(old('Modelo', $avion->Modelo) == 'E195' ? 'selected' : ''); ?>>E195</option>
                            </optgroup>

                            <optgroup label="Bombardier">
                                <option value="CRJ200" <?php echo e(old('Modelo', $avion->Modelo) == 'CRJ200' ? 'selected' : ''); ?>>CRJ200</option>
                                <option value="CRJ700" <?php echo e(old('Modelo', $avion->Modelo) == 'CRJ700' ? 'selected' : ''); ?>>CRJ700</option>
                                <option value="CRJ900" <?php echo e(old('Modelo', $avion->Modelo) == 'CRJ900' ? 'selected' : ''); ?>>CRJ900</option>
                            </optgroup>

                            <optgroup label="Cessna / Aviones Pequeños">
                                <option value="C172" <?php echo e(old('Modelo', $avion->Modelo) == 'C172' ? 'selected' : ''); ?>>Cessna 172</option>
                                <option value="C208 Caravan" <?php echo e(old('Modelo', $avion->Modelo) == 'C208 Caravan' ? 'selected' : ''); ?>>Cessna 208 Caravan</option>
                                <option value="Citation X" <?php echo e(old('Modelo', $avion->Modelo) == 'Citation X' ? 'selected' : ''); ?>>Citation X</option>
                            </optgroup>

                            <optgroup label="Helicópteros">
                                <option value="Bell 206" <?php echo e(old('Modelo', $avion->Modelo) == 'Bell 206' ? 'selected' : ''); ?>>Bell 206</option>
                                <option value="Sikorsky S-76" <?php echo e(old('Modelo', $avion->Modelo) == 'Sikorsky S-76' ? 'selected' : ''); ?>>Sikorsky S-76</option>
                                <option value="Airbus H145" <?php echo e(old('Modelo', $avion->Modelo) == 'Airbus H145' ? 'selected' : ''); ?>>Airbus H145</option>
                            </optgroup>
                        </select>
                        <?php $__errorArgs = ['Modelo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div>
                        <label for="Capacidad" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="material-icons text-sm mr-1">people</i>
                            Capacidad
                        </label>
                        <input type="number" name="Capacidad" id="Capacidad" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500" value="<?php echo e(old('Capacidad', $avion->Capacidad)); ?>" required>
                        <?php $__errorArgs = ['Capacidad'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div>
                        <label for="Placa" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="material-icons text-sm mr-1">credit_card</i>
                            Placa
                        </label>
                        <input type="hidden" name="Placa" value="<?php echo e($placaPreview); ?>">
                        <input type="text" id="Placa" class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100" value="<?php echo e($placaPreview); ?>" readonly>
                        <?php $__errorArgs = ['Placa'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div>
                        <label for="Estado" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="material-icons text-sm mr-1">toggle_on</i>
                            Estado
                        </label>
                        <select name="Estado" id="Estado" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500" required>
                            <option value="Activo" <?php echo e(old('Estado', $avion->Estado) == 'Activo' ? 'selected' : ''); ?>>Activo</option>
                            <option value="Inactivo" <?php echo e(old('Estado', $avion->Estado) == 'Inactivo' ? 'selected' : ''); ?>>Inactivo</option>
                        </select>
                        <?php $__errorArgs = ['Estado'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>

                <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
                    <a href="<?php echo e(route('avion.listar')); ?>" class="material-btn border border-gray-300 text-gray-700 hover:bg-gray-50">
                        <i class="material-icons text-sm mr-2">cancel</i>
                        Cancelar
                    </a>
                    <button type="submit" class="material-btn material-btn-primary">
                        <i class="material-icons text-sm mr-2">save</i>
                        Actualizar Avión
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\repositorios\sistema-aeropuerto - copia (4)\resources\views/Avion/Edit.blade.php ENDPATH**/ ?>