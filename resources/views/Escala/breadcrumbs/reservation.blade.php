@if(request()->routeIs(['vuelos.create', 'pasajeros.create', 'boletos.create', 'servicios.create', 'asientos.create']))
    <nav class="checkout-steps">
        <div class="container">
            <ul class="steps">
                @php
                    $steps = ['Vuelos', 'Pasajeros', 'Boletos', 'Servicios', 'Asientos'];
                    $routes = ['vuelos.create', 'pasajeros.create', 'boletos.create', 'servicios.create', 'asientos.create'];
                    $currentRoute = request()->route()->getName();
                    $currentStepIndex = array_search($currentRoute, $routes);
                @endphp
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
    background: #f8f9fa;
    padding: 5px 0 5px 0;
    border-bottom: 1px solid #e9ecef;
}

.checkout-steps .container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 15px;
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
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    font-size: 16px;
    margin-bottom: 8px;
    transition: all 0.3s ease;
}

.step.completed .step-number {
    background-color: #28a745;
    color: white;
}

.step.active .step-number {
    background-color: #007bff;
    color: white;
}

.step:not(.completed):not(.active) .step-number {
    background-color: #e9ecef;
    color: #6c757d;
}

.step-label {
    font-size: 12px;
    text-align: center;
    color: #6c757d;
    font-weight: 500;
}

.step.completed .step-label {
    color: #28a745;
}

.step.active .step-label {
    color: #007bff;
}

.step-line {
    width: 60px;
    height: 2px;
    background-color: #e9ecef;
    margin: 0 10px;
    transition: background-color 0.3s ease;
}

.step-line.completed {
    background-color: #28a745;
}

@media (max-width: 768px) {
    .step-line {
        width: 30px;
    }
    .step-label {
        font-size: 10px;
    }
    .step-number {
        width: 35px;
        height: 35px;
        font-size: 14px;
    }
}
</style>
