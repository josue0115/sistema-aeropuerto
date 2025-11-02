<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
    <a href="{{ route('dashboard') }}">
        {{-- Reemplaza el <x-application-logo> existente con este SVG --}}
        <svg class="block h-9 w-auto fill-current text-blue-600" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            
            <path d="M21 16V14L14 9V3.5C14 2.67 13.33 2 12.5 2H11.5C10.67 2 10 2.67 10 3.5V9L3 14V16L10 13V17.5L8 19V20L11.5 19L15 20V19L13 17.5V13L21 16Z" fill="currentColor"/>
            
            <path d="M11 10.5L10 11.5L11 12.5L12 11.5L11 10.5Z" fill="#1E88E5"/>
            
            <circle cx="12" cy="11" r="0.5" fill="#BBDEFB"/>
        </svg>

        
        <span class="ms-2 text-xl font-semibold text-gray-800 tracking-tight"></span>
    </a>
</div>
               
                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                   @if(in_array(auth()->user()->role, ['cliente', 'operador']))   
                    <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
                        {{ __('Home') }}
                    </x-nav-link>
                @endif
                  
                        
                @if(auth()->user()->role === 'admin' || auth()->user()->role === 'operador')
                    <!-- Dropdown de Módulo de Operaciones -->

                    <div x-data="{ open: false }" class="relative" style="padding-top: 1.25rem; padding-bottom: 0.5rem; margin-left: 1rem;">
                        <button 
                            @click="open = !open"
                            @click.away="open = false"
                            class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out"
                            :class="{ 'border-gray-300 text-gray-700': open }">
                            {{ __('Operaciones / Vuelos') }}
                            <svg class="ml-2 h-4 w-4 transition-transform duration-200" :class="{ 'rotate-180': open }"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>

                        <!-- Dropdown Menu con scroll -->
                        <div x-show="open"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 transform scale-95"
                            x-transition:enter-end="opacity-100 transform scale-100"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 transform scale-100"
                            x-transition:leave-end="opacity-0 transform scale-95"
                            class="absolute left-0 mt-2 w-80 bg-white rounded-lg shadow-xl border border-gray-200 z-50 max-h-24 overflow-y-scroll dropdown-scroll"
                            style="display: none;">
                            
                            <div class="p-3 space-y-2 max-h-50 overflow-y-auto scroll-custom">
                                <!-- Vuelos -->
                                <a href="{{ route('vuelos.index') }}" 
                                    class="flex items-center p-3 rounded-lg hover:bg-blue-50 transition group">
                                    <div  style="width: 40px;" class=" h-10 bg-blue-100 rounded-full flex items-center justify-center mr-3 group-hover:bg-blue-200 transition flex-shrink-0">
                                        <i class="fas fa-plane text-blue-600"></i>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-sm text-gray-800 group-hover:text-blue-600 transition">Vuelos</h3>
                                        <p class="text-xs text-gray-500" ">
                                            Gestionar vuelos disponibles
                                            </p>
                                    </div>
                                </a>

                                <!-- Escalas -->
                                <a href="{{ route('escala.index') }}" 
                                    class="flex items-center p-3 rounded-lg hover:bg-purple-50 transition group">
                                    <div  style="width: 40px;"  class=" h-10 bg-purple-100 rounded-lg flex items-center justify-center mr-3 group-hover:bg-purple-200 transition flex-shrink-0">
                                        <i class="fas fa-exchange-alt text-purple-600"></i>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-sm text-gray-800 group-hover:text-purple-600 transition">Escalas</h3>
                                        <p class="text-xs text-gray-500">Administrar escalas de vuelos</p>
                                    </div>
                                </a>

                                <!-- Horarios -->
                                <a href="{{ route('horario.listar') }}" 
                                    class="flex items-center p-3 rounded-lg hover:bg-green-50 transition group">
                                    <div  style="width: 40px;"  class=" h-10 bg-green-100 rounded-lg flex items-center justify-center mr-3 group-hover:bg-green-200 transition flex-shrink-0">
                                        <i class="fas fa-clock text-green-600"></i>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-sm text-gray-800 group-hover:text-green-600 transition">Horarios</h3>
                                        <p class="text-xs text-gray-500">Configurar horarios de vuelos</p>
                                    </div>
                                </a>

                                <!-- Aviones -->
                                <a href="{{ route('avion.listar') }}" 
                                    class="flex items-center p-3 rounded-lg hover:bg-orange-50 transition group">
                                    <div  style="width: 40px;"  class=" h-10 bg-orange-100 rounded-lg flex items-center justify-center mr-3 group-hover:bg-orange-200 transition flex-shrink-0">
                                        <i class="fas fa-plane-departure text-orange-600"></i>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-sm text-gray-800 group-hover:text-orange-600 transition">Aviones</h3>
                                        <p class="text-xs text-gray-500">Gestionar flota de aviones</p>
                                    </div>
                                </a>

                                <!-- Aeropuertos -->
                                <a href="{{ route('aeropuertos.index') }}" 
                                    class="flex items-center p-3 rounded-lg hover:bg-indigo-50 transition group">
                                    <div  style="width: 40px;"  class=" h-10 bg-indigo-100 rounded-lg flex items-center justify-center mr-3 group-hover:bg-indigo-200 transition flex-shrink-0">
                                        <i class="fas fa-building text-indigo-600"></i>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-sm text-gray-800 group-hover:text-indigo-600 transition">Aeropuertos</h3>
                                        <p class="text-xs text-gray-500">Administrar aeropuertos</p>
                                    </div>
                                </a>

                                <!-- Aerolíneas -->
                                <a href="{{ route('aerolineas.index') }}" 
                                    class="flex items-center p-3 rounded-lg hover:bg-red-50 transition group">
                                    <div  style="width: 40px;"  class=" h-10 bg-red-100 rounded-lg flex items-center justify-center mr-3 group-hover:bg-red-200 transition flex-shrink-0">
                                        <i class="fas fa-globe text-red-600"></i>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-sm text-gray-800 group-hover:text-red-600 transition">Aerolíneas</h3>
                                        <p class="text-xs text-gray-500">Gestionar aerolíneas</p>
                                    </div>
                                </a>

                                <!-- Asientos -->
                                <a href="{{ route('asientos.index') }}" 
                                    class="flex items-center p-3 rounded-lg hover:bg-yellow-50 transition group">
                                    <div   style="width: 40px;" class=" h-10 bg-yellow-100 rounded-lg flex items-center justify-center mr-3 group-hover:bg-yellow-200 transition flex-shrink-0">
                                        <i class="fas fa-chair text-yellow-600"></i>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-sm text-gray-800 group-hover:text-yellow-600 transition">Asientos</h3>
                                        <p class="text-xs text-gray-500">Configurar asientos de aviones</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div x-data="{ open: false }" class="relative" style="padding-top: 1.25rem; padding-bottom: 0.5rem; margin-left: 1rem;">
                        <button
                            @click="open = !open"
                            @click.away="open = false"
                            class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out"
                            :class="{ 'border-gray-300 text-gray-700': open }">
                            {{ __('Pasajeros / Reservas') }}
                            <svg class="ml-2 h-4 w-4 transition-transform duration-200" :class="{ 'rotate-180': open }"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>

                        <!-- Dropdown Menu con scroll -->
                        <div x-show="open"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 transform scale-95"
                            x-transition:enter-end="opacity-100 transform scale-100"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 transform scale-100"
                            x-transition:leave-end="opacity-0 transform scale-95"
                            class="absolute left-0 mt-2 w-80 bg-white rounded-lg shadow-xl border border-gray-200 z-50 max-h-24 overflow-y-scroll dropdown-scroll"
                            style="display: none;">
                            
                            <div class="p-3 space-y-2 max-h-90 overflow-y-auto scroll-custom">
                                <!-- Vuelos -->
                                <a href="{{ route('pasajeros.index') }}" 
                                    class="flex items-center p-3 rounded-lg hover:bg-blue-50 transition group">
                                    <div style="width: 40px;" class=" h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3 group-hover:bg-blue-200 transition flex-shrink-0">
                                        <i class="fas fa-user text-blue-600"></i></i>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-sm text-gray-800 group-hover:text-blue-600 transition">Pasajeros</h3>
                                        <p class="text-xs text-gray-500">Gestionar Pasajeros</p>
                                    </div>
                                </a>

                                <!-- Escalas -->
                                <a href="{{ route('reservas.index') }}" 
                                    class="flex items-center p-3 rounded-lg hover:bg-purple-50 transition group">
                                    <div style="width: 40px;" class=" h-10 bg-purple-100 rounded-lg flex items-center justify-center mr-3 group-hover:bg-purple-200 transition flex-shrink-0">
                                        <i class="fas fa-exchange-alt text-purple-600"></i>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-sm text-gray-800 group-hover:text-purple-600 transition">Reservas</h3>
                                        <p class="text-xs text-gray-500">Gestionar Reservas</p>
                                    </div>
                                </a>

                                <!-- boletos -->
                                <a href="{{ route('boletos.index') }}" 
                                    class="flex items-center p-3 rounded-lg hover:bg-green-50 transition group">
                                    <div style="width: 40px;" class=" h-10 bg-green-100 rounded-lg flex items-center justify-center mr-3 group-hover:bg-green-200 transition flex-shrink-0">
                                    <i class="fas fa-ticket-alt text-green-600"></i> 
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-sm text-gray-800 group-hover:text-green-600 transition">Boletos</h3>
                                        <p class="text-xs text-gray-500">Gestionar Boletos</p>
                                    </div>
                                </a>

                                <!-- Equipaje -->
                                <a href="{{ route('equipajes.index') }}" 
                                    class="flex items-center p-3 rounded-lg hover:bg-orange-50 transition group">
                                    <div style="width: 40px;" class=" h-10 bg-orange-100 rounded-lg flex items-center justify-center mr-3 group-hover:bg-orange-200 transition flex-shrink-0">
                                    <i class="fas fa-suitcase text-green-600"></i> 
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-sm text-gray-800 group-hover:text-orange-600 transition">Equipaje</h3>
                                        <p class="text-xs text-gray-500">Gestionar Equipaje</p>
                                    </div>
                                </a>

                                <!-- Historila de vuelos -->
                                <a href="{{ route('historial_vuelos.index') }}" 
                                    class="flex items-center p-3 rounded-lg hover:bg-indigo-50 transition group">
                                    <div style="width: 40px;" class=" h-10 bg-indigo-100 rounded-lg flex items-center justify-center mr-3 group-hover:bg-indigo-200 transition flex-shrink-0">
                                        <i class="fas fa-building text-indigo-600"></i>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-sm text-gray-800 group-hover:text-indigo-600 transition">Historia de Vuelos</h3>
                                        <p class="text-xs text-gray-500">Gestionar Historia de Vuelos</p>
                                    </div>
                                </a>
                            
                            </div>
                        </div>
                    </div>

                    <div x-data="{ open: false }" class="relative" style="padding-top: 1.25rem; padding-bottom: 0.5rem; margin-left: 1rem;">
                        <button
                            @click="open = !open"
                            @click.away="open = false"
                            class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out"
                            :class="{ 'border-gray-300 text-gray-700': open }">
                            {{ __('Administrativao / Financiero') }}
                            <svg class="ml-2 h-4 w-4 transition-transform duration-200" :class="{ 'rotate-180': open }"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>

                        <!-- Dropdown Menu con scroll -->
                        <div x-show="open"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 transform scale-95"
                            x-transition:enter-end="opacity-100 transform scale-100"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 transform scale-100"
                            x-transition:leave-end="opacity-0 transform scale-95"
                            class="absolute left-0 mt-2 w-80 bg-white rounded-lg shadow-xl border border-gray-200 z-50 max-h-24 overflow-y-scroll dropdown-scroll"
                            style="display: none;">
                            
                            <div class="p-3 space-y-2 max-h-90 overflow-y-auto scroll-custom">
                                <!-- Vuelos -->
                                <a href="{{ route('facturas.index') }}" 
                                    class="flex items-center p-3 rounded-lg hover:bg-blue-50 transition group">
                                    <div style="width: 40px;" class=" h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3 group-hover:bg-blue-200 transition flex-shrink-0">
                                        <i class="fas fa-file-invoice text-green-600"></i>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-sm text-gray-800 group-hover:text-blue-600 transition">Facturas</h3>
                                        <p class="text-xs text-gray-500">Gestionar y Administrar Facturas</p>
                                    </div>
                                </a>

                                <!-- Escalas -->
                                <a href="{{ route('pagos.index') }}" 
                                    class="flex items-center p-3 rounded-lg hover:bg-purple-50 transition group">
                                    <div style="width: 40px;" class="h-10 bg-purple-100 rounded-lg flex items-center justify-center mr-3 group-hover:bg-purple-200 transition flex-shrink-0">
                                        <i class="fas fa-credit-card text-green-600"></i> 
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-sm text-gray-800 group-hover:text-purple-600 transition">Pagos</h3>
                                        <p class="text-xs text-gray-500">Gestionar y administrar Pagos</p>
                                    </div>
                                </a>

                            
                            </div>
                        </div>
                    </div>

                    <div x-data="{ open: false }" class="relative" style="padding-top: 1.25rem; padding-bottom: 0.5rem; margin-left: 1rem;">
                        <button
                            @click="open = !open"
                            @click.away="open = false"
                            class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out"
                            :class="{ 'border-gray-300 text-gray-700': open }">
                            {{ __('Personal / Mantenimiento') }}
                            <svg class="ml-2 h-4 w-4 transition-transform duration-200" :class="{ 'rotate-180': open }"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>

                        <!-- Dropdown Menu con scroll -->
                        <div x-show="open"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 transform scale-95"
                            x-transition:enter-end="opacity-100 transform scale-100"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 transform scale-100"
                            x-transition:leave-end="opacity-0 transform scale-95"
                            class="absolute left-0 mt-2 w-80 bg-white rounded-lg shadow-xl border border-gray-200 z-50 max-h-24 overflow-y-scroll dropdown-scroll"
                            style="display: none;">
                            
                            <div class="p-3 space-y-2 max-h-90 overflow-y-auto scroll-custom">
                                <!-- Vuelos -->
                                <a href="{{ route('personal.listar') }}" 
                                    class="flex items-center p-3 rounded-lg hover:bg-blue-50 transition group">
                                    <div style="width: 40px;" class=" h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3 group-hover:bg-blue-200 transition flex-shrink-0">
                                        <i class="fas fa-user-cog text-green-600"></i> 
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-sm text-gray-800 group-hover:text-blue-600 transition">Personal</h3>
                                        <p class="text-xs text-gray-500">Gestionar y Administrar Personal</p>
                                    </div>
                                </a>

                                <!-- Escalas -->
                                <a href="{{ route('mantenimiento.listar') }}" 
                                    class="flex items-center p-3 rounded-lg hover:bg-purple-50 transition group">
                                    <div  style="width: 40px;" class=" h-10 bg-purple-100 rounded-lg flex items-center justify-center mr-3 group-hover:bg-purple-200 transition flex-shrink-0">
                                        <i class="fas fa-wrench text-green-600"></i> 
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-sm text-gray-800 group-hover:text-purple-600 transition">Mantenimiento</h3>
                                        <p class="text-xs text-gray-500">Gestionar y administrar Mantenimiento</p>
                                    </div>
                                </a>

                            
                            </div>
                        </div>
                    </div>

                    <div x-data="{ open: false }" class="relative" style="padding-top: 1.25rem; padding-bottom: 0.5rem; margin-left: 1rem;">
                        <button
                            @click="open = !open"
                            @click.away="open = false"
                            class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out"
                            :class="{ 'border-gray-300 text-gray-700': open }">
                            {{ __('Servicios') }}
                            <svg class="ml-2 h-4 w-4 transition-transform duration-200" :class="{ 'rotate-180': open }"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>

                        <!-- Dropdown Menu con scroll -->
                        <div x-show="open"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 transform scale-95"
                            x-transition:enter-end="opacity-100 transform scale-100"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 transform scale-100"
                            x-transition:leave-end="opacity-0 transform scale-95"
                            class="absolute left-0 mt-2 w-80 bg-white rounded-lg shadow-xl border border-gray-200 z-50 max-h-24 overflow-y-scroll dropdown-scroll"
                            style="display: none;">
                            
                            <div class="p-3 space-y-2 max-h-90 overflow-y-auto scroll-custom">
                                <!-- Vuelos -->
                                <a href="{{ route('servicios.index') }}" 
                                    class="flex items-center p-3 rounded-lg hover:bg-blue-50 transition group">
                                    <div style="width: 40px;" class=" h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3 group-hover:bg-blue-200 transition flex-shrink-0">
                                    <i class="fas fa-star text-green-600"></i>  
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-sm text-gray-800 group-hover:text-blue-600 transition">Servicios</h3>
                                        <p class="text-xs text-gray-500">Gestionar y Administrar Servicios</p>
                                    </div>
                                </a>

                            
                            </div>
                        </div>
                    </div>

                    <div x-data="{ open: false }" class="relative" style="padding-top: 1.25rem; padding-bottom: 0.5rem; margin-left: 1rem;">
                        <button
                            @click="open = !open"
                            @click.away="open = false"
                            class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out"
                            :class="{ 'border-gray-300 text-gray-700': open }">
                            {{ __('Reportes') }}
                            <svg class="ml-2 h-4 w-4 transition-transform duration-200" :class="{ 'rotate-180': open }"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>

                        <!-- Dropdown Menu con scroll -->
                        <div x-show="open"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 transform scale-95"
                            x-transition:enter-end="opacity-100 transform scale-100"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 transform scale-100"
                            x-transition:leave-end="opacity-0 transform scale-95"
                            class="absolute left-0 mt-2 w-80 bg-white rounded-lg shadow-xl border border-gray-200 z-50 max-h-24 overflow-y-scroll dropdown-scroll"
                            style="display: none;">
                            
                            <div class="p-3 space-y-2 max-h-90 overflow-y-auto scroll-custom">
                                <!-- Reportes -->
                                <a href="{{ route('reportes.disponibilidad-boletos') }}" 
                                    class="flex items-center p-3 rounded-lg hover:bg-blue-50 transition group">
                                    <div style="width: 40px;" class=" h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3 group-hover:bg-blue-200 transition flex-shrink-0">
                                    <i class="fas fa-ticket-alt text-blue-600"></i> 
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-sm text-gray-800 group-hover:text-blue-600 transition">Disponibilidad de boletos</h3>
                                        <p class="text-xs text-gray-500">Gestionar y Administrar Servicios</p>
                                    </div>
                                </a>
                                <a href="{{ route('reportes.boletos-facturados') }}" 
                                    class="flex items-center p-3 rounded-lg hover:bg-blue-50 transition group">
                                    <div style="width: 40px;" class=" h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3 group-hover:bg-blue-200 transition flex-shrink-0">
                                   <i class="fas fa-check-circle text-green-600"></i>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-sm text-gray-800 group-hover:text-blue-600 transition">Boletos Facturados</h3>
                                        <p class="text-xs text-gray-500">Gestionar y Administrar Servicios</p>
                                    </div>
                                </a>

                            
                            </div>
                        </div>
                    </div>
                 
                  
                  @elseif(in_array(auth()->user()->role, ['cliente', 'operador']))
                        
                        <!-- Botón que abre el modal -->
                        <button
                            @click="window.dispatchEvent(new CustomEvent('reservas-modal'))"
                            class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                            {{ __('Mis Reservas') }}
                        </button>

                        <!-- Botón que abre el modal de boletos -->
                        <button
                            @click="window.dispatchEvent(new CustomEvent('boletos-modal'))"
                            class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                            {{ __('Mis Boletos') }}
                        </button>

                        
                        <button
                            @click="window.dispatchEvent(new CustomEvent('facturas-modal'))"
                            class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                            {{ __('Mis Facturas') }}
                        </button>

                        <!-- Botón que abre el modal de pagos -->
                        <button
                            @click="window.dispatchEvent(new CustomEvent('pagos-modal'))"
                            class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                            {{ __('Mis Pagos') }}
                        </button>
                    @endif
                </div>
            </div>

            <!-- Settings Dropdown -->
            <style>
    /* Estilo para el botón de usuario (similar a un botón de Material) */
    .material-user-btn {
        display: inline-flex;
        align-items: center;
        padding: 8px 12px;
        border-radius: 20px; /* Forma de píldora para un look moderno */
        font-size: 0.95rem;
        font-weight: 500;
        color: #424242; /* Gris oscuro */
        background-color: #f5f5f5; /* Gris muy claro, casi blanco */
        border: 1px solid #e0e0e0; /* Borde sutil */
        transition: background-color 0.2s, box-shadow 0.2s;
    }
    .material-user-btn:hover {
        background-color: #e0e0e0;
        color: #212121;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }
    .material-user-btn:focus {
        outline: none;
        box-shadow: 0 0 0 3px rgba(33, 150, 243, 0.3); /* Azul de enfoque */
    }

    /* Estilo para el contenido del Dropdown (simulando una Material Card) */
    .material-dropdown-content {
        background-color: white;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        padding: 8px 0;
    }
    /* Estilo para los ítems del Dropdown */
    .material-dropdown-item {
        display: flex;
        align-items: center;
        padding: 10px 16px;
        font-size: 0.9rem;
        color: #424242;
        transition: background-color 0.15s;
    }
    .material-dropdown-item:hover {
        background-color: #e3f2fd; /* Azul muy claro */
        color: #1976D2; /* Azul Material */
    }
</style>

<div class="hidden sm:flex sm:items-center sm:ms-6">
    <x-dropdown align="right" width="48" class="material-dropdown-content-wrapper">
        <x-slot name="trigger">
            {{-- Botón de usuario con estilo Material --}}
            <button class="material-user-btn">
                {{-- Icono de Usuario (opcional, si es una imagen de perfil, se mantendría) --}}
                <i class="material-icons text-lg" style="margin-right: 6px; color: #757575;">account_circle</i>
                <div>{{ Auth::user()->name }}</div>

                {{-- Flecha desplegable (ajustada para un look más limpio) --}}
                <div class="ms-1">
                    <svg class="fill-current h-4 w-4 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </div>
            </button>
        </x-slot>

        {{-- Contenido del Dropdown (Se asume que x-slot name="content" envuelve el contenido) --}}
        <x-slot name="content">
            <div class="material-dropdown-content">
                {{-- 1. Opción Perfil --}}
                <x-dropdown-link :href="route('profile.edit')" class="material-dropdown-item">
                    <i class="material-icons" style="font-size: 18px; margin-right: 12px;">person</i>
                    {{ __('Profile') }}
                </x-dropdown-link>

                <div class="border-t border-gray-100 my-1"></div>

                {{-- 2. Opción Cerrar Sesión --}}
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-dropdown-link :href="route('logout')"
                        class="material-dropdown-item text-red-600 hover:bg-red-50 hover:text-red-700"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        <i class="material-icons" style="font-size: 18px; margin-right: 12px;">logout</i>
                        {{ __('Log Out') }}
                    </x-dropdown-link>
                </form>
            </div>
        </x-slot>
    </x-dropdown>
</div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</nav>

<style>
    .dropdown-scroll::-webkit-scrollbar {
    width: 6px;
}

.dropdown-scroll::-webkit-scrollbar-track {
    background: #f1f5f9;
    border-radius: 3px;
}

.dropdown-scroll::-webkit-scrollbar-thumb {
    background: #94a3b8;
    border-radius: 3px;
}

.dropdown-scroll::-webkit-scrollbar-thumb:hover {
    background: #64748b;
}
.modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    z-index: 50;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: rgba(17, 24, 39, 0.5);
    overflow-y: auto;
    padding: 1rem;
}
/* Scroll delgado y con color */
  .scroll-custom::-webkit-scrollbar {
      width: 6px;
  }
  .scroll-custom::-webkit-scrollbar-thumb {
      background-color: #cbd5e0; /* gris suave */
      border-radius: 10px;
  }
  .scroll-custom::-webkit-scrollbar-thumb:hover {
      background-color: #a0aec0;
  }
