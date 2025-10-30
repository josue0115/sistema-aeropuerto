<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
                        {{ __('Home') }}
                    </x-nav-link>
                    @if(auth()->user()->role === 'admin')
                        <x-nav-link :href="route('aerolineas.index')" :active="request()->routeIs('aerolineas.index')">
                            {{ __('Aerolineas') }}
                        </x-nav-link>
                        <x-nav-link :href="route('aeropuertos.index')" :active="request()->routeIs('aeropuertos.index')">
                            {{ __('Aeropuertos') }}
                        </x-nav-link>
                        <x-nav-link :href="route('avion.listar')" :active="request()->routeIs('avion.listar')">
                            {{ __('Aviones') }}
                        </x-nav-link>
                        <x-nav-link :href="route('personal.listar')" :active="request()->routeIs('personal.listar')">
                            {{ __('Personal') }}
                        </x-nav-link>
                        <x-nav-link :href="route('mantenimiento.listar')" :active="request()->routeIs('mantenimiento.listar')">
                            {{ __('Mantenimiento') }}
                        </x-nav-link>
                        <x-nav-link :href="route('horario.listar')" :active="request()->routeIs('horario.listar')">
                            {{ __('Horarios') }}
                        </x-nav-link>
                        <x-nav-link :href="route('escala.index')" :active="request()->routeIs('escala.index')">
                            {{ __('Escalas') }}
                        </x-nav-link>
                        <x-nav-link :href="route('tipo_servicios.index')" :active="request()->routeIs('tipo_servicios.index')">
                            {{ __('Tipo Servicios') }}
                        </x-nav-link>
                        <x-nav-link :href="route('asientos.index')" :active="request()->routeIs('asientos.index')">
                            {{ __('Asientos') }}
                        </x-nav-link>
                    @elseif(auth()->user()->role === 'operador')
                        <x-nav-link :href="route('vuelos.index')" :active="request()->routeIs('vuelos.index')">
                            {{ __('Vuelos') }}
                        </x-nav-link>
                        <x-nav-link :href="route('pasajeros.index')" :active="request()->routeIs('pasajeros.index')">
                            {{ __('Pasajeros') }}
                        </x-nav-link>
                        <x-nav-link :href="route('reservas.index')" :active="request()->routeIs('reservas.index')">
                            {{ __('Reservas') }}
                        </x-nav-link>
                        <x-nav-link :href="route('boletos.index')" :active="request()->routeIs('boletos.index')">
                            {{ __('Boletos') }}
                        </x-nav-link>
                        <x-nav-link :href="route('equipajes.index')" :active="request()->routeIs('equipajes.index')">
                            {{ __('Equipajes') }}
                        </x-nav-link>
                        <x-nav-link :href="route('servicios.index')" :active="request()->routeIs('servicios.index')">
                            {{ __('Servicios') }}
                        </x-nav-link>
                        <x-nav-link :href="route('facturas.index')" :active="request()->routeIs('facturas.index')">
                            {{ __('Facturas') }}
                        </x-nav-link>
                        <x-nav-link :href="route('pagos.index')" :active="request()->routeIs('pagos.index')">
                            {{ __('Pagos') }}
                        </x-nav-link>
                        <x-nav-link :href="route('historial_vuelos.index')" :active="request()->routeIs('historial_vuelos.index')">
                            {{ __('Historial Vuelos') }}
                        </x-nav-link>
                    @elseif(in_array(auth()->user()->role, ['cliente', 'operador']))
                        <x-nav-link :href="route('vuelos.disponibles')" :active="request()->routeIs('vuelos.disponibles')">
                            {{ __('Vuelos Disponibles') }}
                        </x-nav-link>
                        <x-nav-link :href="route('reservas.index')" :active="request()->routeIs('reservas.index')">
                            {{ __('Mis Reservas') }}
                        </x-nav-link>
                        <x-nav-link :href="route('boletos.index')" :active="request()->routeIs('boletos.index')">
                            {{ __('Mis Boletos') }}
                        </x-nav-link>
                        <x-nav-link :href="route('facturas.index')" :active="request()->routeIs('facturas.index')">
                            {{ __('Mis Facturas') }}
                        </x-nav-link>
                        <x-nav-link :href="route('pagos.index')" :active="request()->routeIs('pagos.index')">
                            {{ __('Mis Pagos') }}
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
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

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">
                {{ __('Home') }}
            </x-responsive-nav-link>
            @if(auth()->user()->role === 'admin')
                <x-responsive-nav-link :href="route('aerolineas.index')" :active="request()->routeIs('aerolineas.index')">
                    {{ __('Aerolineas') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('aeropuertos.index')" :active="request()->routeIs('aeropuertos.index')">
                    {{ __('Aeropuertos') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('avion.listar')" :active="request()->routeIs('avion.listar')">
                    {{ __('Aviones') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('personal.listar')" :active="request()->routeIs('personal.listar')">
                    {{ __('Personal') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('mantenimiento.listar')" :active="request()->routeIs('mantenimiento.listar')">
                    {{ __('Mantenimiento') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('horario.listar')" :active="request()->routeIs('horario.listar')">
                    {{ __('Horarios') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('escala.index')" :active="request()->routeIs('escala.index')">
                    {{ __('Escalas') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('tipo_servicios.index')" :active="request()->routeIs('tipo_servicios.index')">
                    {{ __('Tipo Servicios') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('asientos.index')" :active="request()->routeIs('asientos.index')">
                    {{ __('Asientos') }}
                </x-responsive-nav-link>
            @elseif(auth()->user()->role === 'operador')
                <x-responsive-nav-link :href="route('vuelos.index')" :active="request()->routeIs('vuelos.index')">
                    {{ __('Vuelos') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('pasajeros.index')" :active="request()->routeIs('pasajeros.index')">
                    {{ __('Pasajeros') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('reservas.index')" :active="request()->routeIs('reservas.index')">
                    {{ __('Reservas') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('boletos.index')" :active="request()->routeIs('boletos.index')">
                    {{ __('Boletos') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('equipajes.index')" :active="request()->routeIs('equipajes.index')">
                    {{ __('Equipajes') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('servicios.index')" :active="request()->routeIs('servicios.index')">
                    {{ __('Servicios') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('facturas.index')" :active="request()->routeIs('facturas.index')">
                    {{ __('Facturas') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('pagos.index')" :active="request()->routeIs('pagos.index')">
                    {{ __('Pagos') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('historial_vuelos.index')" :active="request()->routeIs('historial_vuelos.index')">
                    {{ __('Historial Vuelos') }}
                </x-responsive-nav-link>
            @elseif(in_array(auth()->user()->role, ['cliente', 'operador']))
                <x-responsive-nav-link :href="route('vuelos.disponibles')" :active="request()->routeIs('vuelos.disponibles')">
                    {{ __('Vuelos Disponibles') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('reservas.index')" :active="request()->routeIs('reservas.index')">
                    {{ __('Mis Reservas') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('boletos.index')" :active="request()->routeIs('boletos.index')">
                    {{ __('Mis Boletos') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('facturas.index')" :active="request()->routeIs('facturas.index')">
                    {{ __('Mis Facturas') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('pagos.index')" :active="request()->routeIs('pagos.index')">
                    {{ __('Mis Pagos') }}
                </x-responsive-nav-link>
            @endif
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
