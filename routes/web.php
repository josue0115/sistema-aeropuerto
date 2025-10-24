<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HistorialVueloController;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\FacturaController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\EquipajeController;
use App\Http\Controllers\BoletoController;
use App\Http\Controllers\PasajeroController;
use App\Http\Controllers\AerolineaController;
use App\Http\Controllers\AvionController;
use App\Http\Controllers\PersonalController;
use App\Http\Controllers\MantenimientoController;
use App\Http\Controllers\VueloController;
use App\Http\Controllers\HorarioController;
use App\Http\Controllers\EscalaController;
//use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AsientoController;
use App\Http\Controllers\TipoServicioController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AeropuertoController;
use App\Http\Controllers\PagoController;

Route::get('/', [HomeController::class, 'index'])->name('home');
// Mostrar lista de aeropuertos
Route::get('aeropuerto/Listar', [AeropuertoController::class, 'Listar'])->name('aeropuerto.listar');
Route::get('/aeropuertos', [AeropuertoController::class, 'Listar'])->name('aeropuertos.index');
// Mostrar formulario para crear
Route::get('aeropuerto/create', [AeropuertoController::class, 'create'])->name('aeropuerto.create');
// Mostrar detalles
Route::get('aeropuerto/{aeropuerto}', [AeropuertoController::class, 'show'])->name('aeropuerto.show');
// Mostrar formulario para editar
Route::get('aeropuerto/{aeropuerto}/edit', [AeropuertoController::class, 'edit'])->name('aeropuerto.edit');
// Mostrar confirmación para eliminar
Route::get('aeropuerto/{aeropuerto}/delete', [AeropuertoController::class, 'delete'])->name('aeropuerto.delete');
// API para obtener ciudades


// Crear, actualizar y eliminar aeropuertos desde modal
Route::post('/aeropuerto/store', [AeropuertoController::class, 'store'])->name('aeropuerto.store');
Route::put('/aeropuerto/update/{aeropuerto}', [AeropuertoController::class, 'update'])->name('aeropuerto.update');
Route::delete('/aeropuerto/destroy/{aeropuerto}', [AeropuertoController::class, 'destroy'])->name('aeropuerto.destroy');

// Rutas para Aerolinea
Route::get('/aerolinea/Listar', [AerolineaController::class, 'Listar'])->name('aerolinea.Listar');
Route::get('/aerolineas', [AerolineaController::class, 'Listar'])->name('aerolineas.index');
// Mostrar formulario para crear
Route::get('aerolinea/create', [AerolineaController::class, 'create'])->name('aerolinea.create');
// Mostrar detalles
Route::get('aerolinea/{aerolinea}', [AerolineaController::class, 'show'])->name('aerolinea.show');
// Mostrar formulario para editar
Route::get('aerolinea/{aerolinea}/edit', [AerolineaController::class, 'edit'])->name('aerolinea.edit');
// Mostrar confirmación para eliminar
Route::get('aerolinea/{aerolinea}/delete', [AerolineaController::class, 'delete'])->name('aerolinea.delete');
Route::post('/aerolinea/store', [AerolineaController::class, 'store'])->name('aerolinea.store');
Route::put('/aerolinea/update/{aerolinea}', [AerolineaController::class, 'update'])->name('aerolinea.update');
Route::delete('/aerolinea/destroy/{aerolinea}', [AerolineaController::class, 'destroy'])->name('aerolinea.destroy');
Route::resource('historial_vuelos', HistorialVueloController::class);


// Rutas para Avion
// Listar aviones
Route::get('/avion/Listar', [AvionController::class, 'Listar'])->name('avion.listar');
// Mostrar formulario para crear
Route::get('avion/create', [AvionController::class, 'create'])->name('avion.create');
// Mostrar detalles
Route::get('avion/{avion}', [AvionController::class, 'show'])->name('avion.show');
// Mostrar formulario para editar
Route::get('avion/{avion}/edit', [AvionController::class, 'edit'])->name('avion.edit');
// Mostrar confirmación para eliminar
Route::get('avion/{avion}/delete', [AvionController::class, 'delete'])->name('avion.delete');
// CRUD: store, update y destroy
Route::post('/avion/store', [AvionController::class, 'store'])->name('avion.store');
Route::put('/avion/update/{avion}', [AvionController::class, 'update'])->name('avion.update');
Route::delete('/avion/destroy/{avion}', [AvionController::class, 'destroy'])->name('avion.destroy');
Route::resource('servicios', ServicioController::class);

