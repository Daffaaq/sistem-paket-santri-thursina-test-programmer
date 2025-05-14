<?php

namespace App\Exports;

use App\Models\Santri;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class SantriExport implements FromCollection, WithHeadings, WithMapping, WithColumnFormatting
{
    public function collection()
    {
        // Eager load relasi 'asrama' untuk menghindari N+1 query
        return Santri::with('asrama')->get();
    }

    public function map($santri): array
    {
        return [
            $santri->nis,
            $santri->nama_santri,
            $santri->alamat,
            $santri->asrama ? $santri->asrama->nama_asrama : '-',
            (int) $santri->total_paket_diterima, // Data tetap dalam bentuk integer
        ];
    }

    public function headings(): array
    {
        return [
            'NIS',
            'Nama Santri',
            'Alamat',
            'Nama Asrama',
            'Total Paket Diterima'
        ];
    }

    public function columnFormats(): array
    {
        // Memastikan kolom 'Total Paket Diterima' adalah format angka
        return [
            'E' => NumberFormat::FORMAT_NUMBER, // Format angka untuk memastikan nilai 0 ditampilkan
        ];
    }
}
