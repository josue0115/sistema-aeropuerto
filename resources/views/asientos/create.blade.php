@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white shadow-md rounded-lg p-6 border border-gray-200">
        <div class="flex items-center justify-between mb-4">
            <h4 class="text-xl font-semibold text-gray-800">Crear Nuevo Asiento</h4>
            <a href="{{ route('asientos.index') }}" class="material-btn material-btn-secondary">Volver</a>
        </div>

        <form action="{{ route('asientos.store') }}" method="POST" x-data="seatSelection" x-init="init()">
            @csrf

            {{-- Selección de Vuelo --}}
            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <label for="IdVuelo" class="block text-sm font-medium text-gray-700 mb-1">Número de Vuelo</label>
                    <div class="flex gap-2">
                        <select name="IdVuelo" id="IdVuelo" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                            <option value="">Seleccione un vuelo</option>
                            @foreach($vuelos as $vuelo)
                                <option value="{{ $vuelo->IdVuelo }}"
                                    {{ old('IdVuelo') == $vuelo->IdVuelo ? 'selected' : (isset($vueloSeleccionado) && $vueloSeleccionado == $vuelo->IdVuelo ? 'selected' : '') }}>
                                    Vuelo {{ $vuelo->IdVuelo }} - {{ $vuelo->aeropuerto_origen_nombre ?? 'N/A' }} a {{ $vuelo->aeropuerto_destino_nombre ?? 'N/A' }}
                                </option>
                            @endforeach
                        </select>

                        {{-- Botón para abrir el modal --}}
                        <button type="button" @click="if (!document.getElementById('IdVuelo').value) { showError('Selecciona un vuelo primero') } else { loadSeats(); seatModal = true }" class="material-btn material-btn-secondary whitespace-nowrap">
                            Seleccionar Asiento
                        </button>
                    </div>
                    <small class="text-gray-500">Selecciona un vuelo y luego haz clic para elegir asiento</small>
                </div>

                <div>
                    <label for="NumeroAsiento" class="block text-sm font-medium text-gray-700 mb-1">Número de Asiento</label>
                    <input type="text" name="NumeroAsiento" id="NumeroAsiento" class="w-full border border-gray-300 rounded-md px-3 py-2 bg-gray-100" value="{{ old('NumeroAsiento') }}" readonly required>
                </div>
            </div>

            {{-- Clase / Estado --}}
            <div class="grid md:grid-cols-2 gap-6 mt-6">
                <div>
                    <label for="Clase" class="block text-sm font-medium text-gray-700 mb-1">Clase</label>
                    <input type="text" name="Clase" id="Clase" class="w-full border border-gray-300 rounded-md px-3 py-2 bg-gray-100" value="{{ old('Clase') }}" readonly>
                </div>

                <div>
                    <label for="Estado" class="block text-sm font-medium text-gray-700 mb-1">Estado</label>
                    <select name="Estado" id="Estado" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                        <option value="">Seleccione un estado</option>
                        <option value="Disponible" {{ old('Estado', 'Ocupado') == 'Disponible' ? 'selected' : '' }}>Disponible</option>
                        <option value="Reservado" {{ old('Estado', 'Ocupado') == 'Reservado' ? 'selected' : '' }}>Reservado</option>
                        <option value="Ocupado" {{ old('Estado', 'Ocupado') == 'Ocupado' ? 'selected' : '' }}>Ocupado</option>
                    </select>
                </div>
            </div>

            {{-- Botones --}}
            <div class="flex flex-wrap gap-3 justify-end mt-8 pt-6 border-t border-gray-200">
                <button type="submit" name="action" value="create" class="material-btn material-btn-primary">Crear Asiento</button>
                <button type="submit" name="action" value="finalize" class="material-btn material-btn-success">Finalizar Reserva</button>
                <a href="{{ route('asientos.index') }}" class="material-btn material-btn-secondary">Cancelar</a>
            </div>

            {{-- Modal Selección Asiento --}}
            <div x-show="seatModal" x-cloak class="fixed inset-0 flex  justify-center bg-black/50 z-50">
                <div class="bg-white rounded-lg shadow-lg w-full max-w-3xl p-6" style="width: 850px; height:900px;">
                    <div class="flex items-center justify-between mb-4 border-b pb-2">
                        <h5 class="text-lg font-semibold text-gray-700">Seleccionar Asiento</h5>
                        <button @click="seatModal=false" class="material-btn material-btn-secondary text-sm">Cerrar</button>
                    </div>
                    <div id="airplane-container"   class="p-4 border border-gray-200 rounded bg-gray-50 text-center">
                        <p class="text-gray-500">Cargando asientos...</p>
                    </div>
                    <div class="flex justify-end mt-6">
                        <button type="button" @click="seatModal=false" class="material-btn material-btn-secondary mr-2">Cancelar</button>
                        <button type="button" @click="confirmSeat()" class="material-btn material-btn-primary">Seleccionar Asiento</button>
                    </div>
                </div>
            </div>

            {{-- Modal de Error --}}
            <div x-show="errorModal" x-cloak class="fixed inset-0 flex items-center justify-center bg-black/50 z-50">
                <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
                    <h5 class="text-lg font-semibold text-gray-700 mb-2">Error</h5>
                    <p class="text-gray-600 mb-4" x-text="errorMessage"></p>
                    <div class="flex justify-end">
                        <button @click="errorModal=false" class="material-btn material-btn-primary">Aceptar</button>
                    </div>
                </div>
            </div>

        </form>
    </div>