.modal-content {
    background-color: white;
    border-radius: 0.5rem;
    width: 100%;
    max-width: 56rem;
    padding: 1.5rem;
    display: flex;
    flex-direction: column;
    max-height: 90vh;
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
}

.modal-scrollable {
    max-height: 60vh;
    overflow-y: auto;
    padding-right: 0.5rem;
}

.modal-scrollable::-webkit-scrollbar {
    width: 8px;
}

.modal-scrollable::-webkit-scrollbar-track {
    background: #555b61ff;
    border-radius: 4px;
}

.modal-scrollable::-webkit-scrollbar-thumb {
    background: #94a3b8;
    border-radius: 4px;
}

.modal-scrollable::-webkit-scrollbar-thumb:hover {
    background: #64748b;
}

    /* Estilos base del modal overlay */
    .material-modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.6); /* Fondo semi-transparente oscuro */
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 50; /* Z-index alto para estar encima de todo */
    }

    /* Estilos del contenido del modal (similar a una Material Card) */
    .material-modal-content {
        background-color: #ffffff;
        border-radius: 8px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        width: 90%;
        max-width: 650px; /* Ancho máximo estándar para modales de detalle */
        padding: 30px;
        display: flex;
        flex-direction: column;
        max-height: 90vh; /* Altura máxima para permitir scroll */
        position: relative;
    }

    /* Estilos de botones Material (para consistencia) */
    .material-btn-pdf {
        background-color: #039BE5; /* Light Blue 600 */
        color: white;
        padding: 6px 12px;
        font-size: 0.9rem;
        border-radius: 4px;
        transition: background-color 0.2s;
    }
    .material-btn-pdf:hover {
        background-color: #0277BD; /* Light Blue 800 */
    }
    .material-btn-secondary {
        background-color: #e0e0e0;
        color: #424242;
        padding: 8px 16px;
        border-radius: 4px;
        transition: background-color 0.2s;
    }
    .material-btn-secondary:hover {
        background-color: #bdbdbd;
    }

    /* Colores del estado */
    .status-pagada { background-color: #A5D6A7; color: #1B5E20; font-weight: 600; } /* Verde claro */
    .status-pendiente { background-color: #FFF59D; color: #F57F17; font-weight: 600; } /* Amarillo claro */
    .status-cancelada { background-color: #FFCDD2; color: #B71C1C; font-weight: 600; } /* Rojo claro */
/* Estilos base del modal overlay (Reutilizando el estilo del modal de Facturas) */
    .material-modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.6);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 50;
    }

    /* Estilos del contenido del modal (similar a una Material Card) */
    .material-modal-content {
        background-color: #ffffff;
        border-radius: 8px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        width: 90%;
        max-width: 650px;
        padding: 30px;
        display: flex;
        flex-direction: column;
        max-height: 90vh;
        position: relative;
    }

    /* Estilos de botones Material (para consistencia) */
    .material-btn-pdf {
        background-color: #039BE5; /* Light Blue 600 */
        color: white;
        padding: 6px 12px;
        font-size: 0.9rem;
        border-radius: 4px;
        transition: background-color 0.2s;
    }
    .material-btn-pdf:hover {
        background-color: #0277BD; /* Light Blue 800 */
    }
    .material-btn-secondary {
        background-color: #e0e0e0;
        color: #424242;
        padding: 8px 16px;
        border-radius: 4px;
        transition: background-color 0.2s;
    }
    .material-btn-secondary:hover {
        background-color: #bdbdbd;
    }

    /* Scrollbar personalizado para el contenido del modal */
    #boletos-content::-webkit-scrollbar {
        width: 8px;
        height: 8px;
    }
    #boletos-content::-webkit-scrollbar-thumb {
        background-color: #9ca3af;
        border-radius: 4px;
    }
    #boletos-content::-webkit-scrollbar-track {
        background-color: #f3f4f6;
    }
    /* Estilos base del modal overlay (Reutilizando el estilo del modal de Facturas) */
    .material-modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.6);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 50;
    }

    /* Estilos del contenido del modal (similar a una Material Card) */
    .material-modal-content {
        background-color: #ffffff;
        border-radius: 8px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        width: 90%;
        max-width: 650px;
        padding: 30px;
        display: flex;
        flex-direction: column;
        max-height: 90vh;
        position: relative;
    }

    /* Estilos de botones Material (para consistencia) */
    .material-btn-pdf {
        background-color: #039BE5; /* Light Blue 600 */
        color: white;
        padding: 6px 12px;
        font-size: 0.9rem;
        border-radius: 4px;
        transition: background-color 0.2s;
    }
    .material-btn-pdf:hover {
        background-color: #0277BD; /* Light Blue 800 */
    }
    .material-btn-secondary {
        background-color: #e0e0e0;
        color: #424242;
        padding: 8px 16px;
        border-radius: 4px;
        transition: background-color 0.2s;
    }
    .material-btn-secondary:hover {
        background-color: #bdbdbd;
    }

    /* Colores del estado de Reserva */
    .status-confirmada { background-color: #A5D6A7; color: #1B5E20; font-weight: 600; } /* Verde claro */
    .status-pendiente-reserva { background-color: #FFECB3; color: #FF6F00; font-weight: 600; } /* Amarillo-Naranja para Reserva Pendiente */
    .status-cancelada-reserva { background-color: #FFCDD2; color: #B71C1C; font-weight: 600; } /* Rojo claro */
    ¡Excelente! Finalmente, modernizaremos el Modal de Pagos para el cliente.

Seguiremos la misma convención Material Design y usaremos el color Morado (Deep Purple, #512DA8) para la sección de pagos y transacciones, simbolizando seguridad y finanzas.

Incluiremos las funciones de formato de moneda y fecha para una presentación de datos clara y profesional.

💳 Historial de Pagos Modernizado (Alpine.js + Tailwind + CSS de Soporte)
Blade

<style>
    /* Estilos base del modal overlay (Reutilizando el estilo del modal de Facturas/Boletos) */
    .material-modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.6);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 50;
    }

    /* Estilos del contenido del modal (similar a una Material Card) */
    .material-modal-content {
        background-color: #ffffff;
        border-radius: 8px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        width: 90%;
        max-width: 650px;
        padding: 30px;
        display: flex;
        flex-direction: column;
        max-height: 90vh;
        position: relative;
    }

    /* Estilos de botones Material (para consistencia) */
    .material-btn-secondary {
        background-color: #e0e0e0;
        color: #424242;
        padding: 8px 16px;
        border-radius: 4px;
        transition: background-color 0.2s;
    }
    .material-btn-secondary:hover {
        background-color: #bdbdbd;
    }

    /* Colores del estado de Pago */
    .status-completado { background-color: #A5D6A7; color: #1B5E20; font-weight: 600; } /* Verde para Completado */
    .status-pendiente-pago { background-color: #FFECB3; color: #FF6F00; font-weight: 600; } /* Amarillo-Naranja para Pendiente */
    .status-fallido { background-color: #FFCDD2; color: #B71C1C; font-weight: 600; } /* Rojo para Fallido */
</style>


<!-- ✅ Modal de Módulo de Operaciones / Vuelos CON SCROLL -->
<div
    x-data="{ open: false }"
    x-on:operaciones-modal.window="open = true"
    x-show="open"
    x-transition
    class="modal-overlay"
    style="display: none;"
>
    <div @click.away="open = false" class="modal-content" style="max-width: 500px;">
        <h2 class="text-xl font-semibold mb-4 flex items-center">
            <i class="fas fa-plane-departure mr-3 text-blue-600"></i>
            Módulo de Operaciones / Vuelos
        </h2>
        <p class="text-gray-600 mb-6">Selecciona una opción para acceder a la gestión correspondiente.</p>

        <!-- Contenedor con scroll -->
        <div class="modal-scrollable">
            <div class="space-y-3">
                <!-- Vuelos -->
                <a href="{{ route('vuelos.index') }}" 
                   class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-blue-50 hover:border-blue-300 transition group">
                    <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-4 group-hover:bg-blue-200 transition">
                        <i class="fas fa-plane text-blue-600"></i>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-800 group-hover:text-blue-600 transition">Vuelos</h3>
                        <p class="text-sm text-gray-500">Gestionar vuelos disponibles</p>
                    </div>
                </a>

                <!-- Escalas -->
                <a href="{{ route('escala.index') }}" 
                   class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-purple-50 hover:border-purple-300 transition group">
                    <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center mr-4 group-hover:bg-purple-200 transition">
                        <i class="fas fa-exchange-alt text-purple-600"></i>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-800 group-hover:text-purple-600 transition">Escalas</h3>
                        <p class="text-sm text-gray-500">Administrar escalas de vuelos</p>
                    </div>
                </a>

                <!-- Horarios -->
                <a href="{{ route('horario.listar') }}" 
                   class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-green-50 hover:border-green-300 transition group">
                    <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-4 group-hover:bg-green-200 transition">
                        <i class="fas fa-clock text-green-600"></i>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-800 group-hover:text-green-600 transition">Horarios</h3>
                        <p class="text-sm text-gray-500">Configurar horarios de vuelos</p>
                    </div>
                </a>

                <!-- Aviones -->
                <a href="{{ route('avion.listar') }}" 
                   class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-orange-50 hover:border-orange-300 transition group">
                    <div class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center mr-4 group-hover:bg-orange-200 transition">
                        <i class="fas fa-plane-departure text-orange-600"></i>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-800 group-hover:text-orange-600 transition">Aviones</h3>
                        <p class="text-sm text-gray-500">Gestionar flota de aviones</p>
                    </div>
                </a>

                <!-- Aeropuertos -->
                <a href="{{ route('aeropuertos.index') }}" 
                   class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-indigo-50 hover:border-indigo-300 transition group">
                    <div class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center mr-4 group-hover:bg-indigo-200 transition">
                        <i class="fas fa-building text-indigo-600"></i>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-800 group-hover:text-indigo-600 transition">Aeropuertos</h3>
                        <p class="text-sm text-gray-500">Administrar aeropuertos</p>
                    </div>
                </a>

                <!-- Aerolíneas -->
                <a href="{{ route('aerolineas.index') }}" 
                   class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-red-50 hover:border-red-300 transition group">
                    <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center mr-4 group-hover:bg-red-200 transition">
                        <i class="fas fa-globe text-red-600"></i>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-800 group-hover:text-red-600 transition">Aerolíneas</h3>
                        <p class="text-sm text-gray-500">Gestionar aerolíneas</p>
                    </div>
                </a>

                <!-- Asientos -->
                <a href="{{ route('asientos.index') }}" 
                   class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-yellow-50 hover:border-yellow-300 transition group">
                    <div class="w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center mr-4 group-hover:bg-yellow-200 transition">
                        <i class="fas fa-chair text-yellow-600"></i>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-800 group-hover:text-yellow-600 transition">Asientos</h3>
                        <p class="text-sm text-gray-500">Configurar asientos de aviones</p>
                    </div>
                </a>
            </div>
        </div>

        <div class="mt-6 flex justify-end">
            <button @click="open = false"
                class="px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300 transition">
                Cerrar
            </button>
        </div>
    </div>
</div>

<!-- ✅ Modal de Reservas con scroll interno -->
<div
    x-data="{
        open: false,
        reservas: [],
        loading: false,
        error: null,
        loadReservas() {
            this.loading = true;
            this.error = null;
            fetch('/cliente/reservas')
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Error al obtener datos');
                    }
                    return response.json();
                })
                .then(data => {
                    this.reservas = data;
                    this.loading = false;
                })
                .catch(error => {
                    this.error = '⚠️ Error al cargar tus reservas. Inténtelo de nuevo.';
                    this.loading = false;
                    console.error('Error:', error);
                });
        },
        formatCurrency(amount) {
            return new Intl.NumberFormat('es-GT', { 
                style: 'currency', 
                currency: 'USD',
                minimumFractionDigits: 2
            }).format(amount);
        },
        formatDate(dateString, includeTime = false) {
            if (!dateString) return 'N/A';
            const options = { 
                year: 'numeric', 
                month: 'short', 
                day: 'numeric' 
            };
            if (includeTime) {
                 options.hour = '2-digit';
                 options.minute = '2-digit';
            }
            return new Date(dateString).toLocaleDateString('es-ES', options);
        }
    }"
    x-on:reservas-modal.window="open = true; loadReservas()"
    x-show="open"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 scale-90"
    x-transition:enter-end="opacity-100 scale-100"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100 scale-100"
    x-transition:leave-end="opacity-0 scale-90"
    class="material-modal-overlay"
    style="display: none;"
>
    <div
        @click.away="open = false"
        class="material-modal-content"
    >
        <h2 class="text-2xl font-bold mb-2 text-gray-800 flex items-center">
            <i class="material-icons" style="font-size: 28px; margin-right: 12px; color: #FFB300;">event_note</i>
            Mis Reservas Activas
        </h2>
        <p class="text-gray-600 mb-6 border-b pb-4">Detalle de las reservas pendientes de emisión de boleto o próximas a su fecha de viaje.</p>

        <div
            id="reservas-content"
            class="space-y-4 flex-1 pr-2 overflow-y-auto"
            style="max-height: 60vh;"
        >
            <div x-show="loading" class="text-center py-10">
                <div class="spinner-border animate-spin inline-block w-10 h-10 border-4 rounded-full" style="border-color: #FFB300; border-right-color: transparent;"></div>
                <p class="mt-3 text-yellow-600 font-semibold">Cargando reservas...</p>
            </div>

            <div x-show="error" class="text-center py-10 bg-red-50 rounded-lg border border-red-200">
                <i class="material-icons text-red-600 text-4xl mb-2">error_outline</i>
                <p class="text-red-600 font-semibold" x-text="error"></p>
            </div>

            <div x-show="!loading && !error" class="space-y-4">
                <template x-if="reservas.length === 0">
                    <div class="text-center text-gray-500 py-10 bg-gray-50 rounded-lg border border-gray-200">
                        <i class="material-icons text-gray-400 text-4xl mb-2">calendar_today</i>
                        <p>No tienes **reservas** activas en este momento.</p>
                    </div>
                </template>

                <template x-for="reserva in reservas" :key="reserva.idReserva">
                    <div class="border border-gray-200 rounded-lg p-4 hover:bg-yellow-50 transition duration-150">
                        <div class="flex justify-between items-start">
                            <div class="flex-1 min-w-0">
                                <h3 class="font-bold text-xl text-gray-900 mb-2 flex items-center">
                                    <i class="material-icons" style="font-size: 20px; margin-right: 8px; color: #FFB300;">bookmark</i>
                                    Reserva #<span x-text="reserva.idReserva"></span>
                                </h3>
                                
                                {{-- Información de la ruta --}}
                                <p class="text-sm font-semibold text-gray-700 mt-2">
                                    <i class="material-icons" style="font-size: 14px; vertical-align: middle; margin-right: 4px; color: #303F9F;">near_me</i>
                                    <span x-text="reserva.aeropuerto_origen || 'N/A'"></span> 
                                    <i class="material-icons" style="font-size: 14px; vertical-align: middle; color: #6c757d;">trending_flat</i>
                                    <span x-text="reserva.aeropuerto_destino || 'N/A'"></span>
                                </p>

                                {{-- Fechas y Vuelo --}}
                                <p class="text-xs text-gray-600 mt-1">
                                    <i class="material-icons" style="font-size: 12px; vertical-align: middle; margin-right: 4px;">calendar_month</i>
                                    Vuelo: **<span x-text="reserva.IdVuelo || reserva.idVuelo"></span>** | Fecha de Vuelo: <span x-text="formatDate(reserva.FechaSalida)"></span>
                                </p>
                                <p class="text-xs text-gray-600">
                                    <i class="material-icons" style="font-size: 12px; vertical-align: middle; margin-right: 4px;">schedule</i>
                                    Reservada el: <span x-text="formatDate(reserva.FechaReserva)"></span>
                                </p>
                                
                                {{-- Monto Anticipado / Pagado --}}
                                <div class="mt-3 pt-3 border-t border-dashed border-gray-200">
                                    <p class="text-base font-bold text-gray-900">
                                        Anticipo: <span x-text="formatCurrency(reserva.MontoAnticipado)"></span>
                                    </p>
                                </div>
                            </div>
                            
                            <div class="text-right">
                                <span 
                                    class="inline-block px-3 py-1 text-xs rounded-full shadow-sm"
                                    :class="{
                                        'status-confirmada': reserva.Estado === 'Confirmada',
                                        'status-pendiente-reserva': reserva.Estado === 'Pendiente' || reserva.Estado === 'Reservada',
                                        'status-cancelada-reserva': reserva.Estado === 'Cancelada'
                                    }"
                                >
                                    <span x-text="reserva.Estado || 'N/A'"></span>
                                </span>
                                <br>
                                <a 
                                    :href="`/reservas/${reserva.idReserva}/pdf`" 
                                    target="_blank" 
                                    class="material-btn material-btn-pdf flex items-center mt-2"
                                >
                                    <i class="material-icons" style="font-size: 18px; margin-right: 6px;">picture_as_pdf</i>
                                    Descargar
                                </a>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </div>

        <div class="mt-6 pt-4 border-t border-gray-100 flex justify-end">
            <button
                @click="open = false"
                class="material-btn material-btn-secondary"
            >
                Cerrar
            </button>
        </div>
    </div>
</div>

<!-- ✅ Modal de Boletos con scroll interno -->
<div
    x-data="{
        open: false,
        boletos: [],
        loading: false,
        error: null,
        loadBoletos() {
            this.loading = true;
            this.error = null;
            fetch('/cliente/boletos')
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Error al obtener datos');
                    }
                    return response.json();
                })
                .then(data => {
                    this.boletos = data;
                    this.loading = false;
                })
                .catch(error => {
                    this.error = '⚠️ Error al cargar tus boletos. Inténtelo de nuevo.';
                    this.loading = false;
                    console.error('Error:', error);
                });
        },
        formatCurrency(amount) {
            return new Intl.NumberFormat('es-GT', { 
                style: 'currency', 
                currency: 'USD',
                minimumFractionDigits: 2
            }).format(amount);
        },
        formatDate(dateString, includeTime = false) {
            if (!dateString) return 'N/A';
            const options = { 
                year: 'numeric', 
                month: 'short', 
                day: 'numeric' 
            };
            if (includeTime) {
                 options.hour = '2-digit';
                 options.minute = '2-digit';
            }
            return new Date(dateString).toLocaleDateString('es-ES', options);
        }
    }"
    x-on:boletos-modal.window="open = true; loadBoletos()"
    x-show="open"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 scale-90"
    x-transition:enter-end="opacity-100 scale-100"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100 scale-100"
    x-transition:leave-end="opacity-0 scale-90"
    class="material-modal-overlay"
    style="display: none;"
