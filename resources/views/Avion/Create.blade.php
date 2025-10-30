@extends('layouts.app')

@section('page-title', 'Crear Avión - Sistema Aeropuerto')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="material-card">
        <div class="p-6 border-b border-gray-200">
            <h1 class="text-2xl font-semibold text-gray-800">
                <i class="material-icons text-purple-600 mr-2">add</i>
                Crear Nuevo Avión
            </h1>
            <p class="text-gray-600 mt-1">Complete la información para agregar un nuevo avión al sistema</p>
        </div>

        <div class="p-6">
            <form method="POST" action="{{ route('avion.store') }}" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="idAerolinea" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="material-icons text-sm mr-1">flight</i>
                            Aerolínea
                        </label>
                        <select name="idAerolinea" id="idAerolinea" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500" required>
                            <option value="">Seleccione una aerolínea</option>
                            @foreach($aerolineas as $aero)
                                <option value="{{ $aero->idAerolinea }}">{{ $aero->idAerolinea }} - {{ $aero->Nombre }}</option>
                            @endforeach
                        </select>
                        @error('IdAerolinea')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="Tipo" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="material-icons text-sm mr-1">category</i> Tipo
                        </label>
                        <select name="Tipo" id="Tipo" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500" 
                            required>
                            <option value="" disabled selected>Selecciona el tipo de aeronave</option>
                            
                            <!-- Pasajeros -->
                            <optgroup label="Aeronaves de Pasajeros">
                                <option value="Comercial Internacional">Comercial Internacional</option>
                                <option value="Comercial Doméstico">Comercial Doméstico</option>
                                <option value="Regional">Regional</option>
                                <option value="Ejecutivo / Privado">Ejecutivo / Privado</option>
                            </optgroup>

                            <!-- Carga -->
                            <optgroup label="Aeronaves de Carga">
                                <option value="Carga Pura">Carga Pura</option>
                                <option value="Mixto (Pasajeros + Carga)">Mixto (Pasajeros + Carga)</option>
                            </optgroup>

                            <!-- Otros Tipos -->
                            <optgroup label="Otros Tipos de Aeronaves">
                                <option value="Militar">Militar</option>
                                <option value="Entrenamiento">Entrenamiento</option>
                                <option value="Helicóptero">Helicóptero</option>
                                <option value="Rescate / Ambulancia Aérea">Rescate / Ambulancia Aérea</option>
                                <option value="Servicios Aéreos Especiales">Servicios Aéreos Especiales (fumigación, fotografía, etc.)</option>
                                <option value="Dron / UAV">Dron / UAV</option>
                            </optgroup>                            </select>

                        @error('Tipo')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror


                    </div>

                    <div>
                        <label for="Modelo" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="material-icons text-sm mr-1">build</i>
                            Modelo
                        </label>
                       <select name="Modelo" id="Modelo"    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500" required>
                                <option value="" disabled selected>Selecciona el modelo</option>

                                <optgroup label="Airbus">
                                    <option value="A220">A220</option>
                                    <option value="A320">A320</option>
                                    <option value="A321">A321</option>
                                    <option value="A330">A330</option>
                                    <option value="A350">A350</option>
                                    <option value="A380">A380</option>
                                </optgroup>

                                <optgroup label="Boeing">
                                    <option value="B737">737</option>
                                    <option value="B747">747</option>
                                    <option value="B757">757</option>
                                    <option value="B767">767</option>
                                    <option value="B777">777</option>
                                    <option value="B787">787 Dreamliner</option>
                                </optgroup>

                                <optgroup label="Embraer">
                                    <option value="E170">E170</option>
                                    <option value="E190">E190</option>
                                    <option value="E195">E195</option>
                                </optgroup>

                                <optgroup label="Bombardier">
                                    <option value="CRJ200">CRJ200</option>
                                    <option value="CRJ700">CRJ700</option>
                                    <option value="CRJ900">CRJ900</option>
                                </optgroup>

                                <optgroup label="Cessna / Aviones Pequeños">
                                    <option value="C172">Cessna 172</option>
                                    <option value="C208 Caravan">Cessna 208 Caravan</option>
                                    <option value="Citation X">Citation X</option>
                                </optgroup>

                                <optgroup label="Helicópteros">
                                    <option value="Bell 206">Bell 206</option>
                                    <option value="Sikorsky S-76">Sikorsky S-76</option>
                                    <option value="Airbus H145">Airbus H145</option>
                                </optgroup>
                            </select>
                        @error('Modelo')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="Capacidad" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="material-icons text-sm mr-1">people</i>
                            Capacidad
                        </label>
                        <input type="number" name="Capacidad" id="Capacidad" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500" required>
                        @error('Capacidad')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="Placa" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="material-icons text-sm mr-1">credit_card</i>
                            Placa
                        </label>
                        <input type="hidden" name="Placa" id="Placa" value="{{ $placaPreview }}">
                        <input type="text" id="Placa" class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100"  value="{{ $placaPreview }}"readonly>
                        @error('Placa')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="Estado" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="material-icons text-sm mr-1">toggle_on</i>
                            Estado
                        </label>
                        <select name="Estado" id="Estado" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500" required>
                            <option value="Activo">Activo</option>
                            <option value="Inactivo">Inactivo</option>
                        </select>
                        @error('Estado')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
                    <a href="{{ route('avion.listar') }}" class="material-btn border border-gray-300 text-gray-700 hover:bg-gray-50">
                        <i class="material-icons text-sm mr-2">cancel</i>
                        Cancelar
                    </a>
                    <button type="submit" class="material-btn material-btn-primary">
                        <i class="material-icons text-sm mr-2">save</i>
                        Crear Avión
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
