<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paket extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_paket';

    // Tentukan nama tabel jika tidak mengikuti konvensi plural
    protected $table = 'pakets';

    // Tentukan kolom yang boleh diisi (mass assignable)
    protected $fillable = [
        'nama_paket',
        'tanggal_diterima',
        'id_kategori',
        'penerima_paket',
        'pengirim_paket',
        'isi_paket_yang_disita',
        'status_paket'
    ];

    // Relasi dengan kategori paket (belongs to)
    public function kategoriPaket()
    {
        return $this->belongsTo(KategoriPaket::class, 'id_kategori');
    }

    // Relasi dengan santri (belongs to)
    public function penerimaPaket()
    {
        return $this->belongsTo(Santri::class, 'penerima_paket', 'nis');
    }
}