>
    <div
        @click.away="open = false"
        class="material-modal-content"
    >
        <h2 class="text-2xl font-bold mb-2 text-gray-800 flex items-center">
            <i class="material-icons" style="font-size: 28px; margin-right: 12px; color: #4CAF50;">flight_takeoff</i>
            Mis Boletos de Viaje
        </h2>
        <p class="text-gray-600 mb-6 border-b pb-4">Revisa la información de tus boletos y descárgalos en PDF.</p>

        <div
            id="boletos-content"
            class="space-y-4 flex-1 pr-2 overflow-y-auto"
            style="max-height: 60vh;"
        >
            <div x-show="loading" class="text-center py-10">
                <div class="spinner-border animate-spin inline-block w-10 h-10 border-4 rounded-full" style="border-color: #4CAF50; border-right-color: transparent;"></div>
                <p class="mt-3 text-green-600 font-semibold">Cargando boletos...</p>
            </div>

            <div x-show="error" class="text-center py-10 bg-red-50 rounded-lg border border-red-200">
                <i class="material-icons text-red-600 text-4xl mb-2">error_outline</i>
                <p class="text-red-600 font-semibold" x-text="error"></p>
            </div>

            <div x-show="!loading && !error" class="space-y-4">
                <template x-if="boletos.length === 0">
                    <div class="text-center text-gray-500 py-10 bg-gray-50 rounded-lg border border-gray-200">
                        <i class="material-icons text-gray-400 text-4xl mb-2">flight</i>
                        <p>No tienes **boletos** registrados para mostrar.</p>
                    </div>
                </template>

                <template x-for="boleto in boletos" :key="boleto.idBoleto">
                    <div class="border border-gray-200 rounded-lg p-4 hover:bg-green-50 transition duration-150">
                        <div class="flex justify-between items-start">
                            <div class="flex-1 min-w-0">
                                <h3 class="font-bold text-xl text-gray-900 mb-2 flex items-center">
                                    <i class="material-icons" style="font-size: 20px; margin-right: 8px; color: #4CAF50;">confirmation_number</i>
                                    Boleto #<span x-text="boleto.idBoleto"></span>
                                </h3>
                                
                                {{-- Información de la ruta --}}
                                <p class="text-sm font-semibold text-gray-700 mt-2">
                                    <i class="material-icons" style="font-size: 14px; vertical-align: middle; margin-right: 4px; color: #303F9F;">near_me</i>
                                    <span x-text="boleto.aeropuerto_origen || 'N/A'"></span> 
                                    <i class="material-icons" style="font-size: 14px; vertical-align: middle; color: #6c757d;">trending_flat</i>
                                    <span x-text="boleto.aeropuerto_destino || 'N/A'"></span>
                                </p>

                                {{-- Fechas y Pasajero --}}
                                <p class="text-xs text-gray-600 mt-1">
                                    <i class="material-icons" style="font-size: 12px; vertical-align: middle; margin-right: 4px;">event</i>
                                    Salida: <span x-text="formatDate(boleto.FechaSalida, true)"></span> | Vuelo: **<span x-text="boleto.IdVuelo || boleto.idVuelo"></span>**
                                </p>
                                <p class="text-xs text-gray-600">
                                    <i class="material-icons" style="font-size: 12px; vertical-align: middle; margin-right: 4px;">person</i>
                                    Pasajero: <span x-text="boleto.Nombre + ' ' + boleto.Apellido"></span>
                                </p>
                                
                                {{-- Precios (Usando Total si está disponible) --}}
                                <div class="mt-3 pt-3 border-t border-dashed border-gray-200">
                                    <p class="text-base font-bold text-gray-900">
                                        Total Pagado: <span x-text="formatCurrency(boleto.Total || boleto.Precio)"></span>
                                    </p>
                                    <p class="text-xs text-gray-500">
                                        Precio Unitario: <span x-text="formatCurrency(boleto.Precio)"></span> | Cantidad: <span x-text="boleto.Cantidad || 1"></span>
                                    </p>
                                </div>
                            </div>
                            
                            <div class="text-right">
                                <a
                                    :href="`/boletos/${boleto.idBoleto}/pdf`"
                                    target="_blank"
                                    class="material-btn material-btn-pdf flex items-center mt-2"
                                >
                                    <i class="material-icons" style="font-size: 18px; margin-right: 6px;">picture_as_pdf</i>
                                    Descargar
                                </a>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </div>

        <div class="mt-6 pt-4 border-t border-gray-100 flex justify-end">
            <button
                @click="open = false"
                class="material-btn material-btn-secondary"
            >
                Cerrar
            </button>
        </div>
    </div>
