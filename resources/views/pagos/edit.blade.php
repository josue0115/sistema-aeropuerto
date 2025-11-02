@extends('layouts.app')

@section('title', 'Editar Registro de Pago')

@section('content')
<style>
/* =====================================================================================
    NOTA: Mantenemos los estilos customizados de la vista original.
===================================================================================== */
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
.btn-pago-edit {
    background: linear-gradient(90deg, #f59e0b, #d97706);
    border: none;
    color: #fff;
    padding: 12px 20px;
    border-radius: 10px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s ease;
}
.btn-pago-edit:hover {
    transform: translateY(-1px);
    background: linear-gradient(90deg, #d97706, #b45309);
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
    <div class="card-box">
        <div class="flex justify-between items-center mb-1">
            <h3 class="text-xl font-bold text-gray-800">Editar Registro de Pago</h3>
            <a href="{{ route('pagos.index') }}" class="material-btn material-btn-secondary flex items-center px-4 py-2">
                <i class="material-icons text-sm mr-2">arrow_back</i>Volver
            </a>
        </div>
        <p class="text-sm text-gray-500 mb-6" vale="{{ $pago->idPago }}">Modifique los detalles del pago ID: {{ $pago->idPago }}</p>
        
        <div class="credit-preview">
            <div class="text-xs opacity-80 flex justify-between">
                <span>TARJETA</span>
                <span id="card-brand">{{ $pago->tipo_tarjeta ?? 'VISA / MASTERCARD' }}</span> 
            </div>
            <div id="card-display" class="credit-number">•••• •••• •••• {{ substr($pago->numero_tarjeta ?? '0000', -4) }}</div>
            <div class="credit-footer">
                <div>
                    <div style="font-size:0.7rem; opacity:0.8;">TITULAR</div>
                    <div id="holder-display">{{ $pago->nombre_titular ?? 'NOMBRE COMPLETO' }}</div>
                </div>
                <div>
                    <div style="font-size:0.7rem; opacity:0.8;">VÁLIDO HASTA</div>
                    <div id="expiry-display">{{ $pago->fecha_expiracion ?? 'MM/AA' }}</div>
                </div>
            </div>
        </div>

        <form id="payment-form" action="{{ route('pagos.update', $pago->idPago) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div style="margin-bottom: 20px;">
                <label>ID Reserva Asociada</label>
<input id="idReserva" name="idReserva" type="number" value="{{ old('idReserva', $pago->idReserva) }}" required>

                @error('idBoleto')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-2 gap-4 mb-5">
                <div>
                    <label>Monto Pagado (USD)</label>
                    <input type="text" value="${{ number_format($pago->Monto, 2) }}" readonly class="bg-gray-100 cursor-not-allowed">
                </div>
                <div>
                    <label>Fecha de Pago</label>
                    <input type="text" value="{{ \Carbon\Carbon::parse($pago->FechaPago)->format('Y-m-d H:i') }}" readonly class="bg-gray-100 cursor-not-allowed">

                </div>
            </div>

            <h4 class="text-lg font-bold text-gray-800 border-t pt-4 mt-4 mb-4">Detalles del Método de Pago</h4>

            <div style="margin-bottom: 15px;">
                <label>Últimos 4 Dígitos Tarjeta</label>
                <input id="numero_tarjeta_edit" name="numero_tarjeta_edit" type="text" maxlength="4" placeholder="{{ substr($pago->numero_tarjeta ?? '0000', -4) }}" value="{{ old('numero_tarjeta_edit', substr($pago->numero_tarjeta ?? '', -4)) }}">
                <p class="text-xs text-gray-500 mt-1">Si no edita este campo, se mantendrá la información original.</p>
                @error('numero_tarjeta_edit')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex mb-4">
                <div class="w-1/2">
                    <label>Fecha Exp</label>
                    <input id="fecha_expiracion_edit" name="fecha_expiracion_edit" maxlength="5" placeholder="MM/AA" value="{{ old('fecha_expiracion_edit', $pago->fecha_expiracion ?? '') }}">
                    @error('fecha_expiracion_edit')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="w-1/2">
                    <label>CVV</label>
                    <input id="cvv_edit" name="cvv_edit" maxlength="4" placeholder="•••" value="{{ old('cvv_edit') }}">
                    <p class="text-xs text-gray-500 mt-1">Deje vacío si no desea actualizar.</p>
                    @error('cvv_edit')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                                    </div>
            </div>

            <div style="margin-bottom: 20px;">
                <label>Nombre del Titular</label>
                
                <input id="nombre_titular_edit" name="nombre_titular_edit" placeholder="Como aparece en la tarjeta">
               
                    <p class="text-red-500 text-xs mt-1">message </p>
              
            </div>

            <div style="margin-bottom: 20px;">
                <label for="Estado" class="text-sm font-medium text-gray-700 mb-1 flex items-center">
                    <i class="material-icons text-gray-500 mr-1 text-sm">check_circle</i>Estado de Pago
                </label>
                <select id="Estado" name="Estado" class="form-select w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="Aprobado" {{ old('Estado', $pago->Estado) == 'Aprobado' ? 'selected' : '' }}>Aprobado</option>
                    <option value="Pendiente" {{ old('Estado', $pago->Estado) == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                    <option value="Rechazado" {{ old('Estado', $pago->Estado) == 'Rechazado' ? 'selected' : '' }}>Rechazado</option>
                    <option value="Reembolsado" {{ old('Estado', $pago->Estado) == 'Reembolsado' ? 'selected' : '' }}>Reembolsado</option>
                </select>
                @error('Estado')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div style="margin-top:25px; text-align:right;">
                <button type="submit" class="btn-pago-edit">
                    <i class="fas fa-save mr-1"></i>Guardar Cambios
                </button>
            </div>
        </form>
    </div>

    {{-- ================== SECCIÓN DE RESUMEN ================== --}}
    <div class="summary-box overflow-auto">
        <div class="summary-title flex items-center">
            <i class="fas fa-receipt mr-2 text-blue-600"></i>
            Resumen del Pago (Referencia)
        </div>

        <div class="p-6" style="max-height: 565px; overflow-y: auto;">
            @php
                $detallesPago = $detallesPago ?? [];
            @endphp

            {{-- BOLETO --}}
            @if(!empty($detallesPago['boleto']))
                <div class="mb-6 pb-6 border-b border-gray-100">
                    <h6 class="text-xs font-bold text-gray-500 mb-3 uppercase tracking-wider flex items-center">
                        <i class="fas fa-plane-departure mr-2 text-blue-500"></i>Boleto
                    </h6>
                    <div class="flex justify-between items-center py-2 bg-blue-50 px-3 rounded-lg">
                        <span class="text-gray-800 font-medium">Vuelo {{ $detallesPago['boleto']->idVuelo }}</span>
                        <span class="font-bold text-gray-900">${{ number_format($detallesPago['boleto']->Precio, 2) }}</span>
                    </div>
                    <p class="text-sm text-gray-500 mt-2 ml-3">
                        <i class="far fa-user text-xs mr-1"></i>
                        Pasajero: {{ $detallesPago['boleto']->idPasajero }}
                    </p>
                </div>
            @endif

            {{-- SERVICIOS --}}
            @if(!empty($detallesPago['servicios']))
                <div class="mb-6 pb-6 border-b border-gray-100">
                    <h6 class="text-xs font-bold text-gray-500 mb-3 uppercase tracking-wider flex items-center">
                        <i class="fas fa-concierge-bell mr-2 text-purple-500"></i>Servicios Adicionales
                    </h6>
                    @foreach($detallesPago['servicios'] as $servicio)
                        <div class="flex justify-between items-center py-2 hover:bg-gray-50 px-3 rounded-lg transition-colors">
                            <span class="text-gray-800">{{ $servicio->tipo_servicio }}</span>
                            <span class="font-semibold text-gray-900">${{ number_format($servicio->CostoTotal, 2) }}</span>
                        </div>
                    @endforeach
                </div>
            @endif

            {{-- ASIENTO --}}
            @if(!empty($detallesPago['asiento']))
                <div class="mb-6 pb-6 border-b border-gray-100">
                    <h6 class="text-xs font-bold text-gray-500 mb-3 uppercase tracking-wider flex items-center">
                        <i class="fas fa-chair mr-2 text-orange-500"></i>Asiento
                    </h6>
                    <div class="flex justify-between items-center py-2 bg-orange-50 px-3 rounded-lg">
                        <span class="text-gray-800 font-medium">Asiento {{ $detallesPago['asiento']->NumeroAsiento }}</span>
                        <span class="font-bold text-gray-900">${{ number_format($detallesPago['asiento']->precio_vuelo * 0.1, 2) }}</span>
                    </div>
                    <p class="text-sm text-gray-500 mt-2 ml-3">
                        <i class="fas fa-route text-xs mr-1"></i>
                        {{ $detallesPago['asiento']->aeropuerto_origen }} → {{ $detallesPago['asiento']->aeropuerto_destino }}
                    </p>
                </div>
            @endif

            {{-- EQUIPAJES --}}
            @if(!empty($detallesPago['equipajes']))
                <div class="mb-6 pb-6 border-b border-gray-100">
                    <h6 class="text-xs font-bold text-gray-500 mb-3 uppercase tracking-wider flex items-center">
                        <i class="fas fa-suitcase-rolling mr-2 text-green-500"></i>Equipajes
                    </h6>
                    @foreach($detallesPago['equipajes'] as $equipaje)
                        <div class="bg-green-50 p-3 rounded-lg mb-2">
                            <div class="flex justify-between items-center">
                                <span class="text-gray-800 font-medium">{{ $equipaje->Dimensiones ?? 'N/A' }}</span>
                                <span class="font-bold text-gray-900">${{ number_format($equipaje->Monto ?? 0, 2) }}</span>
                            </div>
                            <p class="text-xs text-gray-500 mt-1">
                                <i class="fas fa-weight-hanging text-xs mr-1"></i>
                                {{ $equipaje->Peso ?? 0 }}kg | {{ $equipaje->Dimensiones ?? 'N/A' }}
                            </p>
                        </div>
                    @endforeach
                </div>
            @endif

            {{-- TOTALES --}}
            <div class="space-y-3 mb-6">
                <div class="flex justify-between items-center py-2">
                    <span class="text-gray-600">Subtotal</span>
                    <span class="font-semibold text-gray-900">${{ number_format($detallesPago['total'] ?? 0, 2) }}</span>
                </div>
                <div class="flex justify-between items-center py-2">
                    <span class="text-gray-600">Impuesto (12% IVA)</span>
                    <span class="font-semibold text-gray-900">${{ number_format(($detallesPago['total'] ?? 0) * 0.12, 2) }}</span>
                </div>
            </div>

            <div class="text-white p-5 rounded-xl mb-6 shadow-lg" style="background: linear-gradient(to right, #16a34a, #15803d);">
                <div class="flex justify-between items-center">
                    <span class="text-lg font-bold">Total a Pagar</span>
                    <span class="text-3xl font-bold">${{ number_format(($detallesPago['total'] ?? 0) * 1.12, 2) }}</span>
                </div>
            </div>

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
                            Tus datos están protegidos con encriptación SSL. No almacenamos información sensible.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
document.addEventListener("DOMContentLoaded", () => {
    const numeroEdit = document.getElementById('numero_tarjeta_edit');
    const nombreEdit = document.getElementById('nombre_titular_edit');
    const fechaEdit = document.getElementById('fecha_expiracion_edit');
    const cardDisplay = document.getElementById('card-display');
    const holderDisplay = document.getElementById('holder-display');
    const expiryDisplay = document.getElementById('expiry-display');
    const cardBrand = document.getElementById('card-brand');

    function updateCardNumberDisplay(inputVal) {
        let lastFour = inputVal.replace(/\D/g, '').substring(0, 4);
        cardDisplay.textContent = '•••• •••• •••• ' + (lastFour || '••••');
    }

    updateCardNumberDisplay(numeroEdit.value);

    numeroEdit.addEventListener('input', e => {
        let val = e.target.value.replace(/\D/g, '').substring(0, 4);
        e.target.value = val;
        updateCardNumberDisplay(val);
        if (val.length > 0) {
            cardBrand.textContent = val.startsWith('4') ? 'VISA' :
                                    val.startsWith('5') ? 'MASTERCARD' : 'TARJETA';
        }
    });

    nombreEdit.addEventListener('input', e => {
        holderDisplay.textContent = e.target.value.toUpperCase() || 'NOMBRE COMPLETO';
    });

    fechaEdit.addEventListener('input', e => {
        let val = e.target.value.replace(/\D/g, '').substring(0, 4);
        if (val.length >= 3) val = val.substring(0, 2) + '/' + val.substring(2);
        e.target.value = val;
        expiryDisplay.textContent = val || 'MM/AA';
    });

    holderDisplay.textContent = nombreEdit.value.toUpperCase() || 'NOMBRE COMPLETO';
    expiryDisplay.textContent = fechaEdit.value || 'MM/AA';
});
</script>
@endsection

               
