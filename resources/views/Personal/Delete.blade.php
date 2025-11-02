@extends('layouts.app')

@section('page-title', 'Confirmar Eliminación')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex flex-col items-center justify-center min-h-[70vh]">
        
        <div class="material-card shadow-2xl rounded-lg max-w-lg w-full border-t-8 border-red-500">
            
            <div class="p-8 text-center">
                <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-red-100 mb-5">
                    <i class="material-icons text-red-600 text-3xl">warning</i>
                </div>
                
                <h5 class="text-3xl font-extrabold text-red-700 mb-4">
                    ¡ATENCIÓN! Acción Irreversible
                </h5>
                
                <p class="text-gray-700 text-xl font-semibold mb-8">
                    ¿Estás seguro de que deseas eliminar permanentemente al empleado **{{ $personal->Nombre }} {{ $personal->Apellido }}**?
                </p>

                <div class="bg-red-50 p-6 rounded-xl border border-red-200 mb-8 text-left">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="text-lg font-bold text-gray-600 flex items-center"><i class="material-icons text-md mr-2">badge</i> ID:</div>
                        <div class="text-xl font-extrabold text-gray-900">{{ $personal->IdPersonal }}</div>
                        
                        <div class="text-lg font-bold text-gray-600 flex items-center"><i class="material-icons text-md mr-2">person</i> Nombre:</div>
                        <div class="text-xl font-bold text-gray-900">{{ $personal->Nombre }} {{ $personal->Apellido }}</div>
                        
                        <div class="text-lg font-bold text-gray-600 flex items-center"><i class="material-icons text-md mr-2">work</i> Cargo:</div>
                        <div class="text-xl font-bold text-gray-900">{{ $personal->Cargo }}</div>
                    </div>
                </div>

                <div class="flex justify-center space-x-4 mt-8">
                    <a href="{{ route('personal.listar') }}" class="material-btn material-btn-secondary flex items-center px-8 py-3 text-lg">
                        <i class="material-icons text-md mr-2">cancel</i>
                        Cancelar
                    </a>
                    
                    <form action="{{ route('personal.destroy', $personal->IdPersonal) }}" method="POST" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" style="background: linear-gradient(135deg, var(--color-danger), #f56565); color: white; padding: 12px 24px; font-size: 1rem; border: none;" class="material-btn flex items-center">
                            <i class="material-icons text-md mr-2">delete_forever</i>
                            Sí, Eliminar Personal
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection