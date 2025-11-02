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

Route::get('/', [HomeController::class, 'index'])->name('home')->middleware('auth');

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

     
    // Aerolíneas - ✅ ORDEN CORRECTO
    Route::get('/aerolinea/Listar', [AerolineaController::class, 'Listar'])->name('aerolinea.Listar');
    Route::get('/aerolinea/create', [AerolineaController::class, 'create'])->name('aerolinea.create');
    Route::post('/aerolinea', [AerolineaController::class, 'store'])->name('aerolinea.store');
    Route::get('/aerolinea/{aerolinea}/edit', [AerolineaController::class, 'edit'])->name('aerolinea.edit');
    Route::get('/aerolinea/{aerolinea}/delete', [AerolineaController::class, 'delete'])->name('aerolinea.delete');
    Route::put('/aerolinea/{aerolinea}', [AerolineaController::class, 'update'])->name('aerolinea.update');
    Route::delete('/aerolinea/{aerolinea}', [AerolineaController::class, 'destroy'])->name('aerolinea.destroy');
    Route::get('/aerolinea/{aerolinea}', [AerolineaController::class, 'show'])->name('aerolinea.show');
    Route::get('/aerolinea', [AerolineaController::class, 'Listar'])->name('aerolineas.index');
    // Route::get('/pagos', [PagoController::class, 'index'])->name('pagos.index');

    // Personal
    Route::get('/personal/Listar', [PersonalController::class, 'Listar'])->name('personal.listar');
    Route::get('/personal/create', [PersonalController::class, 'create'])->name('personal.create');
    Route::post('/personal/store', [PersonalController::class, 'store'])->name('personal.store');
    Route::get('/personal/{personal}/edit', [PersonalController::class, 'edit'])->name('personal.edit');
    Route::get('/personal/{personal}/delete', [PersonalController::class, 'delete'])->name('personal.delete');
    Route::put('/personal/update/{personal}', [PersonalController::class, 'update'])->name('personal.update');
    Route::delete('/personal/destroy/{personal}', [PersonalController::class, 'destroy'])->name('personal.destroy');
    Route::get('/personal/{personal}', [PersonalController::class, 'show'])->name('personal.show');

     
});

Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// =====================================================
// RUTAS DE ADMIN, CLIENTE Y OPERADOR
// =====================================================
Route::middleware(['auth', 'role:admin|cliente|operador'])->group(function () {
    // Aviones
    Route::get('/avion/Listar', [AvionController::class, 'Listar'])->name('avion.listar');
    Route::get('/avion/create', [AvionController::class, 'create'])->name('avion.create');
    Route::post('/avion/store', [AvionController::class, 'store'])->name('avion.store');
    Route::get('/avion/{avion}/edit', [AvionController::class, 'edit'])->name('avion.edit');
    Route::put('/avion/update/{avion}', [AvionController::class, 'update'])->name('avion.update');
    Route::delete('/avion/destroy/{avion}', [AvionController::class, 'destroy'])->name('avion.destroy');
    Route::get('/avion/{avion}', [AvionController::class, 'show'])->name('avion.show');

    // Aeropuertos - ✅ ORDEN CORRECTO
    Route::get('aeropuerto/Listar', [AeropuertoController::class, 'Listar'])->name('aeropuerto.listar');
    Route::get('aeropuerto/create', [AeropuertoController::class, 'create'])->name('aeropuerto.create');
    Route::post('/aeropuerto/store', [AeropuertoController::class, 'store'])->name('aeropuerto.store');
    Route::get('aeropuerto/{aeropuerto}/edit', [AeropuertoController::class, 'edit'])->name('aeropuerto.edit');
    Route::get('aeropuerto/{aeropuerto}/delete', [AeropuertoController::class, 'delete'])->name('aeropuerto.delete');
    Route::put('/aeropuerto/update/{aeropuerto}', [AeropuertoController::class, 'update'])->name('aeropuerto.update');
    Route::delete('/aeropuerto/destroy/{aeropuerto}', [AeropuertoController::class, 'destroy'])->name('aeropuerto.destroy');
    Route::get('aeropuerto/{aeropuerto}', [AeropuertoController::class, 'show'])->name('aeropuerto.show');
    Route::get('/aeropuertos', [AeropuertoController::class, 'Listar'])->name('aeropuertos.index');

    // Asientos - ✅ ORDEN CORRECTO
    Route::get('/asientos/available-seats', [AsientoController::class, 'getAvailableSeats'])->name('asientos.available-seats');
    Route::resource('asientos', AsientoController::class);

});