</div>





<div
    x-data="{
        open: false,
        facturas: [],
        loading: false,
        error: null,
        loadFacturas() {
            this.loading = true;
            this.error = null;
            // Usamos la ruta Laravel Helper si es posible, si no mantenemos el fetch literal
            fetch('/cliente/facturas') 
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Error al obtener datos');
                    }
                    return response.json();
                })
                .then(data => {
                    this.facturas = data;
                    this.loading = false;
                })
                .catch(error => {
                    this.error = '⚠️ Error al cargar las facturas. Inténtelo de nuevo.';
                    this.loading = false;
                    console.error('Error:', error);
                });
        },
        // Función para formatear el monto a moneda (si no está disponible en el backend)
        formatCurrency(amount) {
            return new Intl.NumberFormat('es-GT', { 
                style: 'currency', 
                currency: 'USD',
                minimumFractionDigits: 2
            }).format(amount);
        },
        formatDate(dateString) {
            if (!dateString) return 'N/A';
            return new Date(dateString).toLocaleDateString('es-ES', { 
                year: 'numeric', 
                month: 'short', 
                day: 'numeric' 
            });
        }
    }"
    x-on:facturas-modal.window="open = true; loadFacturas()"
    x-show="open"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 scale-90"
    x-transition:enter-end="opacity-100 scale-100"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100 scale-100"
    x-transition:leave-end="opacity-0 scale-90"
    class="material-modal-overlay"
    style="display: none;"
