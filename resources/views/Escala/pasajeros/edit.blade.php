@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Editar Pasajero</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('pasajeros.update', $pasajero[0]->idPasajero) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="Nombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control @error('Nombre') is-invalid @enderror" id="Nombre" name="Nombre" value="{{ old('Nombre', $pasajero[0]->Nombre) }}" maxlength="45">
                                @error('Nombre')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="Apellido" class="form-label">Apellido</label>
                                <input type="text" class="form-control @error('Apellido') is-invalid @enderror" id="Apellido" name="Apellido" value="{{ old('Apellido', $pasajero[0]->Apellido) }}" maxlength="45">
                                @error('Apellido')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="Pais" class="form-label">País</label>
                                <input type="text" class="form-control @error('Pais') is-invalid @enderror" id="Pais" name="Pais" value="{{ old('Pais', $pasajero[0]->Pais) }}" maxlength="45">
                                @error('Pais')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="TipoPasajero" class="form-label">Tipo Pasajero</label>
                                <input type="text" class="form-control @error('TipoPasajero') is-invalid @enderror" id="TipoPasajero" name="TipoPasajero" value="{{ old('TipoPasajero', $pasajero[0]->TipoPasajero) }}" maxlength="45">
                                @error('TipoPasajero')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="Estado" class="form-label">Estado</label>
                                <select class="form-control @error('Estado') is-invalid @enderror" id="Estado" name="Estado">
                                    <option value="">Seleccione un estado</option>
                                    <option value="Activo" {{ old('Estado', $pasajero[0]->Estado) == 'Activo' ? 'selected' : '' }}>Activo</option>
                                    <option value="Inactivo" {{ old('Estado', $pasajero[0]->Estado) == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                                    <option value="Suspendido" {{ old('Estado', $pasajero[0]->Estado) == 'Suspendido' ? 'selected' : '' }}>Suspendido</option>
                                    <option value="Bloqueado" {{ old('Estado', $pasajero[0]->Estado) == 'Bloqueado' ? 'selected' : '' }}>Bloqueado</option>
                                </select>
                                @error('Estado')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Actualizar Pasajero</button>
                        <a href="{{ route('pasajeros.index') }}" class="btn btn-secondary">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