// =====================================================
// RUTAS COMPARTIDAS: CLIENTE Y OPERADOR
// =====================================================
Route::middleware(['auth', 'role:cliente|operador'])->group(function () {
    
   
    // Formularios de creación
    Route::get('/boletos/create', [BoletoController::class, 'create'])->name('boletos.create');
    Route::get('/equipajes/create', [EquipajeController::class, 'create'])->name('equipajes.create');
    Route::get('/servicios/create', [ServicioController::class, 'create'])->name('servicios.create');
    Route::get('/reservas/create', [ReservaController::class, 'create'])->name('reservas.create');
   

    // Vuelos disponibles
    Route::get('/vuelos/disponibles', [VueloController::class, 'listarDisponibles'])->name('vuelos.disponibles');
    Route::post('/vuelos/disponibles', [VueloController::class, 'listarDisponibles'])->name('vuelos.disponibles.post');

    // Pasajeros
    Route::get('/pasajeros/create', [PasajeroController::class, 'create'])->name('pasajeros.create');
    Route::post('/pasajeros', [PasajeroController::class, 'store'])->name('pasajeros.store');

    // Boletos
    Route::post('/boletos', [BoletoController::class, 'store'])->name('boletos.store');
    Route::get('/boletos/{boleto}/pdf', [BoletoController::class, 'generatePdf'])->name('boletos.pdf');

    // Equipajes
    Route::post('/equipajes', [EquipajeController::class, 'store'])->name('equipajes.store');

    // Servicios
    Route::post('/servicios', [ServicioController::class, 'store'])->name('servicios.store');

    
    // Tipo de Servicios
    Route::resource('tipo_servicios', TipoServicioController::class);

    // Reservas
    Route::post('/reservas', [ReservaController::class, 'store'])->name('reservas.store');
    Route::get('/reservas/{reserva}/pdf', [ReservaController::class, 'generatePdf'])->name('reservas.pdf');

    // Pagos
    Route::get('/pagos/create', [PagoController::class, 'create'])->name('pagos.create');
    Route::post('/pagos', [PagoController::class, 'store'])->name('pagos.store');
    Route::get('/pagos/success', [PagoController::class, 'success'])->name('pagos.success');
    Route::get('/pagos/{pago}', [PagoController::class, 'show'])->name('pagos.show');
     
    // Facturas PDF
    Route::get('/facturas/create', [FacturaController::class, 'create'])->name('facturas.create');
    Route::get('/facturas/{factura}/pdf', [FacturaController::class, 'generatePdf'])->name('facturas.pdf');
});

