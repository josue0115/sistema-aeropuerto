<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;
use App\Models\Vuelo;
use App\Models\Pasajero;
use App\Models\Boleto;
use App\Models\Servicio;
use App\Models\Asiento;



// Home
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Inicio', route('home'));
});

// Home > Vuelos
Breadcrumbs::for('vuelos.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Vuelos', route('vuelos.index'));
});

// Home > Vuelos > Crear
Breadcrumbs::for('vuelos.create', function (BreadcrumbTrail $trail) {
    $trail->parent('vuelos.index');
    $trail->push('Crear Vuelo', route('vuelos.create'));
});

// Home > Vuelos > [Vuelo]
Breadcrumbs::for('vuelos.show', function (BreadcrumbTrail $trail, $vuelo) {
    $trail->parent('vuelos.index');
    $id = is_object($vuelo) ? $vuelo->idVuelo : $vuelo;
    $result = Vuelo::obtenerPorId($id);
    $vueloObj = $result ? (object) $result[0] : abort(404);
    $trail->push('Vuelo ' . $vueloObj->idVuelo, route('vuelos.show', $id));
});

// Home > Vuelos > [Vuelo] > Editar
Breadcrumbs::for('vuelos.edit', function (BreadcrumbTrail $trail, $vuelo) {
    $trail->parent('vuelos.show', $vuelo);
    $id = is_object($vuelo) ? $vuelo->idVuelo : $vuelo;
    $trail->push('Editar', route('vuelos.edit', $id));
});

// Home > Pasajeros
Breadcrumbs::for('pasajeros.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Pasajeros', route('pasajeros.index'));
});

// Home > Pasajeros > Crear
Breadcrumbs::for('pasajeros.create', function (BreadcrumbTrail $trail) {
    $trail->parent('pasajeros.index');
    $trail->push('Crear Pasajero', route('pasajeros.create'));
});

// Home > Pasajeros > [Pasajero]
Breadcrumbs::for('pasajeros.show', function (BreadcrumbTrail $trail, $pasajero) {
    $id = is_object($pasajero) ? $pasajero->idPasajero : $pasajero;
    $result = Pasajero::obtenerPorId($id);
    $pasajeroObj = $result ? (object) $result[0] : abort(404);
    $trail->parent('pasajeros.index');
    $trail->push($pasajeroObj->Nombre . ' ' . $pasajeroObj->Apellido, route('pasajeros.show', $id));
});

// Home > Pasajeros > [Pasajero] > Editar
Breadcrumbs::for('pasajeros.edit', function (BreadcrumbTrail $trail, $pasajero) {
    $id = is_object($pasajero) ? $pasajero->idPasajero : $pasajero;
    $result = Pasajero::obtenerPorId($id);
    $pasajeroObj = $result ? (object) $result[0] : abort(404);
    $trail->parent('pasajeros.show', $pasajero);
    $trail->push('Editar', route('pasajeros.edit', $id));
});

// Home > Boletos
Breadcrumbs::for('boletos.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Boletos', route('boletos.index'));
});

// Home > Boletos > Crear
Breadcrumbs::for('boletos.create', function (BreadcrumbTrail $trail) {
    $trail->parent('boletos.index');
    $trail->push('Crear Boleto', route('boletos.create'));
});

// Home > Boletos > [Boleto]
// Breadcrumbs::for('boletos.show', function (BreadcrumbTrail $trail, $boleto) {
//     //  $boleto = Boleto::findOrFail($id); // Usa Eloquent aquí solo para el breadcrumb

//     $trail->parent('boletos.index');
//     $trail->push('Boleto ' . $boleto->idBoleto, route('boletos.show', $idBoleto));
// });

Breadcrumbs::for('boletos.show', function (BreadcrumbTrail $trail, $boleto) {
    // $boleto es un objeto stdClass, por eso no usar $id directamente
    $id = is_object($boleto) ? $boleto->idBoleto : $boleto;

    $result = Boleto::obtenerPorId($id);
    $boleto = $result ? (object) $result[0] : abort(404);

    $trail->parent('boletos.index');
    $trail->push('Boleto ' . $boleto->idBoleto, route('boletos.show', $boleto->idBoleto));
});



