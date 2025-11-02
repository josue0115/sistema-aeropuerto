<?php $__env->startSection('title', 'Procesar Pago'); ?>

<?php $__env->startSection('content'); ?>
<style>
/* ======== ESTILOS GLOBALES ======== */
body {
  background-color: #f3f4f6;
}
.container-pago {
  display: grid;
  grid-template-columns: 1fr 0.8fr;
  gap: 24px;
  max-width: 1200px;
  margin: 0 auto;
   align-items: start;
}
.card-box, .summary-box {
  background: #fff;
  border-radius: 18px;
  box-shadow: 0 4px 20px rgba(0,0,0,0.06);
  padding: 24px;
}
@media (max-width: 992px) {
  .container-pago { grid-template-columns: 1fr; }
}

/* ======== TARJETA VISUAL ======== */
.credit-preview {
  background: linear-gradient(135deg, #1e3a8a, #3b82f6);
  color: #fff;
  border-radius: 16px;
  padding: 20px;
  height: 180px;
  position: relative;
  overflow: hidden;
  margin-bottom: 20px;
  box-shadow: 0 6px 20px rgba(37,99,235,0.3);
}
.credit-preview::after {
  content: "";
  position: absolute;
  right: -30px;
  top: -30px;
  width: 150px;
  height: 150px;
  background: rgba(255,255,255,0.1);
  border-radius: 50%;
}
.credit-number {
  font-size: 1.4rem;
  letter-spacing: 3px;
  font-family: monospace;
  margin-top: 25px;
}
.credit-footer {
  display: flex;
  justify-content: space-between;
  align-items: end;
  margin-top: 25px;
  font-size: 0.9rem;
}
.credit-footer div { line-height: 1.2; }

/* ======== FORMULARIO ======== */
label {
  font-size: 0.9rem;
  font-weight: 600;
  color: #374151;
  display: block;
  margin-bottom: 4px;
}
input {
  width: 100%;
  border: 1.8px solid #e5e7eb;
  border-radius: 10px;
  padding: 10px 12px;
  font-size: 0.95rem;
  transition: all 0.2s ease;
}
input:focus {
  outline: none;
  border-color: #2563eb;
  box-shadow: 0 0 0 3px rgba(37,99,235,0.1);
}
.flex {
  display: flex;
  gap: 10px;
}

/* ======== BOTÓN Y ALERTA ======== */
.btn-pago {
  background: linear-gradient(90deg, #16a34a, #15803d);
  border: none;
  color: #fff;
  padding: 12px 20px;
  border-radius: 10px;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.2s ease;
}
.btn-pago:hover {
  transform: translateY(-1px);
  background: linear-gradient(90deg, #15803d, #166534);
}
.alert {
  background: #ecfdf5;
  border: 1px solid #bbf7d0;
  color: #065f46;
  font-size: 0.8rem;
  padding: 8px 12px;
  border-radius: 8px;
  margin-top: 12px;
  display: flex;
  align-items: center;
  gap: 6px;
}

/* ======== RESUMEN ======== */
.summary-title {
  font-size: 1.2rem;
  font-weight: 700;
  color: #111827;
  margin-bottom: 10px;
}
.summary-line {
  display: flex;
  justify-content: space-between;
  margin: 6px 0;
  font-size: 0.95rem;
}
.summary-total {
  background: linear-gradient(90deg, #16a34a, #15803d);
  color: white;
  padding: 14px 18px;
  border-radius: 12px;
  font-size: 1.1rem;
  display: flex;
  justify-content: space-between;
  font-weight: 700;
  margin-top: 18px;
}
.security-note {
  background: #eff6ff;
  border: 1px solid #bfdbfe;
  padding: 10px 14px;
  border-radius: 10px;
  font-size: 0.8rem;
  color: #1e40af;
  margin-top: 16px;
  display: flex;
  align-items: center;
  gap: 6px;
}
</style>

<div class="container-pago">
  <!-- 🧾 Información de pago -->
  <div class="card-box">
    <h3 class="text-lg font-bold text-gray-800 mb-1">Información de Pago</h3>
    <p class="text-sm text-gray-500 mb-3">Completa los datos de tu tarjeta de forma segura</p>

    <!-- Tarjeta visual -->
    <div class="credit-preview">
      <div class="text-xs opacity-80 flex justify-between">
        <span>TARJETA</span>
        <span id="card-brand">VISA / MASTERCARD</span>
      </div>
      <div id="card-display" class="credit-number">•••• •••• •••• ••••</div>
      <div class="credit-footer">
        <div>
          <div style="font-size:0.7rem; opacity:0.8;">TITULAR</div>
          <div id="holder-display">NOMBRE COMPLETO</div>
        </div>
        <div>
          <div style="font-size:0.7rem; opacity:0.8;">VÁLIDO HASTA</div>
          <div id="expiry-display">MM/AA</div>
        </div>
      </div>
    </div>

    <!-- Formulario -->
    <form id="payment-form" action="<?php echo e(route('pagos.store')); ?>" method="POST">
      <?php echo csrf_field(); ?>
      <div>
        <label>Número de Tarjeta *</label>
        <input id="numero_tarjeta" name="numero_tarjeta" maxlength="19" placeholder="#### #### #### ####" required>
      </div>

      <div class="flex">
        <div class="w-1/2">
          <label>Fecha Exp *</label>
          <input id="fecha_expiracion" name="fecha_expiracion" maxlength="5" placeholder="MM/AA" required>
        </div>
        <div class="w-1/2">
          <label>CVV *</label>
          <input id="cvv" name="cvv" maxlength="4" placeholder="•••" required>
        </div>
      </div>

      <div>
        <label>Nombre del Titular *</label>
        <input id="nombre_titular" name="nombre_titular" placeholder="Como aparece en la tarjeta" required>
      </div>

      <div class="alert"><i class="fas fa-lock"></i> Encriptación SSL de 256 bits · PCI DSS</div>

      <div style="margin-top:16px; text-align:right;">
        <a href="<?php echo e(route('pagos.index')); ?>" style="background: #e5e7eb; color: #374151; padding: 10px 16px; border-radius: 10px; font-weight: 600; margin-right: 10px; display: inline-flex; align-items: center; gap: 6px; text-decoration: none; ">
                <i class="material-icons text-sm mr-2">arrow_back</i>Volver
            </a>
        <button type="submit" class="btn-pago"><i class="fas fa-lock mr-1"></i>Procesar Pago Seguro</button>
      </div>
    </form>
  </div>

<div class="w-full lg:w-1/3 " >
    <div style="border-radius: 18px;" class="bg-white shadow-xl rounded-2xl overflow-hidden border border-gray-100 sticky top-6">
        <div class="p-6 border-b border-gray-200" style="background: linear-gradient(to right, #f9fafb, #f3f4f6);">
            <h5 class="text-xl font-bold text-gray-800 flex items-center">
                <i class="fas fa-receipt mr-3 text-blue-600"></i>
                Resumen del Pago
            </h5>
        </div>
        <div class="p-6" style="max-height: 565px; overflow-y: scroll; -webkit-overflow-scrolling: touch;">
            <!-- Boleto -->
            <?php if($detallesPago['boleto']): ?>
            <div class="mb-6 pb-6 border-b border-gray-100">
                <h6 class="text-xs font-bold text-gray-500 mb-3 uppercase tracking-wider flex items-center">
                    <i class="fas fa-plane-departure mr-2 text-blue-500"></i>
                    Boleto
                </h6>
                <div class="flex justify-between items-center py-2 bg-blue-50 px-3 rounded-lg">
                    <span class="text-gray-800 font-medium">Vuelo <?php echo e($detallesPago['boleto']->idVuelo); ?></span>
                    <span class="font-bold text-gray-900">$<?php echo e(number_format($detallesPago['boleto']->Precio, 2)); ?></span>
                </div>
                <p class="text-sm text-gray-500 mt-2 ml-3">
                    <i class="far fa-user text-xs mr-1"></i>
                    Pasajero: <?php echo e($detallesPago['boleto']->idPasajero); ?>

                </p>
            </div>
            <?php endif; ?>

            <!-- Servicios -->
            <?php if(!empty($detallesPago['servicios'])): ?>
            <div class="mb-6 pb-6 border-b border-gray-100">
                <h6 class="text-xs font-bold text-gray-500 mb-3 uppercase tracking-wider flex items-center">
                    <i class="fas fa-concierge-bell mr-2 text-purple-500"></i>
                    Servicios Adicionales
                </h6>
                <?php $__currentLoopData = $detallesPago['servicios']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $servicio): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="flex justify-between items-center py-2 hover:bg-gray-50 px-3 rounded-lg transition-colors">
                    <span class="text-gray-800"><?php echo e($servicio->tipo_servicio); ?></span>
                    <span class="font-semibold text-gray-900">$<?php echo e(number_format($servicio->CostoTotal, 2)); ?></span>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <?php endif; ?>

            <!-- Asiento -->
            <?php if($detallesPago['asiento']): ?>
            <div class="mb-6 pb-6 border-b border-gray-100">
                <h6 class="text-xs font-bold text-gray-500 mb-3 uppercase tracking-wider flex items-center">
                    <i class="fas fa-chair mr-2 text-orange-500"></i>
                    Asiento
                </h6>
                <div class="flex justify-between items-center py-2 bg-orange-50 px-3 rounded-lg">
                    <span class="text-gray-800 font-medium">Asiento <?php echo e($detallesPago['asiento']->NumeroAsiento); ?></span>
                    <span class="font-bold text-gray-900">$<?php echo e(number_format($detallesPago['asiento']->precio_vuelo * 0.1, 2)); ?></span>
                </div>
                <p class="text-sm text-gray-500 mt-2 ml-3">
                    <i class="fas fa-route text-xs mr-1"></i>
                    <?php echo e($detallesPago['asiento']->aeropuerto_origen); ?> → <?php echo e($detallesPago['asiento']->aeropuerto_destino); ?>

                </p>
            </div>
            <?php endif; ?>

            <!-- Equipajes -->
            <?php if(!empty($detallesPago['equipajes'])): ?>
            <div class="mb-6 pb-6 border-b border-gray-100">
                <h6 class="text-xs font-bold text-gray-500 mb-3 uppercase tracking-wider flex items-center">
                    <i class="fas fa-suitcase-rolling mr-2 text-green-500"></i>
                    Equipajes
                </h6>
                <?php $__currentLoopData = $detallesPago['equipajes']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $equipaje): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="bg-green-50 p-3 rounded-lg mb-2">
                    <div class="flex justify-between items-center">
                        <span class="text-gray-800 font-medium"><?php echo e($equipaje->Dimensiones ?? 'N/A'); ?></span>
                        <span class="font-bold text-gray-900">$<?php echo e(number_format($equipaje->Monto ?? 0, 2)); ?></span>
                    </div>
                    <p class="text-xs text-gray-500 mt-1">
                        <i class="fas fa-weight-hanging text-xs mr-1"></i>
                        <?php echo e($equipaje->Peso ?? 0); ?>kg | <?php echo e($equipaje->Dimensiones ?? 'N/A'); ?>

                    </p>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <?php endif; ?>

            <!-- Cálculos -->
            <div class="space-y-3 mb-6">
                <div class="flex justify-between items-center py-2">
                    <span class="text-gray-600">Subtotal</span>
                    <span class="font-semibold text-gray-900">$<?php echo e(number_format($detallesPago['total'], 2)); ?></span>
                </div>
                <div class="flex justify-between items-center py-2">
                    <span class="text-gray-600">Impuesto (12% IVA)</span>
                    <span class="font-semibold text-gray-900">$<?php echo e(number_format($detallesPago['total'] * 0.12, 2)); ?></span>
                </div>
            </div>

            <!-- Total -->
            <div class="text-white p-5 rounded-xl mb-6 shadow-lg" style="background: linear-gradient(to right, #16a34a, #15803d);">
                <div class="flex justify-between items-center">
                    <span class="text-lg font-bold">Total a Pagar</span>
                    <span class="text-3xl font-bold">$<?php echo e(number_format($detallesPago['total'] * 1.12, 2)); ?></span>
                </div>
            </div>

            <!-- Badge de Seguridad -->
            <div class="p-5 rounded-xl border border-blue-100" style="background: linear-gradient(to bottom right, #eff6ff, #e0e7ff);">
                <div class="flex items-start">
                    <div class="flex-shrink-0 mr-3">
                        <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center">
                            <i class="fas fa-shield-alt text-white"></i>
                        </div>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-blue-900 mb-1">Pago 100% Seguro</p>
                        <p class="text-xs text-blue-700 leading-relaxed">
                            Tus datos están protegidos con encriptación SSL de última generación. No almacenamos información sensible.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!-- 💰 Resumen -->


<script>
document.addEventListener("DOMContentLoaded", () => {
  const numero = document.getElementById('numero_tarjeta');
  const nombre = document.getElementById('nombre_titular');
  const fecha = document.getElementById('fecha_expiracion');
  const cardDisplay = document.getElementById('card-display');
  const holderDisplay = document.getElementById('holder-display');
  const expiryDisplay = document.getElementById('expiry-display');
  const cardBrand = document.getElementById('card-brand');

  numero.addEventListener('input', e => {
    let val = e.target.value.replace(/\D/g, '').substring(0,16);
    e.target.value = val.replace(/(\d{4})(?=\d)/g, '$1 ').trim();
    cardDisplay.textContent = e.target.value || '•••• •••• •••• ••••';
    cardBrand.textContent = val.startsWith('4') ? 'VISA' : val.startsWith('5') ? 'MASTERCARD' : 'VISA / MASTERCARD';
  });
  nombre.addEventListener('input', e => holderDisplay.textContent = e.target.value.toUpperCase() || 'NOMBRE COMPLETO');
  fecha.addEventListener('input', e => {
    let val = e.target.value.replace(/\D/g, '').substring(0,4);
    if (val.length >= 3) val = val.substring(0,2)+'/'+val.substring(2);
    e.target.value = val;
    expiryDisplay.textContent = val || 'MM/AA';
  });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\repositorios\sistema-aeropuerto - copia (4)\resources\views/pagos/create.blade.php ENDPATH**/ ?>