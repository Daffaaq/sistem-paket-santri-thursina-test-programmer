<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class UsersExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * Mendapatkan data untuk diekspor.
     */
    public function collection()
    {
        // Mengambil semua data user
        return User::all();
    }

    /**
     * Menambahkan Heading (Judul kolom) di file Excel.
     */
    public function headings(): array
    {
        return [
            'ID',  // Kolom ID
            'Name',
            'Username',
            'Email',
            'Email Verified At',
            'Created At',
            'Updated At'
        ];
    }

    /**
     * Memetakan data agar ID menggunakan nomor urut (1, 2, 3, dst)
     */
    public function map($user): array
    {
        static $index = 1; // Static variable untuk nomor ID yang berurutan

        return [
            $index++, // ID yang akan bertambah setiap kali
            $user->name,
            $user->username,
            $user->email,
            $user->email_verified_at,
            $user->created_at,
            $user->updated_at
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
