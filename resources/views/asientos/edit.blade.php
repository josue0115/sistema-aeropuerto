@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Editar Asiento
                        <a href="{{ route('asientos.index') }}" class="btn btn-secondary float-end">Volver</a>
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('asientos.update', $asiento[0]->idAsiento) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="idVuelo">Vuelo</label>
                                    <select name="idVuelo" id="idVuelo" class="form-control" required>
                                        <option value="">Seleccione un vuelo</option>
                                        @foreach($vuelos as $vuelo)
                                            <option value="{{ $vuelo->IdVuelo }}" {{ old('idVuelo', $asiento[0]->idVuelo) == $vuelo->IdVuelo ? 'selected' : '' }}>
                                                Vuelo {{ $vuelo->IdVuelo }} - {{ $vuelo->aeropuertoOrigen->NombreAeropuerto ?? 'N/A' }} a {{ $vuelo->aeropuertoDestino->NombreAeropuerto ?? 'N/A' }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('idVuelo')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="NumeroAsiento">Número de Asiento</label>
                                    <input type="text" name="NumeroAsiento" id="NumeroAsiento" class="form-control" value="{{ old('NumeroAsiento', $asiento[0]->NumeroAsiento) }}" required>
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
                                    <input type="text" name="Clase" id="Clase" class="form-control" value="{{ old('Clase', $asiento[0]->Clase) }}">
                                    @error('Clase')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="Estado">Estado</label>
                                    <input type="text" name="Estado" id="Estado" class="form-control" value="{{ old('Estado', $asiento[0]->Estado) }}">
                                    @error('Estado')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Actualizar Asiento</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
