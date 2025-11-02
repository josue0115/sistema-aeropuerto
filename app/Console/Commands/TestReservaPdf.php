<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Reserva;
use App\Models\Pasajero;
use App\Models\Vuelo;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class TestReservaPdf extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test-reserva-pdf {id?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test PDF generation for reserva';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $id = $this->argument('id') ?? 1;

        $this->info("Testing PDF generation for reserva ID: {$id}");

        // Obtener reserva
        $reservaData = Reserva::obtenerPorId($id);
        if (empty($reservaData)) {
            $this->error("No se encontró la reserva con ID {$id}");
            return;
        }

        $reserva = $reservaData[0];
        $this->info("Reserva encontrada: {$reserva->idReserva}");

        // Obtener pasajero
        $pasajero = null;
        if ($reserva->idPasajero) {
            $pasajeroData = DB::select('CALL Sp_Consulta_Pasajero(?)', [$reserva->idPasajero]);
            if (!empty($pasajeroData)) {
                $pasajero = $pasajeroData[0];
                $this->info("Pasajero encontrado: {$pasajero->Nombre} {$pasajero->Apellido}");
            }
        }

        // Obtener vuelo
        $vuelo = null;
        if ($reserva->idVuelo) {
            $vueloData = DB::select('
                SELECT v.*, ao.NombreAeropuerto as aeropuerto_origen, ad.NombreAeropuerto as aeropuerto_destino
                FROM vuelo v
                LEFT JOIN aeropuerto ao ON v.IdAeropuertoOrigen = ao.IdAeropuerto
                LEFT JOIN aeropuerto ad ON v.IdAeropuertoDestino = ad.IdAeropuerto
                WHERE v.IdVuelo = ?
            ', [$reserva->idVuelo]);

            if (!empty($vueloData)) {
                $vuelo = $vueloData[0];
                $this->info("Vuelo encontrado: {$vuelo->IdVuelo} - {$vuelo->aeropuerto_origen} a {$vuelo->aeropuerto_destino}");
            }
        }

        // Preparar datos para PDF
        $data = [
            'reserva' => $reserva,
            'pasajero' => $pasajero,
            'vuelo' => $vuelo,
        ];

        try {
            $pdf = Pdf::loadView('reservas.pdf', $data);
            $filename = "reserva_{$id}_test.pdf";
            $pdf->save(storage_path("app/public/{$filename}"));
            $this->info("PDF generado exitosamente: storage/app/public/{$filename}");
        } catch (\Exception $e) {
            $this->error("Error generando PDF: " . $e->getMessage());
        }
    }
}
