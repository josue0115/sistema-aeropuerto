<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class DisponibilidadBoletosExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithTitle, WithStyles, WithEvents
{
    protected $fecha;
    protected $idVuelo;
    protected $data;

    public function __construct($fecha, $idVuelo = null)
    {
        $this->fecha = $fecha;
        $this->idVuelo = $idVuelo;
        $this->data = $this->getData();
    }

    /**
     * Obtener los datos para el reporte
     */
    private function getData()
    {
        // Consulta para obtener disponibilidad de boletos por vuelo y fecha
        $query = \DB::table('vuelo as v')
            ->leftJoin('boletos as b', 'v.IdVuelo', '=', 'b.IdVuelo')
            ->leftJoin('aeropuerto as ao', 'v.IdAeropuertoOrigen', '=', 'ao.IdAeropuerto')
            ->leftJoin('aeropuerto as ad', 'v.IdAeropuertoDestino', '=', 'ad.IdAeropuerto')
            ->leftJoin('avion as a', 'v.IdAvion', '=', 'a.IdAvion')
            ->select(
                'v.IdVuelo',
                'ao.NombreAeropuerto as origen',
                'ad.NombreAeropuerto as destino',
                'v.FechaSalida',
                'v.FechaLlegada',
                'a.Capacidad',
                \DB::raw('COALESCE(SUM(b.Cantidad), 0) as boletos_vendidos'),
                \DB::raw('a.Capacidad - COALESCE(SUM(b.Cantidad), 0) as boletos_disponibles')
            )
            ->whereDate('v.FechaSalida', '=', $this->fecha)
            ->groupBy('v.IdVuelo', 'ao.NombreAeropuerto', 'ad.NombreAeropuerto', 'v.FechaSalida', 'v.FechaLlegada', 'a.Capacidad');

        if ($this->idVuelo) {
            $query->where('v.IdVuelo', '=', $this->idVuelo);
        }

        return $query->get();
    }

    /**
     * @return Collection
     */
    public function collection()
    {
        return $this->data;
    }

    /**
     * Encabezados de las columnas
     */
    public function headings(): array
    {
        return [
            'ID Vuelo',
            'Origen',
            'Destino',
            'Fecha Salida',
            'Fecha Llegada',
            'Capacidad Total',
            'Boletos Vendidos',
            'Boletos Disponibles'
        ];
    }

    /**
     * Mapear los datos para cada fila
     */
    public function map($vuelo): array
    {
        return [
            $vuelo->IdVuelo,
            $vuelo->origen,
            $vuelo->destino,
            \Carbon\Carbon::parse($vuelo->FechaSalida)->format('d/m/Y H:i'),
            \Carbon\Carbon::parse($vuelo->FechaLlegada)->format('d/m/Y H:i'),
            $vuelo->Capacidad,
            $vuelo->boletos_vendidos,
            $vuelo->boletos_disponibles
        ];
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'Disponibilidad de Boletos - ' . $this->fecha;
    }

    /**
     * Aplicar estilos a la hoja de Excel
     */
    public function styles(Worksheet $sheet)
    {
        $lastRow = $this->data->count() + 1; // +1 por el encabezado

        // Estilo para el encabezado
        $sheet->getStyle('A1:H1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => '4F81BD'],
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
        ]);

        // Bordes para todas las celdas de datos
        $sheet->getStyle('A1:H' . $lastRow)->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
        ]);

        // Ajustar ancho de columnas automáticamente
        foreach (range('A', 'H') as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }

        return [];
    }

    /**
     * Registrar eventos para el archivo Excel
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $sheet = $event->sheet;
                $lastRow = $this->data->count() + 1; // +1 por el encabezado

                // Agregar fila de resumen al final
                $summaryRow = $lastRow + 2;
                $sheet->setCellValue('A' . $summaryRow, 'Total de vuelos mostrados:');
                $sheet->setCellValue('B' . $summaryRow, $this->data->count());
                $sheet->setCellValue('A' . ($summaryRow + 1), 'Fecha del reporte:');
                $sheet->setCellValue('B' . ($summaryRow + 1), \Carbon\Carbon::parse($this->fecha)->format('d/m/Y'));

                // Estilo para las filas de resumen
                $sheet->getStyle('A' . $summaryRow . ':B' . ($summaryRow + 1))->applyFromArray([
                    'font' => [
                        'bold' => true,
                    ],
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'startColor' => ['rgb' => 'E6E6FA'],
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['rgb' => '000000'],
                        ],
                    ],
                ]);
            },
        ];
    }
}
