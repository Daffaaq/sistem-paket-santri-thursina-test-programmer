<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriPaket extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_kategori';

    // Tentukan nama tabel jika tidak mengikuti konvensi plural
    protected $table = 'kategori_pakets';

    // Tentukan kolom yang boleh diisi (mass assignable)
    protected $fillable = [
        'nama_kategori'
    ];

    // Relasi dengan pakets (one-to-many)
    public function pakets()
    {
        return $this->hasMany(Paket::class, 'id_kategori');
    }
}