// Home > Boletos > [Boleto] > Editar
Breadcrumbs::for('boletos.edit', function (BreadcrumbTrail $trail, $boleto) {
    $trail->parent('boletos.show', $boleto);
   // $trail->push('Editar', route('boletos.edit', $boleto));
    $trail->push('Boleto ' . $boleto->idBoleto, route('boletos.edit', $boleto->idBoleto));
});

// Home > Servicios
Breadcrumbs::for('servicios.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Servicios', route('servicios.index'));
});

// Home > Servicios > Crear
Breadcrumbs::for('servicios.create', function (BreadcrumbTrail $trail) {
    $trail->parent('servicios.index');
    $trail->push('Crear Servicio', route('servicios.create'));
});

// Home > Servicios > [Servicio]
Breadcrumbs::for('servicios.show', function (BreadcrumbTrail $trail, $servicio) {
    $trail->parent('servicios.index');
    $id = is_object($servicio) ? $servicio->idServicio : $servicio;
    $result = Servicio::obtenerPorId($id);
    $servicioObj = $result ? (object) $result[0] : abort(404);
    $trail->push('Servicio ' . $servicioObj->idServicio, route('servicios.show', $id));
});

// Home > Servicios > [Servicio] > Editar
Breadcrumbs::for('servicios.edit', function (BreadcrumbTrail $trail, $servicio) {
    $id = is_object($servicio) ? $servicio->idServicio : $servicio;
    $result = Servicio::obtenerPorId($id);
    $servicioObj = $result ? (object) $result[0] : abort(404);
    $trail->parent('servicios.show', $servicio);
    $trail->push('Editar', route('servicios.edit', $id));
});

// Home > Asientos
Breadcrumbs::for('asientos.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Asientos', route('asientos.index'));
});

// Home > Asientos > Crear
Breadcrumbs::for('asientos.create', function (BreadcrumbTrail $trail) {
    $trail->parent('asientos.index');
    $trail->push('Crear Asiento', route('asientos.create'));
});

// Home > Asientos > [Asiento]
Breadcrumbs::for('asientos.show', function (BreadcrumbTrail $trail, $asiento) {
    $trail->parent('asientos.index');
    $trail->push('Asiento ' . $asiento->idAsiento, route('asientos.show', $asiento));
});

// Home > Asientos > [Asiento] > Editar
Breadcrumbs::for('asientos.edit', function (BreadcrumbTrail $trail, $asiento) {
    $trail->parent('asientos.show', $asiento);
    $trail->push('Editar', route('asientos.edit', $asiento));
});

// Reservation Flow Breadcrumbs
// Home > Reserva > Vuelos
Breadcrumbs::for('reservation.vuelos', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Reserva', '#');
    $trail->push('Vuelos', route('vuelos.create'));
});

// Home > Reserva > Vuelos > Pasajeros
Breadcrumbs::for('reservation.pasajeros', function (BreadcrumbTrail $trail) {
    $trail->parent('reservation.vuelos');
    $trail->push('Pasajeros', route('pasajeros.create'));
});

// Home > Reserva > Vuelos > Pasajeros > Boletos
Breadcrumbs::for('reservation.boletos', function (BreadcrumbTrail $trail) {
    $trail->parent('reservation.pasajeros');
    $trail->push('Boletos', route('boletos.create'));
});

// Home > Reserva > Vuelos > Pasajeros > Boletos > Servicios
Breadcrumbs::for('reservation.servicios', function (BreadcrumbTrail $trail) {
    $trail->parent('reservation.boletos');
    $trail->push('Servicios', route('servicios.create'));
});

// Home > Reserva > Vuelos > Pasajeros > Boletos > Servicios > Asientos
Breadcrumbs::for('reservation.asientos', function (BreadcrumbTrail $trail) {
    $trail->parent('reservation.servicios');
    $trail->push('Asientos', route('asientos.create'));
});
