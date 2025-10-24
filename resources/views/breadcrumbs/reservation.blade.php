@if(request()->routeIs(['vuelos.create', 'vuelos.disponibles', 'reservas.create', 'pasajeros.create', 'boletos.create', 'servicios.create', 'asientos.create']))
    <nav class="checkout-steps" style="position: relative;">
       @if(session()->has('total_acumulado'))
            <div class="absolute top-3 right-3 bg-blue-600 text-white px-4 py-2 rounded-lg shadow-lg">
                <div class="text-sm font-medium">Total Reserva</div>
                <div class="text-lg font-bold">${{ number_format(session('total_acumulado'), 2) }}</div>
            </div>
        @endif
        <div class="container">
            
            @php
                $steps = ['Vuelos', 'Pasajeros', 'Boletos', 'Servicios', 'Asientos', 'Reservas', 'Pago'];
                $routes = ['vuelos.create', 'pasajeros.create', 'boletos.create', 'servicios.create', 'asientos.create', 'reservas.create'];
                $currentRoute = request()->route()->getName();
                if ($currentRoute == 'vuelos.disponibles') {
                    $currentRoute = 'vuelos.create';
                }
                $currentStepIndex = array_search($currentRoute, $routes);
                $progressPercentage = (($currentStepIndex + 1) / count($steps)) * 100;
            @endphp
              
            <!-- Barra de progreso -->
              
            <div class="progress-bar-container">
                <div class="progress-bar-fill" style="width: {{ $progressPercentage }}%"></div>
                <div class="progress-text">{{ intval($progressPercentage) }}% Completado</div>
            </div>
         
            <ul class="steps">
                @foreach($steps as $index => $step)
                    @php $stepNumber = $index + 1; @endphp
                    <li class="step {{ $stepNumber <= $currentStepIndex + 1 ? 'completed' : ($stepNumber == $currentStepIndex + 2 ? 'active' : '') }}">
                        <span class="step-number">{{ $stepNumber }}</span>
                        <span class="step-label">{{ $step }}</span>
                    </li>
                    @if($index < count($steps) - 1)
                        <li class="step-line {{ $stepNumber < $currentStepIndex + 1 ? 'completed' : '' }}"></li>
                    @endif
                @endforeach
               
            </ul>
              
           
        </div>
         
    </nav>
@endif


<style>
.checkout-steps {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 20px 0 15px 0;
    border-bottom: 3px solid #5a67d8;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
}

.checkout-steps .container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 15px;
}

/* Barra de progreso */
.progress-bar-container {
    width: 100%;
    height: 10px;
    background-color: rgba(255,255,255,0.3);
    border-radius: 5px;
    margin-bottom: 25px;
    position: relative;
    overflow: hidden;
    box-shadow: inset 0 1px 3px rgba(0,0,0,0.2);
}

.progress-bar-fill {
    height: 100%;
    background: linear-gradient(90deg, #48bb78 0%, #38a169 100%);
    border-radius: 5px;
    transition: width 0.5s ease;
    box-shadow: 0 0 10px rgba(72, 187, 120, 0.5);
}

.progress-text {
    position: absolute;
    top: -30px;
    right: 0;
    font-size: 14px;
    color: #fff;
    font-weight: 600;
    text-shadow: 1px 1px 2px rgba(0,0,0,0.3);
}

.steps {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-wrap: wrap;
}

.step {
    display: flex;
    flex-direction: column;
    align-items: center;
    position: relative;
}

.step-number {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    font-size: 18px;
    margin-bottom: 10px;
    transition: all 0.4s ease;
    box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    border: 3px solid transparent;
}

.step.completed .step-number {
    background: linear-gradient(135deg, #48bb78 0%, #38a169 100%);
    color: white;
    transform: scale(1.1);
    box-shadow: 0 6px 12px rgba(72, 187, 120, 0.4);
}

.step.active .step-number {
    background: linear-gradient(135deg, #4299e1 0%, #3182ce 100%);
    color: white;
    transform: scale(1.15);
    box-shadow: 0 8px 16px rgba(66, 153, 225, 0.5);
    animation: pulse 2s infinite;
    border-color: #fff;
}

.step:not(.completed):not(.active) .step-number {
    background-color: rgba(255,255,255,0.9);
    color: #4a5568;
    border-color: rgba(255,255,255,0.5);
}

.step-label {
    font-size: 14px;
    text-align: center;
    color: rgba(255,255,255,0.9);
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
    text-shadow: 1px 1px 2px rgba(0,0,0,0.3);
}

.step.completed .step-label {
    color: #48bb78;
    text-shadow: 1px 1px 2px rgba(72, 187, 120, 0.3);
}

.step.active .step-label {
    color: #fff;
    font-weight: 700;
    text-shadow: 1px 1px 2px rgba(0,0,0,0.5);
}

.step-line {
    width: 80px;
    height: 4px;
    background-color: rgba(255,255,255,0.3);
    margin: 0 15px;
    transition: background-color 0.4s ease;
    border-radius: 2px;
    box-shadow: inset 0 1px 2px rgba(0,0,0,0.1);
}

.step-line.completed {
    background: linear-gradient(90deg, #48bb78 0%, #38a169 100%);
    box-shadow: 0 0 8px rgba(72, 187, 120, 0.4);
}

@keyframes pulse {
    0% { transform: scale(1.15); }
    50% { transform: scale(1.2); }
    100% { transform: scale(1.15); }
}

@media (max-width: 768px) {
    .checkout-steps {
        padding: 15px 0 10px 0;
    }
    .progress-bar-container {
        margin-bottom: 20px;
        height: 8px;
    }
    .progress-text {
        font-size: 12px;
        top: -25px;
    }
    .step-line {
        width: 40px;
        margin: 0 10px;
    }
    .step-label {
        font-size: 12px;
    }
    .step-number {
        width: 45px;
        height: 45px;
        font-size: 16px;
    }
}
</style>
