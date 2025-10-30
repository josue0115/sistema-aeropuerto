@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Crear Pasajeros</h4>
                    <p id="cantidad-display">Cantidad de personas: Cargando...</p>
                </div>
                <div class="card-body">
                    <form action="{{ route('pasajeros.store') }}" method="POST" id="pasajeros-form">
                        @csrf
                        <div id="pasajeros-container">
                            <!-- Los formularios de pasajeros se generarán aquí dinámicamente -->
                            <input type="hidden" name="pasajeros[0][idPasajero]" value="{{ old('pasajeros.0.idPasajero', 1) }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Crear Pasajeros</button>
                        <a href="{{ route('pasajeros.index') }}" class="btn btn-secondary">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Navigation Buttons -->
    <div class="container mt-4">
        <div class="row">
            <div class="col-12 text-center">
                <a href="{{ route('vuelos.disponibles') }}" class="btn btn-warning btn-lg me-2">Anterior: Vuelos</a>
                <a href="{{ route('boletos.create') }}" class="btn btn-success btn-lg">Siguiente: Boletos</a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const cantidadPersonas = sessionStorage.getItem('cantidadPersonas') || 1;
    const cantidadDisplay = document.getElementById('cantidad-display');
    const container = document.getElementById('pasajeros-container');

    cantidadDisplay.textContent = `Cantidad de personas: ${cantidadPersonas}`;

    for (let i = 0; i < cantidadPersonas; i++) {
        const pasajeroDiv = document.createElement('div');
        pasajeroDiv.className = 'pasajero-section mb-4';
        pasajeroDiv.innerHTML = `
            <h5>Pasajero ${i + 1}</h5>
            <div class="row">
                <div class="col-md-6 mb-3" style="display: none;">
                    <label for="idPasajero_${i}" class="form-label">ID Pasajero</label>
                    <input type="number" class="form-control" id="idPasajero_${i}" name="pasajeros[${i}][idPasajero]" value="${i + 1}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="Nombre_${i}" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="Nombre_${i}" name="pasajeros[${i}][Nombre]" maxlength="45" required>

                </div>
                <div class="col-md-6 mb-3">
                    <label for="Apellido_${i}" class="form-label">Apellido</label>
                    <input type="text" class="form-control" id="Apellido_${i}" name="pasajeros[${i}][Apellido]" maxlength="45" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="Pais_${i}" class="form-label">País</label>
                    <select class="form-control" id="Pais_${i}" name="pasajeros[${i}][Pais]" required>
                        <option value="">Seleccione un país</option>
                        <option value="México">México</option>
                        <option value="Estados Unidos">Estados Unidos</option>
                        <option value="Canadá">Canadá</option>
                        <option value="España">España</option>
                        <option value="Francia">Francia</option>
                        <option value="Alemania">Alemania</option>
                        <option value="Italia">Italia</option>
                        <option value="Reino Unido">Reino Unido</option>
                        <option value="Brasil">Brasil</option>
                        <option value="Argentina">Argentina</option>
                        <option value="Chile">Chile</option>
                        <option value="Colombia">Colombia</option>
                        <option value="Perú">Perú</option>
                        <option value="Venezuela">Venezuela</option>
                        <option value="Ecuador">Ecuador</option>
                        <option value="Uruguay">Uruguay</option>
                        <option value="Paraguay">Paraguay</option>
                        <option value="Bolivia">Bolivia</option>
                        <option value="Panamá">Panamá</option>
                        <option value="Costa Rica">Costa Rica</option>
                        <option value="Nicaragua">Nicaragua</option>
                        <option value="Honduras">Honduras</option>
                        <option value="El Salvador">El Salvador</option>
                        <option value="Guatemala">Guatemala</option>
                        <option value="Belice">Belice</option>
                        <option value="Cuba">Cuba</option>
                        <option value="República Dominicana">República Dominicana</option>
                        <option value="Puerto Rico">Puerto Rico</option>
                        <option value="Jamaica">Jamaica</option>
                        <option value="Haití">Haití</option>
                        <option value="Trinidad y Tobago">Trinidad y Tobago</option>
                        <option value="Barbados">Barbados</option>
                        <option value="Bahamas">Bahamas</option>
                        <option value="Antigua y Barbuda">Antigua y Barbuda</option>
                        <option value="San Cristóbal y Nieves">San Cristóbal y Nieves</option>
                        <option value="Santa Lucía">Santa Lucía</option>
                        <option value="San Vicente y las Granadinas">San Vicente y las Granadinas</option>
                        <option value="Granada">Granada</option>
                        <option value="Dominica">Dominica</option>
                        <option value="Surinam">Surinam</option>
                        <option value="Guyana">Guyana</option>
                        <option value="Guyana Francesa">Guyana Francesa</option>
                        <option value="Aruba">Aruba</option>
                        <option value="Curazao">Curazao</option>
                        <option value="Bonaire">Bonaire</option>
                        <option value="Saba">Saba</option>
                        <option value="San Eustaquio">San Eustaquio</option>
                        <option value="San Martín">San Martín</option>
                        <option value="Islas Vírgenes Británicas">Islas Vírgenes Británicas</option>
                        <option value="Islas Vírgenes de los Estados Unidos">Islas Vírgenes de los Estados Unidos</option>
                        <option value="Islas Caimán">Islas Caimán</option>
                        <option value="Islas Turcas y Caicos">Islas Turcas y Caicos</option>
                        <option value="Bermudas">Bermudas</option>
                        <option value="Groenlandia">Groenlandia</option>
                        <option value="Islas Feroe">Islas Feroe</option>
                        <option value="Islandia">Islandia</option>
                        <option value="Noruega">Noruega</option>
                        <option value="Suecia">Suecia</option>
                        <option value="Finlandia">Finlandia</option>
                        <option value="Dinamarca">Dinamarca</option>
                        <option value="Países Bajos">Países Bajos</option>
                        <option value="Bélgica">Bélgica</option>
                        <option value="Luxemburgo">Luxemburgo</option>
                        <option value="Suiza">Suiza</option>
                        <option value="Austria">Austria</option>
                        <option value="Hungría">Hungría</option>
                        <option value="República Checa">República Checa</option>
                        <option value="Eslovaquia">Eslovaquia</option>
                        <option value="Polonia">Polonia</option>
                        <option value="Eslovenia">Eslovenia</option>
                        <option value="Croacia">Croacia</option>
                        <option value="Bosnia y Herzegovina">Bosnia y Herzegovina</option>
                        <option value="Serbia">Serbia</option>
                        <option value="Montenegro">Montenegro</option>
                        <option value="Kosovo">Kosovo</option>
                        <option value="Macedonia del Norte">Macedonia del Norte</option>
                        <option value="Albania">Albania</option>
                        <option value="Grecia">Grecia</option>
                        <option value="Bulgaria">Bulgaria</option>
                        <option value="Rumania">Rumania</option>
                        <option value="Moldavia">Moldavia</option>
                        <option value="Ucrania">Ucrania</option>
                        <option value="Bielorrusia">Bielorrusia</option>
                        <option value="Rusia">Rusia</option>
                        <option value="Lituania">Lituania</option>
                        <option value="Letonia">Letonia</option>
                        <option value="Estonia">Estonia</option>
                        <option value="Portugal">Portugal</option>
                        <option value="Andorra">Andorra</option>
                        <option value="Mónaco">Mónaco</option>
                        <option value="San Marino">San Marino</option>
                        <option value="Ciudad del Vaticano">Ciudad del Vaticano</option>
                        <option value="Liechtenstein">Liechtenstein</option>
                        <option value="Malta">Malta</option>
                        <option value="Chipre">Chipre</option>
                        <option value="Turquía">Turquía</option>
                        <option value="Israel">Israel</option>
                        <option value="Líbano">Líbano</option>
                        <option value="Jordania">Jordania</option>
                        <option value="Siria">Siria</option>
                        <option value="Irak">Irak</option>
                        <option value="Irán">Irán</option>
                        <option value="Kuwait">Kuwait</option>
                        <option value="Arabia Saudita">Arabia Saudita</option>
                        <option value="Bahréin">Bahréin</option>
                        <option value="Qatar">Qatar</option>
                        <option value="Emiratos Árabes Unidos">Emiratos Árabes Unidos</option>
                        <option value="Omán">Omán</option>
                        <option value="Yemen">Yemen</option>
                        <option value="Egipto">Egipto</option>
                        <option value="Libia">Libia</option>
                        <option value="Túnez">Túnez</option>
                        <option value="Argelia">Argelia</option>
                        <option value="Marruecos">Marruecos</option>
                        <option value="Mauritania">Mauritania</option>
                        <option value="Mali">Mali</option>
                        <option value="Níger">Níger</option>
                        <option value="Chad">Chad</option>
                        <option value="Sudán">Sudán</option>
                        <option value="Sudán del Sur">Sudán del Sur</option>
                        <option value="Eritrea">Eritrea</option>
                        <option value="Yibuti">Yibuti</option>
                        <option value="Somalia">Somalia</option>
                        <option value="Etiopía">Etiopía</option>
                        <option value="Kenia">Kenia</option>
                        <option value="Tanzania">Tanzania</option>
                        <option value="Uganda">Uganda</option>
                        <option value="Ruanda">Ruanda</option>
                        <option value="Burundi">Burundi</option>
                        <option value="República Democrática del Congo">República Democrática del Congo</option>
                        <option value="República del Congo">República del Congo</option>
                        <option value="Gabón">Gabón</option>
                        <option value="Camerún">Camerún</option>
                        <option value="República Centroafricana">República Centroafricana</option>
                        <option value="Guinea Ecuatorial">Guinea Ecuatorial</option>
                        <option value="Sao Tomé y Príncipe">Sao Tomé y Príncipe</option>
                        <option value="Angola">Angola</option>
                        <option value="Zambia">Zambia</option>
                        <option value="Zimbabue">Zimbabue</option>
                        <option value="Malawi">Malawi</option>
                        <option value="Mozambique">Mozambique</option>
                        <option value="Namibia">Namibia</option>
                        <option value="Botsuana">Botsuana</option>
                        <option value="Suazilandia">Suazilandia</option>
                        <option value="Lesoto">Lesoto</option>
                        <option value="Sudáfrica">Sudáfrica</option>
                        <option value="India">India</option>
                        <option value="Pakistán">Pakistán</option>
                        <option value="Bangladés">Bangladés</option>
                        <option value="Sri Lanka">Sri Lanka</option>
                        <option value="Nepal">Nepal</option>
                        <option value="Bután">Bután</option>
                        <option value="Maldivas">Maldivas</option>
                        <option value="Afganistán">Afganistán</option>
                        <option value="China">China</option>
                        <option value="Japón">Japón</option>
                        <option value="Corea del Sur">Corea del Sur</option>
                        <option value="Corea del Norte">Corea del Norte</option>
                        <option value="Mongolia">Mongolia</option>
                        <option value="Taiwán">Taiwán</option>
                        <option value="Hong Kong">Hong Kong</option>
                        <option value="Macao">Macao</option>
                        <option value="Singapur">Singapur</option>
                        <option value="Malasia">Malasia</option>
                        <option value="Indonesia">Indonesia</option>
                        <option value="Filipinas">Filipinas</option>
                        <option value="Tailandia">Tailandia</option>
                        <option value="Vietnam">Vietnam</option>
                        <option value="Camboya">Camboya</option>
                        <option value="Laos">Laos</option>
                        <option value="Myanmar">Myanmar</option>
                        <option value="Brunéi">Brunéi</option>
                        <option value="Timor Oriental">Timor Oriental</option>
                        <option value="Australia">Australia</option>
                        <option value="Nueva Zelanda">Nueva Zelanda</option>
                        <option value="Papúa Nueva Guinea">Papúa Nueva Guinea</option>
                        <option value="Islas Salomón">Islas Salomón</option>
                        <option value="Vanuatu">Vanuatu</option>
                        <option value="Fiyi">Fiyi</option>
                        <option value="Samoa">Samoa</option>
                        <option value="Tonga">Tonga</option>
                        <option value="Tuvalu">Tuvalu</option>
                        <option value="Kiribati">Kiribati</option>
                        <option value="Islas Marshall">Islas Marshall</option>
                        <option value="Micronesia">Micronesia</option>
                        <option value="Palaos">Palaos</option>
                        <option value="Nauru">Nauru</option>
                        <option value="Otros">Otros</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="TipoPasajero_${i}" class="form-label">Tipo Pasajero</label>
                    <select class="form-control" id="TipoPasajero_${i}" name="pasajeros[${i}][TipoPasajero]" required>
                        <option value="">Seleccione un tipo</option>
                        <option value="Adulto">Adulto</option>
                        <option value="Niño">Niño</option>
                        <option value="Bebé">Bebé</option>
                        <option value="Estudiante">Estudiante</option>
                        <option value="Senior">Senior</option>
                        <option value="Militar">Militar</option>
                        <option value="Discapacitado">Discapacitado</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="Estado_${i}" class="form-label">Estado</label>
                    <select class="form-control" id="Estado_${i}" name="pasajeros[${i}][Estado]" required>
                        <option value="">Seleccione un estado</option>
                        <option value="Activo">Activo</option>
                        <option value="Inactivo">Inactivo</option>
                        <option value="Suspendido">Suspendido</option>
                        <option value="Bloqueado">Bloqueado</option>
                    </select>
                </div>
            </div>

        `;
        container.appendChild(pasajeroDiv);
    }
});
</script>
@endsection
