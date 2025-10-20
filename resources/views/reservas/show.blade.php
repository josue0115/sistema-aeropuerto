@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Detalles de la Reserva
                        <a href="{{ route('reservas.index') }}" class="btn btn-secondary float-end">Volver</a>
                    </h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>ID Reserva</h5>
                            <p>{{ $reserva->idReserva }}</p>
                        </div>
                        <div class="col-md-6">
                            <h5>ID Pasajero</h5>
                            <p>{{ $reserva->idPasajero }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <h5>ID Vuelo</h5>
                            <p>{{ $reserva->idVuelo }}</p>
                        </div>
                        <div class="col-md-6">
                            <h5>Fecha Reserva</h5>
                            <p>{{ $reserva->FechaReserva }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Fecha Vuelo</h5>
                            <p>{{ $reserva->FechaVuelo }}</p>
                        </div>
                        <div class="col-md-6">
                            <h5>Monto Anticipado</h5>
                            <p>{{ $reserva->MontoAnticipado }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Estado</h5>
                            <p>{{ $reserva->Estado }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
