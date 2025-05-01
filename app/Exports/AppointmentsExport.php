<?php

namespace App\Exports;

use App\Models\Appointment;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class AppointmentsExport implements FromQuery, WithMapping, WithHeadings, WithChunkReading, ShouldAutoSize, WithStyles
{
    use Exportable;

    public function query()
    {
        return Appointment::with('user');
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:F1')->getFont()->setBold(true)->setSize(12);
        $sheet->getStyle('A1:F1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
        $sheet->getStyle('A1:F1')->getFill()->getStartColor()->setARGB('FFFF00'); // اللون الأصفر كخلفية

        $sheet->getStyle('E')->getNumberFormat()->setFormatCode('yyyy-mm-dd hh:mm');
        $sheet->getStyle('F')->getNumberFormat()->setFormatCode('yyyy-mm-dd hh:mm');

        $sheet->getStyle('A:F')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        return $sheet;
    }

    public function headings(): array
    {
        return [
            'ID',
            'User Name',
            'Title',
            'Description',
            'Appointment Time',
            'Created At',
        ];
    }

    public function map($appointment): array
    {
        return [
            $appointment->id,
            optional($appointment->user)->name ?? 'N/A',
            $appointment->title,
            $appointment->description,
            date('Y-m-d H:i', strtotime($appointment->appointment_time)),
            $appointment->created_at->format('Y-m-d H:i'),
        ];
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}
