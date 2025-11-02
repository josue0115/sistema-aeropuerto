 <!-- Carga de Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Carga de Lucide Icons para iconos limpios -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        /* Estilo personalizado para las barras de progreso */
        .progress-bar {
            transition: width 0.5s ease-in-out;
        }
        /* Configuración de la fuente Inter */
        :root {
            font-family: 'Inter', sans-serif;
        }
        /* Estilos base para simular gráficos */
        .mock-chart {
            height: 250px;
            background: linear-gradient(to top, #e0f2f1 0%, #ffffff 100%);
            border-radius: 0.5rem;
            border: 1px solid #e0e0e0;
        }
        .mock-line {
            height: 100%;
            background: repeating-linear-gradient(
                to top,
                #0000 0,
                #0000 9%,
                #d1d5db 10%,
                #d1d5db 11%
            );
            background-size: 100% 50px;
        }
        .mock-bar {
            position: absolute;
            bottom: 0;
            width: 15%;
            background-color: #0d9488; /* Teal-600 */
            border-radius: 0.25rem 0.25rem 0 0;
        }
        /* Personalización del scrollbar */
        .custom-scroll::-webkit-scrollbar {
            width: 8px;
        }

        .custom-scroll::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        .custom-scroll::-webkit-scrollbar-thumb {
            background: #0d9488;
            border-radius: 10px;
        }

        .custom-scroll::-webkit-scrollbar-thumb:hover {
            background: #0f766e;
        }
            </style>
     <script>
        // Configuración de Tailwind para incluir la fuente Inter y colores personalizados
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary': '#0d9488', // Teal-600
                        'secondary': '#f97316', // Orange-500
                        'accent': '#6366f1', // Indigo-500
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>

<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header', null, []); ?> 
        <h2 class="font-semibold text-xl text-gray-800 leading-tight py-6">
            <?php echo e(__('Dashboard')); ?>

        </h2>

        <div  class="py-12 bg-gray-50 min-h-screen p-4 sm:p-8 overflow-y-auto max-h-screen custom-scroll">
                <!-- <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            <?php echo e(__("You're logged in!")); ?>

                        </div>
                    </div>
                </div> -->
                <div class="max-w-7xl mx-auto">
                <!-- Título del Dashboard -->
                    <header class="mb-6">
                        <h1 class="text-4xl font-extrabold text-gray-900 mb-2 flex items-center">
                            <i data-lucide="layout-dashboard" class="w-8 h-8 mr-3 text-primary"></i>
                            Panel de Control Aeroportuario
                        </h1>
                        <p class="text-gray-500">Vista general de operaciones, finanzas y experiencia del pasajero.</p>
                    </header>

                <!-- Contenedor principal de Indicadores (KPIs) -->
                <section id="kpi-indicators" class="mb-12">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-4 border-b pb-2">Indicadores Clave (KPIs)</h2>
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">

                        <!-- KPI 1: Vuelos Diarios -->
                        <div class="bg-white p-5 rounded-xl shadow-lg border border-primary/20 hover:shadow-xl transition duration-300">
                            <div class="flex items-center justify-between">
                                <h3 class="text-sm font-medium text-gray-500 uppercase">Vuelos Diarios</h3>
                                <i data-lucide="plane" class="w-6 h-6 text-primary"></i>
                            </div>
                            <p class="mt-1 text-3xl font-bold text-gray-900" id="totalVuelos"><?php echo e(number_format($vuelosDiarios)); ?></p>
                            <p class="text-xs text-green-500 mt-1 flex items-center">
                                <i data-lucide="arrow-up" class="w-3 h-3 mr-1"></i>
                                +4.1% vs. ayer
                            </p>
                        </div>

                        <!-- KPI 2: Porcentaje de Puntualidad (Salidas) -->
                        <div class="bg-white p-5 rounded-xl shadow-lg border border-primary/20 hover:shadow-xl transition duration-300">
                            <div class="flex items-center justify-between">
                                <h3 class="text-sm font-medium text-gray-500 uppercase">Puntualidad Salidas</h3>
                                <i data-lucide="clock" class="w-6 h-6 text-secondary"></i>
                            </div>
                            <p class="mt-1 text-3xl font-bold text-gray-900" id="puntualidadSalidas"><?php echo e($puntualidadSalidas); ?>%</p>
                            <p class="text-xs text-red-500 mt-1 flex items-center">
                                <i data-lucide="arrow-down" class="w-3 h-3 mr-1"></i>
                                -1.2% semanal
                            </p>
                        </div>

                        <!-- KPI 3: Ingresos Totales (Mensual) -->
                        <div class="bg-white p-5 rounded-xl shadow-lg border border-primary/20 hover:shadow-xl transition duration-300">
                            <div class="flex items-center justify-between">
                                <h3 class="text-sm font-medium text-gray-500 uppercase">Ingresos (Mes)</h3>
                                <i data-lucide="wallet" class="w-6 h-6 text-accent"></i>
                            </div>
                            <p class="mt-1 text-3xl font-bold text-gray-900" id="ingresosMensuales">$<?php echo e(number_format($ingresosMensuales )); ?> </p>
                            <p class="text-xs text-green-500 mt-1 flex items-center">
                                <i data-lucide="arrow-up" class="w-3 h-3 mr-1"></i>
                                +12.8% vs. mes anterior
                            </p>
                        </div>

                        <!-- KPI 4: Nivel de Satisfacción (NPS) -->
                        <div class="bg-white p-5 rounded-xl shadow-lg border border-primary/20 hover:shadow-xl transition duration-300">
                            <div class="flex items-center justify-between">
                                <h3 class="text-sm font-medium text-gray-500 uppercase">Satisfacción (NPS)</h3>
                                <i data-lucide="smile" class="w-6 h-6 text-green-600"></i>
                            </div>
                            <p class="mt-1 text-3xl font-bold text-gray-900" id="npsScore"><?php echo e($npsScore); ?></p>
                            <p class="text-xs text-gray-500 mt-1">
                                Encuestas recientes
                            </p>
                        </div>

                    </div>
                </section>
                
                <!-- Indicadores Operacionales y de Capacidad -->
                <section id="operational-indicators" class="mb-12">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-4 border-b pb-2">Operaciones y Capacidad</h2>
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                        <!-- Gráfico de Líneas (Mock) - Evolución de Puntualidad -->
                        <div class="lg:col-span-2 bg-white p-6 rounded-xl shadow-lg">
                            <h3 class="text-xl font-semibold text-gray-800 mb-4">Evolución Semanal de Puntualidad (Llegadas)</h3>
                            <div class="mock-chart relative overflow-hidden">
                                <div class="mock-line"></div>
                                <!-- Simulación de línea de tendencia -->
                                <svg class="absolute inset-0 w-full h-full p-2" viewBox="0 0 100 100" preserveAspectRatio="none">
                                    <polyline fill="none" stroke="#6366f1" stroke-width="2" points="
                                        0,<?php echo e(100 - ($evolucionPuntualidad[6] ?? 0)); ?>

                                        16.66,<?php echo e(100 - ($evolucionPuntualidad[5] ?? 0)); ?>

                                        33.32,<?php echo e(100 - ($evolucionPuntualidad[4] ?? 0)); ?>

                                        49.98,<?php echo e(100 - ($evolucionPuntualidad[3] ?? 0)); ?>

                                        66.64,<?php echo e(100 - ($evolucionPuntualidad[2] ?? 0)); ?>

                                        83.3,<?php echo e(100 - ($evolucionPuntualidad[1] ?? 0)); ?>

                                        99.96,<?php echo e(100 - ($evolucionPuntualidad[0] ?? 0)); ?>

                                    " />
                                    <circle cx="99.96" cy="<?php echo e(100 - ($evolucionPuntualidad[0] ?? 0)); ?>" r="2" fill="#6366f1" />
                                </svg>
                                <div class="absolute bottom-0 left-0 right-0 h-4 text-xs text-gray-500 flex justify-around items-center">
                                    <span>Lun</span><span>Mar</span><span>Mié</span><span>Jue</span><span>Vie</span><span>Sáb</span><span>Dom</span>
                                </div>
                            </div>
                        </div>

                        <!-- Tarjetas de Capacidad y Tiempos -->
                        <div class="space-y-4">
                            <div class="bg-white p-5 rounded-xl shadow-lg border border-gray-200">
                                <div class="flex items-center justify-between">
                                    <h4 class="font-medium text-gray-800">Capacidad Promedio de Vuelo</h4>
                                    <i data-lucide="users" class="w-5 h-5 text-primary"></i>
                                </div>
                                <div class="text-2xl font-bold text-gray-900 my-1"><?php echo e($capacidadPromedio); ?>%</div>
                                <div class="bg-gray-200 rounded-full h-2.5">
                                    <div class="progress-bar bg-primary h-2.5 rounded-full" style="width: <?php echo e($capacidadPromedio); ?>%;"></div>
                                </div>
                            </div>

                            <div class="bg-white p-5 rounded-xl shadow-lg border border-gray-200">
                                <div class="flex items-center justify-between">
                                    <h4 class="font-medium text-gray-800">Tiempo Promedio de Embarque</h4>
                                    <i data-lucide="timer" class="w-5 h-5 text-secondary"></i>
                                </div>
                                <p class="text-2xl font-bold text-gray-900"><?php echo e($tiempoEmbarque); ?> min</p>
                                <p class="text-xs text-gray-500">Objetivo: 20 min</p>
                            </div>
                            
                            <div class="bg-white p-5 rounded-xl shadow-lg border border-gray-200">
                                <div class="flex items-center justify-between">
                                    <h4 class="font-medium text-gray-800">Puertas Activas / Disponibles</h4>
                                    <i data-lucide="grip-vertical" class="w-5 h-5 text-accent"></i>
                                </div>
                                <p class="text-2xl font-bold text-gray-900"><?php echo e($puertasActivas); ?> / <?php echo e($puertasTotal); ?></p>
                                <p class="text-xs text-gray-500">6 puertas libres</p>
                            </div>
                        </div>

                    </div>
                </section>

                <!-- Indicadores de Ventas y Pasajeros -->
                <section id="sales-passenger-data" class="mb-12">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-4 border-b pb-2">Ventas y Datos de Pasajeros</h2>
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                        
                        <!-- Top 5 Destinos Más Vendidos (Gráfico de Barras Mock) -->
                        <div class="lg:col-span-1 bg-white p-6 rounded-xl shadow-lg">
                            <h3 class="text-xl font-semibold text-gray-800 mb-4">Top 5 Destinos (Boletos)</h3>
                            <div class="mock-chart relative flex justify-around items-end p-2">
                                <?php $__currentLoopData = $topDestinos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $destino): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $heights = [95, 80, 65, 50, 35];
                                        $lefts = [10, 25, 40, 55, 70];
                                        $height = isset($heights[$index]) ? $heights[$index] : 35;
                                        $left = isset($lefts[$index]) ? $lefts[$index] : 10;
                                        $opacity = 1 - ($index * 0.2);
                                    ?>
                                    <div class="mock-bar bg-primary" style="height: <?php echo e($height); ?>%; left: <?php echo e($left); ?>%; opacity: <?php echo e($opacity); ?>;">
                                        <span class="absolute -top-6 text-xs font-semibold text-primary"><?php echo e(number_format($destino->total)); ?>K</span>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <div class="mt-4 text-xs text-center space-x-2">
                                <?php $__currentLoopData = $topDestinos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $destino): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <span class="font-medium"><?php echo e(substr($destino->NombreAeropuerto, 0, 3)); ?></span> <?php if(!$loop->last): ?>·<?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>

                        <!-- Detalle de Ingresos por Clase -->
                        <div class="lg:col-span-2 bg-white p-6 rounded-xl shadow-lg">
                            <h3 class="text-xl font-semibold text-gray-800 mb-4">Ingresos por Clase y Promedio de Precio</h3>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                                <div class="border p-4 rounded-lg bg-gray-50">
                                    <p class="text-sm text-gray-500">Económica</p>
                                    <p class="text-xl font-bold text-gray-900">$<?php echo e(number_format($ingresosEconomica)); ?>M</p>
                                    <p class="text-sm text-primary">Avg: $<?php echo e(number_format($avgEconomica)); ?></p>
                                </div>
                                <div class="border p-4 rounded-lg bg-gray-50">
                                    <p class="text-sm text-gray-500">Ejecutiva</p>
                                    <p class="text-xl font-bold text-gray-900">$<?php echo e(number_format($ingresosEjecutiva)); ?>M</p>
                                    <p class="text-sm text-secondary">Avg: $<?php echo e(number_format($avgEjecutiva)); ?></p>
                                </div>
                                <div class="border p-4 rounded-lg bg-gray-50">
                                    <p class="text-sm text-gray-500">Primera</p>
                                    <p class="text-xl font-bold text-gray-900">$<?php echo e(number_format($ingresosPrimera )); ?>M</p>
                                    <p class="text-sm text-accent">Avg: $<?php echo e(number_format($avgPrimera)); ?></p>
                                </div>
                            </div>
                            
                            <h4 class="font-medium text-gray-800 mt-4 mb-2">Pasajeros Recurrentes vs. Nuevos</h4>
                            <div class="flex space-x-2 text-sm text-white font-semibold rounded-lg overflow-hidden">
                                <div class="bg-primary/90 p-2 text-center" style="flex: <?php echo e($porcentajeRecurrentes); ?>;"><?php echo e($porcentajeRecurrentes); ?>% Recurrentes</div>
                                <div class="bg-secondary/90 p-2 text-center" style="flex: <?php echo e($porcentajeNuevos); ?>;"><?php echo e($porcentajeNuevos); ?>% Nuevos</div>
                            </div>
                        </div>

                    </div>
                </section>
                
                <!-- Monitoreo en Tiempo Real y Tablas -->
                <section id="realtime-monitoring" class="mb-12">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-4 border-b pb-2">Monitoreo en Tiempo Real</h2>
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        
                        <!-- Mapa Interactivo Mejorado -->
                        <div class="bg-white p-6 rounded-xl shadow-lg">
                            <h3 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                                <i data-lucide="globe" class="w-6 h-6 mr-2 text-primary"></i>
                                Mapa de Vuelos Activos
                            </h3>
                            <div class="w-full h-80 bg-gradient-to-br from-blue-100 to-blue-300 rounded-lg relative overflow-hidden border border-gray-300 shadow-inner">
                                <!-- Simulación de mapa con gradientes -->
                                <div class="absolute inset-0 bg-gradient-to-r from-blue-200 via-blue-100 to-green-100 opacity-80"></div>
                                <!-- Continentes simulados -->
                                <div class="absolute top-1/4 left-1/4 w-16 h-12 bg-green-400 rounded-lg opacity-60"></div>
                                <div class="absolute bottom-1/3 right-1/4 w-20 h-14 bg-green-500 rounded-lg opacity-60"></div>
                                <div class="absolute top-1/2 left-1/2 w-12 h-10 bg-green-300 rounded-lg opacity-60"></div>
                                <!-- Aeropuertos y rutas -->
                                <svg class="absolute inset-0 w-full h-full" viewBox="0 0 400 320" preserveAspectRatio="none">
                                    <!-- Rutas de vuelo -->
                                    <path d="M50,100 Q150,80 250,120" stroke="#0d9488" stroke-width="2" fill="none" stroke-dasharray="5,5" class="animate-pulse"></path>
                                    <path d="M300,200 Q200,180 100,160" stroke="#6366f1" stroke-width="2" fill="none" stroke-dasharray="5,5" class="animate-pulse"></path>
                                    <path d="M150,50 Q200,100 300,80" stroke="#f97316" stroke-width="2" fill="none" stroke-dasharray="5,5" class="animate-pulse"></path>
                                    <!-- Aviones en vuelo -->
                                    <circle cx="150" cy="90" r="4" fill="#0d9488" class="animate-ping"></circle>
                                    <circle cx="200" cy="170" r="4" fill="#6366f1" class="animate-ping"></circle>
                                    <circle cx="250" cy="70" r="4" fill="#f97316" class="animate-ping"></circle>
                                </svg>
                                <!-- Marcadores de aeropuertos -->
                                <div class="absolute top-1/4 left-1/4 transform -translate-x-1/2 -translate-y-1/2">
                                    <i data-lucide="map-pin" class="w-8 h-8 text-red-500 drop-shadow-lg hover:scale-110 transition-transform cursor-pointer" title="Aeropuerto Internacional - Vuelo Activo"></i>
                                </div>
                                <div class="absolute bottom-1/3 right-1/4 transform -translate-x-1/2 -translate-y-1/2">
                                    <i data-lucide="map-pin" class="w-8 h-8 text-green-500 drop-shadow-lg hover:scale-110 transition-transform cursor-pointer" title="Aeropuerto Nacional - En Ruta"></i>
                                </div>
                                <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                                    <i data-lucide="map-pin" class="w-8 h-8 text-blue-500 drop-shadow-lg hover:scale-110 transition-transform cursor-pointer" title="Hub Internacional - Múltiples Vuelos"></i>
                                </div>
                                <!-- Etiquetas -->
                                <div class="absolute top-1/4 left-1/4 mt-8 ml-2 bg-white px-2 py-1 rounded shadow text-xs font-medium text-gray-700">Madrid</div>
                                <div class="absolute bottom-1/3 right-1/4 mb-8 mr-2 bg-white px-2 py-1 rounded shadow text-xs font-medium text-gray-700">Nueva York</div>
                                <div class="absolute top-1/2 left-1/2 mt-8 ml-2 bg-white px-2 py-1 rounded shadow text-xs font-medium text-gray-700">Londres</div>
                            </div>
                            <div class="mt-4 grid grid-cols-3 gap-4 text-sm">
                                <div class="flex items-center">
                                    <div class="w-3 h-3 bg-red-500 rounded-full mr-2"></div>
                                    <span>Vuelos Salientes</span>
                                </div>
                                <div class="flex items-center">
                                    <div class="w-3 h-3 bg-green-500 rounded-full mr-2"></div>
                                    <span>Vuelos Entrantes</span>
                                </div>
                                <div class="flex items-center">
                                    <div class="w-3 h-3 bg-blue-500 rounded-full mr-2"></div>
                                    <span>Conexiones</span>
                                </div>
                            </div>
                            <p class="text-sm text-gray-500 mt-3">Capacidad de Terminal A: <span class="text-primary font-bold"><?php echo e($capacidadPromedio); ?>% (<?php echo e(intval($capacidadPromedio * 6.6)); ?>/660 personas)</span></p>
                        </div>

                        <!-- Tabla de Estado de Vuelos (Datos Técnicos / Administrativos) -->
                        <div class="bg-white p-6 rounded-xl shadow-lg overflow-x-auto">
                            <h3 class="text-xl font-semibold text-gray-800 mb-4">Estado Actual de Vuelos (T-30 min)</h3>
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Vuelo</th>
                                        <th class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Destino</th>
                                        <th class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Puerta</th>
                                        <th class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <?php $__currentLoopData = $vuelosRecientes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vuelo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td class="px-3 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?php echo e($vuelo['id']); ?></td>
                                        <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo e($vuelo['destino']); ?></td>
                                        <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo e($vuelo['puerta']); ?></td>
                                        <td class="px-3 py-4 whitespace-nowrap">
                                            <?php if($vuelo['estado'] == 'Embarcando'): ?>
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                    <?php echo e($vuelo['estado']); ?>

                                                </span>
                                            <?php elseif($vuelo['estado'] == 'Retrasado (30m)'): ?>
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                    <?php echo e($vuelo['estado']); ?>

                                                </span>
                                            <?php elseif($vuelo['estado'] == 'En Vuelo'): ?>
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-indigo-100 text-indigo-800">
                                                    <?php echo e($vuelo['estado']); ?>

                                                </span>
                                            <?php else: ?>
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                    <?php echo e($vuelo['estado']); ?>

                                                </span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>

                <!-- Sección de Datos de Aerolínea y Rutas -->
                <section id="airline-route-data" class="mb-12">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-4 border-b pb-2">Datos de Aerolínea y Rutas</h2>
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        
                        <!-- Ranking de Aerolíneas (Ejemplo de Tabla Detallada) -->
                        <div class="bg-white p-6 rounded-xl shadow-lg overflow-x-auto">
                            <h3 class="text-xl font-semibold text-gray-800 mb-4">Ranking de Aerolíneas</h3>
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aerolínea</th>
                                        <th class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Puntualidad</th>
                                        <th class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ventas (M)</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <?php $__currentLoopData = $rankingAerolineas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $aerolinea): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td class="px-3 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?php echo e($aerolinea['nombre']); ?></td>
                                        <td class="px-3 py-4 whitespace-nowrap text-sm text-green-600 font-medium"><?php echo e($aerolinea['puntualidad']); ?></td>
                                        <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-900"><?php echo e($aerolinea['ventas']); ?></td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>

                        <!-- Rutas con Mayor Demanda vs. Bajo Desempeño (Gráfico de Barras Doble Mock) -->
                        <div class="bg-white p-6 rounded-xl shadow-lg">
                            <h3 class="text-xl font-semibold text-gray-800 mb-4">Desempeño de Rutas (Ocupación)</h3>
                            <div class="mock-chart relative flex justify-around items-end p-2">
                                <?php $__currentLoopData = $desempenoRutas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $ruta): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($index < 2): ?>
                                        <!-- Alto Desempeño -->
                                        <div class="mock-bar bg-green-500/80" style="height: <?php echo e(85 - ($index * 15)); ?>%; left: <?php echo e(10 + ($index * 15)); ?>%;">
                                            <span class="absolute -top-6 text-xs font-semibold text-green-500"><?php echo e($ruta['codigo']); ?></span>
                                        </div>
                                    <?php else: ?>
                                        <!-- Bajo Desempeño -->
                                        <div class="mock-bar bg-red-500/80" style="height: <?php echo e(40 - (($index - 2) * 15)); ?>%; left: <?php echo e(55 + (($index - 2) * 15)); ?>%;">
                                            <span class="absolute -top-6 text-xs font-semibold text-red-500"><?php echo e($ruta['codigo']); ?></span>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <div class="mt-4 text-sm text-gray-500 text-center">
                                <span class="text-green-500 font-semibold">Alto Desempeño (80%+ Ocupación)</span> |
                                <span class="text-red-500 font-semibold">Bajo Desempeño (40%- Ocupación)</span>
                            </div>
                        </div>
                    </div>
                </section>

            </div>

     <?php $__env->endSlot(); ?>

   
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH C:\repositorios\sistema-aeropuerto - copia (4)\resources\views/dashboard.blade.php ENDPATH**/ ?>