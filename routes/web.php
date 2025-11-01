<?php

use App\Http\Controllers\ProfileController;
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
use App\Http\Controllers\AsientoController;
use App\Http\Controllers\TipoServicioController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AeropuertoController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\ReporteController;

Route::get('/', [HomeController::class, 'index'])->middleware('auth')->name('home');

// =====================================================
// RUTAS DE REPORTES
// =====================================================
Route::middleware(['auth', 'role:operador|admin'])->group(function () {
    Route::get('/reportes', function () {
        return view('reportes');
    })->name('reportes.index');
    Route::get('/reportes/disponibilidad-boletos', [ReporteController::class, 'disponibilidadBoletos'])->name('reportes.disponibilidad-boletos');
    Route::get('/reportes/disponibilidad-boletos/ver', [ReporteController::class, 'verDisponibilidadBoletos'])->name('reportes.disponibilidad-boletos.ver');
    Route::post('/reportes/disponibilidad-boletos/generar', [ReporteController::class, 'generarDisponibilidadBoletos'])->name('reportes.disponibilidad-boletos.generar');
    Route::get('/reportes/disponibilidad-boletos/exportar', [ReporteController::class, 'exportarDisponibilidadBoletos'])->name('reportes.disponibilidad-boletos.exportar');

    Route::get('/reportes/boletos-facturados', [ReporteController::class, 'boletosFacturados'])->name('reportes.boletos-facturados');
    Route::get('/reportes/boletos-facturados/ver', [ReporteController::class, 'verBoletosFacturados'])->name('reportes.boletos-facturados.ver');
    Route::post('/reportes/boletos-facturados/generar', [ReporteController::class, 'generarBoletosFacturados'])->name('reportes.boletos-facturados.generar');
    Route::get('/reportes/boletos-facturados/exportar', [ReporteController::class, 'exportarBoletosFacturados'])->name('reportes.boletos-facturados.exportar');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// =====================================================
// RUTAS DE ADMIN
// =====================================================
Route::middleware(['auth', 'role:admin'])->group(function () {
    // Aeropuertos
    Route::get('aeropuerto/Listar', [AeropuertoController::class, 'Listar'])->name('aeropuerto.listar');
    Route::get('/aeropuertos', [AeropuertoController::class, 'Listar'])->name('aeropuertos.index');
    Route::get('aeropuerto/create', [AeropuertoController::class, 'create'])->name('aeropuerto.create');
    Route::get('aeropuerto/{aeropuerto}', [AeropuertoController::class, 'show'])->name('aeropuerto.show');
    Route::get('aeropuerto/{aeropuerto}/edit', [AeropuertoController::class, 'edit'])->name('aeropuerto.edit');
    Route::get('aeropuerto/{aeropuerto}/delete', [AeropuertoController::class, 'delete'])->name('aeropuerto.delete');
    Route::post('/aeropuerto/store', [AeropuertoController::class, 'store'])->name('aeropuerto.store');
    Route::put('/aeropuerto/update/{aeropuerto}', [AeropuertoController::class, 'update'])->name('aeropuerto.update');
    Route::delete('/aeropuerto/destroy/{aeropuerto}', [AeropuertoController::class, 'destroy'])->name('aeropuerto.destroy');

    // Aerolíneas
    Route::get('/aerolinea/Listar', [AerolineaController::class, 'Listar'])->name('aerolinea.Listar');
    Route::get('/aerolinea', [AerolineaController::class, 'Listar'])->name('aerolineas.index');
    Route::get('/aerolinea/create', [AerolineaController::class, 'create'])->name('aerolinea.create');
    Route::post('/aerolinea', [AerolineaController::class, 'store'])->name('aerolinea.store');
    Route::get('/aerolinea/{aerolinea}', [AerolineaController::class, 'show'])->name('aerolinea.show');
    Route::get('/aerolinea/{aerolinea}/edit', [AerolineaController::class, 'edit'])->name('aerolinea.edit');
    Route::put('/aerolinea/{aerolinea}', [AerolineaController::class, 'update'])->name('aerolinea.update');
    Route::delete('/aerolinea/{aerolinea}', [AerolineaController::class, 'delete'])->name('aerolinea.delete');

    // Aviones
    Route::get('/avion/Listar', [AvionController::class, 'Listar'])->name('avion.listar');
    Route::get('/avion/create', [AvionController::class, 'create'])->name('avion.create');
    Route::post('/avion/store', [AvionController::class, 'store'])->name('avion.store');
    Route::get('/avion/{avion}', [AvionController::class, 'show'])->name('avion.show');
    Route::get('/avion/{avion}/edit', [AvionController::class, 'edit'])->name('avion.edit');
    Route::put('/avion/update/{avion}', [AvionController::class, 'update'])->name('avion.update');
    Route::delete('/avion/destroy/{avion}', [AvionController::class, 'destroy'])->name('avion.destroy');

    // Route::get('/asientos/index', [AsientoController::class, 'index'])->name('asientos.index');

    // Personal
    Route::get('/personal/Listar', [PersonalController::class, 'Listar'])->name('personal.listar');
    Route::get('/personal/create', [PersonalController::class, 'create'])->name('personal.create');
    Route::post('/personal/store', [PersonalController::class, 'store'])->name('personal.store');
    Route::get('/personal/{personal}', [PersonalController::class, 'show'])->name('personal.show');
    Route::get('/personal/{personal}/edit', [PersonalController::class, 'edit'])->name('personal.edit');
    Route::put('/personal/update/{personal}', [PersonalController::class, 'update'])->name('personal.update');
    Route::delete('/personal/destroy/{personal}', [PersonalController::class, 'destroy'])->name('personal.destroy');

    // Mantenimiento
    Route::get('/mantenimiento/Listar', [MantenimientoController::class, 'Listar'])->name('mantenimiento.listar');
    Route::get('/mantenimiento/create', [MantenimientoController::class, 'create'])->name('mantenimiento.create');
    Route::post('/mantenimiento/store', [MantenimientoController::class, 'store'])->name('mantenimiento.store');
    Route::get('/mantenimiento/{mantenimiento}', [MantenimientoController::class, 'show'])->name('mantenimiento.show');
    Route::get('/mantenimiento/{mantenimiento}/edit', [MantenimientoController::class, 'edit'])->name('mantenimiento.edit');
    Route::put('/mantenimiento/update/{mantenimiento}', [MantenimientoController::class, 'update'])->name('mantenimiento.update');
    Route::delete('/mantenimiento/destroy/{mantenimiento}', [MantenimientoController::class, 'destroy'])->name('mantenimiento.destroy');

    // Horarios
    Route::get('/horario/Listar', [HorarioController::class, 'Listar'])->name('horario.listar');
    Route::get('/horario/create', [HorarioController::class, 'create'])->name('horario.create');
    Route::get('/horario/{horario}', [HorarioController::class, 'show'])->name('horario.show');
    Route::get('/horario/{horario}/edit', [HorarioController::class, 'edit'])->name('horario.edit');
    Route::get('/horario/{horario}/delete', [HorarioController::class, 'delete'])->name('horario.delete');
    Route::post('/horario', [HorarioController::class, 'store'])->name('horario.store');
    Route::put('/horario/{horario}', [HorarioController::class, 'update'])->name('horario.update');
    Route::delete('/horario/{horario}', [HorarioController::class, 'destroy'])->name('horario.destroy');
    Route::get('/horario', [HorarioController::class, 'index'])->name('horario.index');

    // Escalas
    Route::get('/escala/Listar', [EscalaController::class, 'index'])->name('escala.index');
    Route::get('/escala/create', [EscalaController::class, 'create'])->name('escala.create');
    Route::post('/escala', [EscalaController::class, 'store'])->name('escala.store');
    Route::get('/escala/{escala}', [EscalaController::class, 'show'])->name('escala.show');
    Route::get('/escala/{escala}/edit', [EscalaController::class, 'edit'])->name('escala.edit');
    Route::put('/escala/{escala}', [EscalaController::class, 'update'])->name('escala.update');
    Route::delete('/escala/{escala}', [EscalaController::class, 'destroy'])->name('escala.destroy');
});

// =====================================================
// RUTAS COMPARTIDAS: CLIENTE Y OPERADOR
// =====================================================
Route::middleware(['auth', 'role:cliente|operador'])->group(function () {
    // Vistas de creación (formularios)

    Route::get('/pasajeros/create', [PasajeroController::class, 'create'])->name('pasajeros.create');
    Route::get('/boletos/create', [BoletoController::class, 'create'])->name('boletos.create');
    Route::get('/equipajes/create', [EquipajeController::class, 'create'])->name('equipajes.create');
    Route::get('/servicios/create', [ServicioController::class, 'create'])->name('servicios.create');
    Route::get('/reservas/create', [ReservaController::class, 'create'])->name('reservas.create');
    Route::get('/pagos/create', [PagoController::class, 'create'])->name('pagos.create');

    Route::post('/vuelos/disponibles', [VueloController::class, 'listarDisponibles'])->name('vuelos.disponibles.post');
   Route::get('/vuelos/disponibles', [VueloController::class, 'listarDisponibles'])->name('vuelos.disponibles');

    //Route::post('/vuelos/disponibles', [VueloController::class, 'listarDisponibles'])->name('vuelos.disponibles.post');

    // Pasajeros
    Route::post('/pasajeros', [PasajeroController::class, 'store'])->name('pasajeros.store');
    Route::get('/pasajeros/{pasajero}', [PasajeroController::class, 'show'])->name('pasajeros.show');
    Route::get('/pasajeros', [PasajeroController::class, 'index'])->name('pasajeros.index');

    // Boletos
    Route::post('/boletos', [BoletoController::class, 'store'])->name('boletos.store');
    Route::get('/boletos/{boleto}/pdf', [BoletoController::class, 'generatePdf'])->name('boletos.pdf');

    // Equipajes
    Route::post('/equipajes', [EquipajeController::class, 'store'])->name('equipajes.store');

    // Servicios
    Route::post('/servicios', [ServicioController::class, 'store'])->name('servicios.store');

    // Asientos
    //Route::resource('asientos', AsientoController::class)->except(['create']);

    // Tipo de Servicios
    Route::resource('tipo_servicios', TipoServicioController::class);
     // Asientos
    Route::get('/asientos/available-seats', [AsientoController::class, 'getAvailableSeats'])->name('asientos.available-seats');
    Route::get('/asientos/create', [AsientoController::class, 'create'])->name('asientos.create');
    Route::resource('asientos', AsientoController::class)->except(['create']);

    // Reservas
    Route::post('/reservas', [ReservaController::class, 'store'])->name('reservas.store');

    // Pagos
    Route::post('/pagos', [PagoController::class, 'store'])->name('pagos.store');
    Route::get('/pagos/success', [PagoController::class, 'success'])->name('pagos.success');

    // Facturas PDF
    Route::get('/facturas/{factura}/pdf', [FacturaController::class, 'generatePdf'])->name('facturas.pdf');
});

// =====================================================
// RUTAS SOLO OPERADOR
// =====================================================
Route::middleware(['auth', 'role:operador'])->group(function () {
    // Vuelos

        // ✅ Orden correcto
        Route::get('/vuelos', [VueloController::class, 'index'])->name('vuelos.index');
        Route::post('/vuelos/buscar', [VueloController::class, 'buscar'])->name('vuelos.buscar');
        Route::get('/vuelo/create', [VueloController::class, 'create'])->name('vuelo.create');
        Route::post('/vuelo', [VueloController::class, 'store'])->name('vuelo.store');
        Route::get('/vuelo/{idVuelo}', [VueloController::class, 'show'])->name('vuelo.show');
        Route::get('/vuelo/{idVuelo}/edit', [VueloController::class, 'edit'])->name('vuelo.edit');
        Route::put('/vuelo/{idVuelo}', [VueloController::class, 'update'])->name('vuelo.update');
        Route::get('/vuelo/{idVuelo}/delete', [VueloController::class, 'delete'])->name('vuelo.delete');
        Route::delete('/vuelo/{idVuelo}', [VueloController::class, 'destroy'])->name('vuelo.destroy');

 //   Route::get('/pasajeros/create', [PasajeroController::class, 'create'])->name('pasajeros.create.operador');
    Route::get('/pasajeros/{pasajero}/edit', [PasajeroController::class, 'edit'])->name('pasajeros.edit');
    Route::put('/pasajeros/{pasajero}', [PasajeroController::class, 'update'])->name('pasajeros.update');
    Route::delete('/pasajeros/{pasajero}', [PasajeroController::class, 'destroy'])->name('pasajeros.destroy');

    // Reservas
    Route::get('/reservas', [ReservaController::class, 'index'])->name('reservas.index');
    Route::get('/reservas/{reserva}', [ReservaController::class, 'show'])->name('reservas.show');
    Route::get('/reservas/{reserva}/edit', [ReservaController::class, 'edit'])->name('reservas.edit');
    Route::put('/reservas/{reserva}', [ReservaController::class, 'update'])->name('reservas.update');
    Route::delete('/reservas/{reserva}', [ReservaController::class, 'destroy'])->name('reservas.destroy');

    // Boletos
    Route::get('/boletos', [BoletoController::class, 'index'])->name('boletos.index');
    Route::get('/boletos/{boleto}', [BoletoController::class, 'show'])->name('boletos.show');
    Route::get('/boletos/{boleto}/edit', [BoletoController::class, 'edit'])->name('boletos.edit');
    Route::put('/boletos/{boleto}', [BoletoController::class, 'update'])->name('boletos.update');
    Route::delete('/boletos/{boleto}', [BoletoController::class, 'destroy'])->name('boletos.destroy');

    // Equipajes
    Route::get('/equipajes', [EquipajeController::class, 'index'])->name('equipajes.index');
    Route::get('/equipajes/{equipaje}', [EquipajeController::class, 'show'])->name('equipajes.show');
    Route::get('/equipajes/{equipaje}/edit', [EquipajeController::class, 'edit'])->name('equipajes.edit');
    Route::put('/equipajes/{equipaje}', [EquipajeController::class, 'update'])->name('equipajes.update');
    Route::delete('/equipajes/{equipaje}', [EquipajeController::class, 'destroy'])->name('equipajes.destroy');

    // Servicios
    Route::get('/servicios', [ServicioController::class, 'index'])->name('servicios.index');
    Route::get('/servicios/{servicio}', [ServicioController::class, 'show'])->name('servicios.show');
    Route::get('/servicios/{servicio}/edit', [ServicioController::class, 'edit'])->name('servicios.edit');
    Route::put('/servicios/{servicio}', [ServicioController::class, 'update'])->name('servicios.update');
    Route::delete('/servicios/{servicio}', [ServicioController::class, 'destroy'])->name('servicios.destroy');

    // Facturas
    Route::get('/facturas', [FacturaController::class, 'index'])->name('facturas.index');
    Route::get('/facturas/create', [FacturaController::class, 'create'])->name('facturas.create');
    Route::post('/facturas', [FacturaController::class, 'store'])->name('facturas.store');
    Route::get('/facturas/{factura}', [FacturaController::class, 'show'])->name('facturas.show');
    Route::get('/facturas/{factura}/edit', [FacturaController::class, 'edit'])->name('facturas.edit');
    Route::put('/facturas/{factura}', [FacturaController::class, 'update'])->name('facturas.update');
    Route::delete('/facturas/{factura}', [FacturaController::class, 'destroy'])->name('facturas.destroy');

    // Pagos
    Route::get('/pagos', [PagoController::class, 'index'])->name('pagos.index');
    Route::get('/pagos/{pago}', [PagoController::class, 'show'])->name('pagos.show');
    Route::get('/pagos/{pago}/edit', [PagoController::class, 'edit'])->name('pagos.edit');
    Route::put('/pagos/{pago}', [PagoController::class, 'update'])->name('pagos.update');
    Route::delete('/pagos/{pago}', [PagoController::class, 'destroy'])->name('pagos.destroy');

    // Historial de Vuelos
    Route::get('/historial_vuelos', [HistorialVueloController::class, 'index'])->name('historial_vuelos.index');
    Route::get('/historial_vuelos/create', [HistorialVueloController::class, 'create'])->name('historial_vuelos.create');
    Route::post('/historial_vuelos', [HistorialVueloController::class, 'store'])->name('historial_vuelos.store');
    Route::get('/historial_vuelos/{historial_vuelo}', [HistorialVueloController::class, 'show'])->name('historial_vuelos.show');
    Route::get('/historial_vuelos/{historial_vuelo}/edit', [HistorialVueloController::class, 'edit'])->name('historial_vuelos.edit');
    Route::put('/historial_vuelos/{historial_vuelo}', [HistorialVueloController::class, 'update'])->name('historial_vuelos.update');
    Route::delete('/historial_vuelos/{historial_vuelo}', [HistorialVueloController::class, 'destroy'])->name('historial_vuelos.destroy');
});

// =====================================================
// RUTAS SOLO CLIENTE
// =====================================================
Route::middleware(['auth', 'role:cliente'])->group(function () {
    // Rutas para obtener datos del cliente vía AJAX
    Route::get('/cliente/reservas', function() {
        $user = auth()->user();
        $reservas = DB::select('CALL Sp_Consulta_Reserva(NULL)');
        return response()->json(array_filter($reservas, function($reserva) use ($user) {
            return $reserva->idUsuario == $user->id;
        }));
    });

    Route::get('/cliente/boletos', function() {
        $user = auth()->user();
        $boletos = Boleto::listar();
        return response()->json(array_filter($boletos, function($boleto) use ($user) {
            return $boleto->idUsuario == $user->id;
        }));
    });

    Route::get('/cliente/facturas', function() {
        $user = auth()->user();
        $facturas = Factura::listar();
        return response()->json(array_filter($facturas, function($factura) use ($user) {
            return $factura->idUsuario == $user->id;
        }));
    });

    Route::get('/cliente/pagos', function() {
        $user = auth()->user();
        $pagos = Pago::listar();
        return response()->json(array_filter($pagos, function($pago) use ($user) {
            return $pago->idUsuario == $user->id;
        }));
    });
});

require __DIR__.'/auth.php';