// Rutas para Personal
// Listar personal
Route::get('/personal/Listar', [PersonalController::class, 'Listar'])->name('personal.listar');
// Mostrar formulario para crear
Route::get('/personal/create', [PersonalController::class, 'create'])->name('personal.create');
// Mostrar detalles
Route::get('/personal/{personal}', [PersonalController::class, 'show'])->name('personal.show');
// Mostrar formulario para editar
Route::get('/personal/{personal}/edit', [PersonalController::class, 'edit'])->name('personal.edit');
// Mostrar confirmación de eliminación
Route::get('/personal/{personal}/delete', [PersonalController::class, 'delete'])->name('personal.delete');
// Rutas para Pagos
Route::get('pagos/success', [PagoController::class, 'success'])->name('pagos.success');
Route::resource('pagos', PagoController::class);

// Rutas para Facturas
Route::resource('facturas', FacturaController::class);
Route::get('facturas/{factura}/pdf', [FacturaController::class, 'generatePdf'])->name('facturas.pdf');
// Guardar, actualizar y eliminar
Route::post('/personal/store', [PersonalController::class, 'store'])->name('personal.store');
Route::put('/personal/update/{personal}', [PersonalController::class, 'update'])->name('personal.update');
Route::delete('/personal/destroy/{personal}', [PersonalController::class, 'destroy'])->name('personal.destroy');
// Rutas para Reservas
Route::resource('reservas', ReservaController::class);
Route::resource('equipajes', EquipajeController::class);
// Rutas para Mantenimiento
// Listar mantenimientos
Route::get('/mantenimiento/Listar', [MantenimientoController::class, 'Listar'])->name('mantenimiento.listar');
// Mostrar formulario para crear
Route::get('/mantenimiento/create', [MantenimientoController::class, 'create'])->name('mantenimiento.create');
// Mostrar detalles
Route::get('/mantenimiento/{mantenimiento}', [MantenimientoController::class, 'show'])->name('mantenimiento.show');
// Mostrar formulario para editar
Route::get('/mantenimiento/{mantenimiento}/edit', [MantenimientoController::class, 'edit'])->name('mantenimiento.edit');
// Mostrar confirmación para eliminar
Route::get('/mantenimiento/{mantenimiento}/delete', [MantenimientoController::class, 'delete'])->name('mantenimiento.delete');
// Guardar, actualizar y eliminar
Route::post('/mantenimiento/store', [MantenimientoController::class, 'store'])->name('mantenimiento.store');
Route::put('/mantenimiento/update/{mantenimiento}', [MantenimientoController::class, 'update'])->name('mantenimiento.update');
Route::delete('/mantenimiento/destroy/{mantenimiento}', [MantenimientoController::class, 'destroy'])->name('mantenimiento.destroy');

// Rutas para Vuelo
// Listar vuelos
Route::get('/vuelo', [VueloController::class, 'index'])->name('vuelo.index');
Route::get('/vuelos', [VueloController::class, 'index'])->name('vuelos.index');
// Mostrar formulario para crear
Route::get('/vuelo/create', [VueloController::class, 'create'])->name('vuelo.create');
Route::get('/vuelos/create', [VueloController::class, 'create'])->name('vuelos.create');
// Vuelos Disponibles
Route::get('/vuelos/disponibles', [VueloController::class, 'listarDisponibles'])->name('vuelos.disponibles');
// Mostrar detalles
Route::get('/vuelo/{vuelo}', [VueloController::class, 'show'])->name('vuelo.show');
Route::resource('boletos', BoletoController::class);
Route::get('boletos/{boleto}/pdf', [BoletoController::class, 'generatePdf'])->name('boletos.pdf');
// Rutas para Pasajeros
Route::resource('pasajeros', PasajeroController::class);



// Mostrar formulario para editar
Route::get('/vuelo/{vuelo}/edit', [VueloController::class, 'edit'])->name('vuelo.edit');
// Mostrar confirmación para eliminar
Route::get('/vuelo/{vuelo}/delete', [VueloController::class, 'delete'])->name('vuelo.delete');
// Guardar, actualizar y eliminar
Route::post('/vuelo', [VueloController::class, 'store'])->name('vuelo.store');
Route::post('/vuelos', [VueloController::class, 'store'])->name('vuelos.store');
Route::put('/vuelo/{vuelo}', [VueloController::class, 'update'])->name('vuelo.update');
Route::delete('/vuelo/{vuelo}', [VueloController::class, 'destroy'])->name('vuelo.destroy');

