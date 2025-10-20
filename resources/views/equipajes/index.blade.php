@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Equipajes
                        <a href="{{ route('equipajes.create') }}" class="btn btn-primary float-end">Crear Nuevo Equipaje</a>
                    </h4>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID Equipaje</th>
                                <th>ID Boleto</th>
                                <th>Costo</th>
                                <th>Dimensiones</th>
                                <th>Monto</th>
                                <th>Costo Extra</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($equipajes as $equipaje)
                                <tr>
                                    <td>{{ $equipaje->idEquipaje }}</td>
                                    <td>{{ $equipaje->idBoleto }}</td>
                                    <td>{{ $equipaje->Costo }}</td>
                                    <td>{{ $equipaje->Dimensiones }}</td>
                                    <td>{{ $equipaje->Monto }}</td>
                                    <td>{{ $equipaje->CostoExtra }}</td>
                                    <td>{{ $equipaje->Estado }}</td>
                                    <td>
                                        <a href="{{ route('equipajes.show', $equipaje->idEquipaje) }}" class="btn btn-info btn-sm">Ver</a>
                                        <a href="{{ route('equipajes.edit', $equipaje->idEquipaje) }}" class="btn btn-warning btn-sm">Editar</a>
                                        <form action="{{ route('equipajes.destroy', $equipaje->idEquipaje) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">No hay equipajes registrados.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
