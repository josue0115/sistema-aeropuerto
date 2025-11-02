@extends('layouts.app')

@section('page-title', 'Detalles del Personal')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-6">
        <div class="flex items-center justify-between mb-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-800 mb-1 flex items-center">
                    <i class="material-icons text-blue-600 mr-2 text-3xl">person</i>
                    Detalles del Empleado: {{ $personal->Nombre }} {{ $personal->Apellido }}
                </h1>
                <p class="text-gray-600 text-lg">Información completa del personal ID **#{{ $personal->IdPersonal }}**.</p>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('personal.listar') }}" class="material-btn material-btn-secondary flex items-center">
                    <i class="material-icons text-sm mr-2">arrow_back</i>
                    Volver a la Lista
                </a>
                {{-- <a href="{{ route('personal.edit', $personal->IdPersonal) }}" class="material-btn material-btn-primary flex items-center">
                    <i class="material-icons text-sm mr-2">edit</i>
                    Editar Personal
                </a> --}}
            </div>
        </div>
    </div>
    
    <div class="material-card shadow-xl rounded-lg max-w-4xl mx-auto">
        <div class="p-6">
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8 border-b pb-6">
                <div class="col-span-1 border-r pr-6">
                    <p class="text-sm font-semibold text-gray-500 mb-1">ID Personal</p>
                    <p class="text-2xl font-bold text-indigo-700">{{ $personal->IdPersonal }}</p>
                    <p class="mt-4 text-sm font-semibold text-gray-500 mb-1">Estado</p>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium 
                        @if($personal->Estado == 'Activo') 
                            bg-green-100 text-green-800
                        @else 
                            bg-red-100 text-red-800 
                        @endif">
                        <i class="material-icons text-xs mr-1">{{ $personal->Estado == 'Activo' ? 'check_circle' : 'do_not_disturb_on' }}</i>
                        {{ $personal->Estado }}
                    </span>
                </div>

                <div class="col-span-1 border-r pr-6">
                    <p class="text-sm font-semibold text-gray-500 mb-1">Nombre Completo</p>
                    <p class="text-xl font-bold text-gray-900">{{ $personal->Nombre }} {{ $personal->Apellido }}</p>
                </div>
                
                <div class="col-span-1">
                    <p class="text-sm font-semibold text-gray-500 mb-1">Cargo</p>
                    <p class="text-xl font-bold text-blue-700">{{ $personal->Cargo }}</p>
                    <p class="mt-4 text-sm font-semibold text-gray-500 mb-1">Salario (Q)</p>
                    <p class="text-xl font-bold text-green-700">Q {{ number_format($personal->Salario, 2) }}</p>
                </div>
            </div>
            
            <h5 class="text-lg font-semibold text-gray-700 border-b pb-3 mb-6 flex items-center">
                <i class="material-icons text-sm mr-2 text-gray-500">info</i>
                Detalles del Empleo y Contacto
            </h5>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <div class="space-y-4">
                    <div>
                        <p class="text-sm font-semibold text-gray-500 mb-1 flex items-center"><i class="material-icons text-sm mr-1">event</i> Fecha de Ingreso</p>
                        <p class="text-gray-800 font-medium">{{ \Carbon\Carbon::parse($personal->FechaIngreso)->locale('es')->isoFormat('D MMMM YYYY') }}</p>
                    </div>

                    <div>
                        <p class="text-sm font-semibold text-gray-500 mb-1 flex items-center"><i class="material-icons text-sm mr-1">location_on</i> Dirección</p>
                        <p class="text-gray-800 font-medium">{{ $personal->Direccion }}</p>
                    </div>
                </div>

                <div class="space-y-4">
                    <div>
                        <p class="text-sm font-semibold text-gray-500 mb-1 flex items-center"><i class="material-icons text-sm mr-1">phone</i> Teléfono</p>
                        <p class="text-gray-800 font-medium">{{ $personal->Telefono }}</p>
                    </div>
                    
                    <div>
                        <p class="text-sm font-semibold text-gray-500 mb-1 flex items-center"><i class="material-icons text-sm mr-1">email</i> Correo Electrónico</p>
                        <p class="text-blue-600 font-medium break-all">{{ $personal->Correo }}</p>
                    </div>
                </div>
            </div>

            <div class="flex justify-start mt-8 pt-6 border-t border-gray-200">
                <a href="{{ route('personal.listar') }}" class="material-btn material-btn-secondary flex items-center px-6">
                    <i class="material-icons text-sm mr-2">close</i>
                    Cerrar
                </a>
            </div>
        </div>
    </div>
</div>
@endsection