>
    <div
        @click.away="open = false"
        class="material-modal-content"
    >
        <h2 class="text-2xl font-bold mb-2 text-gray-800 flex items-center">
            <i class="material-icons" style="font-size: 28px; margin-right: 12px; color: #2196F3;">credit_card</i>
            Historial de Facturas
        </h2>
        <p class="text-gray-600 mb-6 border-b pb-4">Revisa y descarga todas tus facturas emitidas por tus compras.</p>

        <div
            id="facturas-content"
            class="space-y-4 flex-1 pr-2 overflow-y-auto"
            style="max-height: 60vh;"
        >
            <div x-show="loading" class="text-center py-10">
                <div class="spinner-border animate-spin inline-block w-10 h-10 border-4 rounded-full" style="border-color: #2196F3; border-right-color: transparent;"></div>
                <p class="mt-3 text-blue-600 font-semibold">Cargando facturas...</p>
            </div>

            <div x-show="error" class="text-center py-10 bg-red-50 rounded-lg border border-red-200">
                <i class="material-icons text-red-600 text-4xl mb-2">error_outline</i>
                <p class="text-red-600 font-semibold" x-text="error"></p>
            </div>

            <div x-show="!loading && !error" class="space-y-4">
                <template x-if="facturas.length === 0">
                    <div class="text-center text-gray-500 py-10 bg-gray-50 rounded-lg border border-gray-200">
                        <i class="material-icons text-gray-400 text-4xl mb-2">info_outline</i>
                        <p>No tienes **facturas emitidas** en este momento.</p>
                    </div>
                </template>

                <template x-for="factura in facturas" :key="factura.idFactura">
                    <div class="border border-gray-200 rounded-lg p-4 hover:bg-blue-50 transition duration-150">
                        <div class="flex justify-between items-start">
                            <div class="flex-1 min-w-0">
                                <div class="flex items-baseline mb-2">
                                    <h3 class="font-bold text-xl text-gray-900 mr-3">Factura #<span x-text="factura.idFactura"></span></h3>
                                    <span
                                        class="inline-block px-3 py-1 text-xs rounded-full shadow-sm"
                                        :class="{
                                            'status-pagada': factura.Estado === 'Pagada',
                                            'status-pendiente': factura.Estado === 'Pendiente',
                                            'status-cancelada': factura.Estado !== 'Pagada' && factura.Estado !== 'Pendiente'
                                        }"
                                    >
                                        <span x-text="factura.Estado || 'N/A'"></span>
                                    </span>
                                </div>
                                
                                <p class="text-sm text-gray-700">
                                    <i class="material-icons" style="font-size: 14px; vertical-align: middle; margin-right: 4px;">today</i>
                                    Emisión: <span x-text="formatDate(factura.FechaEmision)"></span>
                                </p>
                                <p class="text-sm text-gray-700 mt-1">
                                    <i class="material-icons" style="font-size: 14px; vertical-align: middle; margin-right: 4px;">person</i>
                                    Pasajero: <span x-text="factura.Nombre + ' ' + factura.Apellido"></span>
                                </p>
                                <p class="text-xs text-gray-500 mt-1">
                                    Boleto: <span x-text="factura.idBoleto || 'N/A'"></span> | Vuelo: <span x-text="factura.IdVuelo || 'N/A'"></span>
                                </p>

                                <div class="mt-3 pt-3 border-t border-dashed border-gray-200">
                                    <p class="text-lg font-bold text-gray-900">
                                        Total: <span x-text="formatCurrency(factura.MontoTotal)"></span>
                                    </p>
                                    <p class="text-xs text-gray-600">
                                        Monto: <span x-text="formatCurrency(factura.monto)"></span> | Impuesto: <span x-text="formatCurrency(factura.impuesto)"></span>
                                    </p>
                                </div>
                            </div>
                            
                            <div class="text-right">
                                <a
                                    :href="`/facturas/${factura.idFactura}/pdf`"
                                    target="_blank"
                                    class="material-btn material-btn-pdf flex items-center mt-2"
                                >
                                    <i class="material-icons" style="font-size: 18px; margin-right: 6px;">picture_as_pdf</i>
                                    PDF
                                </a>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </div>

        <div class="mt-6 pt-4 border-t border-gray-100 flex justify-end">
            <button
                @click="open = false"
                class="material-btn material-btn-secondary"
            >
                Cerrar
            </button>
        </div>
    </div>
