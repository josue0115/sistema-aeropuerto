@extends('layouts.app')

@section('page-title', 'Editar Vuelo - Sistema Aeropuerto')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="material-card">
        <div class="p-6 border-b border-gray-200">
            <h1 class="text-2xl font-semibold text-gray-800">
                <i class="material-icons text-blue-600 mr-2">edit</i>
                Editar Vuelo
            </h1>
            <p class="text-gray-600 mt-1">Modifique la información del vuelo seleccionado</p>
        </div>

        <div class="p-6">
            <form method="POST" action="{{ route('vuelo.update', $vuelo) }}" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="idAvion" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="material-icons text-sm mr-1">flight</i>
                            Código Avión
                        </label>
                        <select name="idAvion" id="idAvion" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                            <option value="">Seleccione un avión</option>
                            @foreach($aviones as $avion)
                                <option value="{{ $avion->IdAvion }}" {{ $vuelo->idAvion == $avion->IdAvion ? 'selected' : '' }}>{{ $avion->IdAvion }} - {{ $avion->Placa }}</option>
                            @endforeach
                        </select>
                        @error('idAvion')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="idAeropuertoOrigen" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="material-icons text-sm mr-1">flight_takeoff</i>
                            Aeropuerto Origen
                        </label>
                        <select name="idAeropuertoOrigen" id="idAeropuertoOrigen" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                            <option value="">Seleccione aeropuerto origen</option>
                            @foreach($aeropuertos as $aeropuerto)
                                  <option value="{{ $aeropuerto->IdAeropuerto }}" {{ $vuelo->idAeropuertoOrigen == $aeropuerto->IdAeropuerto ? 'selected' : '' }}>
                                    {{ $aeropuerto->IdAeropuerto }} - {{ $aeropuerto->NombreAeropuerto }}
                                </option>
                            @endforeach
                        </select>
                        @error('idAeropuertoOrigen')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="idAeropuertoDestino" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="material-icons text-sm mr-1">flight_land</i>
                            Aeropuerto Destino
                        </label>
                        <select name="idAeropuertoDestino" id="idAeropuertoDestino" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                            <option value="">Seleccione aeropuerto destino</option>
                            @foreach($aeropuertos as $aeropuerto)
                                <option value="{{ $aeropuerto->IdAeropuerto }}" {{ $vuelo->idAeropuertoDestino == $aeropuerto->IdAeropuerto ? 'selected' : '' }}>{{ $aeropuerto->IdAeropuerto }} - {{ $aeropuerto->NombreAeropuerto }}</option>
                            @endforeach
                        </select>
                        @error('idAeropuertoDestino')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="FechaSalida" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="material-icons text-sm mr-1">schedule</i>
                            Fecha Salida
                        </label>
                        <input type="datetime-local" name="FechaSalida" id="FechaSalida" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" value="{{ $vuelo->FechaSalida }}" min="{{ date('Y-m-d\TH:i') }}" required>
                        @error('FechaSalida')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="FechaLlegada" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="material-icons text-sm mr-1">schedule</i>
                            Fecha Llegada
                        </label>
                        <input type="datetime-local" name="FechaLlegada" id="FechaLlegada" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" value="{{ $vuelo->FechaLlegada }}" min="{{ date('Y-m-d\TH:i') }}" required>
                        @error('FechaLlegada')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="Precio" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="material-icons text-sm mr-1">attach_money</i>
                            Precio
                        </label>
                        <input type="number" name="Precio" id="Precio" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" step="0.01" value="{{ $vuelo->Precio }}" required readonly>
                        @error('Precio')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="Estado" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="material-icons text-sm mr-1">toggle_on</i>
                            Estado
                        </label>
                        <select name="Estado" id="Estado" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                            <option value="">Seleccione estado</option>
                            <option value="Programado" {{ $vuelo->Estado == 'Programado' ? 'selected' : '' }}>Programado</option>
                            <option value="EnVuelo" {{ $vuelo->Estado == 'EnVuelo' ? 'selected' : '' }}>En Vuelo</option>
                            <option value="Llegado" {{ $vuelo->Estado == 'Llegado' ? 'selected' : '' }}>Llegado</option>
                            <option value="Retrasado" {{ $vuelo->Estado == 'Retrasado' ? 'selected' : '' }}>Retrasado</option>
                            <option value="Cancelado" {{ $vuelo->Estado == 'Cancelado' ? 'selected' : '' }}>Cancelado</option>
                        </select>
                        @error('Estado')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
                    <a href="{{ route('vuelo.index') }}" class="material-btn border border-gray-300 text-gray-700 hover:bg-gray-50">
                        <i class="material-icons text-sm mr-2">cancel</i>
                        Cancelar
                    </a>
                    <button type="submit" class="material-btn material-btn-primary">
                        <i class="material-icons text-sm mr-2">save</i>
                        Actualizar Vuelo
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // 1. Obtención ÚNICA de los elementos
    const origenSelect = document.getElementById('idAeropuertoOrigen');
    const destinoSelect = document.getElementById('idAeropuertoDestino');
    const fechaSalidaInput = document.getElementById('FechaSalida');
    const fechaLlegadaInput = document.getElementById('FechaLlegada');
    const precioInput = document.getElementById('Precio');

    // Función para calcular precio basado en origen y destino
    function calcularPrecio() {
        const origen = origenSelect.value;
        const destino = destinoSelect.value;
        if (origen && destino) {
            // Aquí puedes implementar la lógica para calcular el precio
            // Por ahora, asignamos un precio fijo basado en si es nacional o internacional
            const precio = (origen.substring(0, 2) === destino.substring(0, 2)) ? 500.00 : 1500.00;
            precioInput.value = precio.toFixed(2);
        } else {
            precioInput.value = '';
        }
    }

    // --- LÓGICA DE CÁLCULO DE FECHA DE LLEGADA ---
    function formatDateTimeLocal(date) {
        const yyyy = date.getFullYear();
        const mm = String(date.getMonth() + 1).padStart(2, '0');
        const dd = String(date.getDate()).padStart(2, '0');
        const hh = String(date.getHours()).padStart(2, '0');
        const min = String(date.getMinutes()).padStart(2, '0');
        return `${yyyy}-${mm}-${dd}T${hh}:${min}`;
    }

    function actualizarFechaLlegada() {
        const fechaSalidaValue = fechaSalidaInput.value;
        if (!fechaSalidaValue) {
            fechaLlegadaInput.value = '';
            return;
        }

        // Convertir el valor del input a objeto Date
        const fechaSalida = new Date(fechaSalidaValue);

        // Clonar la fecha y sumarle 1 día (24 horas * 60 minutos * 60 segundos * 1000 milisegundos)
        const fechaLlegada = new Date(fechaSalida.getTime() + (24 * 60 * 60 * 1000));

        // Asignar el nuevo valor formateado
        fechaLlegadaInput.value = formatDateTimeLocal(fechaLlegada);
    }

    // --- INICIALIZACIÓN Y EVENTOS ---

    // Escuchar cambios en origen y destino para calcular precio
    origenSelect.addEventListener('change', calcularPrecio);
    destinoSelect.addEventListener('change', calcularPrecio);

    // 2. Ejecutar al cargar la página si ya hay valor en FechaSalida (proveniente del formulario anterior)
    if (fechaSalidaInput.value && !fechaLlegadaInput.value) {
        // Ejecuta la actualización solo si FechaLlegada está vacía
        actualizarFechaLlegada();
    }

    // Escuchar el evento 'change' en la fecha de salida para actualizar la llegada
    fechaSalidaInput.addEventListener('change', actualizarFechaLlegada);

    // Validación para asegurar que origen y destino sean diferentes
    function validarAeropuertos() {
        if (origenSelect.value && destinoSelect.value && origenSelect.value === destinoSelect.value) {
            destinoSelect.setCustomValidity('El aeropuerto de destino debe ser diferente al de origen');
        } else {
            destinoSelect.setCustomValidity('');
        }
    }

    origenSelect.addEventListener('change', validarAeropuertos);
    destinoSelect.addEventListener('change', validarAeropuertos);

    // Validación de fechas
    function validarFechas() {
        // Note: Se usa fechaSalidaInput y fechaLlegadaInput definidos al inicio
        const fechaSalida = new Date(fechaSalidaInput.value);
        const fechaLlegada = new Date(fechaLlegadaInput.value);
        const ahora = new Date();

        // Lógica de validación
        if (fechaSalida < ahora) {
            fechaSalidaInput.setCustomValidity('La fecha de salida debe ser futura');
        } else {
            fechaSalidaInput.setCustomValidity('');
        }

        if (fechaLlegada && fechaLlegada <= fechaSalida) {
            fechaLlegadaInput.setCustomValidity('La fecha de llegada debe ser posterior a la de salida');
        } else {
            fechaLlegadaInput.setCustomValidity('');
        }
    }

    fechaSalidaInput.addEventListener('change', validarFechas);
    fechaLlegadaInput.addEventListener('change', validarFechas);
});
</script>
@endsection
