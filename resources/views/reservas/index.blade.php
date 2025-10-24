@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Reservas
                        <a href="{{ route('reservas.create') }}" class="btn btn-primary float-end">Crear Nueva Reserva</a>
                    </h4>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID Reserva</th>
                                    <th>ID Pasajero</th>
                                    <th>ID Vuelo</th>
                                    <th>Fecha Reserva</th>
                                    <th>Fecha Vuelo</th>
                                    <th>Monto Anticipado</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($reservas as $reserva)
                                    <tr>
                                        <td>{{ $reserva->idReserva }}</td>
                                        <td>{{ $reserva->idPasajero }}</td>
                                        <td>{{ $reserva->idVuelo }}</td>
                                        <td>{{ $reserva->FechaReserva }}</td>
                                        <td>{{ $reserva->FechaVuelo }}</td>
                                        <td>{{ $reserva->MontoAnticipado }}</td>
                                        <td>{{ $reserva->Estado }}</td>
                                        <td>
                                            <div class="btn-group-vertical btn-group-sm d-block d-md-inline-block" role="group">
                                                <a href="{{ route('reservas.show', $reserva->idReserva) }}" class="btn btn-info btn-sm">Ver</a>
                                                <a href="{{ route('reservas.edit', $reserva->idReserva) }}" class="btn btn-warning btn-sm">Editar</a>
                                                <form action="{{ route('reservas.destroy', $reserva->idReserva) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center">No hay reservas registradas.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