// Rutas para Horario
// Listar horarios
Route::get('/horario/Listar', [HorarioController::class, 'index'])->name('horario.index');
// Mostrar formulario para crear
Route::get('/horario/create', [HorarioController::class, 'create'])->name('horario.create');
// Mostrar detalles
Route::get('/horario/{horario}', [HorarioController::class, 'show'])->name('horario.show');
// Mostrar formulario para editar
Route::get('/horario/{horario}/edit', [HorarioController::class, 'edit'])->name('horario.edit');
// Mostrar confirmación para eliminar
Route::get('/horario/{horario}/delete', [HorarioController::class, 'delete'])->name('horario.delete');
// Guardar, actualizar y eliminar
Route::post('/horario', [HorarioController::class, 'store'])->name('horario.store');
Route::put('/horario/{horario}', [HorarioController::class, 'update'])->name('horario.update');
Route::delete('/horario/{horario}', [HorarioController::class, 'destroy'])->name('horario.destroy');

// Rutas para Escala
// Listar escalas
Route::get('/escala/Listar', [EscalaController::class, 'index'])->name('escala.index');
// Mostrar formulario para crear
Route::get('/escala/create', [EscalaController::class, 'create'])->name('escala.create');
// Mostrar detalles
Route::get('/escala/{escala}', [EscalaController::class, 'show'])->name('escala.show');
// Mostrar formulario para editar
Route::get('/escala/{escala}/edit', [EscalaController::class, 'edit'])->name('escala.edit');
// Mostrar confirmación para eliminar
Route::get('/escala/{escala}/delete', [EscalaController::class, 'delete'])->name('escala.delete');
// Guardar, actualizar y eliminar
Route::post('/escala', [EscalaController::class, 'store'])->name('escala.store');
Route::put('/escala/{escala}', [EscalaController::class, 'update'])->name('escala.update');
Route::delete('/escala/{escala}', [EscalaController::class, 'destroy'])->name('escala.destroy');
// Rutas para Asientos
Route::get('/asientos/available-seats', [AsientoController::class, 'getAvailableSeats'])->name('asientos.available-seats');
Route::resource('asientos', AsientoController::class);
// Rutas para Horario
// Listar horarios
Route::get('/horario/Listar', [HorarioController::class, 'Listar'])->name('horario.listar');
// Mostrar formulario para crear
Route::get('/horario/create', [HorarioController::class, 'create'])->name('horario.create');
// Mostrar detalles
Route::get('/horario/{horario}', [HorarioController::class, 'show'])->name('horario.show');
// Mostrar formulario para editar
Route::get('/horario/{horario}/edit', [HorarioController::class, 'edit'])->name('horario.edit');
// Mostrar confirmación para eliminar
Route::get('/horario/{horario}/delete', [HorarioController::class, 'delete'])->name('horario.delete');
// Guardar, actualizar y eliminar
Route::post('/horario', [HorarioController::class, 'store'])->name('horario.store');
Route::put('/horario/{horario}', [HorarioController::class, 'update'])->name('horario.update');
Route::delete('/horario/{horario}', [HorarioController::class, 'destroy'])->name('horario.destroy');
Route::resource('tipo_servicios', TipoServicioController::class);
Route::resource('asientos', AsientoController::class);
// Rutas para Horario
// Listar horarios
Route::get('/horario', [HorarioController::class, 'index'])->name('horario.index');
// Mostrar formulario para crear
Route::get('/horario/create', [HorarioController::class, 'create'])->name('horario.create');
// Mostrar detalles
Route::get('/horario/{horario}', [HorarioController::class, 'show'])->name('horario.show');
// Mostrar formulario para editar
Route::get('/horario/{horario}/edit', [HorarioController::class, 'edit'])->name('horario.edit');
// Mostrar confirmación para eliminar
Route::get('/horario/{horario}/delete', [HorarioController::class, 'delete'])->name('horario.delete');
// Guardar, actualizar y eliminar
Route::post('/horario', [HorarioController::class, 'store'])->name('horario.store');
Route::put('/horario/{horario}', [HorarioController::class, 'update'])->name('horario.update');
Route::delete('/horario/{horario}', [HorarioController::class, 'destroy'])->name('horario.destroy');
