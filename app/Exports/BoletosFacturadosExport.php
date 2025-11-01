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

class BoletosFacturadosExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithTitle, WithStyles, WithEvents
{
    protected $fechaInicio;
    protected $fechaFin;
    protected $data;

    public function __construct($fechaInicio, $fechaFin)
    {
        $this->fechaInicio = $fechaInicio;
        $this->fechaFin = $fechaFin;
        $this->data = $this->getData();
    }

    /**
     * Obtener los datos para el reporte
     */
    private function getData()
    {
        // Consulta para obtener boletos facturados en el período
        return \DB::table('boletos as b')
            ->leftJoin('pasajeros as p', 'b.IdPasajero', '=', 'p.IdPasajero')
            ->leftJoin('vuelo as v', 'b.IdVuelo', '=', 'v.IdVuelo')
            ->select(
                'b.IdBoleto',
                'p.Nombre',
                'p.Apellido',
                'b.IdVuelo',
                'b.FechaCompra',
                'b.Precio'
            )
            ->whereBetween('b.FechaCompra', [$this->fechaInicio, $this->fechaFin])
            ->orderBy('b.FechaCompra', 'desc')
            ->get();
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
            'ID Boleto',
            'Cliente',
            'Vuelo',
            'Fecha Compra',
            'Precio'
        ];
    }

    /**
     * Mapear los datos para cada fila
     */
    public function map($boleto): array
    {
        return [
            $boleto->IdBoleto,
            $boleto->Nombre . ' ' . $boleto->Apellido,
            'Vuelo ' . $boleto->IdVuelo,
            \Carbon\Carbon::parse($boleto->FechaCompra)->format('d/m/Y H:i'),
            '$' . number_format($boleto->Precio, 2)
        ];
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'Boletos Facturados - ' . \Carbon\Carbon::parse($this->fechaInicio)->format('d/m/Y') . ' a ' . \Carbon\Carbon::parse($this->fechaFin)->format('d/m/Y');
    }

    /**
     * Aplicar estilos a la hoja de Excel
     */
    public function styles(Worksheet $sheet)
    {
        $lastRow = $this->data->count() + 1; // +1 por el encabezado

        // Estilo para el encabezado
        $sheet->getStyle('A1:E1')->applyFromArray([
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
        $sheet->getStyle('A1:E' . $lastRow)->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
        ]);

        // Ajustar ancho de columnas automáticamente
        foreach (range('A', 'E') as $column) {
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
                $sheet->setCellValue('A' . $summaryRow, 'Total de boletos mostrados:');
                $sheet->setCellValue('B' . $summaryRow, $this->data->count());
                $sheet->setCellValue('A' . ($summaryRow + 1), 'Período del reporte:');
                $sheet->setCellValue('B' . ($summaryRow + 1), \Carbon\Carbon::parse($this->fechaInicio)->format('d/m/Y') . ' - ' . \Carbon\Carbon::parse($this->fechaFin)->format('d/m/Y'));

                // Calcular total de ingresos
                $totalIngresos = $this->data->sum('Precio');
                $sheet->setCellValue('A' . ($summaryRow + 2), 'Total de ingresos:');
                $sheet->setCellValue('B' . ($summaryRow + 2), '$' . number_format($totalIngresos, 2));

                // Estilo para las filas de resumen
                $sheet->getStyle('A' . $summaryRow . ':B' . ($summaryRow + 2))->applyFromArray([
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
