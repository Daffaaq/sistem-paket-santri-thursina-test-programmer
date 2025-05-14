<?php

namespace App\Exports;

use App\Models\Paket;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeExport;

class PaketKeluarExport implements FromCollection, WithHeadings, WithMapping, WithEvents
{
    private $rowNumber = 0;
    public function collection()
    {
        return Paket::with(['kategoriPaket', 'penerimaPaket.asrama'])
            ->where('status_paket', 'Diambil')
            ->get();
    }

    /**
     * Format each row of the export.
     *
     * @param  \App\Models\Paket  $paket
     * @return array
     */
    public function map($paket): array
    {
        $this->rowNumber++;
        return [
            $this->rowNumber,
            $paket->nama_paket,
            $paket->tanggal_diterima,
            $paket->kategoriPaket->nama_kategori ?? '-',
            $paket->penerimaPaket->nama_santri ?? '-',
            $paket->penerimaPaket->asrama->nama_asrama ?? '-',
            $paket->pengirim_paket,
            $paket->status_paket,
        ];
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama Paket',
            'Tanggal Diterima',
            'Kategori',
            'Penerima',
            'Asrama',
            'Pengirim',
            'Status',
        ];
    }
    public function registerEvents(): array
    {
        return [
            BeforeExport::class => function () {
                $this->rowNumber = 0;
            },
        ];
    }
}
