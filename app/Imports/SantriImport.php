<?php

namespace App\Imports;

use App\Models\Santri;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SantriImport implements ToModel, WithHeadingRow
{
    protected $idAsrama;

    public function __construct($idAsrama)
    {
        $this->idAsrama = $idAsrama;
    }

    public function model(array $row)
    {
        if (Santri::where('nis', $row['nis'])->exists()) {
            return null;
        }

        return new Santri([
            'nis' => $row['nis'],
            'nama_santri' => $row['nama_santri'],
            'alamat' => $row['alamat'],
            'id_asrama' => $this->idAsrama,
            'total_paket_diterima' => $row['total_paket_diterima'] ?? 0,
        ]);
    }
}