</div>

<script src="//unpkg.com/alpinejs@3.x.x" defer></script>
@endsection

@section('scripts')
<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('seatSelection', () => ({
        seatModal: false,
        errorModal: false,
        errorMessage: '',
        selectedSeat: null,

        init() {
            console.log("✅ Alpine seatSelection iniciado correctamente");
        },

        showError(msg) {
            this.errorMessage = msg;
            this.errorModal = true;
        },

        async loadSeats() {
            const vueloId = document.getElementById('IdVuelo').value;
            const container = document.getElementById('airplane-container');
            container.innerHTML = '<p class="text-gray-100">Cargando asientos...</p>';

            try {
                console.log('🔍 Cargando asientos para vuelo:', vueloId);
                const response = await fetch(`/asientos/available-seats?idVuelo=${vueloId}`);
                if (!response.ok) throw new Error(`Error HTTP: ${response.status}`);
                const data = await response.json();
                const available = data.available || [];
                const occupied = data.occupied || [];
                this.renderSeats(available, occupied);
            } catch (error) {
                console.error("❌ Error cargando asientos:", error);
                container.innerHTML = `<p class="text-red-500 mb-2">Error al cargar los asientos.</p>
                                       <p class="text-sm text-gray-500">Detalles: ${error.message}</p>`;
            }
        },

        renderSeats(available, occupied) {
            const container = document.getElementById('airplane-container');
            const firstClass = ['1A', '1B', '1C', '1D'];
            const businessClass = ['2A','2B','2C','2D','3A','3B','3C','3D'];
            const economyClass = ['4A','4B','4C','4D','4E','4F','5A','5B','5C','5D','5E','5F','6A','6B','6C','6D','6E','6F'];

            container.innerHTML = `
                <div class="airplane-wrapper" style="max-width: 500px; margin: 0 auto;">
                    <div style="background-color: #007bff; border-radius: 50px 50px 0 0; height: 64px; display: flex; align-items: center; justify-content: center; margin-bottom: 16px; color: white; font-weight: bold; font-size: 18px;">✈️ CABINA</div>
                    <div style="margin-bottom: 16px; padding: 16px; border-radius: 8px; border: 2px solid #ffc107; background-color: #fff3cd;">
                        <h6 style="text-align: center; font-weight: bold; color: #664d03; margin-bottom: 12px; font-size: 16px;">✨ PRIMERA CLASE</h6>
                        <div style="display: flex; justify-content: center; gap: 16px;">
                            <div style="display: flex; gap: 8px;">${this.renderSeatRow(firstClass.slice(0,2), available, occupied, '#ffc107')}</div>
                            <div style="width: 48px; display: flex; align-items: center; justify-content: center;"><div style="height: 100%; width: 2px; background-color: #6c757d;"></div></div>
                            <div style="display: flex; gap: 8px;">${this.renderSeatRow(firstClass.slice(2,4), available, occupied, '#ffc107')}</div>
                        </div>
                    </div>
                    <div style="margin-bottom: 16px; padding: 16px; border-radius: 8px; border: 2px solid #055160; background-color: #cff4fc;">
                        <h6 style="text-align: center; font-weight: bold; color: #055160; margin-bottom: 12px; font-size: 16px;">💼 CLASE EJECUTIVA</h6>
                        ${this.renderClassSection(businessClass, available, occupied, 4, '#055160')}
                    </div>
                    <div style="margin-bottom: 16px; padding: 16px; border-radius: 8px; border: 2px solid #198754; background-color: #d1edff;">
                        <h6 style="text-align: center; font-weight: bold; color: #0f5132; margin-bottom: 12px; font-size: 16px;">🪑 CLASE ECONÓMICA</h6>
                        ${this.renderClassSection(economyClass, available, occupied, 6, '#198754')}
                    </div>
                    <div style="background-color: #6c757d; border-radius: 0 0 8px 8px; height: 48px; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; font-size: 12px;">SALIDA DE EMERGENCIA</div>
                    <div style="margin-top: 16px; display: flex; flex-wrap: wrap; align-items: center; justify-content: center; gap: 12px; font-size: 14px;">
                        
                        <div style="display: flex; align-items: center; gap: 8px;">
                            <div style="width: 32px; height: 32px; background-color: #007bff; border: 4px solid #007bff; border-radius: 4px; display: flex; align-items: center; justify-content: center; color: white; font-size: 12px; font-weight: bold;">S</div>
                            <span style="color: #6c757d;">Seleccionado</span>
                        </div>
                        <div style="display: flex; align-items: center; gap: 8px;">
                            <div style="width: 32px; height: 32px; background-color: #6c757d; border-radius: 4px; display: flex; align-items: center; justify-content: center; color: white; font-size: 12px; font-weight: bold;">O</div>
                            <span style="color: #6c757d;">Ocupado</span>
                        </div>
                    </div>
                </div>
            `;

            this.attachSeatListeners(container);
        },

        renderClassSection(seats, available, occupied, seatsPerRow, color) {
            let html = '';
            for (let i = 0; i < seats.length; i += seatsPerRow) {
                const rowSeats = seats.slice(i, i + seatsPerRow);
                const leftSeats = rowSeats.slice(0, seatsPerRow/2);
                const rightSeats = rowSeats.slice(seatsPerRow/2);
                html += `
                    <div style="display: flex; justify-content: center; gap: 16px; margin-bottom: 8px;">
                        <div style="display: flex; gap: 8px;">${this.renderSeatRow(leftSeats, available, occupied, color)}</div>
                        <div style="width: 48px; display: flex; align-items: center; justify-content: center;"><div style="height: 100%; width: 2px; background-color: #6c757d;"></div></div>
                        <div style="display: flex; gap: 8px;">${this.renderSeatRow(rightSeats, available, occupied, color)}</div>
                    </div>
                `;
            }
            return html;
        },

        renderSeatRow(seats, available, occupied, color) {
            return seats.map(seat => {
                const isOccupied = occupied.includes(seat);
                let style = 'border-radius: 4px; display: flex; align-items: center; justify-content: center; color: white; font-size: 12px; font-weight: bold; width: 40px; height: 40px;';
                if (isOccupied) {
                    style += ' background-color: #6c757d; cursor: not-allowed; opacity: 0.75;';
                } else {
                    style += ` background-color: ${color}; cursor: pointer; transition: opacity 0.2s;`;
                }
                return `<div data-seat="${seat}" data-color="${color}" class="seat" style="${style}">${seat}</div>`;
            }).join('');
        },

        attachSeatListeners(container) {
            const seats = container.querySelectorAll('.seat');
            seats.forEach(seat => {
                if (seat.style.cursor === 'not-allowed') return;
                seat.addEventListener('click', () => {
                    container.querySelectorAll('.seat').forEach(s => {
                        s.style.border = '';
                        if (s.style.cursor !== 'not-allowed') {
                            const originalColor = s.dataset.color;
                            s.style.backgroundColor = originalColor;
                        }
                    });
                    const originalColor = seat.dataset.color;
                    seat.style.backgroundColor = '#007bff';
                    seat.style.border = '4px solid #007bff';
                    this.selectedSeat = seat.dataset.seat;
                });
            });
        },

        confirmSeat() {
            if (!this.selectedSeat) {
                this.showError('Por favor selecciona un asiento.');
                return;
            }
            document.getElementById('NumeroAsiento').value = this.selectedSeat;
            document.getElementById('Clase').value = this.getSeatClass(this.selectedSeat);
            this.seatModal = false;
        },

        getSeatClass(seat) {
            const row = seat.charAt(0);
            if (row === '1') return 'Primera Clase';
            if (['2','3'].includes(row)) return 'Clase Ejecutiva';
            return 'Clase Económica';
        }

    }))
})
</script>
@endsection
