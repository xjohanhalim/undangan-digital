<?php

namespace App\Exports;

use App\Models\Rsvp;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RsvpExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Rsvp::select('name', 'attendance', 'message', 'created_at')->get();
    }

    public function headings(): array
    {
        return [
            'Nama',
            'Kehadiran',
            'Ucapan',
            'Waktu'
        ];
    }
}