</div>
<!-- ✅ Modal de Pagos con scroll interno -->
<div
    x-data="{
        open: false,
        pagos: [],
        loading: false,
        error: null,
        loadPagos() {
            this.loading = true;
            this.error = null;
            fetch('/cliente/pagos')
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Error al obtener datos');
                    }
                    return response.json();
                })
                .then(data => {
                    this.pagos = data;
                    this.loading = false;
                })
                .catch(error => {
                    this.error = '⚠️ Error al cargar tu historial de pagos. Inténtelo de nuevo.';
                    this.loading = false;
                    console.error('Error:', error);
                });
        },
        formatCurrency(amount) {
            return new Intl.NumberFormat('es-GT', { 
                style: 'currency', 
                currency: 'USD',
                minimumFractionDigits: 2
            }).format(amount);
        },
        formatDate(dateString) {
            if (!dateString) return 'N/A';
            return new Date(dateString).toLocaleDateString('es-ES', { 
                year: 'numeric', 
                month: 'short', 
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            });
        }
    }"
    x-on:pagos-modal.window="open = true; loadPagos()"
    x-show="open"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 scale-90"
    x-transition:enter-end="opacity-100 scale-100"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100 scale-100"
    x-transition:leave-end="opacity-0 scale-90"
    class="material-modal-overlay"
    style="display: none;"
