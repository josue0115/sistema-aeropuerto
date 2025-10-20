@extends('layouts.app')

@section('content')
<div class="container mt-0 pt-0">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Crear Nuevo Asiento
                        <a href="{{ route('asientos.index') }}" class="btn btn-secondary float-end">Volver</a>
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('asientos.store') }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="idVuelo">Número de Vuelo</label>
                                    <div class="input-group">
                                        <select name="idVuelo" id="idVuelo" class="form-control" required>
                                            <option value="">Seleccione un vuelo</option>
                                            @foreach($vuelos as $vuelo)
                                                <option value="{{ $vuelo->IdVuelo }}" {{ old('idVuelo') == $vuelo->IdVuelo ? 'selected' : '' }}>
                                                    Vuelo {{ $vuelo->IdVuelo }} - {{ $vuelo->aeropuertoOrigen->NombreAeropuerto ?? 'N/A' }} a {{ $vuelo->aeropuertoDestino->NombreAeropuerto ?? 'N/A' }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <button type="button" class="btn btn-outline-secondary" id="selectSeatBtn">Seleccionar Asiento</button>
                                    </div>
                                    <small class="text-muted">Selecciona un vuelo y luego haz clic para elegir asiento</small>
                                    @error('idVuelo')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="NumeroAsiento">Número de Asiento</label>
                                    <input type="text" name="NumeroAsiento" id="NumeroAsiento" class="form-control" value="{{ old('NumeroAsiento') }}" required readonly>
                                    @error('NumeroAsiento')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="Clase">Clase</label>
                                    <input type="text" name="Clase" id="Clase" class="form-control" value="{{ old('Clase') }}" readonly>
                                    @error('Clase')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="Estado">Estado</label>
                                    <select name="Estado" id="Estado" class="form-control">
                                        <option value="">Seleccione un estado</option>
                                        <option value="Disponible" {{ old('Estado', 'Ocupado') == 'Disponible' ? 'selected' : '' }}>Disponible</option>
                                        <option value="Reservado" {{ old('Estado', 'Ocupado') == 'Reservado' ? 'selected' : '' }}>Reservado</option>
                                        <option value="Ocupado" {{ old('Estado', 'Ocupado') == 'Ocupado' ? 'selected' : '' }}>Ocupado</option>
                                    </select>
                                    @error('Estado')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Crear Asiento</button>
                        <a href="{{ route('asientos.index') }}" class="btn btn-secondary">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Navigation Buttons -->
    <div class="container mt-4">
        <div class="row">
            <div class="col-12 text-center">
                <a href="{{ route('servicios.create') }}" class="btn btn-warning btn-lg me-2">Anterior: Servicios</a>
                <a href="{{ route('reservas.create') }}" class="btn btn-success btn-lg">Finalizar Reserva</a>
            </div>
        </div>
    </div>

    <!-- Modal de Selección de Asientos -->
                    <div class="modal fade" id="seatModal" tabindex="-1" aria-labelledby="seatModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="seatModalLabel">Seleccionar Asiento</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div id="airplane-container">
                                        <!-- El contenido del avión se cargará aquí -->
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                    <button type="button" class="btn btn-primary" id="confirmSeat">Seleccionar Asiento</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal de Error -->
                    <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="errorModalLabel">Error</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body" id="errorModalBody">
                                    <!-- Error message will be inserted here -->
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Aceptar</button>
                                </div>
                            </div>
                        </div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('JavaScript loaded for asientos create');
    const numeroAsientoInput = document.getElementById('NumeroAsiento');
    const selectSeatBtn = document.getElementById('selectSeatBtn');
    const idVueloSelect = document.getElementById('idVuelo');
    const airplaneContainer = document.getElementById('airplane-container');
    const confirmSeatBtn = document.getElementById('confirmSeat');
    const errorModalBody = document.getElementById('errorModalBody');
    let selectedSeat = null;
    let seatModal = null;
    let errorModal = null;

    // Initialize modals immediately when DOM is ready
    const modalElement = document.getElementById('seatModal');
    const errorModalElement = document.getElementById('errorModal');
    if (modalElement) {
        seatModal = new bootstrap.Modal(modalElement);
        console.log('Seat modal initialized successfully');
    } else {
        console.error('Seat modal element not found');
    }

    if (errorModalElement) {
        errorModal = new bootstrap.Modal(errorModalElement);
        console.log('Error modal initialized successfully');
    } else {
        console.error('Error modal element not found');
    }

    // Function to show error modal
    function showErrorModal(message) {
        if (errorModal && errorModalBody) {
            errorModalBody.textContent = message;
            errorModal.show();
        } else {
            alert(message); // Fallback to alert if modal fails
        }
    }

    // Hacer el botón de asiento clickeable
    selectSeatBtn.addEventListener('click', function() {
        console.log('Seat select button clicked');
        const vueloId = idVueloSelect.value;
        console.log('Selected vueloId:', vueloId);
        if (!vueloId) {
            showErrorModal('Por favor selecciona un vuelo primero.');
            return;
        }
        if (seatModal) {
            loadSeats(vueloId);
            seatModal.show();
        } else {
            console.error('Seat modal not initialized');
            showErrorModal('Error: Modal no inicializado');
        }
    });

    // Cargar asientos disponibles
    function loadSeats(vueloId) {
        console.log('Loading seats for vueloId:', vueloId);
        fetch(`/asientos/available-seats?idVuelo=${vueloId}`)
            .then(response => {
                console.log('Response status:', response.status);
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                console.log('Received data:', data);
                renderAirplane(data.available, data.occupied);
            })
            .catch(error => {
                console.error('Error loading seats:', error);
                airplaneContainer.innerHTML = '<p>Error al cargar los asientos. Verifica la consola para más detalles.</p>';
            });
    }

    // Renderizar el avión
    function renderAirplane(availableSeats, occupiedSeats) {
        console.log('Rendering airplane with available:', availableSeats, 'occupied:', occupiedSeats);
        airplaneContainer.innerHTML = `
            <div class="airplane-container">
                <div class="airplane">
                    <!-- Cabina del piloto -->
                    <div class="cockpit">
                        <div class="cockpit-window"></div>
                    </div>

                    <!-- Primera clase -->
                    <div class="first-class">
                        <h6>Primera Clase</h6>
                        <div class="seats-row">
                            <div class="seat-group">
                                ${renderSeatGroup(['1A', '1B'], availableSeats, occupiedSeats)}
                            </div>
                            <div class="aisle"></div>
                            <div class="seat-group">
                                ${renderSeatGroup(['1C', '1D'], availableSeats, occupiedSeats)}
                            </div>
                        </div>
                    </div>

                    <!-- Clase ejecutiva -->
                    <div class="business-class">
                        <h6>Clase Ejecutiva</h6>
                        <div class="seats-row">
                            <div class="seat-group">
                                ${renderSeatGroup(['2A', '2B'], availableSeats, occupiedSeats)}
                            </div>
                            <div class="aisle"></div>
                            <div class="seat-group">
                                ${renderSeatGroup(['2C', '2D'], availableSeats, occupiedSeats)}
                            </div>
                        </div>
                        <div class="seats-row">
                            <div class="seat-group">
                                ${renderSeatGroup(['3A', '3B'], availableSeats, occupiedSeats)}
                            </div>
                            <div class="aisle"></div>
                            <div class="seat-group">
                                ${renderSeatGroup(['3C', '3D'], availableSeats, occupiedSeats)}
                            </div>
                        </div>
                    </div>

                    <!-- Clase económica -->
                    <div class="economy-class">
                        <h6>Clase Económica</h6>
                        <div class="seats-row">
                            <div class="seat-group">
                                ${renderSeatGroup(['4A', '4B', '4C'], availableSeats, occupiedSeats)}
                            </div>
                            <div class="aisle"></div>
                            <div class="seat-group">
                                ${renderSeatGroup(['4D', '4E', '4F'], availableSeats, occupiedSeats)}
                            </div>
                        </div>
                        <div class="seats-row">
                            <div class="seat-group">
                                ${renderSeatGroup(['5A', '5B', '5C'], availableSeats, occupiedSeats)}
                            </div>
                            <div class="aisle"></div>
                            <div class="seat-group">
                                ${renderSeatGroup(['5D', '5E', '5F'], availableSeats, occupiedSeats)}
                            </div>
                        </div>
                        <div class="seats-row">
                            <div class="seat-group">
                                ${renderSeatGroup(['6A', '6B', '6C'], availableSeats, occupiedSeats)}
                            </div>
                            <div class="aisle"></div>
                            <div class="seat-group">
                                ${renderSeatGroup(['6D', '6E', '6F'], availableSeats, occupiedSeats)}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-3">
                <small class="text-muted">
                    <span class="seat-legend available-legend"></span> Disponible
                    <span class="seat-legend selected-legend"></span> Seleccionado
                    <span class="seat-legend occupied-legend"></span> Ocupado
                </small>
            </div>
        `;

        // Agregar event listeners a los asientos
        document.querySelectorAll('.seat.available').forEach(seat => {
            seat.addEventListener('click', function() {
                console.log('Seat clicked:', this.dataset.seat);
                // Remover selección previa
                document.querySelectorAll('.seat').forEach(s => s.classList.remove('selected'));
                // Seleccionar asiento actual
                this.classList.add('selected');
                selectedSeat = this.dataset.seat;
            });
        });
    }

    // Renderizar grupo de asientos
    function renderSeatGroup(seats, availableSeats, occupiedSeats) {
        return seats.map(seat => {
            let seatClass = 'seat';
            if (availableSeats.includes(seat)) {
                seatClass += ' available';
            } else if (occupiedSeats.includes(seat)) {
                seatClass += ' occupied';
            } else {
                seatClass += ' available'; // Asientos no registrados se consideran disponibles
            }
            return `<div class="${seatClass}" data-seat="${seat}">${seat}</div>`;
        }).join('');
    }

    // Función para obtener la clase basada en el número de asiento
    function getSeatClass(seatNumber) {
        const row = seatNumber.charAt(0);
        if (row === '1') {
            return 'Primera Clase';
        } else if (row === '2' || row === '3') {
            return 'Clase Ejecutiva';
        } else if (row >= '4' && row <= '6') {
            return 'Clase Económica';
        }
        return '';
    }

    // Confirmar selección de asiento
    confirmSeatBtn.addEventListener('click', function() {
        console.log('Confirm seat clicked, selectedSeat:', selectedSeat);
        if (selectedSeat) {
            numeroAsientoInput.value = selectedSeat;
            const seatClass = getSeatClass(selectedSeat);
            document.getElementById('Clase').value = seatClass;
            if (seatModal) {
                seatModal.hide();
            }
        } else {
            showErrorModal('Por favor selecciona un asiento.');
        }
    });

    // Limpiar selección cuando se cambia el vuelo
    idVueloSelect.addEventListener('change', function() {
        numeroAsientoInput.value = '';
        document.getElementById('Clase').value = '';
        selectedSeat = null;
    });
});
</script>
@endsection