// =====================================================
// RUTAS ADMIN Y OPERADOR
// =====================================================
Route::middleware(['auth', 'role:admin|operador'])->group(function () {
    // Horarios - ✅ ORDEN CORRECTO
    Route::get('/horario/Listar', [HorarioController::class, 'Listar'])->name('horario.listar');
    Route::get('/horario/create', [HorarioController::class, 'create'])->name('horario.create');
    Route::post('/horario', [HorarioController::class, 'store'])->name('horario.store');
    Route::get('/horario/{horario}/edit', [HorarioController::class, 'edit'])->name('horario.edit');
    Route::get('/horario/{horario}/delete', [HorarioController::class, 'delete'])->name('horario.delete');
    Route::put('/horario/{horario}', [HorarioController::class, 'update'])->name('horario.update');
    Route::delete('/horario/{horario}', [HorarioController::class, 'destroy'])->name('horario.destroy');
    Route::get('/horario/{horario}', [HorarioController::class, 'show'])->name('horario.show');
    Route::get('/horario', [HorarioController::class, 'index'])->name('horario.index');

    Route::get('/pagos', [PagoController::class, 'index'])->name('pagos.index');
    // Escalas - ✅ ORDEN CORRECTO
    Route::get('/escala/Listar', [EscalaController::class, 'index'])->name('escala.index');
    Route::get('/escala/create', [EscalaController::class, 'create'])->name('escala.create');
    Route::post('/escala', [EscalaController::class, 'store'])->name('escala.store');
    Route::get('/escala/{escala}/edit', [EscalaController::class, 'edit'])->name('escala.edit');
    Route::put('/escala/{escala}', [EscalaController::class, 'update'])->name('escala.update');
    Route::delete('/escala/{escala}', [EscalaController::class, 'destroy'])->name('escala.destroy');
    Route::get('/escala/{escala}', [EscalaController::class, 'show'])->name('escala.show');

    // Vistas de recursos
    Route::get('/boletos/index', [BoletoController::class, 'index'])->name('boletos.index');
    Route::get('/boletos/{boleto}', [BoletoController::class, 'show'])->name('boletos.show');
        // Boletos
    Route::get('/boletos/{boleto}/edit', [BoletoController::class, 'edit'])->name('boletos.edit');
    Route::put('/boletos/{boleto}', [BoletoController::class, 'update'])->name('boletos.update');
    Route::delete('/boletos/{boleto}', [BoletoController::class, 'destroy'])->name('boletos.destroy');


    Route::get('/equipajes/index', [EquipajeController::Class, 'index'])->name('equipajes.index');
    Route::get('/equipajes/{equipaje}', [EquipajeController::class, 'show'])->name('equipajes.show');

    Route::get('/facturas/index', [FacturaController::class, 'index'])->name('facturas.index');
    Route::get('/facturas/{factura}', [FacturaController::class, 'show'])->name('facturas.show');

    Route::get('/pasajeros', [PasajeroController::class, 'index'])->name('pasajeros.index');
    Route::get('pasajeros/{pasajero}', [PasajeroController::class, 'show'])->name('pasajeros.show');

    

    Route::get('/reservas', [ReservaController::class, 'index'])->name('reservas.index');
    Route::get('/reservas/{reserva}', [ReservaController::class, 'show'])->name('reservas.show');

    Route::get('/servicios', [ServicioController::class, 'index'])->name('servicios.index');
    Route::get('/servicios/{servicio}', [ServicioController::class, 'show'])->name('servicios.show');

    // Vuelos - ✅ ORDEN CORRECTO
    Route::get('/vuelos', [VueloController::class, 'index'])->name('vuelos.index');
    Route::get('/vuelo/create', [VueloController::class, 'create'])->name('vuelo.create');
    Route::post('/vuelo', [VueloController::class, 'store'])->name('vuelo.store');
    Route::get('/vuelo/{idVuelo}', [VueloController::class, 'show'])->name('vuelo.show');

    // Historial de Vuelos
    Route::get('/historial_vuelos', [HistorialVueloController::class, 'index'])->name('historial_vuelos.index');
    Route::get('/historial_vuelos/{historial_vuelo}', [HistorialVueloController::class, 'show'])->name('historial_vuelos.show');
});