>
    <div
        @click.away="open = false"
        class="material-modal-content"
    >
        <h2 class="text-2xl font-bold mb-2 text-gray-800 flex items-center">
            <i class="material-icons" style="font-size: 28px; margin-right: 12px; color: #512DA8;">account_balance_wallet</i>
            Historial de Transacciones
        </h2>
        <p class="text-gray-600 mb-6 border-b pb-4">Detalle de todos los pagos realizados para boletos y reservas.</p>

        <div
            id="pagos-content"
            class="space-y-4 flex-1 pr-2 overflow-y-auto"
            style="max-height: 60vh;"
        >
            <div x-show="loading" class="text-center py-10">
                <div class="spinner-border animate-spin inline-block w-10 h-10 border-4 rounded-full" style="border-color: #512DA8; border-right-color: transparent;"></div>
                <p class="mt-3 text-purple-700 font-semibold">Cargando historial de pagos...</p>
            </div>

            <div x-show="error" class="text-center py-10 bg-red-50 rounded-lg border border-red-200">
                <i class="material-icons text-red-600 text-4xl mb-2">error_outline</i>
                <p class="text-red-600 font-semibold" x-text="error"></p>
            </div>

            <div x-show="!loading && !error" class="space-y-4">
                <template x-if="pagos.length === 0">
                    <div class="text-center text-gray-500 py-10 bg-gray-50 rounded-lg border border-gray-200">
                        <i class="material-icons text-gray-400 text-4xl mb-2">money_off</i>
                        <p>No tienes **pagos** registrados en el sistema.</p>
                    </div>
                </template>

                <template x-for="pago in pagos" :key="pago.idPago">
                    <div class="border border-gray-200 rounded-lg p-4 hover:bg-purple-50 transition duration-150">
                        <div class="flex justify-between items-start">
                            <div class="flex-1 min-w-0">
                                <div class="flex items-baseline mb-2">
                                    <h3 class="font-bold text-xl text-gray-900 mr-3">Transacción #<span x-text="pago.idPago"></span></h3>
                                    <span
                                        class="inline-block px-3 py-1 text-xs rounded-full shadow-sm"
                                        :class="{
                                            'status-completado': pago.Estado === 'Completado',
                                            'status-pendiente-pago': pago.Estado === 'Pendiente',
                                            'status-fallido': pago.Estado === 'Fallido' || pago.Estado === 'Cancelado'
                                        }"
                                    >
                                        <span x-text="pago.Estado || 'N/A'"></span>
                                    </span>
                                </div>
                                
                                {{-- Información de Pago --}}
                                <p class="text-sm font-semibold text-gray-700 mt-1">
                                    <i class="material-icons" style="font-size: 14px; vertical-align: middle; margin-right: 4px;">credit_card</i>
                                    Método: **<span x-text="pago.MetodoPago || 'N/A'"></span>**
                                </p>
                                <p class="text-xs text-gray-600">
                                    <i class="material-icons" style="font-size: 12px; vertical-align: middle; margin-right: 4px;">receipt</i>
                                    Referencia: <span x-text="pago.Referencia || 'N/A'"></span>
                                </p>

                                {{-- Detalle de Vuelo/Reserva --}}
                                <p class="text-xs text-gray-500 mt-2 border-t pt-2">
                                    <i class="material-icons" style="font-size: 12px; vertical-align: middle; margin-right: 4px;">flight</i>
                                    Vuelo: <span x-text="pago.vuelo_id || 'N/A'"></span> (<span x-text="pago.aeropuerto_origen || 'N/A'"></span> → <span x-text="pago.aeropuerto_destino || 'N/A'"></span>)
                                </p>
                                <p class="text-xs text-gray-500">
                                    Reserva ID: <span x-text="pago.idReserva || 'N/A'"></span> | Pasajero: <span x-text="pago.Nombre + ' ' + pago.Apellido"></span>
                                </p>

                                {{-- Monto y Fecha --}}
                                <div class="mt-3 pt-3 border-t border-dashed border-gray-200">
                                    <p class="text-lg font-bold text-purple-700">
                                        Monto: <span x-text="formatCurrency(pago.Monto)"></span>
                                    </p>
                                    <p class="text-xs text-gray-600">
                                        Fecha de Pago: <span x-text="formatDate(pago.FechaPago)"></span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </div>

        <div class="mt-6 pt-4 border-t border-gray-100 flex justify-end">
            <button
                @click="open = false"
                class="material-btn material-btn-secondary"
            >
                Cerrar
            </button>
        </div>
    </div>
</div>