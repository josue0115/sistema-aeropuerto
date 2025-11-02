<div class="material-sidebar" id="sidebar">
    <div class="p-6 border-b border-gray-700">
        <div class="flex items-center justify-center mb-4">
            <div class="w-12 h-12 bg-white bg-opacity-20 rounded-full flex items-center justify-center mr-3">
                <i class="material-icons text-white text-2xl">flight_takeoff</i>
            </div>
            <div>
                <h2 class="text-white text-xl font-bold">AEROLINEAS</h2>
                <p class="text-white text-opacity-80 text-sm">Sistema de Gestión</p>
            </div>
        </div>
    </div>

    <nav class="mt-4">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                    <i class="material-icons">dashboard</i>
                    Dashboard
                </a>
            </li>

            @if(auth()->user()->role !== 'admin')
            <li class="nav-item">
                @if(auth()->user()->role === 'operador')
                    <a class="nav-link {{ request()->routeIs('vuelos.*') ? 'active' : '' }}" href="{{ route('vuelos.index') }}">
                        <i class="material-icons">flight_takeoff</i>
                        Buscar Vuelos   
                    </a>
                @elseif(in_array(auth()->user()->role, ['cliente', 'operador']))
                    <a class="nav-link {{ request()->routeIs('vuelos.*') ? 'active' : '' }}" href="{{ route('vuelos.disponibles') }}">
                        <i class="material-icons">flight_takeoff</i>
                        Buscar Vuelos
                    </a>
                @endif
            </li>
            @endif

            @if(auth()->user()->role !== 'admin')
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('pasajeros.*') ? 'active' : '' }}" href="{{ route('pasajeros.index') }}">
                    <i class="material-icons">people</i>
                    Pasajeros
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('reservas.*') ? 'active' : '' }}" href="{{ route('reservas.index') }}">
                    <i class="material-icons">event_note</i>
                    Reservas
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('boletos.*') ? 'active' : '' }}" href="{{ route('boletos.index') }}">
                    <i class="material-icons">confirmation_number</i>
                    Boletos
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('servicios.*') ? 'active' : '' }}" href="{{ route('servicios.index') }}">
                    <i class="material-icons">room_service</i>
                    Servicios
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('asientos.*') ? 'active' : '' }}" href="{{ route('asientos.index') }}">
                    <i class="material-icons">event_seat</i>
                    Asientos
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('pagos.*') ? 'active' : '' }}" href="{{ route('pagos.index') }}">
                    <i class="material-icons">payment</i>
                    Pagos
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('facturas.*') ? 'active' : '' }}" href="{{ route('facturas.index') }}">
                    <i class="material-icons">receipt</i>
                    Facturas
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('equipajes.*') ? 'active' : '' }}" href="{{ route('equipajes.index') }}">
                    <i class="material-icons">work</i>
                    Equipajes
                </a>
            </li>
            @endif

            <!-- Separator -->
            <li class="nav-item">
                <hr class="border-gray-600 my-2">
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('aerolinea.*') ? 'active' : '' }}" href="{{ route('aerolineas.index') }}">
                    <i class="material-icons">business</i>
                    Aerolíneas
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('aeropuertos.*') ? 'active' : '' }}" href="{{ route('aeropuertos.index') }}">
                    <i class="material-icons">location_city</i>
                    Aeropuertos
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('avion.*') ? 'active' : '' }}" href="{{ route('avion.listar') }}">
                    <i class="material-icons">airplanemode_active</i>
                    Aviones
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('personal.*') ? 'active' : '' }}" href="{{ route('personal.listar') }}">
                    <i class="material-icons">engineering</i>
                    Personal
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('mantenimiento.*') ? 'active' : '' }}" href="{{ route('mantenimiento.listar') }}">
                    <i class="material-icons">build</i>
                    Mantenimiento
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('horario.*') ? 'active' : '' }}" href="{{ route('horario.index') }}">
                    <i class="material-icons">schedule</i>
                    Horarios
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('escala.*') ? 'active' : '' }}" href="{{ route('escala.index') }}">
                    <i class="material-icons">transfer_within_a_station</i>
                    Escalas
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('tipo_servicios.*') ? 'active' : '' }}" href="{{ route('tipo_servicios.index') }}">
                    <i class="material-icons">category</i>
                    Tipo Servicios
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('historial_vuelos.*') ? 'active' : '' }}" href="{{ route('historial_vuelos.index') }}">
                    <i class="material-icons">history</i>
                    Historial Vuelos
                </a>
            </li>
        </ul>
    </nav>
</div>