// =====================================================
// RUTAS SOLO OPERADOR
// =====================================================
Route::middleware(['auth', 'role:operador'])->group(function () {
    // Vuelos - ✅ ORDEN CORRECTO
    Route::post('/vuelos/buscar', [VueloController::class, 'buscar'])->name('vuelos.buscar');
    Route::get('/vuelo/{idVuelo}/edit', [VueloController::class, 'edit'])->name('vuelo.edit');
    Route::get('/vuelo/{idVuelo}/delete', [VueloController::class, 'delete'])->name('vuelo.delete');
    Route::get('/vuelo/listar', [VueloController::class, 'index'])->name('vuelo.listar');
    Route::put('/vuelo/{idVuelo}', [VueloController::class, 'update'])->name('vuelo.update');
    Route::delete('/vuelo/{idVuelo}', [VueloController::class, 'destroy'])->name('vuelo.destroy');

    // Pasajeros
    Route::get('/pasajeros/{pasajero}/edit', [PasajeroController::class, 'edit'])->name('pasajeros.edit');
    Route::put('/pasajeros/{pasajero}', [PasajeroController::class, 'update'])->name('pasajeros.update');
    Route::delete('/pasajeros/{pasajero}', [PasajeroController::class, 'destroy'])->name('pasajeros.destroy');
   
    // Reservas
    Route::get('/reservas/{reserva}/edit', [ReservaController::class, 'edit'])->name('reservas.edit');
    Route::put('/reservas/{reserva}', [ReservaController::class, 'update'])->name('reservas.update');
    Route::delete('/reservas/{reserva}', [ReservaController::class, 'destroy'])->name('reservas.destroy');


    // Equipajes
    Route::get('/equipajes/{equipaje}/edit', [EquipajeController::class, 'edit'])->name('equipajes.edit');
    Route::put('/equipajes/{equipaje}', [EquipajeController::class, 'update'])->name('equipajes.update');
    Route::delete('/equipajes/{equipaje}', [EquipajeController::class, 'destroy'])->name('equipajes.destroy');

    // Servicios
    Route::get('/servicios/{servicio}/edit', [ServicioController::class, 'edit'])->name('servicios.edit');
    Route::put('/servicios/{servicio}', [ServicioController::class, 'update'])->name('servicios.update');
    Route::delete('/servicios/{servicio}', [ServicioController::class, 'destroy'])->name('servicios.destroy');

    // Facturas
    Route::post('/facturas', [FacturaController::class, 'store'])->name('facturas.store');
    Route::get('/facturas/{factura}/edit', [FacturaController::class, 'edit'])->name('facturas.edit');
    Route::put('/facturas/{factura}', [FacturaController::class, 'update'])->name('facturas.update');
    Route::delete('/facturas/{factura}', [FacturaController::class, 'destroy'])->name('facturas.destroy');

    // Pagos
    
    Route::get('/pagos/{pago}/edit', [PagoController::class, 'edit'])->name('pagos.edit');
    Route::put('/pagos/{pago}', [PagoController::class, 'update'])->name('pagos.update');
    Route::delete('/pagos/{pago}', [PagoController::class, 'destroy'])->name('pagos.destroy');

    // Historial de Vuelos
    Route::get('/historial_vuelos/create', [HistorialVueloController::class, 'create'])->name('historial_vuelos.create');
    Route::post('/historial_vuelos', [HistorialVueloController::class, 'store'])->name('historial_vuelos.store');
    Route::get('/historial_vuelos/{historial_vuelo}/edit', [HistorialVueloController::class, 'edit'])->name('historial_vuelos.edit');
    Route::put('/historial_vuelos/{historial_vuelo}', [HistorialVueloController::class, 'update'])->name('historial_vuelos.update');
    Route::delete('/historial_vuelos/{historial_vuelo}', [HistorialVueloController::class, 'destroy'])->name('historial_vuelos.destroy');
});
// =====================================================
// RUTAS DE MANTENIMIENTO (OPERADOR Y ADMIN)
// =====================================================
Route::middleware(['auth', 'role:operador|admin'])->group(function () {
    Route::get('/mantenimiento/Listar', [MantenimientoController::class, 'Listar'])->name('mantenimiento.listar');
    Route::get('/mantenimiento/create', [MantenimientoController::class, 'create'])->name('mantenimiento.create');
    Route::post('/mantenimiento', [MantenimientoController::class, 'store'])->name('mantenimiento.store');
    Route::get('/mantenimiento/{mantenimiento}/edit', [MantenimientoController::class, 'edit'])->name('mantenimiento.edit');
    Route::put('/mantenimiento/{mantenimiento}', [MantenimientoController::class, 'update'])->name('mantenimiento.update');
    Route::delete('/mantenimiento/{mantenimiento}', [MantenimientoController::class, 'destroy'])->name('mantenimiento.destroy');
    Route::get('/mantenimiento/{mantenimiento}', [MantenimientoController::class, 'show'])->name('mantenimiento.show');
});

