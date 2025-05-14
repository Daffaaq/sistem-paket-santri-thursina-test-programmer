<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Santri extends Model
{
    use HasFactory;

    // Jika primary key bukan 'id', harus dideklarasikan
    protected $primaryKey = 'nis';
    public $incrementing = false; // karena NIS bukan integer auto increment
    protected $keyType = 'string';

    // Tentukan nama tabel jika tidak mengikuti konvensi plural
    protected $table = 'santris';

    public function getRouteKeyName()
    {
        return 'nis';
    }

    // Tentukan kolom yang boleh diisi (mass assignable)
    protected $fillable = [
        'nis',
        'nama_santri',
        'alamat',
        'id_asrama',
        'total_paket_diterima'
    ];


    // Relasi dengan asrama (belongs to)
    public function asrama()
    {
        return $this->belongsTo(Asrama::class, 'id_asrama', 'id_asrama');
    }


    // Relasi dengan pakets (one-to-many)
    public function pakets()
    {
        return $this->hasMany(Paket::class, 'penerima_paket', 'nis');
    }
}