// =====================================================
// RUTAS SOLO CLIENTE
// =====================================================
Route::middleware(['auth', 'role:cliente'])->group(function () {
    Route::get('/cliente/reservas', function() {
        $user = auth()->user();
        $reservas = DB::select('
            SELECT r.*, v.IdVuelo, v.FechaSalida, ao.NombreAeropuerto as aeropuerto_origen, ad.NombreAeropuerto as aeropuerto_destino
            FROM reservas r
            LEFT JOIN vuelo v ON r.idVuelo = v.idVuelo
            LEFT JOIN aeropuerto ao ON v.IdAeropuertoOrigen = ao.IdAeropuerto
            LEFT JOIN aeropuerto ad ON v.IdAeropuertoDestino = ad.IdAeropuerto
            WHERE r.user_id = ?
            ORDER BY r.FechaReserva DESC
        ', [$user->id]);
        return response()->json($reservas);
    });

    Route::get('/cliente/boletos', function() {
        $user = auth()->user();
        $boletos = DB::select('
            SELECT b.*, p.Nombre, p.Apellido, v.IdVuelo, v.FechaSalida,
                   ao.NombreAeropuerto as aeropuerto_origen, ad.NombreAeropuerto as aeropuerto_destino
            FROM boletos b
            LEFT JOIN pasajeros p ON b.idPasajero = p.idPasajero
            LEFT JOIN vuelo v ON b.idVuelo = v.idVuelo
            LEFT JOIN aeropuerto ao ON v.IdAeropuertoOrigen = ao.IdAeropuerto
            LEFT JOIN aeropuerto ad ON v.IdAeropuertoDestino = ad.IdAeropuerto
            WHERE b.user_id = ?
            ORDER BY b.FechaCompra DESC
        ', [$user->id]);
        return response()->json($boletos);
    });

    Route::get('/cliente/facturas', function() {
        $user = auth()->user();
        $facturas = DB::select('
            SELECT f.*, b.idBoleto, p.Nombre, p.Apellido, v.IdVuelo,
                   ao.NombreAeropuerto as aeropuerto_origen, ad.NombreAeropuerto as aeropuerto_destino
            FROM facturas f
            LEFT JOIN boletos b ON f.idBoleto = b.idBoleto
            LEFT JOIN pasajeros p ON b.idPasajero = p.idPasajero
            LEFT JOIN vuelo v ON b.idVuelo = v.idVuelo
            LEFT JOIN aeropuerto ao ON v.IdAeropuertoOrigen = ao.IdAeropuerto
            LEFT JOIN aeropuerto ad ON v.IdAeropuertoDestino = ad.IdAeropuerto
            WHERE f.user_id = ?
            ORDER BY f.FechaEmision DESC
        ', [$user->id]);
        return response()->json($facturas);
    });

    Route::get('/cliente/pagos', function() {
        $user = auth()->user();
        $pagos = DB::select('
            SELECT p.*, r.idReserva, r.idVuelo, r.idPasajero, r.FechaReserva,
                   pas.Nombre, pas.Apellido, v.IdVuelo as vuelo_id,
                   ao.NombreAeropuerto as aeropuerto_origen, ad.NombreAeropuerto as aeropuerto_destino
            FROM pagos p
            LEFT JOIN reservas r ON p.idReserva = r.idReserva
            LEFT JOIN pasajeros pas ON r.idPasajero = pas.idPasajero
            LEFT JOIN vuelo v ON r.idVuelo = v.idVuelo
            LEFT JOIN aeropuerto ao ON v.IdAeropuertoOrigen = ao.IdAeropuerto
            LEFT JOIN aeropuerto ad ON v.IdAeropuertoDestino = ad.IdAeropuerto
            WHERE p.user_id = ?
            ORDER BY p.FechaPago DESC
        ', [$user->id]);
        return response()->json($pagos);
    });
});

require __DIR__.'/auth.php';